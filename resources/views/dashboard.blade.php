@extends("layouts.app")
@section('content')
<!-- Main content -->
<style>

</style>
<section class="content pt-3">
    <div class="container-fluid">
        <div class="row mb-3">
            <div class="col-xl-3 col-md-6 mb-3">
                <div class="card tile-card">
                    <div class="card-body tile-card-info">
                        <div class="rotate">
                            <img src="{{asset('assets/media/user-group-296.png')}}" style="width: 100px;">
                        </div>
                        <h6 class="tile-heading">Total Roles</h6>
                        <h4 class="tile-count">{{$totalRoles}}</h4>
                    </div>
                </div>
            </div>
            @foreach($totalUsers as $totaluser_key => $totalUser)
                <div class="col-xl-3 col-md-6 mb-3">
                    <div class="card tile-card">
                        <div class="card-body tile-card-success">
                            <div class="rotate">
                                <img src="{{asset('assets/media/user-group-296.png')}}" style="width: 100px;">
                            </div>
                            <h6 class="tile-heading">Total {{$totaluser_key}}</h6>
                            <h4 class="tile-count">{{$totalUser}}</h4>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endsection