  
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
     
      
    </ul>

  <!-- Right navbar links -->
  <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- Messages: style can be found in dropdown.less-->
          
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" style="color: #fff; font-size:14px; padding:15px;">
              

                @if(auth()->user()->avatar)
                    <img src="{{ asset('public/uploads/avatar/'. auth()->user()->avatar)  }}" alt="Admin" class="user-image"/>
                @else
                    <img src="{{ asset('assets/media/avatars/blank.png') }}" class="user-image" />
                @endif

              <span class="hidden-xs">{{ auth()->user()->name }}</span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              
            
              
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="{{ url('admin/view/'.auth()->user()->id) }}" class="btn btn-block btn-flat btn-xs">Profile</a>
                </div>
                <div class="pull-right">
                  <a href="{{ route('logout') }}" onclick="event.preventDefault();
                        document.getElementById('action-logout-form').submit();"  class="btn btn-block btn-flat btn-xs">
                    Sign out</a>

                    <form id="action-logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                     </form>
                </div>
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->
         
        </ul>
      </div>

    
  </nav>
  <!-- /.navbar -->


