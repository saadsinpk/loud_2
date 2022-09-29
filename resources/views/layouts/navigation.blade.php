  
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light" style="background: #b08129;">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
     
      
    </ul>

  <!-- Right navbar links -->


  <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">

     <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-bell"></i>
          <span class="badge badge-warning navbar-badge">15</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-item dropdown-header">15 Notifications</span>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-envelope mr-2"></i> 4 new contacts us 
            <span class="float-right text-muted text-sm">3 mins</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-users mr-2"></i> New Votes
            <span class="float-right text-muted text-sm">12 hours</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-file mr-2"></i> 3 new submission
            <span class="float-right text-muted text-sm">2 days</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
        </div>
      </li>
          <!-- Messages: style can be found in dropdown.less-->
          
          <!-- User Account: style can be found in dropdown.less -->
          <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
            <i class="far fa-user"></i>
            
            </a>
            <div class="dropdown-menu  dropdown-menu-right">
              <!-- User image -->
              
            
                <div class="pull-left">
                  <a href="{{ url('admin/view/'.auth()->user()->id) }}" class="btn  btn-flat btn-xs">Profile</a>
                </div>
                <div class="pull-right">
                  <a href="{{ route('logout') }}" onclick="event.preventDefault();
                        document.getElementById('action-logout-form').submit();"  class="btn  btn-flat btn-xs">
                    Sign out</a>

                    <form id="action-logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                     </form>
                </div>
              
            </div>
          </li>
          <!-- Control Sidebar Toggle Button -->
         
        </ul>
      </div>

    
  </nav>
  <!-- /.navbar -->


