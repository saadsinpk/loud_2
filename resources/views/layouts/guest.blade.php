<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Kwara') }}</title>

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet">
        <link rel="icon" type="image/x-icon" href="{{ asset('assets/media/logos/favi-icon.png') }}">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/boxicons.css') }}">
        <link rel="stylesheet" href="{{ asset('css/core.css') }}">
        <link rel="stylesheet" href="{{ asset('css/theme-default.css') }}">
        <link rel="stylesheet" href="{{ asset('css/demo.css') }}">
        <link rel="stylesheet" href="{{ asset('css/perfect-scrollbar.css') }}">
        <link rel="stylesheet" href="{{ asset('css/page-auth.css') }}">
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">

      

        <!-- Scripts -->
     <script src="{{ asset('js/app.js') }}" defer></script>
    </head>
    
    <body  class="bg-body">
       @yield("content")
       

       <!--begin::Global Javascript Bundle(used by all pages)-->
       <script src="{{ asset('assets/plugins/global/plugins.bundle.js') }}"></script>
       <script src="{{ asset('assets/js/scripts.bundle.js') }}"></script>
       

        <!--end::Global Javascript Bundle-->
       @yield("after_script")
    </body>

</html>
