<!doctype html>
<html lang="es">

<head>
    <title>CAU - Alcoy</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="{{ asset('images/cau.png') }}">
    <link href="https://fonts.googleapis.com/css?family=Josefin+Sans:300, 400,700" rel="stylesheet" async>
    <link href="https://fonts.googleapis.com/css?family=Baloo+Thambi|Varela+Round" rel="stylesheet" async>
    <link rel="stylesheet" href=" {{ asset('css/bootstrap.css') }}">
    <link rel="stylesheet" href=" {{ asset('css/animate.css') }}">
    <link rel="stylesheet" href=" {{ asset('css/owl.carousel.min.css') }}">

    <link rel="stylesheet" href=" {{ asset('fonts/ionicons/css/ionicons.min.css') }}">
    <link rel="stylesheet" href=" {{ asset('fonts/fontawesome/css/font-awesome.min.css')}}">
    <link rel="stylesheet" href=" {{ asset('fonts/flaticon/font/flaticon.css')}}">
    <script src="{{ asset('js/registerChild.js') }}" defer></script>
    <!-- Theme Style -->
    <link rel="stylesheet" href="{{ asset('css/style.css')}}">
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script>
    window.Laravel = {
        csrfToken: '{{ csrf_token() }}'
    };
    </script>
</head>
@include('partials.nav')
<div id='app'>
    @yield('content')
</div>

@include('partials.footer')