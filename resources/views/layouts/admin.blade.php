<!doctype html>
<html lang="es">
<head>
    <title>Admin - CAU</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="{{ asset('images/cau.png') }}">
    <link href="https://fonts.googleapis.com/css?family=Josefin+Sans:300, 400,700" rel="stylesheet" async>
    <link href="https://fonts.googleapis.com/css?family=Baloo+Thambi|Varela+Round" rel="stylesheet" async>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous" async>
    
    <link rel="stylesheet" href=" {{ asset('css/toggleSwitch.css') }}">
    
    <link rel="stylesheet" href=" {{ asset('css/bootstrap.css') }}">
    <!-- <link href="http://netdna.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.css" rel="stylesheet"> -->
    <link rel="stylesheet" href=" {{ asset('css/animate.css') }}">
    <link rel="stylesheet" href=" {{ asset('css/owl.carousel.min.css') }}">

    <link rel="stylesheet" href=" {{ asset('fonts/ionicons/css/ionicons.min.css') }}">
    <link rel="stylesheet" href=" {{ asset('fonts/fontawesome/css/font-awesome.min.css')}}">
    <link rel="stylesheet" href=" {{ asset('fonts/flaticon/font/flaticon.css')}}">
    
    <!-- Theme Style -->
    <link rel="stylesheet" href="{{ asset('css/style.css')}}">
    <link href=" {{ asset('css/simple-sidebar.css') }}" rel="stylesheet">
    <script src="{{ asset('js/app.js') }}" defer></script>
</head>

<div id='app'>
    @include('partials.navAdmin')
    @yield('content')
    </div>
    </div>
</div>
@include('partials.footer')


