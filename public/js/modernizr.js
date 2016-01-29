/*! modernizr 3.2.0 (Custom Build) | MIT *
 * http://modernizr.com/download/?-audio-flexbox-flexboxlegacy-flexboxtweener-flexwrap !*/
!function(e,n,t){function o(e,n){return typeof e===n}function r(){var e,n,t,r,a,s,i;for(var l in x)if(x.hasOwnProperty(l)){if(e=[],n=x[l],n.name&&(e.push(n.name.toLowerCase()),n.options&&n.options.aliases&&n.options.aliases.length))for(t=0;t<n.options.aliases.length;t++)e.push(n.options.aliases[t].toLowerCase());for(r=o(n.fn,"function")?n.fn():n.fn,a=0;a<e.length;a++)s=e[a],i=s.split("."),1===i.length?Modernizr[i[0]]=r:(!Modernizr[i[0]]||Modernizr[i[0]]instanceof Boolean||(Modernizr[i[0]]=new Boolean(Modernizr[i[0]])),Modernizr[i[0]][i[1]]=r),h.push((r?"":"no-")+i.join("-"))}}function a(e){var n=C.className,t=Modernizr._config.classPrefix||"";if(T&&(n=n.baseVal),Modernizr._config.enableJSClass){var o=new RegExp("(^|\\s)"+t+"no-js(\\s|$)");n=n.replace(o,"$1"+t+"js$2")}Modernizr._config.enableClasses&&(n+=" "+t+e.join(" "+t),T?C.className.baseVal=n:C.className=n)}function s(){return"function"!=typeof n.createElement?n.createElement(arguments[0]):T?n.createElementNS.call(n,"http://www.w3.org/2000/svg",arguments[0]):n.createElement.apply(n,arguments)}function i(e,n){return function(){return e.apply(n,arguments)}}function l(e,n,t){var r;for(var a in e)if(e[a]in n)return t===!1?e[a]:(r=n[e[a]],o(r,"function")?i(r,t||n):r);return!1}function f(e,n){return!!~(""+e).indexOf(n)}function u(e){return e.replace(/([a-z])-([a-z])/g,function(e,n,t){return n+t.toUpperCase()}).replace(/^-/,"")}function c(e){return e.replace(/([A-Z])/g,function(e,n){return"-"+n.toLowerCase()}).replace(/^ms-/,"-ms-")}function d(){var e=n.body;return e||(e=s(T?"svg":"body"),e.fake=!0),e}function p(e,t,o,r){var a,i,l,f,u="modernizr",c=s("div"),p=d();if(parseInt(o,10))for(;o--;)l=s("div"),l.id=r?r[o]:u+(o+1),c.appendChild(l);return a=s("style"),a.type="text/css",a.id="s"+u,(p.fake?p:c).appendChild(a),p.appendChild(c),a.styleSheet?a.styleSheet.cssText=e:a.appendChild(n.createTextNode(e)),c.id=u,p.fake&&(p.style.background="",p.style.overflow="hidden",f=C.style.overflow,C.style.overflow="hidden",C.appendChild(p)),i=t(c,e),p.fake?(p.parentNode.removeChild(p),C.style.overflow=f,C.offsetHeight):c.parentNode.removeChild(c),!!i}function y(n,o){var r=n.length;if("CSS"in e&&"supports"in e.CSS){for(;r--;)if(e.CSS.supports(c(n[r]),o))return!0;return!1}if("CSSSupportsRule"in e){for(var a=[];r--;)a.push("("+c(n[r])+":"+o+")");return a=a.join(" or "),p("@supports ("+a+") { #modernizr { position: absolute; } }",function(e){return"absolute"==getComputedStyle(e,null).position})}return t}function m(e,n,r,a){function i(){c&&(delete E.style,delete E.modElem)}if(a=o(a,"undefined")?!1:a,!o(r,"undefined")){var l=y(e,r);if(!o(l,"undefined"))return l}for(var c,d,p,m,v,g=["modernizr","tspan"];!E.style;)c=!0,E.modElem=s(g.shift()),E.style=E.modElem.style;for(p=e.length,d=0;p>d;d++)if(m=e[d],v=E.style[m],f(m,"-")&&(m=u(m)),E.style[m]!==t){if(a||o(r,"undefined"))return i(),"pfx"==n?m:!0;try{E.style[m]=r}catch(h){}if(E.style[m]!=v)return i(),"pfx"==n?m:!0}return i(),!1}function v(e,n,t,r,a){var s=e.charAt(0).toUpperCase()+e.slice(1),i=(e+" "+P.join(s+" ")+s).split(" ");return o(n,"string")||o(n,"undefined")?m(i,n,r,a):(i=(e+" "+b.join(s+" ")+s).split(" "),l(i,n,t))}function g(e,n,o){return v(e,t,t,n,o)}var h=[],x=[],w={_version:"3.2.0",_config:{classPrefix:"",enableClasses:!0,enableJSClass:!0,usePrefixes:!0},_q:[],on:function(e,n){var t=this;setTimeout(function(){n(t[e])},0)},addTest:function(e,n,t){x.push({name:e,fn:n,options:t})},addAsyncTest:function(e){x.push({name:null,fn:e})}},Modernizr=function(){};Modernizr.prototype=w,Modernizr=new Modernizr;var C=n.documentElement,T="svg"===C.nodeName.toLowerCase();Modernizr.addTest("audio",function(){var e=s("audio"),n=!1;try{(n=!!e.canPlayType)&&(n=new Boolean(n),n.ogg=e.canPlayType('audio/ogg; codecs="vorbis"').replace(/^no$/,""),n.mp3=e.canPlayType('audio/mpeg; codecs="mp3"').replace(/^no$/,""),n.opus=e.canPlayType('audio/ogg; codecs="opus"').replace(/^no$/,""),n.wav=e.canPlayType('audio/wav; codecs="1"').replace(/^no$/,""),n.m4a=(e.canPlayType("audio/x-m4a;")||e.canPlayType("audio/aac;")).replace(/^no$/,""))}catch(t){}return n});var _="Moz O ms Webkit",b=w._config.usePrefixes?_.toLowerCase().split(" "):[];w._domPrefixes=b;var P=w._config.usePrefixes?_.split(" "):[];w._cssomPrefixes=P;var S={elem:s("modernizr")};Modernizr._q.push(function(){delete S.elem});var E={style:S.elem.style};Modernizr._q.unshift(function(){delete E.style}),w.testAllProps=v,w.testAllProps=g,Modernizr.addTest("flexboxlegacy",g("boxDirection","reverse",!0)),Modernizr.addTest("flexbox",g("flexBasis","1px",!0)),Modernizr.addTest("flexboxtweener",g("flexAlign","end",!0)),Modernizr.addTest("flexwrap",g("flexWrap","wrap",!0)),r(),a(h),delete w.addTest,delete w.addAsyncTest;for(var z=0;z<Modernizr._q.length;z++)Modernizr._q[z]();e.Modernizr=Modernizr}(window,document);
