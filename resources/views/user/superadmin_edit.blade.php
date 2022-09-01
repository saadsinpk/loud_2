@extends("layouts.app")
@section("content")
<!--begin::Post-->
<div class="post d-flex flex-column-fluid" id="kt_post">
    <!--begin::Container-->
    <div id="kt_content_container" class="container-xxl">
        @include("msg.msg")
        <!--begin::Card-->
        <div class="card">
            <!--begin::Card header-->
            <div class="card-header border-0 pt-6 d-flex justify-content-end">
                <!--begin::Card toolbar-->
                <div class="card-toolbar">
                    <!-- show list of sites to select -->
                    <a href="{{route('superUser.index')}}" class="btn btn-info btn-sm"><i class="fas fa-menu"></i> Back to List</a>
                </div>
                <!--end::Card toolbar-->
            </div>
            <!--end::Card header-->
            <!--begin::Card body-->
            <div class="card-body pt-0">
                <!--begin::Table-->
                
                  <form method="POST" action="{{route('superUser.update', encrypt($user->id))}}">
                        @csrf
                        <div class="form-group mb-5">
                            <label><b>* Name</b></label>
                            <input type="text" name="name" placeholder="Name" required  class="form-control mt-2" value="{{$user->name}}">
                        </div>
                        <div class="form-group mb-5">
                            <label><b>* Email</b></label>
                            <input type="email" name="email" placeholder="Email" required  class="form-control mt-2" value="{{$user->email}}">
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-sm">Update</button>
                        </div>
                  </form>


                <!--end::Table-->
            </div>
            <!--end::Card body-->
        </div>
        <!--end::Card-->
        <!--begin::Modals-->
        

    </div>
    <!--end::Container-->
</div>
<!--end::Post-->

@endsection
