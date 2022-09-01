    @extends("layouts.app")

    @push("styles")
    <link rel="stylesheet" type="text/css" href="/public/assets/css/toggle-switch.css">
    @endpush

    @section("content")
        <!--begin::Content-->
        <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
            <!--begin::Post-->
            <div class="post d-flex flex-column-fluid" id="kt_post">
                <!--begin::Container-->
                <div id="kt_content_container" class="container-xxl">
                    <!--begin::Layout-->
                    <div class="d-flex flex-column flex-xl-row">
                        <!--begin::Sidebar-->
                        <div class="flex-column flex-lg-row-auto col-12 mb-12">
                            <!--begin::Card-->
                            <div class="card mb-5 mb-xl-8">
                                <!--begin::Card body-->
                                <div class="card-body pt-15">
                                    <!--begin::Summary-->
                                    <div class="d-flex flex-center flex-column mb-5">
                                        <!--begin::Avatar-->
                                        <!--end::Avatar-->
                                        <!--begin::Name-->
                                        <a href="#" class="fs-3 text-gray-800 text-hover-primary fw-bolder mb-3"></a>
                                        <!--end::Name-->
                                        <div class="mb-9">
                                            <!--begin::Badge-->
                                            <div class="badge badge-light-primary d-inline">Comment</div>
                                            <!--begin::Badge-->
                                        </div>

                                    </div>
                                    <!--end::Summary-->
                                    <!--begin::Details toggle-->
                                    <div class="d-flex flex-stack fs-4 py-3">
                                        <div class="fw-bolder rotate collapsible" data-bs-toggle="collapse" href="#kt_post_view_details" role="button" aria-expanded="false" aria-controls="kt_post_view_details">Details
                                        <span class="ms-2 rotate-180">
                                            <!--begin::Svg Icon | path: icons/duotune/arrows/arr072.svg-->
                                            <span class="svg-icon svg-icon-3">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                    <path d="M11.4343 12.7344L7.25 8.55005C6.83579 8.13583 6.16421 8.13584 5.75 8.55005C5.33579 8.96426 5.33579 9.63583 5.75 10.05L11.2929 15.5929C11.6834 15.9835 12.3166 15.9835 12.7071 15.5929L18.25 10.05C18.6642 9.63584 18.6642 8.96426 18.25 8.55005C17.8358 8.13584 17.1642 8.13584 16.75 8.55005L12.5657 12.7344C12.2533 13.0468 11.7467 13.0468 11.4343 12.7344Z" fill="black" />
                                                </svg>
                                            </span>
                                            <!--end::Svg Icon-->
                                        </span></div>
                                        @can('edit')
                                            <span data-bs-toggle="tooltip" data-bs-trigger="hover" title="Edit post details">
                                                <a href="#" class="btn btn-sm btn-light-primary" data-bs-toggle="modal" data-bs-target="#kt_modal_update_post">Edit</a>
                                            </span>
                                        @endcan
                                    </div>
                                    <!--end::Details toggle-->
                                    <div class="separator separator-dashed my-3"></div>
                                    <!--begin::Details content-->
                                    <div id="kt_post_view_details" class="collapse show">
                                        <div class="py-5 fs-6">
                                            <div class="table-responsive">
                                                <!--begin::Table-->
                                                <table class="table align-middle table-row-dashed gy-5" id="kt_table_users_login_session">
                                                    <!--begin::Table body-->
                                                    <tbody class="fs-6 fw-bold text-gray-600">
                                                        <tr>
                                                            <td>User</td>
                                                            <td>{{ ucfirst($userName) }}</td>
                                                            <td class="text-end">
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Comment</td>
                                                            <td>{{ $postLike->comment }}</td>
                                                            <td class="text-end">
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Created at</td>
                                                            <td>{{ $postLike->created_at->format("d M Y, g:i A") }}</td>
                                                            <td class="text-end">
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                    <!--end::Table body-->
                                                </table>
                                                <!--end::Table-->
                                            </div>
                                            <input type="hidden" id="post_detail_id" value="{{ $postLike->id }}">

                                            <!--begin::Details item-->
                                        </div>
                                    </div>
                                    <!--end::Details content-->
                                </div>
                                <!--end::Card body-->
                            </div>
                            <!--end::Card-->
                        </div>
                        <!--end::Sidebar-->
                    </div>
                    <!--end::Layout-->
                    <!--begin::Modal - New Address-->
                    <div class="modal fade" id="kt_modal_update_post" tabindex="-1" aria-hidden="true">
                        <!--begin::Modal dialog-->
                        <div class="modal-dialog modal-dialog-centered mw-650px">
                            <!--begin::Modal content-->
                            <div class="modal-content">
                                <!--begin::Form-->
                                <form class="form" action="{{ url('report/updateComment') }}" id="kt_modal_update_post_form" enctype="multipart/form-data" novalidate="novalidate" method="post">
                                    @csrf
                                    <input id="id" name="comment_id" type="hidden" value="{{ $postLike->id }}">
                                    <input id="id" name="report_id" type="hidden" value="{{ $postLike->report_id }}">
                                    <!--begin::Modal header-->
                                    <div class="modal-header" id="kt_modal_update_post_header">
                                        <!--begin::Modal title-->
                                        <h2 class="fw-bolder">Update Comment</h2>
                                        <!--end::Modal title-->
                                        <!--begin::Close-->
                                        <div id="kt_modal_update_post_close" class="btn btn-icon btn-sm btn-active-icon-primary">
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
                                        <div class="d-flex flex-column scroll-y me-n7 pe-7" id="kt_modal_update_post_scroll" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_update_post_header" data-kt-scroll-wrappers="#kt_modal_update_post_scroll" data-kt-scroll-offset="300px">
                                            <!--begin::Post toggle-->
                                            <div class="fw-bolder fs-3 rotate collapsible mb-7" data-bs-toggle="collapse" href="#kt_modal_update_post_post_info" role="button" aria-expanded="false" aria-controls="kt_modal_update_post_post_info">Post Information
                                            <span class="ms-2 rotate-180">
                                                <!--begin::Svg Icon | path: icons/duotune/arrows/arr072.svg-->
                                                <span class="svg-icon svg-icon-3">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                        <path d="M11.4343 12.7344L7.25 8.55005C6.83579 8.13583 6.16421 8.13584 5.75 8.55005C5.33579 8.96426 5.33579 9.63583 5.75 10.05L11.2929 15.5929C11.6834 15.9835 12.3166 15.9835 12.7071 15.5929L18.25 10.05C18.6642 9.63584 18.6642 8.96426 18.25 8.55005C17.8358 8.13584 17.1642 8.13584 16.75 8.55005L12.5657 12.7344C12.2533 13.0468 11.7467 13.0468 11.4343 12.7344Z" fill="black" />
                                                    </svg>
                                                </span>
                                                <!--end::Svg Icon-->
                                            </span></div>
                                            <!--end::Post toggle-->
                                            <!--begin::Post form-->
                                            <div id="kt_modal_update_post_post_info" class="collapse show">
                                                <!--begin::Input group-->

                                                <!--begin::Input group-->
                                                 <div class="fv-row mb-7">
                                                     <!--begin::Label-->
                                                     <label class="fs-6 fw-bold mb-2">
                                                         User
                                                     </label>
                                                     <!--end::Label-->
                                                     <!--begin::Input-->
                                                     <select name="user_id" class="form-control form-control-solid" required>
                                                         <option value="">Select User</option>
                                                         @foreach($users  as $user)
                                                           <option @if($postLike->user_id  == $user->id) selected="selected" @endif value="{{$user->id}}">{{$user->name}}</option>
                                                         @endforeach
                                                     </select>
                                                     <!--end::Input-->
                                                 </div>

				                                <div class="fv-row mb-7">
				                                    <!--begin::Label-->
				                                    <label class="fs-6 fw-bold mb-2">
				                                        Comment
				                                    </label>
                                                    <textarea class="form-control form-control-lg form-control-solid" name="comment">{{$postLike->comment}}</textarea>
				                                    <!--end::Label-->
				                                    <!--begin::Input-->
				                                    
				                                    <!--end::Input-->
				                                </div>
                                                <!--end::Input group-->

                                            </div>
                                            <!--end::Post form-->
                                        </div>
                                        <!--end::Scroll-->
                                    </div>
                                    <!--end::Modal body-->
                                    <!--begin::Modal footer-->
                                    <div class="modal-footer flex-center">
                                        <!--begin::Button-->
                                        <button type="reset" id="kt_modal_update_post_cancel" class="btn btn-light me-3">Discard</button>
                                        <!--end::Button-->
                                        <!--begin::Button-->
                                        <button type="submit" id="" class="btn btn-primary">
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
                    <!--end::Modal - New Address-->
                    <!--end::Modals-->
                   
                </div>
                <!--end::Container-->
            </div>
            <!--end::Post-->
        </div>
        <!--end::Content-->
    @endsection

    @section("after_script")
        <!--begin::Page Custom Javascript(used by this page)-->
        <script src="{{ asset('public/assets/js/custom/apps/report/update.js') }}"></script>

        <!--end::Page Custom Javascript-->
        <!--end::Javascript-->
    @endsection