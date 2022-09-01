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
                                        <a href="#" class="fs-3 text-gray-800 text-hover-primary fw-bolder mb-3">{{ $poll->name }}</a>
                                        <!--end::Name-->
                                        <div class="mb-9">
                                            <!--begin::Badge-->
                                            <div class="badge badge-light-primary d-inline">Poll</div>
                                            <!--begin::Badge-->
                                        </div>

                                    </div>
                                    <!--end::Summary-->
                                    <!--begin::Details toggle-->
                                    <div class="d-flex flex-stack fs-4 py-3">
                                        <div class="fw-bolder rotate collapsible" data-bs-toggle="collapse" href="#kt_poll_view_details" role="button" aria-expanded="false" aria-controls="kt_poll_view_details">Details
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
                                            <span data-bs-toggle="tooltip" data-bs-trigger="hover" title="Edit poll details">
                                                <a href="#" class="btn btn-sm btn-light-primary" data-bs-toggle="modal" data-bs-target="#kt_modal_update_poll">Edit</a>
                                            </span>
                                        @endcan
                                    </div>
                                    <!--end::Details toggle-->
                                    <div class="separator separator-dashed my-3"></div>
                                    <!--begin::Details content-->
                                    <div id="kt_poll_view_details" class="collapse show">
                                        <div class="py-5 fs-6">
                                            <!--begin::Details item-->
                                            <div class="table-responsive">
                                                <!--begin::Table-->
                                                <table class="table align-middle table-row-dashed gy-5" id="kt_table_users_login_session">
                                                    <!--begin::Table body-->
                                                    <tbody class="fs-6 fw-bold text-gray-600">
                                                        <tr>
                                                            <td>Question</td>
                                                            <td>{{ $poll->question }}</td>
                                                            <td class="text-end">
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>User</td>
                                                            <td>{{ ucfirst($userName) }}</td>
                                                            <td class="text-end">
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Ends IN</td>
                                                            <td>{{ $poll->ends_in }}</td>
                                                            <td class="text-end">
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Options</td>
                                                            
                                                            <td>@foreach($PollOptions as $PollOptions_key => $PollOptions_value)
                                                                {{$PollOptions_value->name}},
                                                            @endforeach</td>
                                                            <td class="text-end">
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Is people share</td>
                                                            <td>{{ $poll->is_people_share }}</td>
                                                            <td class="text-end">
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Hide creator detail</td>
                                                            <td>{{ $poll->hide_creator_detail }}</td>
                                                            <td class="text-end">
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Total Vote</td>
                                                            <td>{{ $total_vote }}</td>
                                                            <td class="text-end">
                                                            </td>
                                                        </tr>

                                                        <tr>
                                                            <td>Create Time</td>
                                                            <td>{{ $poll->created_at->format("d M Y, g:i A") }}</td>
                                                            <td class="text-end">
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                    <!--end::Table body-->
                                                </table>
                                                <!--end::Table-->
                                            </div>
                                            <input type="hidden" id="poll_detail_id" value="{{ $poll->id }}">

                                            <!--begin::Details item-->
                                            <!--begin::Details item-->

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
                    <div class="modal fade" id="kt_modal_update_poll" tabindex="-1" aria-hidden="true">
                        <!--begin::Modal dialog-->
                        <div class="modal-dialog modal-dialog-centered mw-650px">
                            <!--begin::Modal content-->
                            <div class="modal-content">
                                <!--begin::Form-->
                                <form class="form" action="{{ url('poll/update') }}" id="kt_modal_update_poll_form" enctype="multipart/form-data" novalidate="novalidate" method="post">
                                    @csrf
                                    <input id="id" name="id" type="hidden" value="{{ $poll->id }}">
                                    <input type="hidden" name="date_filter" value="<?php echo date("m/d/Y")?>">
                                    <!--begin::Modal header-->
                                    <div class="modal-header" id="kt_modal_update_poll_header">
                                        <!--begin::Modal title-->
                                        <h2 class="fw-bolder">Update poll</h2>
                                        <!--end::Modal title-->
                                        <!--begin::Close-->
                                        <div id="kt_modal_update_poll_close" class="btn btn-icon btn-sm btn-active-icon-primary">
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
                                        <div class="d-flex flex-column scroll-y me-n7 pe-7" id="kt_modal_update_poll_scroll" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_update_poll_header" data-kt-scroll-wrappers="#kt_modal_update_poll_scroll" data-kt-scroll-offset="300px">
                                            <!--begin::Poll toggle-->
                                            <div class="fw-bolder fs-3 rotate collapsible mb-7" data-bs-toggle="collapse" href="#kt_modal_update_poll_poll_info" role="button" aria-expanded="false" aria-controls="kt_modal_update_poll_poll_info">Poll Information
                                            <span class="ms-2 rotate-180">
                                                <!--begin::Svg Icon | path: icons/duotune/arrows/arr072.svg-->
                                                <span class="svg-icon svg-icon-3">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                        <path d="M11.4343 12.7344L7.25 8.55005C6.83579 8.13583 6.16421 8.13584 5.75 8.55005C5.33579 8.96426 5.33579 9.63583 5.75 10.05L11.2929 15.5929C11.6834 15.9835 12.3166 15.9835 12.7071 15.5929L18.25 10.05C18.6642 9.63584 18.6642 8.96426 18.25 8.55005C17.8358 8.13584 17.1642 8.13584 16.75 8.55005L12.5657 12.7344C12.2533 13.0468 11.7467 13.0468 11.4343 12.7344Z" fill="black" />
                                                    </svg>
                                                </span>
                                                <!--end::Svg Icon-->
                                            </span></div>

                                            <!--begin::Input group-->
                                            <div class="fv-row mb-7">
                                                <!--begin::Label-->
                                                Question
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <input type="text" class="form-control form-control-solid" placeholder="" name="question" value="{{ $poll->question }}" />
                                                <!--end::Input-->
                                            </div>
                                            <!--end::Input group-->
                                            <!--begin::Input group-->
                                            <div class="fv-row mb-7">
                                                <!--begin::Label-->
                                                <label class="fs-6 fw-bold mb-2">
                                                    Ends IN
                                                </label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <input type="number" class="form-control form-control-solid" placeholder="" name="endsin" value="{{ $poll->endsin }}" />
                                                <!--end::Input-->
                                            </div>
                                            <!--end::Input group-->
                            
                                            <!--begin::Input group-->
                                            <div class="fv-row mb-7 option_div">
                                                <button type="button" data-modal-action="AddOption" class="btn btn-primary">Add Options</button>
                                                @foreach($PollOptions as $PollOptions_key => $PollOptions_value)
                                                    <div class="option_copy option_count">
                                                        <label class="form-label fw-bolder text-dark fs-6">Option</label>
                                                        <input class="form-control form-control-lg form-control-solid" type="text" placeholder="" name="options[]" autocomplete="off" value="{{$PollOptions_value->name}}" />
                                                        <button type="button" data-modal-action="RemoveOption" class="btn btn-primary">Remove Option</button>

                                                    </div>
                                                @endforeach
                                            </div>
                                            <!--end::Input group-->

                                            <!--begin::Input group-->
                                            <div class="fv-row mb-7" for="is_people_share">
                                                <input class="form-check-input" type="hidden" name="is_people_share" value="0" />
                                                <input class="form-check-input" type="checkbox" name="is_people_share" value="1" @if($poll->is_people_share  == 1) checked="checked" @endif />
                                                <label class="form-label fw-bolder text-dark fs-6" id="is_people_share">Is people share</label>
                                            </div>
                                            <!--end::Input group-->


                                            <!--begin::Input group-->
                                            <div class="fv-row mb-7" for="hide_creator_details">
                                                <input class="form-check-input" type="hidden" name="hide_creator_details" value="0" />
                                                <input class="form-check-input" type="checkbox" name="hide_creator_details" value="1" @if($poll->hide_creator_details  == 1) checked="checked" @endif />
                                                <label class="form-label fw-bolder text-dark fs-6" id="hide_creator_details">Hide Creator Details</label>
                                            </div>

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
                                                      <option @if($poll->user_id  == $user->id) selected="selected" @endif value="{{$user->id}}">{{$user->name}}</option>
                                                    @endforeach
                                                </select>
                                                <!--end::Input-->
                                            </div>
                                            <!--end::Input group-->

                                        </div>
                                        <!--end::Scroll-->
                                    </div>
                                    <!--end::Modal body-->
                                    <!--begin::Modal footer-->
                                    <div class="modal-footer flex-center">
                                        <!--begin::Button-->
                                        <button type="reset" id="kt_modal_update_poll_cancel" class="btn btn-light me-3">Discard</button>
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
    <script type="text/javascript">
        $( 'body' ).on( 'click', 'button[data-modal-action="AddOption"]', function () {
            var html = $(".option_count").html();
            $(".option_div").append('<div class="option_clone option_count">'+html+'</div>');
        });
        $( 'body' ).on( 'click', 'button[data-modal-action="RemoveOption"]', function () {
            var numItems = $('.option_count').length;
            if(numItems > 1) {
               $(this).closest(".option_count").remove();
            }
        });
    </script>
        <!--begin::Page Custom Javascript(used by this page)-->
        <script src="{{ asset('public/assets/js/custom/apps/poll/update.js') }}"></script>

        <!--end::Page Custom Javascript-->
        <!--end::Javascript-->
    @endsection