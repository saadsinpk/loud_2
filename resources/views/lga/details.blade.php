@extends("layouts.app")

@push("styles")
<link rel="stylesheet" type="text/css" href="/assets/css/toggle-switch.css">
@endpush

@section("content")

    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Parties</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active"><a href="{{ request()->segment(1) }}">{{ ucfirst( request()->segment(1) ) }}</a></li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

 
                <!--begin::Layout-->
              <!--begin::Card-->
        <div class="card" id="kt_modal_update_lga">
            <!--begin::Card header-->
            <div class="card-header border-0 pt-6">
                <!--begin::Card title-->
                <div class="card-title">Party Edit
                </div>
            </div>
            <!--begin::Card body-->
            <div class="card-body pt-0">
 <!--begin::Form-->
                            <form class="form" action="{{ url('admin/lgas/update') }}" id="kt_modal_update_lga_form"  novalidate="novalidate">
                                <input id="lga_id" name="lga_id" type="hidden" value="{{ $lga->id }}">
                                <!--begin::Modal header-->
                                <div class="modal-header" id="kt_modal_update_lga_header">
                                    <!--begin::Modal title-->
                                    <h2 class="fw-bolder">Update LGA</h2>
                                    <!--end::Modal title-->
                                   
                                </div>
                                <!--end::Modal header-->
                                <!--begin::Modal body-->
                                <div class="modal-body py-10 px-lg-17">
                                    <!--begin::Scroll-->
                                    <div class="d-flex flex-column scroll-y me-n7 pe-7" id="kt_modal_update_lga_scroll" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_update_lga_header" data-kt-scroll-wrappers="#kt_modal_update_lga_scroll" data-kt-scroll-offset="300px">
                                        <!--begin::lga toggle-->
                                       
                                        <!--end::lga toggle-->
                                        <!--begin::lga form-->
                                        <div id="kt_modal_update_lga_info" class="collapse show">
                                            <!--begin::Input group-->
                                            <!--end::Input group-->
                                            <!--begin::Input group-->
                                            <div class="fv-row mb-7">
                                                <!--begin::Label-->
                                                <label class="fs-6 fw-bold mb-2">Name</label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <input id="name" type="text" class="form-control form-control-solid" placeholder="" name="name" value="{{ $lga->name }}"  autocomplete="off"/>
                                                <!--end::Input-->
                                            </div>
                                            <!--end::Input group-->
                                        
                                        </div>
                                        <!--end::lga form-->
                                    </div>
                                    <!--end::Scroll-->
                                </div>
                                <!--end::Modal body-->
                                <!--begin::Modal footer-->
                                <div class="modal-footer flex-center">
                                    <!--begin::Button-->
                                    <button type="reset" id="kt_modal_update_lga_cancel" class="btn btn-light me-3">Discard</button>
                                    <!--end::Button-->
                                    <!--begin::Button-->
                                    <button type="submit" id="kt_modal_update_lga_submit" class="btn btn-primary">
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
                <!--end::Layout-->
               
                
                
            
@endsection

@section("after_script")
    <!--begin::Page Custom Javascript(used by this page)-->
    <script src="{{ asset('assets/js/custom/apps/lgas/update.js') }}"></script>
    <!--end::Page Custom Javascript-->
    <!--end::Javascript-->
@endsection