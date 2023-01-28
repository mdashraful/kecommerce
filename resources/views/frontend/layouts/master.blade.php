<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name') }}</title>
        <link rel="stylesheet" href="{{ mix('public/css/app.css') }}">
        
        @stack('styles')
        <!-- Styles -->

    </head>
    <body>
        @include('frontend.partials._header')
        <main>
            @yield('main-content')       
        </main>

        <footer class="text-muted py-5">
            @include('frontend.partials._footer')
        </footer>

        <script src="{{ mix('public/js/all.js') }}"></script>
        @stack('js')
    </body>
</html>
