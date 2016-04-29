<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title')</title>

    <!--Icons-->
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">
    <link rel="apple-touch-icon" sizes="57x57" href="{{ asset('assets/icons/apple-icon-57x57.png') }}">
    <link rel="apple-touch-icon" sizes="60x60" href="{{ asset('assets/icons/apple-icon-60x60.png') }}">
    <link rel="apple-touch-icon" sizes="72x72" href="{{ asset('assets/icons/apple-icon-72x72.png') }}">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('assets/icons/apple-icon-76x76.png') }}">
    <link rel="apple-touch-icon" sizes="114x114" href="{{ asset('assets/icons/apple-icon-114x114.png') }}">
    <link rel="apple-touch-icon" sizes="120x120" href="{{ asset('assets/icons/apple-icon-120x120.png') }}">
    <link rel="apple-touch-icon" sizes="144x144" href="{{ asset('assets/icons/apple-icon-144x144.png') }}">
    <link rel="apple-touch-icon" sizes="152x152" href="{{ asset('assets/icons/apple-icon-152x152.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('assets/icons/apple-icon-180x180.png') }}">
    <link rel="icon" type="image/png" sizes="192x192"  href="{{ asset('assets/icons/android-icon-192x192.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('assets/icons/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="96x96" href="{{ asset('assets/icons/favicon-96x96.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets/icons/favicon-16x16.png') }}">
    <link rel="shortcut icon" href="{{ asset('assets/icons/favicon.ico') }}">
    <link rel="manifest" href="{{ asset('assets/icons/manifest.json') }}">

    <!-- Fonts -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css" rel='stylesheet' type='text/css'>
    <link href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700" rel='stylesheet' type='text/css'>

    <!-- Styles -->
    {!! Html::style('assets/css/bootstrap.css') !!}
    {!! Html::style('assets/css/main.css') !!}

    @yield('styles')

</head>
<body id="app-layout">
    <nav class="navbar navbar-default navbar-static-top">
        <div class="container">
            <div class="navbar-header">

                <!-- Collapsed Hamburger -->
                <button type="button" class="navbar-toggle collapsed custom-navbar-toggle" data-toggle="collapse" data-target="#app-navbar-collapse">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <!-- Branding Image -->
                <a class="navbar-brand custom-brand" href="{{ url('/') }}">
                    {!! Html::image('assets/images/logo.png') !!}
                </a>
            </div>

            @include('front.partials.search')

            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right custom-menu">
                    <li><a href="{{ route('index') }}">GALERÍA</a></li>
                    <li class="dropdown">
                        <a class="dropdown-toggle" id="categoriesMenu" href="javascript:;" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                            CATEGOR&Iacute;AS <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="categoriesMenu">
                            <?php $categories = \LogoStore\Category::get(['id', 'name']) ?>
                            @foreach($categories as $category)
                                <li><a href="{{ route('category', $category->id) }}">{{ $category->name }}</a></li>
                            @endforeach
                        </ul>
                    </li>
                    <li><a href="">C&Oacute;MO COMPRAR</a></li>
                </ul>

            </div>
        </div>
    </nav>

    @yield('content')
    @include('front.partials.contact_form')
    @include('front.partials.footer')
    <!-- JavaScripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    {!! Html::script('assets/js/bootstrap.min.js') !!}
    @yield('scripts')
</body>
</html>
