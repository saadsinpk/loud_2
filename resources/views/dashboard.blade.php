@extends("layouts.app")
@section('content')
<!-- Main content -->
<style>

</style>
<section class="content pt-3">
    <div class="container-fluid">
        <div class="row mb-3">
            <div class="col-xl col-md-6 mb-3">
                <div class="card tile-card">
                    <div class="card-body tile-card-info">
                        <div class="avatar flex-shrink-0">
                            <img src="{{asset('images/cc-primary.png')}}" class="rounded">
                        </div>
                        <span class="fw-semibold d-block mt-2">Total Roles</span>
                        <h4 class="card-title mb-2">{{$totalRoles}}</h4>
                    </div>
                </div>
            </div>
            @foreach($totalUsers as $totaluser_key => $totalUser)
                <div class="col-xl col-md-6 mb-3">
                    <div class="card tile-card">
                        <div class="card-body tile-card-info">
                            <div class="avatar flex-shrink-0">
                                <img src="{{asset('images/cc-primary.png')}}" class="rounded">
                            </div>
                            <span class="fw-semibold d-block mt-2">Total {{$totaluser_key}}</span>
                            <h4 class="card-title mb-2">{{$totalRoles}}</h4>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endsection