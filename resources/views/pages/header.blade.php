<?php
$uri_path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri_segments = explode('/', $uri_path);
if($uri_segments[1]=="user"){
    $uri="users";
}else if($uri_segments[1]=="poll"){
    $uri="polls";
}else if($uri_segments[1]=="report"){
    $uri="reports";
}else if($uri_segments[1]=="group"){
    $uri="groups";
}else if($uri_segments[1]=="live"){
    $uri="livestreams";
}else if($uri_segments[1]=="meeting"){
    $uri="meeting";
}else if($uri_segments[1]=="post"){
    $uri="discussions";
}else if($uri_segments[1]=="mypermissions"){
    $uri="permissions";
}else{
    $uri=request()->segment(1);
}
?>


    <nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme" id="layout-navbar">
        <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0  d-xl-none ">
          <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
            <i class="bx bx-menu bx-sm"></i>
          </a>
        </div>
        
        <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
          <!-- Search -->
          <div class="navbar-nav align-items-center">
          </div>
          <!-- /Search -->
          <ul class="navbar-nav flex-row align-items-center ms-auto">
            <!-- User -->
            <li class="nav-item navbar-dropdown dropdown-user dropdown">
              <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                <div class="avatar avatar-online">
                    @if(auth()->user()->avatar)
                    <img src="{{ asset("public/uploads/avatar/". auth()->user()->avatar)  }}" class=" rounded-circle" alt="" />
                @else
                    <img src="{{ asset("assets/media/avatars/blank.png") }}" alt="" class=" rounded-circle" />
                @endif
                </div>
              </a>
              <ul class="dropdown-menu dropdown-menu-end">
                <li>
                  <a class="dropdown-item" href="javascript:void(0);">
                    <div class="d-flex">
                      <div class="flex-shrink-0 me-3">
                        <div class="avatar avatar-online">
                          @if(auth()->user()->avatar)
                          <img src="{{ asset("public/uploads/avatar/". auth()->user()->avatar)  }}" class=" rounded-circle" alt="" />
                      @else
                          <img src="{{ asset("assets/media/avatars/blank.png") }}" class=" rounded-circle" alt="" />
                      @endif
                        </div>
                      </div>
                      <div class="flex-grow-1">
                        <span class="fw-semibold d-block"> {{ auth()->user()->roles()->first()->name }}</span>
                        <small class="text-muted">Admin</small>
                      </div>
                    </div>
                  </a>
                </li>
                <li>
                  <div class="dropdown-divider"></div>
                </li>
                  <div class="dropdown-divider"></div>
                </li>
                <li>
                  <a class="dropdown-item" href="{{ route("logout") }}" onclick="event.preventDefault();
                  document.getElementById('action-logout-form').submit();">
                    <i class='bx bx-power-off me-2'></i>
                    <span class="align-middle">Log Out</span>
                  </a>
                </li>
              </ul>
              <form id="action-logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
            </li>
            <!--/ User -->
          </ul>
        </div>
  
          </nav>
    <!-- / Navbar -->