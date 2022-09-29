
	@include('layouts.header')
	@auth
    @include('layouts.navigation')
    @include('layouts.sidebar')
	@endauth

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
        @yield('content')
  </div>
  <!-- /.content-wrapper -->

    @include('layouts.footer')	
	
	@yield("after_script");

	</body>
	</html>
