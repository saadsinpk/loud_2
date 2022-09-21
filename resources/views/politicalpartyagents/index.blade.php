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
            <h1>Political Party Agents</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Political Party Agents</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>


<!--begin::Post-->
<div class="post d-flex flex-column-fluid" id="kt_post">
    <!--begin::Container-->
    <div id="kt_content_container" class="container-xxl">
        <!--begin::Card-->
        <div class="card">
            <!--begin::Card header-->
            <div class="card-header border-0 pt-6">
                <!--begin::Card title-->
                <div class="card-title">
                    <!--begin::Search-->
                    <div class="d-flex align-items-center position-relative my-1">
                        <!--begin::Svg Icon | path: icons/duotune/general/gen021.svg-->
                        <span class="svg-icon svg-icon-1 position-absolute ms-6">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1" transform="rotate(45 17.0365 15.1223)" fill="black" />
                                <path d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z" fill="black" />
                            </svg>
                        </span>
                        <!--end::Svg Icon-->
                        <input type="text" data-kt-politicalpartyagent-table-filter="search" class="form-control form-control-solid w-250px ps-15" placeholder="Search..." />
                    </div>
                    <!--end::Search-->
                </div>
                <!--begin::Card title-->
                <!--begin::Card toolbar-->
                <div class="card-toolbar">
                    <!--begin::Toolbar-->
                    <div class="d-flex justify-content-end" data-kt-politicalpartyagent-table-toolbar="base">
                        <!--begin::Add politicalpartyagent-->
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#kt_modal_add_politicalpartyagent">Add political party agent</button>
                        <!--end::Add politicalpartyagent-->
                    </div>
                    <!--end::Toolbar-->
                    <!--begin::Group actions-->
                    <div class="d-flex justify-content-end align-items-center d-none" data-kt-politicalpartyagent-table-toolbar="selected">
                        <div class="fw-bolder me-5">
                        <span class="me-2" data-kt-politicalpartyagent-table-select="selected_count"></span>Selected</div>
                        <button type="button" class="btn btn-danger" data-kt-politicalpartyagent-table-select="delete_selected">Delete Selected</button>
                    </div>
                    <!--end::Group actions-->
                </div>
                <!--end::Card toolbar-->
            </div>
            <!--end::Card header-->
            <!--begin::Card body-->
            <div class="card-body pt-0">
                <!--begin::Table-->
                <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_politicalpartyagents_table">
                    <!--begin::Table head-->
                    <thead>
                        <!--begin::Table row-->
                        <tr class="text-start text-gray-400 fw-bolder fs-7 text-uppercase gs-0">
                            <th class="w-10px pe-2">
                                <div class="form-check form-check-sm form-check-custom form-check-solid me-3">
                                    <input class="form-check-input" type="checkbox" data-kt-check="true" data-kt-check-target="#kt_politicalpartyagents_table .form-check-input" value="1" />
                                </div>
                            </th>
                            <th class="min-w-125px">political party agent Name</th>
                            <th class="min-w-125px">Name</th>
                            <th class="min-w-125px">Created Date</th>
                            <th class="text-end min-w-70px">Actions</th>
                        </tr>
                        <!--end::Table row-->
                    </thead>
                    <!--end::Table head-->
                    <!--begin::Table body-->
                    <tbody class="fw-bold text-gray-600">
                    </tbody>
                    <!--end::Table body-->
                </table>
                <!--end::Table-->
            </div>
            <!--end::Card body-->
        </div>
        <!--end::Card-->
        <!--begin::Modals-->
        <!--begin::Modal - politicalpartyagents - Add-->
        <div class="modal fade" id="kt_modal_add_politicalpartyagent" tabindex="-1" aria-hidden="true">
            <!--begin::Modal dialog-->
            <div class="modal-dialog modal-dialog-centered mw-650px">
                <!--begin::Modal content-->
                <div class="modal-content">
                    <!--begin::Form-->
                    <form class="form" action="{{ url('/politicalpartyagents') }}" id="kt_modal_add_politicalpartyagent_form" data-kt-redirect="{{ url('/politicalpartyagents') }}" enctype="multipart/form-data" method="POST" novalidate="novalidate">
                        @csrf
                        <!--begin::Modal header-->
                        <div class="modal-header" id="kt_modal_add_politicalpartyagent_header">
                            <!--begin::Modal title-->
                            <h2 class="fw-bolder">Add a political party agent</h2>
                            <!--end::Modal title-->
                            <!--begin::Close-->
                            <div id="kt_modal_add_politicalpartyagent_close" class="btn btn-icon btn-sm btn-active-icon-primary">
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
                            <div class="scroll-y me-n7 pe-7" id="kt_modal_add_politicalpartyagent_scroll" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_add_politicalpartyagent_header" data-kt-scroll-wrappers="#kt_modal_add_politicalpartyagent_scroll" data-kt-scroll-offset="0px">
                                
                                <!--begin::Input group-->
                                <div class="fv-row mb-7">
                                    <!--begin::Label-->
                                    <label class="required fs-6 fw-bold mb-2">Political Party</label>
                                    <!--end::Label-->
                                    <!--begin::Input-->
                                    <input type="text" class="form-control form-control-solid" placeholder="Political Party" name="political_party" id="political_party" value="" />
                                    <!--end::Input-->
                                </div>
                                <!--end::Input group-->
								
								<!--begin::Input group-->
                                <div class="fv-row mb-7">
                                    <!--begin::Label-->
                                    <label class="required fs-6 fw-bold mb-2">Name</label>
                                    <!--end::Label-->
                                    <!--begin::Input-->
                                    <input type="text" class="form-control form-control-solid" placeholder="Name" name="name" id="name" value="" />
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
												<select class="form-control form-control-solid" id="js-data-lga-ajax" name="lga_id"></select>
												<!--end::Input-->
											</div>
											<!--end::Input group-->
											
											<!--begin::Input group-->
											<div class="fv-row mb-7" id="js-data-wards-modal">
												<!--begin::Label-->
												<label class="required fs-6 fw-bold mb-2">Award Assignment</label>
												<!--end::Label-->
												<!--begin::Input-->
												<select class="form-control form-control-solid" id="js-data-wards-ajax" name="wards_id" ></select>
												<!--end::Input-->
											</div>
											<!--end::Input group-->
                
											<!--begin::Input group-->
											<div class="fv-row mb-7" id="js-data-pu-modal">
												<!--begin::Label-->
												<label class="required fs-6 fw-bold mb-2">Polling Unit Assignment</label>
												<!--end::Label-->
												<!--begin::Input-->
												<select class="form-control form-control-solid" id="js-data-pu-ajax" name="polling_unit_id" ></select>
												<!--end::Input-->
											</div>
											<!--end::Input group-->
                                
											<!--begin::Input group-->
											<div class="fv-row mb-7">
												<!--begin::Label-->
												<label class="required fs-6 fw-bold mb-2">Designation</label>
												<!--end::Label-->
												<!--begin::Input-->
												<input type="text" class="form-control form-control-solid" placeholder="Designation" name="designation" id="designation" value="" />
												<!--end::Input-->
											</div>
											<!--end::Input group-->
											
											<!--begin::Input group-->
											<div class="fv-row mb-7">
												<!--begin::Label-->
												<label class="required fs-6 fw-bold mb-2">Home Address</label>
												<!--end::Label-->
												<!--begin::Input-->
												<input type="text" class="form-control form-control-solid" placeholder="Home Address" name="home_address" id="home_address" value="" />
												<!--end::Input-->
											</div>
											<!--end::Input group-->
											
											<!--begin::Input group-->
											<div class="fv-row mb-7">
												<!--begin::Label-->
												<label class="required fs-6 fw-bold mb-2">Mobile</label>
												<!--end::Label-->
												<!--begin::Input-->
												<input type="text" class="form-control form-control-solid" placeholder="Mobile" name="mobile" id="mobile" value="" />
												<!--end::Input-->
											</div>
											<!--end::Input group-->
											
											<!--begin::Input group-->
											<div class="fv-row mb-7">
												<!--begin::Label-->
												<label class="required fs-6 fw-bold mb-2">Additional Mobile</label>
												<!--end::Label-->
												<!--begin::Input-->
												<input type="text" class="form-control form-control-solid" placeholder="Additional Mobile" name="extra_mobile"  id="extra_mobile" value="" />
												<!--end::Input-->
											</div>
											<!--end::Input group-->
											
											<!--begin::Input group-->
											<div class="fv-row mb-7">
												<!--begin::Label-->
												<label class="required fs-6 fw-bold mb-2">Signature Agent</label>
												<!--end::Label-->
												<!--begin::Input-->
												
												
												<div class="form-check form-check-sm form-check-custom form-check-solid me-3">
													<input class="form-check-input" type="checkbox" data-kt-check="true" name="signature_agent" id="signature_agent" value="1" />
												</div>
												<!--end::Input-->
											</div>
											<!--end::Input group-->
											
											<!--begin::Input group-->
											<div class="fv-row mb-7">
												<!--begin::Label-->
												<label class="required fs-6 fw-bold mb-2">Signature auth party officials</label>
												<!--end::Label-->
												<!--begin::Input-->
												
												
												<div class="form-check form-check-sm form-check-custom form-check-solid me-3">
													<input class="form-check-input" type="checkbox" data-kt-check="true" name="signature_auth_party_officials"  id="signature_auth_party_officials" value="1" />
												</div>
								
												<!--end::Input-->
											</div>
											<!--end::Input group-->
											
											<!--begin::Input group-->
											<div class="fv-row mb-7">
												<!--begin::Label-->
												<label class="required fs-6 fw-bold mb-2">Name Party Chairman</label>
												<!--end::Label-->
												<!--begin::Input-->
												<input type="text" class="form-control form-control-solid" placeholder="Name party chairman" name="name_party_chairman"  id="name_party_chairman" value="" />
												<!--end::Input-->
											</div>
											<!--end::Input group-->
											
										<!--begin::Input group-->
											<div class="fv-row mb-7">
												<!--begin::Label-->
												<label class="required fs-6 fw-bold mb-2">Signature party chairman</label>
												<!--end::Label-->
												<!--begin::Input-->
												
												<div class="form-check form-check-sm form-check-custom form-check-solid me-3">
													<input class="form-check-input" type="checkbox" data-kt-check="true" name="signature_party_chairman" id="signature_party_chairman" value="1" />
												</div>
												<!--end::Input-->
											</div>
											
											<!--end::Input group-->
											
										   <!--begin::Input group-->
											<div class="fv-row mb-7">
												<!--begin::Label-->
												<label class="required fs-6 fw-bold mb-2">Name electoral officer</label>
												<!--end::Label-->
												<!--begin::Input-->
												<input type="text" class="form-control form-control-solid" placeholder="name electoral officer" name="name_electoral_officer"  id="name_electoral_officer" value="" />
												<!--end::Input-->
											</div>
											<!--end::Input group-->
											
										   <!--begin::Input group-->
											<div class="fv-row mb-7">
												<!--begin::Label-->
												<label class="required fs-6 fw-bold mb-2">Signature electoral officer</label>
												<!--end::Label-->
												<!--begin::Input-->
												<div class="form-check form-check-sm form-check-custom form-check-solid me-3">
													<input class="form-check-input" type="checkbox" data-kt-check="true" name="signature_electoral_officer"  id="signature_electoral_officer" value="1" />
												</div>
												
												<!--end::Input-->
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
                            <button type="reset" id="kt_modal_add_politicalpartyagent_cancel" class="btn btn-light me-3">Discard</button>
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
        <!--end::Modal - politicalpartyagents - Add-->

        <!--begin::Modal - Adjust Balance-->
        <div class="modal fade" id="kt_politicalpartyagents_export_modal" tabindex="-1" aria-hidden="true">
            <!--begin::Modal dialog-->
            <div class="modal-dialog modal-dialog-centered mw-650px">
                <!--begin::Modal content-->
                <div class="modal-content">
                    <!--begin::Modal header-->
                    <div class="modal-header">
                        <!--begin::Modal title-->
                        <h2 class="fw-bolder">Export political party agents</h2>
                        <!--end::Modal title-->
                        <!--begin::Close-->
                        <div id="kt_politicalpartyagents_export_close" class="btn btn-icon btn-sm btn-active-icon-primary">
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
                    <div class="modal-body scroll-y mx-5 mx-xl-15 my-7">
                        <!--begin::Form-->
                        <form id="kt_politicalpartyagents_export_form" class="form" action="#">
                            <!--begin::Input group-->
                            <div class="fv-row mb-10">
                                <!--begin::Label-->
                                <label class="fs-5 fw-bold form-label mb-5">Select Date Range:</label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                <input class="form-control form-control-solid" placeholder="Pick a date" name="date" />
                                <!--end::Input-->
                            </div>
                            <!--end::Input group-->
                            <!--begin::Input group-->
                            <div class="fv-row mb-10">
                                <!--begin::Label-->
                                <label class="fs-5 fw-bold form-label mb-5">Select Export Format:</label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                <select data-control="select2" data-placeholder="Select a format" data-hide-search="true" name="format" class="form-select form-select-solid">
                                    <option value="excell">Excel</option>
                                    <option value="pdf">PDF</option>
                                    <option value="cvs">CVS</option>
                                    <option value="zip">ZIP</option>
                                </select>
                                <!--end::Input-->
                            </div>
                            <!--end::Input group-->
                            
                            <!--begin::Actions-->
                            <div class="text-center">
                                <button type="reset" id="kt_politicalpartyagents_export_cancel" class="btn btn-light me-3">Discard</button>
                                <button type="submit" id="kt_politicalpartyagents_export_submit" class="btn btn-primary">
                                    <span class="indicator-label">Submit</span>
                                    <span class="indicator-progress">Please wait...
                                    <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                </button>
                            </div>
                            <!--end::Actions-->
                        </form>
                        <!--end::Form-->
                    </div>
                    <!--end::Modal body-->
                </div>
                <!--end::Modal content-->
            </div>
            <!--end::Modal dialog-->
        </div>
        <!--end::Modals-->
    </div>
    <!--end::Container-->
</div>
<!--end::Post-->
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
    <script src="{{ asset('assets/js/custom/apps/politicalpartyagents/add.js') }}"></script>
    <script src="{{ asset('assets/js/custom/apps/politicalpartyagents/list.js') }}"></script>
	<script src="{{ asset('assets/js/custom/apps/common/select2dropdown.js') }}"></script>
    <!--end::Page Custom Javascript-->
    <!--end::Javascript-->
@endsection