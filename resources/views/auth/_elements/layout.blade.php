<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        {{-- Favicon with company_logo --}}
        <link rel="icon" href="{{ asset('storage/' . str_replace('public/', '', $company_logo)) }}" type="image/x-icon" />
        <link rel="shortcut icon" href="{{ asset('storage/' . str_replace('public/', '', $company_logo)) }}" type="image/x-icon" />

        {{-- Title --}}

        <title>
            {{ $company_name ?? env('APP_NAME') }} - @yield('title')
        </title>
        
        
        {{-- Import CSS --}}
        <link rel="stylesheet" href="{{ asset('backoffice/css/style.css') }}">
        @vite('resources/css/bootstrap.css')
        @vite('resources/css/line-awesome.min.css')
        @vite('resources/css/swiper.min.css')
        @vite('resources/css/magnific-popup.css')
        @vite('resources/css/style.css')
        @yield('styles')

        @include('_elements.color')

    </head>
    <body class="min-vh-100 d-flex flex-column">
        {{-- Import Loader --}}
        @include('auth._elements.preloader')

        {{-- Import Header --}}
        @include('auth._elements.header')

        {{-- Content  --}}
        <div class="d-flex justify-content-center align-items-center flex-grow-1">
            @yield('content')
        </div>
        
        {{-- Import Footer --}}
        @include('auth._elements.footer')

        {{-- Import packages --}}
        @include('auth._elements.notyf')

        {{-- Import JS --}}
        @vite('resources/js/jquery.min.js')
        @vite('resources/js/bootstrap.bundle.min.js')
        @vite('resources/js/jquery.filterizr.min.js')
        @vite('resources/js/magnific-popup.min.js')
        @vite('resources/js/swiper.min.js')
        @vite('resources/js/main.js')
        @vite('resources/js/app.js')

        @vite('resources/js/plugins/notyf.js')
        
        @yield('scripts')
        

    </body>
</html>