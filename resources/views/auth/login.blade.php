<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Loud | Log in</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('assets/css/plugins/fontawesome-free/css/all.min.css')}}">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="{{ asset('assets/css/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('assets/css/adminlte.min.css') }}">
  <!-- formValidation -->
  <link rel="stylesheet"  href="{{ asset('assets/js/plugins/formvalidation/formValidation.min.css') }}">
  
  <!-- sweetalert2 --> 
  <link rel="stylesheet"  href="{{ asset('assets/js/plugins/sweetalert2/sweetalert2.min.css') }}">
  
  <style>
    body{
      min-height: 359.9px;
      background: url('/assets/media/loginbg.png');
      background-size: 200px;
      background-color: #fff !important;
      max-height: 400px;
      min-height: 400px !important;
      overflow: hidden;
    }

    #kt_sign_in_submit{
      background: #b08129;
      border-radius: 0px;
      border-color: #fff;
      height: 37px;
    }

    #kt_sign_in_submit:hover{
      background: #5d4414;
      border-color: transparent;
    }

    .login-card-body, .register-card-body {
      border-color: #ffffff5c;
      border-top: 0;
      color: #fff;
      padding: 20px;
      background: #b08129;
    }

     .login-card-body a{
      color: #fff;
     }

      .login-card-body input{
          border-radius: 0px;
        border-color: #ffffff5c;
      }

      .login-card-body .input-group .input-group-text, .register-card-body .input-group .input-group-text{
        color: #5d4414;
        border-top-right-radius: 0px;
        border-bottom-right-radius: 0px;
        border-color: #ffffff5c;
      }

      .login-logo, .register-logo{
        background: #4f350447;
        margin-bottom: 0px;
      }

      .main_img{
        left: 0px;
        position: absolute;
          top: -50px;
            z-index: -1;
      }
      
      .main_img img{
        width: 92%;
      }

    .section_name{
       left: 0px;
      position: absolute;
      bottom: 0;
      z-index: -2;
      background: #040300bf;
      padding: 15px;
      border-top-right-radius: 0%;
      height: 255px;
      display: flex;
      width: 100%;
      align-items: center;
      justify-content: space-around;
      border-bottom-right-radius: 0%;
    }

    .login-box{
        margin-top: 85px;
    }

    label:not(.form-check-label):not(.custom-file-label){
      font-weight: normal;
    }

    .login-box-msg{
      font-size: 22px;
    }

  </style>
</head>
<body class="hold-transition login-page">

<div class="main_img">
    <img alt="Adulrahman" src="{{ asset('assets/media/adulrahman.png') }}"/>

</div>  

<div class="section_name">
  <img alt="Adulrahman" src="{{ asset('assets/media/abdulrama-again.png') }}" style="    width: 300px;"/>
</div>

<div class="login-box">
<!--
  <div class="login-logo">
    <img alt="Logo" src="{{ asset('assets/media/logos/logo.png') }}" style="    width: 265px;"/>
  </div> -->
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg"><strong>LOG IN</strong> </p>

      <form action="{{ route('login') }}" class="form w-100"  id="kt_sign_in_form">
	
        <div class="input-group mb-3">
          <input type="email" class="form-control" placeholder="Email" value="{{ old('email') }}" type="text" name="email" autocomplete="off">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" placeholder="Password"  name="password" value="{{ old('password') }}" autocomplete="off">
		  
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row" style="align-items: center;">
          <div class="col-8">
            <div class="icheck-primary">
              <input type="checkbox" id="remember">
              <label for="remember">
                Remember Me
              </label>
            </div>
          </div>
          <!-- /.col -->
          <div class="col-4">
          

 <!--begin::Submit button-->
                                <button type="button" id="kt_sign_in_submit" class="btn btn-primary btn-block">
                                    <span class="indicator-label">Sign In</span>
                                    <span class="indicator-progress"></span>
                                </button>
                                <!--end::Submit button-->
								
								
          </div>
          <!-- /.col -->
        </div>
      </form>

      

      <p class="mb-1">
	  
        <a href="{{ route('password.reset.form') }}" >  {{ __('Forgot your password?') }}</a>
      </p>
      <p class="mb-0">
      
      </p>
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="{{ asset('assets/js/plugins/jquery/jquery.min.js') }}"></script>

<!-- jQuery \formvalidation -->
<script src="{{ asset('assets/js/plugins/formvalidation/FormValidation.full.min.js') }}"></script>

<!-- sweetalert2 --> 
<script src="{{ asset('assets/js/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
  
<!-- Bootstrap 4 -->
<script src="{{ asset('assets/js/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('assets/js/adminlte.min.js') }}"></script>

<!--begin::Page Custom Javascript(used by this page)-->
<script src="{{ asset('assets/js/custom/authentication/sign-in/general.js') }}"></script>
<!--end::Page Custom Javascript-->
			
</body>
</html>
