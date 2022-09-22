<?php
$uri_path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri_segments = explode('/', $uri_path);
if($uri_segments[1]=="user"){
}else if($uri_segments[1]=="mypermissions"){
    $uri="permissions";
}else{
    $uri=request()->segment(1);
}
?>

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar elevation-4 sidebar-light-danger">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">  
	  <img alt="Logo" src="{{ asset('assets/media/logos/logo.png') }}" class="brand-image  elevation-0" style="opacity: .8"/>
	  
    <!--
      <span class="brand-text font-weight-light">Loud</span> -->
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
     
 <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3  mb-3 d-flex">
        <div class="image">
				        @if(auth()->user()->avatar)
                    <img src="{{ asset('public/uploads/avatar/'. auth()->user()->avatar)  }}" alt="Admin" class="img-circle elevation-2"/>
                @else
                    <img src="{{ asset('assets/media/avatars/blank.png') }}" class="img-circle elevation-2" />
                @endif
				
        </div>
        <div class="info">
          <a href="#" class="d-block">@auth {{ auth()->user()->name }} @endauth<br/>
            <small>{{ auth()->user()->email }}</small></a>
        </div>
      </div>
     

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column nav-flat" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="{{ route('dashboard') }}" class="nav-link active">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
                
              </p>
            </a>
            
          </li>
          <li class="nav-item">
            <a href="{{ url('/admins') }}" class="nav-link">
              <i class="nav-icon fas fa-user"></i>
              <p>
                Admins
				{{--
                <span class="right badge badge-danger">New</span> --}}
              </p>
            </a>
          </li>
       
          <li class="nav-item">
            <a href="{{ url('/user') }}" class="nav-link">
              <i class="nav-icon fas fa-user"></i>
              <p>
                Users
              </p>
            </a>
          </li>
		  
          <li class="nav-item">
            <a href="{{ url('/devices') }}" class="nav-link">
              <i class="nav-icon fas fa-user"></i>
              <p>
                User Devices
              </p>
            </a>
          </li>
		  
          <li class="nav-item">
            <a href="{{ url('/roles') }}" class="nav-link">
              <i class="nav-icon fas fa-user"></i>
              <p>
                Roles
              </p>
            </a>
          </li>
		  
            <li class="nav-item">
		   <a href="#" class="nav-link">
              <i class="nav-icon fas fa-book"></i>
              <p>
                Political Party Agents
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
		  
		  
		 
            <ul class="nav nav-treeview">
             
              <li class="nav-item">
                <a href="{{ url('/lgas') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>LGAs</p>
                </a>
              </li>
              
              <li class="nav-item">
                <a href="{{ url('/wards') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Wards</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ url('/pollingunits') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Polling Units</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ url('/politicalpartyagents') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Political Party Agents</p>
                </a>
              </li>
              
             
            </ul>
          </li>
		  
		  
		 <!-- <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-book"></i>
              <p>
                Pages
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
             
              <li class="nav-item">
                <a href="pages/examples/profile.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Profile</p>
                </a>
              </li>
              
              <li class="nav-item">
                <a href="pages/examples/projects.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Projects</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/examples/project-add.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Project Add</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/examples/project-edit.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Project Edit</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/examples/project-detail.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Project Detail</p>
                </a>
              </li>
             
            </ul>
          </li> -->
         
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>