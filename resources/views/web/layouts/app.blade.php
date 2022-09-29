
	@include('web.layouts.header')
   
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
        @yield('content')
  </div>
  <!-- /.content-wrapper -->

    @include('web.layouts.footer')	
	
	@yield("after_script")

	</body>
	</html>
