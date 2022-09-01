<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">
        <link rel="icon" type="image/x-icon" href="{{ asset('assets/media/logos/favi-icon.png') }}">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">

        <!--begin::Fonts-->
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
		<!--end::Fonts-->

        <!-- Scripts -->
     <script src="{{ asset('js/app.js') }}" defer></script>
    </head>
    
    <body id="kt_body" class="bg-body">
       @yield("content")
       

       <!--begin::Global Javascript Bundle(used by all pages)-->
       <script src="{{ asset('assets/plugins/global/plugins.bundle.js') }}"></script>
       <script src="{{ asset('assets/js/scripts.bundle.js') }}"></script>

        <!--end::Global Javascript Bundle-->
       @yield("after_script")
    </body>

</html>
