<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name', 'Laravel') }}</title>
        <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
        <style>
            body {
                background-image: url({{ asset('assets/image/top_background.png') }});
                background-size: cover;
                background-repeat: no-repeat;
                background-color: rgba(255, 255, 255, 0.5);
                background-blend-mode: overlay;
            }
            @media (max-width: 768px) {
                body {
                    background-size: auto;
                    background-position: center;
                }
            }
            .gradient_button {
                background: linear-gradient(135deg, #EA3939, #8E2451, #32106A);
                border: 1px solid black !important;
                color: white !important;
                border-radius: 5px;
            }
        </style>
        @yield('style')
    </head>
    @yield('content')
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/popper.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
    @yield('script')
</html>