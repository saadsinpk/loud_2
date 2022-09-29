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
            <h1>Agent</h1>
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


                <!--begin::Layout-->
              <!--begin::Card-->
        <div class="card" id="kt_modal_update_politicalpartyagent">
            <!--begin::Card header-->
            <div class="card-header border-0 pt-6">
                <!--begin::Card title-->
                <div class="card-title">Party Edit
                </div>
            </div>
            <!--begin::Card body-->
            <div class="card-body pt-0">
 <!--begin::Form-->
                            <form class="form" action="{{ url('admin/politicalpartyagents/update') }}" id="kt_modal_update_politicalpartyagent_form" enctype="multipart/form-data" novalidate="novalidate">
                                @csrf
                                <input id="politicalpartyagent_id" name="id" type="hidden" value="{{ $politicalpartyagent->id }}">
                                <!--begin::Modal header-->
                                <div class="modal-header" id="kt_modal_update_politicalpartyagent_header">
                                    <!--begin::Modal title-->
                                    <h2 class="fw-bolder">Update political party agent</h2>
                                    <!--end::Modal title-->
                                    <!--begin::Close-->
                                    <div id="kt_modal_update_politicalpartyagent_close" class="btn btn-icon btn-sm btn-active-icon-primary">
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
                                    <div class="d-flex flex-column scroll-y me-n7 pe-7" id="kt_modal_update_politicalpartyagent_scroll" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_update_politicalpartyagent_form" data-kt-scroll-wrappers="#kt_modal_update_politicalpartyagent_scroll" data-kt-scroll-offset="0px">
                                        <!--begin::User toggle-->
                                        <div class="fw-bolder fs-3 rotate collapsible mb-7" data-bs-toggle="collapse" href="#kt_modal_update_politicalpartyagent_user_info" role="button" aria-expanded="false" aria-controls="kt_modal_update_politicalpartyagent_user_info">User Information
                                        <span class="ms-2 rotate-180">
                                            <!--begin::Svg Icon | path: icons/duotune/arrows/arr072.svg-->
                                            <span class="svg-icon svg-icon-3">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                    <path d="M11.4343 12.7344L7.25 8.55005C6.83579 8.13583 6.16421 8.13584 5.75 8.55005C5.33579 8.96426 5.33579 9.63583 5.75 10.05L11.2929 15.5929C11.6834 15.9835 12.3166 15.9835 12.7071 15.5929L18.25 10.05C18.6642 9.63584 18.6642 8.96426 18.25 8.55005C17.8358 8.13584 17.1642 8.13584 16.75 8.55005L12.5657 12.7344C12.2533 13.0468 11.7467 13.0468 11.4343 12.7344Z" fill="black" />
                                                </svg>
                                            </span>
                                            <!--end::Svg Icon-->
                                        </span></div>
                                        <!--end::User toggle-->
                                        <!--begin::User form-->
                                        <div id="kt_modal_update_politicalpartyagent_user_info" class="collapse show">
                                        <!--begin::Input group-->
                                        <div class="fv-row mb-7">
                                            <!--begin::Label-->
                                            <label class="required fs-6 fw-bold mb-2">Political Party</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <input type="text" class="form-control form-control-solid" placeholder="Political Party" name="political_party" id="political_party" value="{{$politicalpartyagent->political_party}}" />
                                            <!--end::Input-->
                                        </div>
                                        <!--end::Input group-->
                                
            <!--begin::Input group-->
                                <div class="fv-row mb-7">
                                    <!--begin::Label-->
                                    <label class="required fs-6 fw-bold mb-2">First Name</label>
                                    <!--end::Label-->
                                    <!--begin::Input-->
                                    <input type="text" class="form-control form-control-solid" placeholder="First Name" name="first_name" id="first_name" value="" />
                                    <!--end::Input-->
                                </div>
                                <!--end::Input group-->
                                <!--begin::Input group-->
                                <div class="fv-row mb-7">
                                    <!--begin::Label-->
                                    <label class="required fs-6 fw-bold mb-2">Middle Name</label>
                                    <!--end::Label-->
                                    <!--begin::Input-->
                                    <input type="text" class="form-control form-control-solid" placeholder="Middle Name" name="middle_name" id="middle_name" value="" />
                                    <!--end::Input-->
                                </div>
                                <!--end::Input group-->

                                <!--begin::Input group-->
                                <div class="fv-row mb-7">
                                    <!--begin::Label-->
                                    <label class="required fs-6 fw-bold mb-2">Last Name</label>
                                    <!--end::Label-->
                                    <!--begin::Input-->
                                    <input type="text" class="form-control form-control-solid" placeholder="Last Name" name="last_name" id="last_name" value="" />
                                    <!--end::Input-->
                                </div>
                                <!--end::Input group-->
                                            

                                            <!--begin::Input group-->
                                            <div class="fv-row mb-7">
                                                <!--begin::Label-->
                                                <label class="required fs-6 fw-bold mb-2">Agent Picture</label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <input type="file" class="form-control form-control-solid" placeholder="Agent Picture" name="agent_picture" id="agent_picture" value="" />
                                                <!--end::Input-->
                                            </div>
                                            <!--end::Input group-->


                                            <!--begin::Input group-->
                                            <div class="fv-row mb-7" id="js-data-lga-modal">
                                                <!--begin::Label-->
                                                <label class="required fs-6 fw-bold mb-2">LGA Assignment</label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <select class="form-control form-control-solid" id="js-data-lga-ajax" name="lga_id">
                                                <option value="{{$politicalpartyagent->lga->id}}">{{$politicalpartyagent->lga->name}}</option>
                                                </select>
                                                <!--end::Input-->
                                            </div>
                                            <!--end::Input group-->
                                            
                                            <!--begin::Input group-->
                                            <div class="fv-row mb-7" id="js-data-wards-modal">
                                                <!--begin::Label-->
                                                <label class="required fs-6 fw-bold mb-2">Award Assignment</label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <select class="form-control form-control-solid" id="js-data-wards-ajax" name="wards_id" >
                                                <option value="{{$politicalpartyagent->ward->id}}">{{$politicalpartyagent->ward->name}}</option>
                                                </select>
                                                <!--end::Input-->
                                            </div>
                                            <!--end::Input group-->
                
                                            <!--begin::Input group-->
                                            <div class="fv-row mb-7" id="js-data-pu-modal">
                                                <!--begin::Label-->
                                                <label class="required fs-6 fw-bold mb-2">Polling Unit Assignment</label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <select class="form-control form-control-solid" id="js-data-pu-ajax" name="polling_unit_id" >
                                                <option value="{{$politicalpartyagent->pollingunit->id}}">{{$politicalpartyagent->pollingunit->name}}</option>
                                                </select>
                                                <!--end::Input-->
                                            </div>
                                            <!--end::Input group-->
                                
                                            <!--begin::Input group-->
                                            <div class="fv-row mb-7">
                                                <!--begin::Label-->
                                                <label class="required fs-6 fw-bold mb-2">Designation</label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <input type="text" class="form-control form-control-solid" placeholder="Designation" name="designation" id="designation" value="{{$politicalpartyagent->designation}}" />
                                                <!--end::Input-->
                                            </div>
                                            <!--end::Input group-->
                                            
                                            <!--begin::Input group-->
                                            <div class="fv-row mb-7">
                                                <!--begin::Label-->
                                                <label class="required fs-6 fw-bold mb-2">Home Address</label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <input type="text" class="form-control form-control-solid" placeholder="Home Address" name="home_address" id="home_address" value="{{$politicalpartyagent->home_address}}" />
                                                <!--end::Input-->
                                            </div>
                                            <!--end::Input group-->
                                                                <!--begin::Input group-->
                                            <div class="fv-row mb-7">
                                                <!--begin::Label-->
                                                <label class="required fs-6 fw-bold mb-2">Latitude</label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <input type="text" class="form-control form-control-solid" placeholder="latitude" name="latitude" id="latitude" value="{{$politicalpartyagent->latitude}}" />
                                                <!--end::Input-->
                                            </div>
                                            <!--end::Input group-->


                                            <!--begin::Input group-->
                                            <div class="fv-row mb-7">
                                                <!--begin::Label-->
                                                <label class="required fs-6 fw-bold mb-2">Longitude</label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <input type="text" class="form-control form-control-solid" placeholder="longitude" name="longitude" id="longitude" value="{{$politicalpartyagent->longitude}}" />
                                                <!--end::Input-->
                                            </div>

                                            <!--begin::Input group-->
                                            <div class="fv-row mb-7">
                                                <!--begin::Label-->
                                                <label class="required fs-6 fw-bold mb-2">Mobile</label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <input type="text" class="form-control form-control-solid" placeholder="Mobile" name="mobile" id="mobile" value="{{$politicalpartyagent->mobile}}" />
                                                <!--end::Input-->
                                            </div>
                                            <!--end::Input group-->
                                            
                                            <!--begin::Input group-->
                                            <div class="fv-row mb-7">
                                                <!--begin::Label-->
                                                <label class="required fs-6 fw-bold mb-2">Additional Mobile</label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <input type="text" class="form-control form-control-solid" placeholder="Additional Mobile" name="extra_mobile"  id="extra_mobile" value="{{$politicalpartyagent->extra_mobile}}" />
                                                <!--end::Input-->
                                            </div>
                                            <!--end::Input group-->
                                            
                                            
                                            
                                            <!--begin::Input group-->
                                            <div class="fv-row mb-7">
                                                <!--begin::Label-->
                                                <label class="required fs-6 fw-bold mb-2">Name Party Chairman</label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <input type="text" class="form-control form-control-solid" placeholder="Name party chairman" name="name_party_chairman"  id="name_party_chairman" value="{{$politicalpartyagent->name_party_chairman}}" />
                                                <!--end::Input-->
                                            </div>
                                            <!--end::Input group-->
                                            
                                        
                                            
                                           <!--begin::Input group-->
                                            <div class="fv-row mb-7">
                                                <!--begin::Label-->
                                                <label class="required fs-6 fw-bold mb-2">Name electoral officer</label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <input type="text" class="form-control form-control-solid" placeholder="name electoral officer" name="name_electoral_officer"  id="name_electoral_officer" value="{{$politicalpartyagent->name_electoral_officer}}" />
                                                <!--end::Input-->
                                            </div>
                                            <!--end::Input group-->
                                            <div class="d-flex fv-row mb-7">
                                            <!--begin::Input group-->
                                            <div class="d-flex col-md-6">
                                                
                                                <!--begin::Input-->
                                                
                                                
                                                <div class="form-check form-check-sm  form-check-solid me-3">
                                                    <input class="form-check-input" type="checkbox" data-kt-check="true" name="signature_agent" id="signature_agent" value="1" @if($politicalpartyagent->signature_agent) checked @endif/>
                                                </div>
                                                <!--end::Input-->
                                                
                                                <!--begin::Label-->
                                                <label class="required fs-6 fw-bold mb-2" for="signature_agent">Signature Agent</label>
                                                <!--end::Label-->
                                            </div>
                                            <!--end::Input group-->
                                            
                                            <!--begin::Input group-->
                                            
                                            <div class="d-flex col-md-6">
                                                
                                                <!--begin::Input-->
                                                
                                                
                                                <div class="form-check form-check-sm  form-check-solid me-3">
                                                    <input class="form-check-input" type="checkbox" data-kt-check="true" name="signature_auth_party_officials"  id="signature_auth_party_officials" value="1" @if($politicalpartyagent->signature_auth_party_officials) checked @endif/>
                                                </div>
                                
                                                <!--end::Input-->
                                                
                                                <!--begin::Label-->
                                                <label class="required fs-6 fw-bold mb-2" for="signature_auth_party_officials">Signature authorization party officials</label>
                                                <!--end::Label-->
                                            </div>
                                            <!--end::Input group-->
                                            </div>
                                            
                                            <div class="d-flex fv-row mb-7">
                                            <!--begin::Input group-->
                                            <div class="d-flex col-md-6">
                                                
                                                <!--begin::Input-->
                                                
                                                <div class="form-check form-check-sm  form-check-solid me-3">
                                                    <input class="form-check-input" type="checkbox" data-kt-check="true" name="signature_party_chairman" id="signature_party_chairman" value="1" @if($politicalpartyagent->signature_party_chairman) checked @endif/>
                                                </div>
                                                <!--end::Input-->
                                                <!--begin::Label-->
                                                <label class="required fs-6 fw-bold mb-2" for="signature_party_chairman">Signature party chairman</label>
                                                <!--end::Label-->
                                            </div>
                                            
                                            <!--end::Input group-->
                                            
                                           <!--begin::Input group-->
                                            <div class="d-flex col-md-6">
                                                
                                                <!--begin::Input-->
                                                <div class="form-check form-check-sm  form-check-solid me-3">
                                                    <input class="form-check-input" type="checkbox" data-kt-check="true" name="signature_electoral_officer"  id="signature_electoral_officer" value="1" @if($politicalpartyagent->signature_electoral_officer) checked @endif />
                                                </div>
                                                
                                                <!--end::Input-->
                                                
                                                <!--begin::Label-->
                                                <label class="required fs-6 fw-bold mb-2" for="signature_electoral_officer">Signature electoral officer</label>
                                                <!--end::Label-->
                                            </div>
                                            <!--end::Input group-->
                                            
                                           
                                        </div>
                                        </div>
                                        <!--end::User form-->
                                    </div>
                                    <!--end::Scroll-->
                                </div>
                                <!--end::Modal body-->
                                <!--begin::Modal footer-->
                                <div class="modal-footer flex-center">
                                    <!--begin::Button-->
                                    <button type="reset" id="kt_modal_update_politicalpartyagent_cancel" class="btn btn-light me-3">Discard</button>
                                    <!--end::Button-->
                                    <!--begin::Button-->
                                    <button type="submit" id="kt_modal_update_politicalpartyagent_submit" class="btn btn-primary">
                                        <span class="indicator-label">Submit</span>
                                        
                                    </button>
                                    <!--end::Button-->
                                </div>
                                <!--end::Modal footer-->
                            </form>
                            <!--end::Form-->
 </div>
</div>


              
                <!--end::Layout-->
               
                
                
               
            </div>
            <!--end::Container-->
        </div>
        <!--end::Post-->
    </div>
    <!--end::Content-->
@endsection

@section("after_script")
    <!--begin::Page Custom Javascript(used by this page)-->
    <script src="{{ asset('assets/js/custom/apps/politicalpartyagents/update.js') }}"></script>
	<script src="{{ asset('assets/js/custom/apps/common/select2dropdown.js') }}"></script>

    <!--end::Page Custom Javascript-->
    <!--end::Javascript-->
@endsection