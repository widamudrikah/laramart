<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- title diaganti yahhh -->
    <title> @yield('title')</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/image/icon.png') }}">

    <meta name="description" content="@yield('meta_description')">
    <meta name="keywords" content="@yield('meta_keyword')">
    <meta name="author" content="Wida Mudrikah">
    
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- fontawesome -->
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('assets/css/bootsrap.min.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/css/custome.css')}}">

    <!-- Owl Carousel -->
    <link rel="stylesheet" href="{{ asset('assets/css/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/css/owl.theme.default.min.css')}}">

    <!-- Exzoom Prod Image -->
    <link rel="stylesheet" href="{{ asset('assets/exzoom/jquery.exzoom.css')}}">

    <!-- livewire -->
    @livewireStyles
</head>

<body>
    <div id="app">

        @include('layouts.include.frontend.navbar')

        <!-- content ada disini -->
        <!-- classnya dihapus yaa wida -->
        <main>
            @yield('content')
        </main>

        @include('layouts.include.frontend.footer')

    </div>

    <!-- Scripts ada masalah sama js bundle dari bootstrap -->
    <!-- <script src="{{ asset('assets/js/bootstrap.bundle.min.js')}}"></script> -->
    <script src="{{ asset('assets/js/jquery.min.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Owl Carousel -->
    <script src="{{ asset('assets/js/owl.carousel.min.js')}}"></script>
    <!-- Exzoom -->
    <script src="{{ asset('assets/exzoom/jquery.exzoom.js')}}"></script>
    @yield('script')
 
    @livewireScripts
    @stack('scripts')
</body>

</html>