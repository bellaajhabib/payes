var facebookUtils = (function($) {

  var accessToken, loginStatus, buttonDefaultText;

  function handleRedirectLogin() {
    var queryString = window.location.hash.substring(1);
    window.location.hash = '';
    var params = queryString.split('&');
    var access_token;

    for (var i in params) {
      var pair = params[i].split("=");
      if (pair[0] == 'access_token')
        access_token = pair[1];
    }

    if ( access_token ) {
      config.targetButton.click();
    }
  }

  var config = {
    appId: null,
    scopes: [],
    requiredScopes : [],
    targetButton: null,
    offline: false,
    customLoginAction: false,
    initComplete: function() {
    },
    onLogin: function() {
    }
  };

  function init(options) {
    $.extend(config, config, options);

    if (config.offline) {
      accessToken = 'flGwmsrRAJPTULmFdeBzOUQnqGOzOwSMIVNmMFQbFmbch';
      loginStatus = 'connected';
      return;
    }

    disableTargetButton();

    $.ajax({
      url: '//connect.facebook.net/fr_FR/sdk.js',
      dataType: "script",
      cache: true
    }).done(function() {
      FB.init({
        appId: config.appId,
        status: true,
        xfbml: true,
        version: 'v2.5'
      });

      FB.getLoginStatus(function(response) {
        loginStatus = response.status;
        if (loginStatus === 'connected') {
          accessToken = response.authResponse.accessToken;
        }
        enableTargetButton();
        handleRedirectLogin();
        config.initComplete();
      });
    });
  }

  function checkPermissions(callback) {
    FB.api('/me/permissions', function(response) {
      var currentPermissions = $.map(response.data, function(item) {
        return item.permission;
      });

      for (var i in config.requiredScopes) {
        var item = currentPermissions.indexOf(config.requiredScopes[i]);
        if ( item == -1 || response.data[item].status === 'declined' ) {
          return callback(false);
        }
      }
      callback(true);
    });
  }

  function handleMissingPermissions(grantedScopes) {
    for (var i in config.requiredScopes) {
      if ( grantedScopes.indexOf(config.requiredScopes[i]) == -1 ) {
        sweetAlert('Permissions requises', 'Pour vous offrir une expérience personnalisée, vous devez autoriser l\'application à accéder à ces informations: ', 'info');
        return false;
      }
    }
    return true;
  }

  function sendLoginRequest() {
    if (config.customLoginAction)
      return config.onLogin(accessToken);

    disableTargetButton();
    $.ajax({
      url: BASE_URL + "/auth/facebookLogin" + (config.offline ? '/offline' : ''),
      method: 'POST',
      data: {access_token: accessToken}
    }).done(function(response) {
      enableTargetButton();
      config.onLogin(response);
    });
  }

  function promptLogin() {
    if ( navigator.userAgent.match('CriOS') ) {
      window.location = 'https://m.facebook.com/dialog/oauth?client_id=' + config.appId + '&redirect_uri=' +
      CURRENT_URL +'&scope=' + config.scopes.join() + '&auth_type=rerequest&response_type=token';
      return;
    }

    FB.login(function(response) {
      if (response.status == 'connected' &&
          response.authResponse &&
          response.authResponse.grantedScopes &&
          handleMissingPermissions( response.authResponse.grantedScopes.split(',') )
      ) {
        accessToken = response.authResponse.accessToken;
        sendLoginRequest();
      }
    }, {
      scope: config.scopes.join(),
      auth_type: 'rerequest',
      return_scopes: true
    });
  }

  function login(onLogin, customLoginAction, permissionNeeded) {
    config.onLogin           = onLogin;
    config.customLoginAction = customLoginAction || false;
    permissionNeeded         = permissionNeeded || false;

    if (loginStatus !== 'connected') {
      return promptLogin();
    }

    if (! permissionNeeded) {
      return sendLoginRequest();
    }
    checkPermissions(function(granted) {
      if (granted) {
        return sendLoginRequest();
      }

      loginStatus = 'missing_permissions';
      promptLogin();
    });
  }

  function fetchUserInfo(callback) {
    if (config.offline) {
      var response = {
        id: 129795977365516,
        name: 'Offline User',
        email: 'offline_user@tfbnw.net'
      };
      return callback(response);
    }

    FB.api('/me?fields=id,name,first_name,last_name,email', function(response) {
      callback(response);
    });
  }

  function share(url, callback) {
    FB.ui({
      method: 'share',
      href: url
    }, callback);
  }

  function feed(params, callback) {
    $.extend(params, { method: 'feed' });
    FB.ui(params, callback);
  }

  function sendAppRequest(message, callback) {
    FB.ui({
      method: 'apprequests',
      message: message
    }, callback);
  }

  function addPageTab() {
    FB.ui({
      method: 'pagetab',
      redirect_uri: CURRENT_URL
    });
  }

  function resizeCanvas(params) {
    // This method is only enabled when Canvas Height is set to "Fluid" in the App Dashboard
    if (!loginStatus) {
      config.initComplete = function() {
        _resizeCanvas(params);
      };
      return;
    }
    _resizeCanvas(params);
  }

  function _resizeCanvas(params) {
    FB.Canvas.setSize({ width: 1, height: 1 });
    setTimeout(function(){
      FB.Canvas.setSize(params);
    }, 1);
  }

  function disableTargetButton() {
    buttonDefaultText = $(config.targetButton).html();
    $(config.targetButton).html('Loading...').prop('disabled', true).addClass('loading');
  }

  function enableTargetButton() {
    $(config.targetButton).html( buttonDefaultText ).prop('disabled', false).removeClass('loading');
  }

  return {
    init: init,
    login: login,
    fetchUserInfo: fetchUserInfo,
    share: share,
    feed: feed,
    sendAppRequest: sendAppRequest,
    resizeCanvas: resizeCanvas
  };
})(jQuery);
