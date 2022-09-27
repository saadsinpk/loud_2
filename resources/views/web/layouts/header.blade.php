<!DOCTYPE html>
<html lang="en">

    <!-- Basic -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">   
   
    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
 
     <!-- Site Metas -->
    <title>Election</title>  
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Site Icons -->
    <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon" />
    <link rel="apple-touch-icon" href="images/apple-touch-icon.png">

    <!-- Bootstrap CSS -->
	<link rel="stylesheet" href="{{ asset('assets/web/css/bootstrap.min.css')}}">
	
    <!-- Site CSS -->
	<link rel="stylesheet" href="{{ asset('assets/web/style.css')}}">
	
    <!-- Colors CSS -->
    
    <!-- ALL VERSION CSS -->
	<link rel="stylesheet" href="{{ asset('assets/web/css/versions.css')}}">
	
    <!-- Responsive CSS -->
	<link rel="stylesheet" href="{{ asset('assets/web/css/responsive.css')}}">
	
    <!-- Custom CSS -->
	<link rel="stylesheet" href="{{ asset('assets/web/css/custom.css')}}">

    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>
<body class="politics_version">

    <!-- LOADER -->
    <div id="preloader">
        <div id="main-ld">
			<div id="loader"></div>  
		</div>
    </div><!-- end loader -->
    <!-- END LOADER -->
<!--
    <div class="topbar text-center hidden-xs">
        <p>This site uses cookies. By continuing to browse ELPolitic, you are agreeing to use our site cookies. <a href="#">Find out more here ></a></p>
    </div> -->

    <header class="header header_style_01">
        <nav class="megamenu navbar navbar-default">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="index.html"><img src="{{url('assets/media/logos/logo.png')}}" width="100" alt="image"></a>
                </div>
                <div id="navbar" class="navbar-collapse collapse">
                    <ul class="nav navbar-nav navbar-right">
                        <li><a data-scroll-nav="0" href="#main-banner" class="active">Home</a></li>
                        <li><a data-scroll-nav="1" href="#about">About Us</a></li>
                        <li><a data-scroll-nav="2" href="#issues">Agents</a></li>
						<li><a data-scroll-nav="4" href="#gallery">Gallery</a></li>
                        <li><a data-scroll-nav="7" href="#contact">Contact</a></li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>