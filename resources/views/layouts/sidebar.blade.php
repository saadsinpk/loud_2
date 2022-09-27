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
	  <img alt="Logo" src="{{ asset('assets/media/logos/logo.png') }}" class="brand-image  elevation-0" />
	  
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
            <a href="{{ url('/admin/admins') }}" class="nav-link">
              <i class="nav-icon fas fa-user"></i>
              <p>
                Admins
				{{--
                <span class="right badge badge-danger">New</span> --}}
              </p>
            </a>
          </li>
       
          <li class="nav-item">
            <a href="{{ url('/admin/user') }}" class="nav-link">
              <i class="nav-icon fas fa-user"></i>
              <p>
                Users
              </p>
            </a>
          </li>
		  
          <!-- <li class="nav-item">
            <a href="{{ url('/devices') }}" class="nav-link">
              <i class="nav-icon fas fa-user"></i>
              <p>
                User Devices
              </p>
            </a>
          </li> -->
		  
          <li class="nav-item">
            <a href="{{ url('/admin/roles') }}" class="nav-link">
              <i class="nav-icon fas fa-user"></i>
              <p>
                Roles
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{ url('/admin/states') }}" class="nav-link">
              <i class="nav-icon fas fa-user"></i>
              <p>
                States
              </p>
            </a>
          </li>


          <li class="nav-item">
            <a href="{{ url('/admin/constituencies') }}" class="nav-link">
              <i class="nav-icon fas fa-user"></i>
              <p>
                Constituencies
              </p>
            </a>
          </li> 


          <li class="nav-item">
            <a href="{{ url('/admin/elections') }}" class="nav-link">
              <i class="nav-icon fas fa-user"></i>
              <p>
                Elections
              </p>
            </a>
          </li>


          <li class="nav-item">
            <a href="{{ url('/admin/senatorialdistricts') }}" class="nav-link">
              <i class="nav-icon fas fa-user"></i>
              <p>
                Senatorial Districts
              </p>
            </a>
          </li>
    

          <li class="nav-item">
            <a href="{{ url('/admin/federalconstituencies') }}" class="nav-link">
              <i class="nav-icon fas fa-user"></i>
              <p>
                Federal Constituencies
              </p>
            </a>
          </li>      

          
          <li class="nav-item">
            <a href="{{ url('/admin/parties') }}" class="nav-link">
              <i class="nav-icon fas fa-user"></i>
              <p>
                Parties
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{ url('/admin/votes') }}" class="nav-link">
              <i class="nav-icon fas fa-user"></i>
              <p>
                Results
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
                <a href="{{ url('/admin/lgas') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>LGAs</p>
                </a>
              </li>
              
              <li class="nav-item">
                <a href="{{ url('/admin/wards') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Wards</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ url('/admin/pollingunits') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Polling Units</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ url('/admin/politicalpartyagents') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Political Party Agents</p>
                </a>
              </li>
              
             
            </ul>
          </li>
		  
		  

         
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>