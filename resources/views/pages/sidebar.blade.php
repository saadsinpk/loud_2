<?php
    $featuresList = \Config::get('constants.FEATURES_LIST');
    $allowedFeatures = (auth()->user()->allowed_features == NULL ? [] : json_decode(auth()->user()->allowed_features, true));
    $isAuthUserRoleSuperAdmin = false;
    if (auth()->user()->hasRole("superAdmin")) {
        $isAuthUserRoleSuperAdmin = true;
    }
?>

<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme" data-bg-class="bg-menu-theme">
    <div class="app-brand demo">
        <a href="#" class="app-brand-link">
            <img src="{{ asset("assets/media/logos/logo.png") }}" style="max-width: 80%" alt="">
        </a>
        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-autod-block d-xl-none">
          <i class="bx bx-chevron-left bx-sm align-middle"></i>
        </a>
    </div>
    <div class="menu-inner-shadow" style="display: none;"></div>
    <ul class="menu-inner py-1 ps ps--active-y">
    <li class="menu-item ">
          <a  href="{{ url("/dashboard") }}" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-home-circle"></i>
                    <div>Dashboard</div>
          </a>
        </li>
    <li class="menu-item ">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                      <i class="menu-icon tf-icons bx bx bx-dock-top"></i>
                      <div>Admin</div>
            </a>
         <ul class="menu-sub">
              <li class="menu-item ">
                <a href="{{ url("/admins") }}" class="menu-link">
                  <div>Admin</div>
                </a>
            </li>
        </ul>
    </li>
    <li class="menu-item ">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                      <i class="menu-icon tf-icons bx bx bx-user"></i>
                      <div>User</div>
            </a>
         <ul class="menu-sub">
              <li class="menu-item ">
                <a href="{{ url("/user") }}" class="menu-link">
                  <div>User</div>
                </a>
            </li>
        </ul>
    </li>
    <li class="menu-item ">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                      <i class="menu-icon tf-icons bx bx bx-news"></i>
                      <div>Role</div>
            </a>
         <ul class="menu-sub">
              <li class="menu-item ">
                <a href="{{ url("/roles") }}"
                 class="menu-link">
                  <div>Role</div>
                </a>
            </li>
        </ul>
    </li>
    <li class="menu-item ">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                      <i class="menu-icon tf-icons bx bx bx-trending-up"></i>
                      <div>Political Party Agents</div>
            </a>
         <ul class="menu-sub">
              <li class="menu-item ">
                <a href="{{ url("/lgas") }}"
                 class="menu-link">
                  <div>LGAS</div>
                </a>
            </li>
              <li class="menu-item ">
                <a href="{{ url("/wards") }}"
                 class="menu-link">
                  <div>Wards</div>
                </a>
            </li>
              <li class="menu-item ">
                <a href="{{ url("/pollingunits") }}"
                 class="menu-link">
                  <div>Pollingunits</div>
                </a>
            </li>
              <li class="menu-item ">
                <a href="{{ url("/politicalpartyagents") }}"
                 class="menu-link">
                  <div>Political Party Agents</div>
                </a>
            </li>
        </ul>
    </li>
    <div style="display:none;" data-kt-menu-trigger="click" class="menu-item menu-accordion">
      <span class="menu-link">
           <span class="menu-icon">
              <!--begin::Svg Icon | path: icons/duotune/general/gen025.svg-->
              <span class="svg-icon svg-icon-2">
                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                      <path d="M17.5 11H6.5C4 11 2 9 2 6.5C2 4 4 2 6.5 2H17.5C20 2 22 4 22 6.5C22 9 20 11 17.5 11ZM15 6.5C15 7.9 16.1 9 17.5 9C18.9 9 20 7.9 20 6.5C20 5.1 18.9 4 17.5 4C16.1 4 15 5.1 15 6.5Z" fill="black"></path>
                      <path opacity="0.3" d="M17.5 22H6.5C4 22 2 20 2 17.5C2 15 4 13 6.5 13H17.5C20 13 22 15 22 17.5C22 20 20 22 17.5 22ZM4 17.5C4 18.9 5.1 20 6.5 20C7.9 20 9 18.9 9 17.5C9 16.1 7.9 15 6.5 15C5.1 15 4 16.1 4 17.5Z" fill="black"></path>
                  </svg>
              </span>
              <!--end::Svg Icon-->
          </span>
          <span class="menu-title">Polls</span>
          <span class="menu-arrow"></span>
      </span>
      <div class="menu-sub menu-sub-accordion menu-active-bg">
          <div class="menu-item">
              <a class="menu-link" href="{{ url("/poll") }}">
                  <span class="menu-bullet">
                      <span class="bullet bullet-dot"></span>
                  </span>
                  <span class="menu-title">Polls</span>
              </a>
          </div>

      </div>
  </div>


  <div style="display:none;" data-kt-menu-trigger="click" class="menu-item menu-accordion">
      <span class="menu-link">
           <span class="menu-icon">
              <!--begin::Svg Icon | path: icons/duotune/general/gen025.svg-->
              <span class="svg-icon svg-icon-2">
                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                      <path d="M17.5 11H6.5C4 11 2 9 2 6.5C2 4 4 2 6.5 2H17.5C20 2 22 4 22 6.5C22 9 20 11 17.5 11ZM15 6.5C15 7.9 16.1 9 17.5 9C18.9 9 20 7.9 20 6.5C20 5.1 18.9 4 17.5 4C16.1 4 15 5.1 15 6.5Z" fill="black"></path>
                      <path opacity="0.3" d="M17.5 22H6.5C4 22 2 20 2 17.5C2 15 4 13 6.5 13H17.5C20 13 22 15 22 17.5C22 20 20 22 17.5 22ZM4 17.5C4 18.9 5.1 20 6.5 20C7.9 20 9 18.9 9 17.5C9 16.1 7.9 15 6.5 15C5.1 15 4 16.1 4 17.5Z" fill="black"></path>
                  </svg>
              </span>
              <!--end::Svg Icon-->
          </span>
          <span class="menu-title">Discussions</span>
          <span class="menu-arrow"></span>
      </span>
      <div class="menu-sub menu-sub-accordion menu-active-bg">
          <div class="menu-item">
              <a class="menu-link" href="{{ url("/post") }}">
                  <span class="menu-bullet">
                      <span class="bullet bullet-dot"></span>
                  </span>
                  <span class="menu-title">Discussions</span>
              </a>
          </div>
      </div>
  </div>


  <div style="display:none;" data-kt-menu-trigger="click" class="menu-item menu-accordion">
      <span class="menu-link">
           <span class="menu-icon">
              <!--begin::Svg Icon | path: icons/duotune/general/gen025.svg-->
              <span class="svg-icon svg-icon-2">
                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                      <path d="M17.5 11H6.5C4 11 2 9 2 6.5C2 4 4 2 6.5 2H17.5C20 2 22 4 22 6.5C22 9 20 11 17.5 11ZM15 6.5C15 7.9 16.1 9 17.5 9C18.9 9 20 7.9 20 6.5C20 5.1 18.9 4 17.5 4C16.1 4 15 5.1 15 6.5Z" fill="black"></path>
                      <path opacity="0.3" d="M17.5 22H6.5C4 22 2 20 2 17.5C2 15 4 13 6.5 13H17.5C20 13 22 15 22 17.5C22 20 20 22 17.5 22ZM4 17.5C4 18.9 5.1 20 6.5 20C7.9 20 9 18.9 9 17.5C9 16.1 7.9 15 6.5 15C5.1 15 4 16.1 4 17.5Z" fill="black"></path>
                  </svg>
              </span>
              <!--end::Svg Icon-->
          </span>
          <span class="menu-title">Reports</span>
          <span class="menu-arrow"></span>
      </span>
      <div class="menu-sub menu-sub-accordion menu-active-bg">
          <div class="menu-item">
              <a class="menu-link" href="{{ url("/report") }}">
                  <span class="menu-bullet">
                      <span class="bullet bullet-dot"></span>
                  </span>
                  <span class="menu-title">Reports</span>
              </a>
          </div>

      </div>
  </div>


  <div style="display:none;" data-kt-menu-trigger="click" class="menu-item menu-accordion">
      <span class="menu-link">
           <span class="menu-icon">
              <!--begin::Svg Icon | path: icons/duotune/general/gen025.svg-->
              <span class="svg-icon svg-icon-2">
                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                      <path d="M17.5 11H6.5C4 11 2 9 2 6.5C2 4 4 2 6.5 2H17.5C20 2 22 4 22 6.5C22 9 20 11 17.5 11ZM15 6.5C15 7.9 16.1 9 17.5 9C18.9 9 20 7.9 20 6.5C20 5.1 18.9 4 17.5 4C16.1 4 15 5.1 15 6.5Z" fill="black"></path>
                      <path opacity="0.3" d="M17.5 22H6.5C4 22 2 20 2 17.5C2 15 4 13 6.5 13H17.5C20 13 22 15 22 17.5C22 20 20 22 17.5 22ZM4 17.5C4 18.9 5.1 20 6.5 20C7.9 20 9 18.9 9 17.5C9 16.1 7.9 15 6.5 15C5.1 15 4 16.1 4 17.5Z" fill="black"></path>
                  </svg>
              </span>
              <!--end::Svg Icon-->
          </span>
          <span class="menu-title">Groups</span>
          <span class="menu-arrow"></span>
      </span>
      <div class="menu-sub menu-sub-accordion menu-active-bg">
          <div class="menu-item">
              <a class="menu-link" href="{{ url("/group") }}">
                  <span class="menu-bullet">
                      <span class="bullet bullet-dot"></span>
                  </span>
                  <span class="menu-title">Groups</span>
              </a>
          </div>
      </div>
  </div>


  <div style="display:none;" data-kt-menu-trigger="click" class="menu-item menu-accordion">
      <span class="menu-link">
           <span class="menu-icon">
              <!--begin::Svg Icon | path: icons/duotune/general/gen025.svg-->
              <span class="svg-icon svg-icon-2">
                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                      <path d="M17.5 11H6.5C4 11 2 9 2 6.5C2 4 4 2 6.5 2H17.5C20 2 22 4 22 6.5C22 9 20 11 17.5 11ZM15 6.5C15 7.9 16.1 9 17.5 9C18.9 9 20 7.9 20 6.5C20 5.1 18.9 4 17.5 4C16.1 4 15 5.1 15 6.5Z" fill="black"></path>
                      <path opacity="0.3" d="M17.5 22H6.5C4 22 2 20 2 17.5C2 15 4 13 6.5 13H17.5C20 13 22 15 22 17.5C22 20 20 22 17.5 22ZM4 17.5C4 18.9 5.1 20 6.5 20C7.9 20 9 18.9 9 17.5C9 16.1 7.9 15 6.5 15C5.1 15 4 16.1 4 17.5Z" fill="black"></path>
                  </svg>
              </span>
              <!--end::Svg Icon-->
          </span>
          <span class="menu-title">Livestreams</span>
          <span class="menu-arrow"></span>
      </span>
      <div class="menu-sub menu-sub-accordion menu-active-bg">
          <div class="menu-item">
              <a class="menu-link" href="{{ url("/live") }}">
                  <span class="menu-bullet">
                      <span class="bullet bullet-dot"></span>
                  </span>
                  <span class="menu-title">Livestreams</span>
              </a>
          </div>
      </div>
  </div>


  <div style="display:none;" data-kt-menu-trigger="click" class="menu-item menu-accordion">
      <span class="menu-link">
           <span class="menu-icon">
              <!--begin::Svg Icon | path: icons/duotune/general/gen025.svg-->
              <span class="svg-icon svg-icon-2">
                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                      <path d="M17.5 11H6.5C4 11 2 9 2 6.5C2 4 4 2 6.5 2H17.5C20 2 22 4 22 6.5C22 9 20 11 17.5 11ZM15 6.5C15 7.9 16.1 9 17.5 9C18.9 9 20 7.9 20 6.5C20 5.1 18.9 4 17.5 4C16.1 4 15 5.1 15 6.5Z" fill="black"></path>
                      <path opacity="0.3" d="M17.5 22H6.5C4 22 2 20 2 17.5C2 15 4 13 6.5 13H17.5C20 13 22 15 22 17.5C22 20 20 22 17.5 22ZM4 17.5C4 18.9 5.1 20 6.5 20C7.9 20 9 18.9 9 17.5C9 16.1 7.9 15 6.5 15C5.1 15 4 16.1 4 17.5Z" fill="black"></path>
                  </svg>
              </span>
              <!--end::Svg Icon-->
          </span>
          <span class="menu-title">Meeting</span>
          <span class="menu-arrow"></span>
      </span>
      <div class="menu-sub menu-sub-accordion menu-active-bg">
          <div class="menu-item">
              <a class="menu-link" href="{{ url("/meeting") }}">
                  <span class="menu-bullet">
                      <span class="bullet bullet-dot"></span>
                  </span>
                  <span class="menu-title">Meeting</span>
              </a>
          </div>
      </div>
  </div>
</aside>