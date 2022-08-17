<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" prefix="og: http://ogp.me/ns#">
    <head>
        @include('page-includes.head')
    </head>
    <body class="">
        @yield('content')
    </body>
</html>
