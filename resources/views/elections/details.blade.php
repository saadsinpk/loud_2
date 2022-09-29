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
              <li class="breadcrumb-item active"><a href="{{ request()->segment(2) }}">{{ ucfirst( request()->segment(2) ) }}</a></li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

 <!--begin::Card-->
        <div class="card" id="kt_modal_update_party">
            <!--begin::Card header-->
            <div class="card-header border-0 pt-6">
                <!--begin::Card title-->
                <div class="card-title">Party Edit
                </div>
            </div>
            <!--begin::Card body-->
            <div class="card-body pt-0">
 <!--begin::Form-->
                    <form class="form" action="{{ url('admin/elections/update') }}" id="kt_modal_update_party_form"  novalidate="novalidate">
                                <input id="party_id" name="party_id" type="hidden" value="{{ $party->id }}">
                                <!--begin::Modal header-->
                                <div class="modal-header" id="kt_modal_update_party_header">
                                    <!--begin::Modal title-->
                                    <h2 class="fw-bolder">Update party</h2>
                                    <!--end::Modal title-->
                                
                                </div>
                                <!--end::Modal header-->
                               
                                    <!--begin::Scroll-->
                                    <div class="d-flex flex-column scroll-y me-n7 pe-7" id="kt_modal_update_party_scroll" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_update_party_header" data-kt-scroll-wrappers="#kt_modal_update_party_scroll" data-kt-scroll-offset="300px">
                                      
                                        <!--begin::party form-->
                                        <div id="kt_modal_update_party_info" class="collapse show">
                                            <!--begin::Input group-->
                                            <!--end::Input group-->
                                            <!--begin::Input group-->
                                            <div class="fv-row mb-7">
                                                <!--begin::Label-->
                                                <label class="fs-6 fw-bold mb-2">Name</label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <input id="name" type="text" class="form-control form-control-solid" placeholder="" name="name" value="{{ $party->name }}"  autocomplete="off"/>
                                                <!--end::Input-->
                                            </div>
                                            <!--end::Input group-->
                                        
                                        </div>
                                        <!--end::party form-->
                                    </div>
                                    <!--end::Scroll-->
                                
                                <!--end::Modal body-->
                                <!--begin::Modal footer-->
                                <div class="modal-footer flex-center">
                                    <!--begin::Button-->
                                    <button type="reset" id="kt_modal_update_party_cancel" class="btn btn-light me-3">Discard</button>
                                    <!--end::Button-->
                                    <!--begin::Button-->
                                    <button type="submit" id="kt_modal_update_party_submit" class="btn btn-primary">
                                        <span class="indicator-label">Submit</span>
                                       </span>
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
    <script src="{{ asset('assets/js/custom/apps/party/update.js') }}"></script>
    <!--end::Page Custom Javascript-->
    <!--end::Javascript-->
@endsection