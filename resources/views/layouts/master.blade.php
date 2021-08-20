<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    @yield('styles')
</head>

<body>

<div class="header">
    @include('partials.header')
    @yield('pageHeader')
</div>

<div class="container">
    @yield('content')
</div>

<script src="{{asset('js/app.js')}}"></script>
<script src="{{ asset('js/main.js') }}"></script>
@yield('scripts');

</body>
</html>