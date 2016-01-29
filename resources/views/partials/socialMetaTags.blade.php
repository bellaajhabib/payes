<meta name="description" content="@yield('description', $description)">

<!-- Open Graph data -->
<meta property="fb:app_id" content="{{ Config::get('services.facebook.client_id') }}"/>
<meta property="og:image" content="@yield('meta.image', isset($image) ? $image : asset('img/fb-share.jpg'))"/>
<meta property="og:title" content="@yield('meta.title', $title)"/>
<meta property="og:url" content="@yield('meta.url', url('/'))"/>
<meta property="og:site_name" content="{{ Config::get('app.name') }}"/>
<meta property="og:type" content="website"/>
<meta property="og:description" content="@yield('meta.description', isset($meta_description) ? $meta_description : $description)"/>

<!-- Twitter Card data -->
<meta name="twitter:card" content="summary">
<meta name="twitter:site" content="@site">
<meta name="twitter:title" content="@yield('meta.title', $title)">
<meta name="twitter:description" content="@yield('meta.description', isset($meta_description) ? $meta_description : $description)">
<meta name="twitter:image" content="@yield('meta.image', isset($image) ? $image : asset('img/fb-share.jpg')))">
