@extends("layouts.app")
@section("content")
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Admin Edit</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Admin Edit</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
	
    <!-- Main content -->
    <section class="content" id="kt_modal_update_admin">
      <div class="row">
        <div class="col-md-12">
          <div class="card card-primary">
           <form class="form" action="{{ url('admins/update') }}" id="kt_modal_update_admin_form"  enctype="multipart/form-data" novalidate="novalidate">
             
			<input id="id" name="id" type="hidden" value="{{ $user->id }}">
            <div class="card-body">
              <div class="form-group">
                <label for="name">Admin Name</label>
                <input type="text" id="name" class="form-control" name="name" value="{{$user->name}}">
              </div>
			  
              <div class="form-group">
                <label for="email">Admin Email</label>
                <input id="email" type="email" class="form-control form-control-solid" placeholder="" name="email" value="{{$user->email}}" />
              </div>
              
			  <div class="form-group">
                 <label for="change-password">Password</label>
				 <input id="change-password" type="password" class="form-control form-control-lg form-control-solid"  name="password" value="" />
              </div>
			  
            
			  
				<!--begin::Button-->
                
				<button type="reset" id="kt_modal_update_admin_cancel" class="btn btn-light me-3">Discard</button>
                                    <!--end::Button-->
                                    <!--begin::Button-->
                    <button  id="kt_modal_update_admin_submit" class="btn btn-primary">
                                        <span class="indicator-label">Submit</span>
                                        <!-- <span class="indicator-progress">Please wait...
                                        <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span> -->
                    </button>
                <!--end::Button-->
									
			  </form>
            </div>
            <!-- /.card-body -->
			
	      <br/>
          </div>
          <!-- /.card -->
		  
        </div>
      </div>
    </section>
    <!-- /.content -->

   
@endsection

@section("after_script")
    <script src="{{ asset('assets/js/custom/apps/admins/update.js') }}"></script>
@endsection