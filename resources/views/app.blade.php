<!DOCTYPE html>
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
    @yield('styles')

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
<body>
	<nav class="navbar navbar-default">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
					<span class="sr-only">Toggle Navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="#">Laravel</a>
			</div>

			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				<ul class="nav navbar-nav">
					<li><a href="/">Home</a></li>
				</ul>

				<ul class="nav navbar-nav navbar-right">
					@if (Auth::guest())
						<li><a href="/auth/login">Login</a></li>
						<li><a href="/auth/register">Register</a></li>
					@else
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">{{ Auth::user()->name }} <span class="caret"></span></a>
							<ul class="dropdown-menu" role="menu">
								<li><a href="/auth/logout">Logout</a></li>
							</ul>
						</li>
					@endif
				</ul>
			</div>
		</div>
	</nav>

	@yield('content')

	<!-- Scripts -->
	<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.1/js/bootstrap.min.js"></script>
</body>
</html>
