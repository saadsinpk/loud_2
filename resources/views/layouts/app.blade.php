<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="icon" type="image/x-icon" href="{{ asset('assets/media/logos/favi-icon.png') }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
		<link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet">

        <!-- Styles -->
		<link rel="stylesheet" href="{{ asset('css/boxicons.css') }}">
        <link rel="stylesheet" href="{{ asset('css/core.css') }}">
        <link rel="stylesheet" href="{{ asset('css/theme-default.css') }}">
        <link rel="stylesheet" href="{{ asset('css/demo.css') }}">
        <link rel="stylesheet" href="{{ asset('css/perfect-scrollbar.css') }}">
        <link rel="stylesheet" href="{{ asset('css/page-auth.css') }}">
        {{-- <link rel="stylesheet" href="{{ asset('css/app.css') }}"> --}}
        <link rel="stylesheet" href="{{ asset('css/main.css') }}">

        <!--begin::Fonts-->
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />

		<script src="{{ asset('js/helpers.js') }}"></script>

		<style>
			#spinner {
				position: fixed;
				width: 100%;
				height: 100%;
				display: flex;
				justify-content: center;
				background-color: rgba(0,0,0,0.3);
				align-items: center;
				z-index: 99999999;
			}
			.fulfilling-bouncing-circle-spinner,
			.fulfilling-bouncing-circle-spinner * {
				box-sizing: border-box;
			}
			
			.fulfilling-bouncing-circle-spinner {
				height: 60px;
				width: 60px;
				position: relative;
				animation: fulfilling-bouncing-circle-spinner-animation infinite 4000ms ease;
			}
			
			.fulfilling-bouncing-circle-spinner .orbit {
				height: 60px;
				width: 60px;
				position: absolute;
				top: 0;
				left: 0;
				border-radius: 50%;
				border: calc(60px * 0.03) solid #009ef7;
				animation: fulfilling-bouncing-circle-spinner-orbit-animation infinite 4000ms ease;
			}
			
			.fulfilling-bouncing-circle-spinner .circle {
				height: 60px;
				width: 60px;
				color: #009ef7;
				display: block;
				border-radius: 50%;
				position: relative;
				border: calc(60px * 0.1) solid #009ef7;
				animation: fulfilling-bouncing-circle-spinner-circle-animation infinite 4000ms ease;
				transform: rotate(0deg) scale(1);
			}
			
			@keyframes fulfilling-bouncing-circle-spinner-animation {
				0% {
					transform: rotate(0deg);
				}
				100% {
					transform: rotate(360deg);
				}
			}
			
			@keyframes fulfilling-bouncing-circle-spinner-orbit-animation {
				0% {
					transform: scale(1);
				}
				50% {
					transform: scale(1);
				}
				62.5% {
					transform: scale(0.8);
				}
				75% {
					transform: scale(1);
				}
				87.5% {
					transform: scale(0.8);
				}
				100% {
					transform: scale(1);
				}
			}
			
			@keyframes fulfilling-bouncing-circle-spinner-circle-animation {
				0% {
					transform: scale(1);
					border-color: transparent;
					border-top-color: inherit;
				}
				16.7% {
					border-color: transparent;
					border-top-color: initial;
					border-right-color: initial;
				}
				33.4% {
					border-color: transparent;
					border-top-color: inherit;
					border-right-color: inherit;
					border-bottom-color: inherit;
				}
				50% {
					border-color: inherit;
					transform: scale(1);
				}
				62.5% {
					border-color: inherit;
					transform: scale(1.4);
				}
				75% {
					border-color: inherit;
					transform: scale(1);
					opacity: 1;
				}
				87.5% {
					border-color: inherit;
					transform: scale(1.4);
				}
				100% {
					border-color: transparent;
					border-top-color: inherit;
					transform: scale(1);
				}
			}


			/*custom pagination*/
			ul.custom-pagination{
	            display: flex;
	            list-style: none;
	        }
	        ul.custom-pagination li a{
	            border: 1px solid #ddd;
	            border-radius: 3px;
	            padding: 5px 10px;
	            margin-right: 2px;
	        }
	        ul.custom-pagination li.active a{
	            background: #7239EA;
	            color: #fff;
	            border: 1px solid #7239EA;
	        }
		</style>
		<!--end::Fonts-->
		@stack("styles")
		
    </head>
    <body>

		<div class="layout-wrapper layout-content-navbar ">
			<!--begin::Page-->
			<div class="layout-container">
                @include("pages.sidebar")
                <!--end::Aside-->
				<div class="layout-page">
                    <!--begin::Aside search-->
                        @include("pages.header")
                    <!--end::Aside search-->
					<!--begin::Content-->
					<div class="content d-flex flex-column flex-column-fluid mt-3" id="kt_content">
						@yield('content')
					</div>
					<!--end::Content-->
					<!--begin::Footer-->
					<div class="footer py-4 d-flex flex-lg-column" id="kt_footer">
                        @include("pages.footer")
					</div>
					<!--end::Footer-->
				</div>
				<!--end::Wrapper-->
			</div>
			<!--end::Page-->
		</div>
		<!--end::Root-->
		<div id="spinner">
			<div class="fulfilling-bouncing-circle-spinner">
				<div class="circle"></div>
				<div class="orbit"></div>
			</div>
		</div>
		
        
		<!--begin::Javascript-->
		<!--begin::Global Javascript Bundle(used by all pages)-->
		<script  src="{{ asset('js/jquery.js') }}"></script>
		<script  src="{{ asset('js/popper.js') }}"></script>
		<script  src="{{ asset('js/bootstrap.js') }}"></script>
		<script  src="{{ asset('js/perfect-scrollbar.js') }}"></script>

		<script src="{{ asset('js/menu.js') }}"></script>
		<script src="{{ asset('js/main.js') }}"></script>
		<!--end::Page Vendors Javascript-->
		
		<script>
			$(window).on('load', function () {
				$('#spinner').hide();
			});
		</script>

	



	</body>

</html>
