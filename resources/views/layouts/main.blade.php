<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">

<head>
    <meta charset="utf-8">
    <meta name="application-name" content="{{ config('app.name') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name') }}</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <style>
        [x-cloak] {
            display: none !important;
        }

        .hidden {
            display: none;
        }
    </style>

    @vite('resources/css/app.css')
    @stack('style')

</head>

<body>
    @include('layouts.navbar')
    @yield('content')
    @vite('resources/js/app.js')
    @stack('script')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const userMenuButton = document.getElementById("user-menu-button");
            const userMenuDropdown = document.getElementById("user-menu-dropdown");
            const mobileMenuButton = document.querySelector('button[aria-controls="mobile-menu"]');
            const mobileMenu = document.getElementById("mobile-menu");

            // Toggle profile dropdown menu
            userMenuButton.addEventListener("click", function() {
                userMenuDropdown.classList.toggle("hidden");
            });

            // Toggle mobile menu
            mobileMenuButton.addEventListener("click", function() {
                mobileMenu.classList.toggle("hidden");
                // Toggle icon in mobile menu button
                mobileMenuButton.querySelectorAll("svg").forEach(icon => icon.classList.toggle("hidden"));
            });
        });
    </script>
</body>

</html>
