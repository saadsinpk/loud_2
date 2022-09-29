<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>{{ config('app.name', 'Loud') }}</title>
  
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <link rel="icon" type="image/x-icon" href="{{ asset('assets/media/logos/favi-icon.png') }}">
  <!-- Font Awesome -->
  <link rel="stylesheet"  href="{{ asset('assets/css/plugins/fontawesome-free/css/all.min.css') }}">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet"  href="{{ asset('assets/js/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet"  href="{{ asset('assets/css/adminlte.min.css') }}">
  <link rel="stylesheet"  href="{{ asset('assets/css/adminlte.css') }}">
  <!-- summernote -->
  <link rel="stylesheet"  href="{{ asset('assets/js/plugins/summernote/summernote-bs4.min.css') }}">
  <!-- formValidation -->
  <link rel="stylesheet"  href="{{ asset('assets/js/plugins/formvalidation/formValidation.min.css') }}">
  
  <!-- sweetalert2 --> 
  <link rel="stylesheet"  href="{{ asset('assets/js/plugins/sweetalert2/sweetalert2.min.css') }}">
  
  @yield("additional_stylesheet");
</head>
<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed">
<div class="wrapper">

  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
	<img alt="Logo" src="{{ asset('assets/media/logos/logo.png') }}" class="animation__shake"  width="200"/>
  </div>