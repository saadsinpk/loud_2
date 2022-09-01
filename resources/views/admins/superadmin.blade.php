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
                        <input id="search-datatable" type="text" data-kt-table-filter="search" class="form-control form-control-solid w-250px ps-15" placeholder="Search Site" />
                    </div>
                    <!--end::Search-->
                </div>
                <!--begin::Card title-->
                <!--begin::Card toolbar-->
                <div class="card-toolbar">
                    <!-- show list of sites to select -->
                    <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createUserModal"><i class="fas fa-plus"></i> Add Super Admin</a>
                </div>
                <!--end::Card toolbar-->
            </div>
            <!--end::Card header-->
            <!--begin::Card body-->
            <div class="card-body pt-0">
                <!--begin::Table-->
                <table class="table align-middle table-row-dashed fs-6 gy-5" id="datatable_list">
                    <!--begin::Table head-->
                    <thead>
                        <!--begin::Table row-->
                        <tr class="text-start text-gray-400 fw-bolder fs-7 text-uppercase gs-0">
                            <th class="min-w-125px">Name</th>
                            <th class="min-w-125px">Email</th>
                            <th class="min-w-125px">Created at</th>
                            <th class="text-left min-w-70px">Actions</th>
                        </tr>
                        <!--end::Table row-->
                    </thead>
                    <!--end::Table head-->
                    <!--begin::Table body-->
                    <tbody class="fw-bold text-gray-600"></tbody>
                    <!--end::Table body-->
                </table>
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


<!-- Modal -->
<div class="modal fade" id="createUserModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Create Super Admin</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        
        <form method="POST" action="{{route('superAdmins.store')}}">
            @csrf
            <div class="form-group mb-5">
                <label><b>* Name</b></label>
                <input type="text" name="name" placeholder="Name" required  class="form-control mt-2" value="{{old('name')}}">
            </div>
            <div class="form-group mb-5">
                <label><b>* Email</b></label>
                <input type="email" name="email" placeholder="Email" required  class="form-control mt-2" value="{{old('email')}}">
            </div>
            <div class="form-group mb-5">
                <label><b>* Password</b></label>
                <input type="password" name="password" placeholder="Password" required  class="form-control mt-2" value="">
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary btn-sm">Create</button>
            </div>
        </form>

      </div>
    </div>
  </div>
</div>
@endsection



@section("after_script")
<script type="text/javascript">
const dataTable = $('table#datatable_list')

$(document).ready(function(){
    loadDataTable()
})
</script>



<script type="text/javascript">
//load forms list
function loadDataTable(){
    dataTable.DataTable({
        order: [], //reset auto order
        processing: true,
        responsive: true,
        serverSide: true,
        //select: true,
        buttons:false,
        pageLength: 10, // default records per page
        "bInfo": true,
        pagingType: "full_numbers",
        //dom: "<'row'<'col-sm-12'i><'col-sm-2'l><'col-sm-7 text-center'B><'col-sm-3'f>>tp", 
        ajax: "{{route('superAdmins.index')}}",
        columns: [ 
            //{ data: 'serial_no',    name: 'serial_no' }, 
            { data: 'name',        name: 'name' }, 
            { data: 'email',        name: 'email' }, 
            { data: 'created_at',   name: 'created_at' }, 
            //{ data: 'status', name: 'status', orderable: false, searchable: false },
            { data: 'actions', name: 'actions', orderable: false, searchable: false  }
        ],    
    });

    //init search option
    $("input#search-datatable").on('keyup change clear', function () {
        dataTable.DataTable().search(this.value).draw();
    });
} 
</script>



<script type="text/javascript">
    function deleteForm(e, a){
        if (!confirm("Are you sure?")) {
            e.preventDefault()
            return
        }
    }
</script>

@endsection