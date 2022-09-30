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
      background: url(/assets/media/loginpagebg.jpg);
      background-size: 30%;
      background-color: #c7875d !important;
    justify-content: flex-start !important;
    background-repeat: repeat;
    }

    .card{
      background: transparent;
      box-shadow: none;
    }
    #kt_sign_in_submit{
    background: #e41626;
    border-radius: 20px;
    border: 0px;
    }

    #kt_sign_in_submit:hover{
      background: #5d4414;
      border-color: transparent;
    }

    .login-card-body, .register-card-body {
        border: 0;
      /* color: #fff; */
      padding: 20px;
      background: transparent;
      box-shadow: none !important;
    }



      .login-card-body input{
          border-radius: 20px;
          background: #726e6e;
          border: 2px solid #000;
          color: #fff;
      }

      input:-internal-autofill-selected {
          border-radius: 20px;
          background: #726e6e;
          border: 2px solid #000;
          color: #fff;
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


    .login-box{
      margin-top: 0rem; /* 5rem mobile */
      background-image: url(/assets/media/main_img.png);
      background-size: cover; 
      width: 24%; /* 100% mobile */
      display: flex;
      align-items: flex-end;
      justify-content: space-around;
      background-repeat: no-repeat;
      height: 100%;
    }

    label:not(.form-check-label):not(.custom-file-label){
      font-weight: normal;
    }

    .login-box-msg{
      font-size: 22px;
    }

    .top_bar{
         display: inline-flex;
        justify-content: flex-end;
        width: 100%;
        align-items: center;
        padding: 1rem;
        position: absolute;
        top: 0px;
    }

    .top_bar img{
      max-width: 150px;
    }

::-webkit-input-placeholder { /* Edge */
  color: #fff !important;
}

:-ms-input-placeholder { /* Internet Explorer 10-11 */
  color: #fff !important;
}

::placeholder {
  color: #fff !important;
}


@media only screen and (max-width: 600px) {
.login-box{
      margin-top: 5rem  ;
      width: 100% ;
      height: 100%;
    }
}

  </style>
</head>
<body class="hold-transition login-page">

<div class="top_bar">
    <img alt="Adulrahman" src="{{ asset('assets/media/logos/top_log.png') }}"/>

</div>  

<div class="login-box">
<!--
  <div class="login-logo">
    <img alt="Logo" src="{{ asset('assets/media/logos/logo.png') }}" style="    width: 265px;"/>
  </div> -->
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg" style="color:#726e6e"><strong>LOG IN</strong> </p>

      <form action="{{ route('login') }}" class="form w-100"  id="kt_sign_in_form">
	
        <div class="input-group mb-3">
          <input type="email" class="form-control" placeholder="Email" value="" id="emailInput" type="text" name="email" autocomplete="off">
          
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" placeholder="Password"  name="password" id="passwordInput" value="" autocomplete="off">
		  
        </div>
        <div class="row" style="align-items: center;">
         
          <!-- /.col -->
          <div class="col-12">
          

 <!--begin::Submit button-->
                                <button type="button" id="kt_sign_in_submit" class="btn btn-primary btn-block">
                                    <span class="indicator-label">Sign In</span>
                                    <span class="indicator-progress"></span>
                                </button>
                                <!--end::Submit button-->
								
								
          </div>

        <div class="col-12 mt-1 text-center pt-2">
          <img alt="Logo" src="{{ asset('assets/media/logos/main_logo.png') }}" style="    width: 100px;"/>
      
        </div>
          
          <!-- /.col -->
        </div>
      </form>

      
<!--
      <p class="mb-1">
	  
        <a href="{{ route('password.reset.form') }}" >  {{ __('Forgot your password?') }}</a>
      </p> -->
      
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->


<!--
<div class="bottom_bar">
  <img alt="Adulrahman" src="{{ asset('assets/media/abdulrama-again.png') }}" style="    width: 300px;"/>
</div> -->

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
