<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">    
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">                
        <title>Laravel Contacts Authentication</title>
        <!-- Styles -->
        <link rel="stylesheet" type="text/css" href="{{ asset('/css/app.css') }}">
    </head>
    <body>
        @include('include.navigation')
        <div class="container-fluid mt-3">
            @include('session.status')
            @yield('content')
        </div>
        @include('include.footer')
        <!-- Scripts -->
        <script src="{{ asset('/js/app.js') }}"></script>
    </body>
</html>
