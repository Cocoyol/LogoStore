<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title')</title>

    <!-- Fonts -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css" rel='stylesheet' type='text/css'>
    <link href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700" rel='stylesheet' type='text/css'>

    <!-- Styles -->
    {!! Html::style('assets/css/bootstrap.css') !!}
    {!! Html::style('assets/css/main.css') !!}

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
                            CATEGOR&Iacute;AS
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
