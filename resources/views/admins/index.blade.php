@extends("layouts.app")

@section("additional_stylesheet")

	<link rel="stylesheet"  href="{{ asset('assets/js/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
	<link rel="stylesheet"  href="{{ asset('assets/js/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
	<link rel="stylesheet"  href="{{ asset('assets/js/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
	
@endsection

@section("content")
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Admins</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Admins</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
	
	
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Admins List</h3>
				
				<!--begin::Card toolbar-->
                <div class="card-toolbar">
                    <!--begin::Toolbar-->
                    <div class="d-flex justify-content-end" data-kt-admin-table-toolbar="base">
                        <!--begin::Add admin-->
                        
						<button type="button" class="btn btn-default" data-toggle="modal" data-target="#kt_modal_add_admin">Add Admin</button>
				
                        <!--end::Add admin-->
                    </div>
                    <!--end::Toolbar-->
                    <!--begin::Group actions-->
                   <!-- <div class="d-flex justify-content-end align-items-center d-none" data-kt-admin-table-toolbar="selected">
                        <div class="fw-bolder me-5">
                        <span class="me-2" data-kt-admin-table-select="selected_count"></span>Selected</div>
                        <button type="button" class="btn btn-danger" data-kt-admin-table-select="delete_selected">Delete Selected</button>
                    </div> -->
                    <!--end::Group actions-->
                </div>
                <!--end::Card toolbar-->
				
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table  id="kt_admins_table" class="table table-bordered table-striped" >
                  <thead>
                  <tr>
				  
                    <th></th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>CREATED DATE</th>
                    <th>Actions</th>
                  </tr>
                  </thead>
                  <tbody>
                 
                  
                  </tbody>
                  <tfoot>
                  <tr>
					
					<th></th>
					<th>Name</th>
                    <th>Email</th>
                    <th>CREATED DATE</th>
                    <th>Actions</th>
                  </tr>
                  </tfoot>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
    
	
	


      </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
	  

		
		
        <!--begin::Modals-->
		
		
        <!--begin::Modal - admins - View -->
		  <div class="modal fade" id="kt_modal_view_admin">
			<div class="modal-dialog">
			  <div class="modal-content">
				<div class="modal-header text-center">
				  <h4 class="modal-title">Admin Details</h4>
				  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				  </button>
				</div>
				<div class="modal-body">
				
				<!-- Profile Image -->
				<div class="card card-primary card-outline">
				  <div class="card-body box-profile">
					<div class="text-center">
					  <img class="profile-user-img img-fluid img-circle"
						   src="{{ asset('assets/media/avatars/blank.png') }}"
						   alt="Admin profile picture">
					</div>

					<h3 class="profile-username text-center"><span id="name_view"></span></h3>

					<p class="text-muted text-center"><span id="email_view"></span></p>
					<p class="text-muted text-center"><span id="role_view"></span></p>

	
				  </div>
				  <!-- /.card-body -->
				</div>
				<!-- /.card -->
				
				</div>
				
			  </div>
			  <!-- /.modal-content -->
			</div>
			<!-- /.modal-dialog -->
		  </div>
		  <!-- /.modal -->
		
        <!--begin::Modal - admins - Add-->
        <div class="modal fade" id="kt_modal_add_admin" tabindex="-1" aria-hidden="true">
            <!--begin::Modal dialog-->
            <div class="modal-dialog modal-dialog-centered mw-650px">
                <!--begin::Modal content-->
                <div class="modal-content">
                    <!--begin::Form-->
                    <form class="form" action="{{ url('/admins') }}" id="kt_modal_add_admin_form" data-kt-redirect="{{ url('/admins') }}" method="POST">
                        @csrf
                        <!--begin::Modal header-->
                        <div class="modal-header" id="kt_modal_add_admin_header">
                            <!--begin::Modal title-->
                            <h2 class="fw-bolder">Add a Admin</h2>
                            <!--end::Modal title-->
                            <!--begin::Close-->
                            <div id="kt_modal_add_admin_close" class="btn btn-icon btn-sm btn-active-icon-primary">
                                <!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
                                <span class="svg-icon svg-icon-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                        <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="black" />
                                        <rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="black" />
                                    </svg>
                                </span>
                                <!--end::Svg Icon-->
                            </div>
                            <!--end::Close-->
                        </div>
                        <!--end::Modal header-->
                        <!--begin::Modal body-->
                        <div class="modal-body py-10 px-lg-17">
                            <!--begin::Scroll-->
                            <div class="scroll-y me-n7 pe-7" id="kt_modal_add_admin_scroll" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_add_admin_header" data-kt-scroll-wrappers="#kt_modal_add_admin_scroll" data-kt-scroll-offset="300px">
                                <!--begin::Input group-->
                                <div class="fv-row mb-7">
                                    <!--begin::Label-->
                                    <label class="required fs-6 fw-bold mb-2">Name</label>
                                    <!--end::Label-->
                                    <!--begin::Input-->
                                    <input type="text" class="form-control form-control-solid" placeholder="" name="name" value="" />
                                    <!--end::Input-->
                                </div>
                                <!--end::Input group-->
                                <!--begin::Input group-->
                                <div class="fv-row mb-7">
                                    <!--begin::Label-->
                                    <label class="fs-6 fw-bold mb-2">
                                        <span class="required">Email</span>
                                        <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" title="Email address must be active"></i>
                                    </label>
                                    <!--end::Label-->
                                    <!--begin::Input-->
                                    <input type="email" class="form-control form-control-solid" placeholder="" name="email" value="" />
                                    <!--end::Input-->
                                </div>
                                <!--end::Input group-->
                
                                <!--begin::Input group-->
                                <div class="fv-row mb-7" data-kt-password-meter="true">
                                    <!--begin::Wrapper-->
                                    <div class="mb-1">
                                        <!--begin::Label-->
                                        <label class="form-label fw-bolder text-dark fs-6">Password</label>
                                        <!--end::Label-->
                                        <!--begin::Input wrapper-->
                                        <div class="position-relative mb-3">
                                            <input class="form-control form-control-lg form-control-solid" type="password" placeholder="" name="password" autocomplete="off" />
                                            <span class="btn btn-sm btn-icon position-absolute translate-middle top-50 end-0 me-n2" data-kt-password-meter-control="visibility">
                                                <i class="bi bi-eye-slash fs-2"></i>
                                                <i class="bi bi-eye fs-2 d-none"></i>
                                            </span>
                                        </div>
                                        <!--end::Input wrapper-->
                                        <!--begin::Meter-->
                                        <div class="d-flex align-items-center mb-3" data-kt-password-meter-control="highlight">
                                            <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
                                            <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
                                            <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
                                            <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px"></div>
                                        </div>
                                        <!--end::Meter-->
                                    </div>
                                    <!--end::Wrapper-->
                                    <!--begin::Hint-->
                                    <div class="text-muted">Use 8 or more characters with a mix of letters, numbers &amp; symbols.</div>
                                    <!--end::Hint-->
                                </div>
                                <!--end::Input group=-->
                                <!--begin::Input group-->
                                <div class="fv-row mb-7">
                                    <label class="form-label fw-bolder text-dark fs-6">Confirm Password</label>
                                    <input class="form-control form-control-lg form-control-solid" type="password" placeholder="" name="confirm-password" autocomplete="off" />
                                </div>
                                <!--end::Input group-->

                                <!--end::Billing form-->
                            </div>
                            <!--end::Scroll-->
                        </div>
                        <!--end::Modal body-->
                        <!--begin::Modal footer-->
                        <div class="modal-footer flex-center">
                            <!--begin::Button-->
                            <button type="reset" id="kt_modal_add_admin_cancel" class="btn btn-light me-3">Discard</button>
                            <!--end::Button-->
                            <!--begin::Button-->
                            <button type="submit" class="btn btn-primary">
                                <span class="indicator-label">Submit</span>
                                <span class="indicator-progress">Please wait...
                                <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                            </button>
                            <!--end::Button-->
                        </div>
                        <!--end::Modal footer-->
                    </form>
                    <!--end::Form-->
                </div>
            </div>
        </div>
        <!--end::Modal - admins - Add-->
		
    </section>
    <!-- /.content -->


@endsection

@section("after_script")

<!-- DataTables  & Plugins -->
<script src="{{ asset('assets/js/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/jszip/jszip.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/pdfmake/pdfmake.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/pdfmake/vfs_fonts.js') }}"></script>
<script src="{{ asset('assets/js/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>


	
    <!--begin::Page Custom Javascript(used by this page)-->
	
   <script src="{{ asset('assets/js/custom/apps/admins/add.js') }}"></script> 
   <script src="{{ asset('assets/js/custom/apps/admins/list.js') }}"></script> 
	
    <!--end::Page Custom Javascript-->
    <!--end::Javascript-->
@endsection