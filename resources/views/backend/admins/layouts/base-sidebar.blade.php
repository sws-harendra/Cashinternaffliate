  <nav class="pcoded-navbar">
      <div class="sidebar_toggle"><a href="#"><i class="icon-close icons"></i></a></div>
      <div class="pcoded-inner-navbar main-menu">
          <div class="">
              <div class="main-menu-header">
                  <img class="img-80 img-radius" src="{{ asset(config_value('company_logo')) }}" alt="User-Profile-Image">
                  <div class="user-details">
                      <span id="more-details">Admin<i class="fa fa-caret-down"></i></span>
                  </div>
              </div>

              <div class="main-menu-content">
                  <ul>
                      <li class="more-details">
                          <a href="user-profile.html"><i class="ti-user"></i>View Profile</a>
                          <a href="#!"><i class="ti-settings"></i>Settings</a>
                          <a href="{{ route('admins.logout') }}"><i class="ti-layout-sidebar-left"></i>Logout</a>
                      </li>
                  </ul>
              </div>
          </div>

          <div class="pcoded-navigation-label" data-i18n="nav.category.navigation">Layout</div>
          <ul class="pcoded-item pcoded-left-item">
              <li class="{{ request()->routeIs('admins.dashboard') ? 'active' : '' }}">
                  <a href="{{ route('admins.dashboard') }}" class="waves-effect waves-dark">
                      <span class="pcoded-micon"><i class="ti-home"></i><b>D</b></span>
                      <span class="pcoded-mtext" data-i18n="nav.dash.main">Dashboard</span>
                      <span class="pcoded-mcaret"></span>
                  </a>
              </li>
              <li class="{{ request()->routeIs('admins.settings') ? 'active' : '' }}">
                  <a href="{{ route('admins.settings') }}" class="waves-effect waves-dark">
                      <span class="pcoded-micon"><i class="ti-settings"></i><b>D</b></span>
                      <span class="pcoded-mtext" data-i18n="nav.dash.main">Settings</span>
                      <span class="pcoded-mcaret"></span>
                  </a>
              </li>
              <li class="{{ request()->routeIs('admins.affiliate-categories.*') ? 'active' : '' }}">
                  <a href="{{ route('admins.affiliate-categories.index') }}" class="waves-effect waves-dark">
                      <span class="pcoded-micon"><i class="ti-layers"></i><b>D</b></span>
                      <span class="pcoded-mtext" data-i18n="nav.dash.main">Affiliate Categories</span>
                      <span class="pcoded-mcaret"></span>
                  </a>
              </li>
              <li class="{{ request()->routeIs('admins.affiliate-subcategories.*') ? 'active' : '' }}">
                  <a href="{{ route('admins.affiliate-subcategories.index') }}" class="waves-effect waves-dark">
                      <span class="pcoded-micon"><i class="ti-layers"></i><b>D</b></span>
                      <span class="pcoded-mtext" data-i18n="nav.dash.main">Affiliate Sub Categories</span>
                      <span class="pcoded-mcaret"></span>
                  </a>
              </li>
              <li class="{{ request()->routeIs('admins.affiliate-products.*') ? 'active' : '' }}">
                  <a href="{{ route('admins.affiliate-products.index') }}" class="waves-effect waves-dark">
                      <span class="pcoded-micon"><i class="ti-layers"></i><b>D</b></span>
                      <span class="pcoded-mtext" data-i18n="nav.dash.main">Affiliate Products</span>
                      <span class="pcoded-mcaret"></span>
                  </a>
              </li>
              <li class="{{ request()->routeIs('admins.home-banner.*') ? 'active' : '' }}">
                  <a href="{{ route('admins.home-banner.index') }}" class="waves-effect waves-dark">
                      <span class="pcoded-micon"><i class="ti-image"></i><b>D</b></span>
                      <span class="pcoded-mtext" data-i18n="nav.dash.main">Home Banner</span>
                      <span class="pcoded-mcaret"></span>
                  </a>
              </li>
              <li class="{{ request()->routeIs('admins.affiliate.clicks') ? 'active' : '' }}">
                  <a href="{{ route('admins.affiliate.clicks') }}" class="waves-effect waves-dark">
                      <span class="pcoded-micon"><i class="ti-layers"></i><b>D</b></span>
                      <span class="pcoded-mtext" data-i18n="nav.dash.main">Affiliate Clicks</span>
                      <span class="pcoded-mcaret"></span>
                  </a>
              </li>
              <li class="{{ request()->routeIs('admins.training-category.*') ? 'active' : '' }}">
                  <a href="{{ route('admins.training-category.index') }}" class="waves-effect waves-dark">
                      <span class="pcoded-micon"><i class="ti-layers"></i><b>D</b></span>
                      <span class="pcoded-mtext" data-i18n="nav.dash.main">Training Categories</span>
                      <span class="pcoded-mcaret"></span>
                  </a>
              </li>
              <li class="{{ request()->routeIs('admins.training-subcategory.*') ? 'active' : '' }}">
                  <a href="{{ route('admins.training-subcategory.index') }}" class="waves-effect waves-dark">
                      <span class="pcoded-micon"><i class="ti-layers"></i><b>D</b></span>
                      <span class="pcoded-mtext" data-i18n="nav.dash.main">Training SubCategories</span>
                      <span class="pcoded-mcaret"></span>
                  </a>
              </li>
              <li class="{{ request()->routeIs('admins.training-videos.*') ? 'active' : '' }}">
                  <a href="{{ route('admins.training-videos.index') }}" class="waves-effect waves-dark">
                      <span class="pcoded-micon"><i class="ti-video-clapper"></i><b>D</b></span>
                      <span class="pcoded-mtext" data-i18n="nav.dash.main">Training Videos</span>
                      <span class="pcoded-mcaret"></span>
                  </a>
              </li>
              <li class="{{ request()->routeIs('admins.payment.methods') ? 'active' : '' }}">
                  <a href="{{ route('admins.payment.methods') }}" class="waves-effect waves-dark">
                      <span class="pcoded-micon"><i class="ti-money"></i><b>D</b></span>
                      <span class="pcoded-mtext" data-i18n="nav.dash.main">Payment Methods</span>
                      <span class="pcoded-mcaret"></span>
                  </a>
              </li>
              <li class="{{ request()->routeIs('admins.withdraw.index') ? 'active' : '' }}">
                  <a href="{{ route('admins.withdraw.index') }}" class="waves-effect waves-dark">
                      <span class="pcoded-micon"><i class="ti-money"></i><b>D</b></span>
                      <span class="pcoded-mtext" data-i18n="nav.dash.main">Withdraw</span>
                      <span class="pcoded-mcaret"></span>
                  </a>
              </li>
              <li class="{{ request()->routeIs('admins.kyc*') ? 'active' : '' }}">
                  <a href="{{ route('admins.kyc.index') }}" class="waves-effect waves-dark">
                      <span class="pcoded-micon"><i class="ti-money"></i><b>D</b></span>
                      <span class="pcoded-mtext" data-i18n="nav.dash.main">User Kyc</span>
                      <span class="pcoded-mcaret"></span>
                  </a>
              </li>

              <li class="{{ request()->routeIs('admins.user.activities') ? 'active' : '' }}">
                  <a href="{{ route('admins.user.activities') }}" class="waves-effect waves-dark">
                      <span class="pcoded-micon"><i class="ti-pulse"></i></span>
                      <span class="pcoded-mtext">User Activity</span>
                  </a>
              </li>
              <li class="{{ request()->routeIs('admins.recruiters*') ? 'active' : '' }}">
                  <a href="{{ route('admins.recruiters.index') }}" class="waves-effect waves-dark">
                      <span class="pcoded-micon"><i class="ti-pulse"></i></span>
                      <span class="pcoded-mtext">Recruiters</span>
                  </a>
              </li>
              <li class="{{ request()->routeIs('admins.recruiter.verifications*') ? 'active' : '' }}">
                  <a href="{{ route('admins.recruiter.verifications') }}" class="waves-effect waves-dark">
                      <span class="pcoded-micon"><i class="ti-pulse"></i></span>
                      <span class="pcoded-mtext">Recruiter Verifications</span>
                  </a>
              </li>

            {{-- jobs --}}
              <li class="{{ request()->routeIs('admins.job-categories*') ? 'active' : '' }}">
                  <a href="{{ route('admins.job-categories.index') }}" class="waves-effect waves-dark">
                      <span class="pcoded-micon"><i class="ti-pulse"></i></span>
                      <span class="pcoded-mtext">Job Categories</span>
                  </a>
              </li>
              <li class="{{ request()->routeIs('admins.job-roles*') ? 'active' : '' }}">
                  <a href="{{ route('admins.job-roles.index') }}" class="waves-effect waves-dark">
                      <span class="pcoded-micon"><i class="ti-pulse"></i></span>
                      <span class="pcoded-mtext">Job Roles</span>
                  </a>
              </li>
              <li class="{{ request()->routeIs('admins.job-locations*') ? 'active' : '' }}">
                  <a href="{{ route('admins.job-locations.index') }}" class="waves-effect waves-dark">
                      <span class="pcoded-micon"><i class="ti-pulse"></i></span>
                      <span class="pcoded-mtext">Job Locations</span>
                  </a>
              </li>
              <li class="{{ request()->routeIs('admins.job-types*') ? 'active' : '' }}">
                  <a href="{{ route('admins.job-types.index') }}" class="waves-effect waves-dark">
                      <span class="pcoded-micon"><i class="ti-pulse"></i></span>
                      <span class="pcoded-mtext">Job Types</span>
                  </a>
              </li>
              <li class="{{ request()->routeIs('admins.experience-levels*') ? 'active' : '' }}">
                  <a href="{{ route('admins.experience-levels.index') }}" class="waves-effect waves-dark">
                      <span class="pcoded-micon"><i class="ti-pulse"></i></span>
                      <span class="pcoded-mtext">Experience Levels</span>
                  </a>
              </li>
              <li class="{{ request()->routeIs('admins.salary-ranges*') ? 'active' : '' }}">
                  <a href="{{ route('admins.salary-ranges.index') }}" class="waves-effect waves-dark">
                      <span class="pcoded-micon"><i class="ti-pulse"></i></span>
                      <span class="pcoded-mtext">Salary Ranges</span>
                  </a>
              </li>



              {{-- <li class="pcoded-hasmenu">
                  <a href="javascript:void(0)" class="waves-effect waves-dark">
                      <span class="pcoded-micon"><i class="ti-layout-grid2-alt"></i></span>
                      <span class="pcoded-mtext" data-i18n="nav.basic-components.main">Components</span>
                      <span class="pcoded-mcaret"></span>
                  </a>
                  <ul class="pcoded-submenu">
                      <li class=" ">
                          <a href="accordion.html" class="waves-effect waves-dark">
                              <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                              <span class="pcoded-mtext" data-i18n="nav.basic-components.alert">Accordion</span>
                              <span class="pcoded-mcaret"></span>
                          </a>
                      </li>
                      <li class=" ">
                          <a href="breadcrumb.html" class="waves-effect waves-dark">
                              <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                              <span class="pcoded-mtext" data-i18n="nav.basic-components.breadcrumbs">Breadcrumbs</span>
                              <span class="pcoded-mcaret"></span>
                          </a>
                      </li>
                      <li class=" ">
                          <a href="button.html" class="waves-effect waves-dark">
                              <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                              <span class="pcoded-mtext" data-i18n="nav.basic-components.alert">Button</span>
                              <span class="pcoded-mcaret"></span>
                          </a>
                      </li>
                      <li class=" ">
                          <a href="tabs.html" class="waves-effect waves-dark">
                              <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                              <span class="pcoded-mtext" data-i18n="nav.basic-components.breadcrumbs">Tabs</span>
                              <span class="pcoded-mcaret"></span>
                          </a>
                      </li>
                      <li class=" ">
                          <a href="color.html" class="waves-effect waves-dark">
                              <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                              <span class="pcoded-mtext" data-i18n="nav.basic-components.alert">Color</span>
                              <span class="pcoded-mcaret"></span>
                          </a>
                      </li>
                      <li class=" ">
                          <a href="label-badge.html" class="waves-effect waves-dark">
                              <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                              <span class="pcoded-mtext" data-i18n="nav.basic-components.breadcrumbs">Label Badge</span>
                              <span class="pcoded-mcaret"></span>
                          </a>
                      </li>
                      <li class=" ">
                          <a href="tooltip.html" class="waves-effect waves-dark">
                              <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                              <span class="pcoded-mtext" data-i18n="nav.basic-components.alert">Tooltip</span>
                              <span class="pcoded-mcaret"></span>
                          </a>
                      </li>
                      <li class=" ">
                          <a href="typography.html" class="waves-effect waves-dark">
                              <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                              <span class="pcoded-mtext"
                                  data-i18n="nav.basic-components.breadcrumbs">Typography</span>
                              <span class="pcoded-mcaret"></span>
                          </a>
                      </li>
                      <li class=" ">
                          <a href="notification.html" class="waves-effect waves-dark">
                              <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                              <span class="pcoded-mtext" data-i18n="nav.basic-components.alert">Notification</span>
                              <span class="pcoded-mcaret"></span>
                          </a>
                      </li>
                      <li class=" ">
                          <a href="icon-themify.html" class="waves-effect waves-dark">
                              <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                              <span class="pcoded-mtext" data-i18n="nav.basic-components.breadcrumbs">Themify</span>
                              <span class="pcoded-mcaret"></span>
                          </a>
                      </li>

                  </ul>
              </li> --}}
          </ul>



      </div>
  </nav>
