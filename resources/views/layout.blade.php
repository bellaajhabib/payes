<!doctype html>
 <?php
            ?>
<!--[if lt IE 9]>      <html class="no-js lt-ie9" lang="{{ App::getLocale() }}"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="{{ App::getLocale() }}"> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>@yield('title'){{ Config::get('app.name') }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- <meta name="author" content="box.agency" /> -->

    {{--
    @include('partials.socialMetaTags', [
        'title' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit.',
        'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aspernatur debitis, autem numquam totam deleniti recusandae tempore earum dignissimos aperiam neque asperiores molestiae.'
    ])
    --}}

                <!-- Metta CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <!-- Use RealFaviconGenerator.net to generate favicons  -->
    @include('partials.favicon')

    <link rel="stylesheet" href="{{ asset('css/vendor.css') }}">
    <link rel="stylesheet" href="{{ asset(elixir('css/main.css')) }}">
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800&subset=latin,cyrillic-ext,latin-ext' rel='stylesheet' type='text/css'>ld('styles')

    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>

    <![endif]-->

    <script>
        BASE_URL    = '{{ url('/') }}';
        CURRENT_URL = '{{ request()->url() }}';
        APP_ENV     = '{{ app()->environment() }}';
    </script>
    <script src="{{ asset('js/modernizr.js') }}"></script>
</head>
<body class="@yield('class')">
<!--[if lt IE 9]>
<div class="alert alert-dismissible outdated-browser show" role="alert">
    <h6>Votre navigateur est obsolète !</h6>
    <p>Pour afficher correctement ce site et bénéficier d'une expérience optimale, nous vous recommandons de mettre à jour votre navigateur.
        <a href="http://outdatedbrowser.com/fr" class="update-btn" target="_blank">Mettre à jour maintenant </a>
    </p>
    <a href="#" class="close-btn" title="Fermer" data-dismiss="alert" aria-label="Fermer">&times;</a>
</div>
<![endif]-->

<div class="loader">
    <div class="spinner">
        <div class="bounce1"></div>
        <div class="bounce2"></div>
        <div class="bounce3"></div>
    </div>
</div>
<div id="wrapper">
    @include('partials.nav')
    <div id="wrapper">
        @yield('content')
    </div>
</div>


<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">

<script src="{{ asset('js/vendor.js') }}"></script>
<script src="{{ asset(elixir('js/main.js')) }}"></script>
<script src="http://blackrockdigital.github.io/startbootstrap-sb-admin-2/bower_components/datatables/media/js/jquery.dataTables.min.js"></script>
<script src="http://blackrockdigital.github.io/startbootstrap-sb-admin-2/bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js"></script>

@yield('scripts')

            <!-- Google Analytics: change UA-XXXXX-X to be your site's ID. -->
<script>
    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
                    (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
                m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
    })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
    ga('create','UA-XXXXX-X','auto');ga('send','pageview');
</script>


</body>
</html>
