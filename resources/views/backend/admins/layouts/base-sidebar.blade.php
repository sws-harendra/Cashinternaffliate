<nav class="pcoded-navbar">
    <div class="sidebar_toggle"><a href="#"><i class="icon-close icons"></i></a></div>

    <div class="pcoded-inner-navbar main-menu">

        <!-- ADMIN PROFILE -->
        <div class="main-menu-header">
            <img class="img-80 img-radius" src="{{ asset(config_value('company_logo')) }}" alt="Admin">
            <div class="user-details">
                <span id="more-details">Admin<i class="fa fa-caret-down"></i></span>
            </div>
        </div>

        <div class="main-menu-content">
            <ul>
                <li class="more-details">
                    <a href="{{ route('admins.settings') }}"><i class="ti-settings"></i> Settings</a>
                    <a href="{{ route('admins.logout') }}"><i class="ti-layout-sidebar-left"></i> Logout</a>
                </li>
            </ul>
        </div>


        <!-- DASHBOARD -->
        <div class="pcoded-navigation-label">Dashboard</div>
        <ul class="pcoded-item pcoded-left-item">
            <li class="{{ request()->routeIs('admins.dashboard') ? 'active' : '' }}">
                <a href="{{ route('admins.dashboard') }}" class="waves-effect waves-dark">
                    <span class="pcoded-micon"><i class="ti-home"></i></span>
                    <span class="pcoded-mtext">Dashboard</span>
                </a>
            </li>
        </ul>


        <!-- RECRUITERS -->
        <div class="pcoded-navigation-label">Recruiters</div>
        <ul class="pcoded-item pcoded-left-item">
            <li class="{{ request()->routeIs('admins.recruiters*') ? 'active' : '' }}">
                <a href="{{ route('admins.recruiters.index') }}" class="waves-effect waves-dark">
                    <span class="pcoded-micon"><i class="ti-briefcase"></i></span>
                    <span class="pcoded-mtext">All Recruiters</span>
                </a>
            </li>

            <li class="{{ request()->routeIs('admins.recruiter.verifications*') ? 'active' : '' }}">
                <a href="{{ route('admins.recruiter.verifications') }}" class="waves-effect waves-dark">
                    <span class="pcoded-micon"><i class="ti-id-badge"></i></span>
                    <span class="pcoded-mtext">Document Verifications</span>
                </a>
            </li>
        </ul>


        <!-- JOB MANAGEMENT -->
        <div class="pcoded-navigation-label">Job Management</div>
        <ul class="pcoded-item pcoded-left-item">

            <li class="{{ request()->routeIs('admins.job-categories*') ? 'active' : '' }}">
                <a href="{{ route('admins.job-categories.index') }}" class="waves-effect waves-dark">
                    <span class="pcoded-micon"><i class="ti-folder"></i></span>
                    <span class="pcoded-mtext">Job Categories</span>
                </a>
            </li>

            <li class="{{ request()->routeIs('admins.job-roles*') ? 'active' : '' }}">
                <a href="{{ route('admins.job-roles.index') }}" class="waves-effect waves-dark">
                    <span class="pcoded-micon"><i class="ti-flag-alt"></i></span>
                    <span class="pcoded-mtext">Job Roles</span>
                </a>
            </li>

            <li class="{{ request()->routeIs('admins.job-types*') ? 'active' : '' }}">
                <a href="{{ route('admins.job-types.index') }}" class="waves-effect waves-dark">
                    <span class="pcoded-micon"><i class="ti-panel"></i></span>
                    <span class="pcoded-mtext">Job Types</span>
                </a>
            </li>

            <li class="{{ request()->routeIs('admins.job-locations*') ? 'active' : '' }}">
                <a href="{{ route('admins.job-locations.index') }}" class="waves-effect waves-dark">
                    <span class="pcoded-micon"><i class="ti-location-pin"></i></span>
                    <span class="pcoded-mtext">Job Locations</span>
                </a>
            </li>

            <li class="{{ request()->routeIs('admins.experience-levels*') ? 'active' : '' }}">
                <a href="{{ route('admins.experience-levels.index') }}" class="waves-effect waves-dark">
                    <span class="pcoded-micon"><i class="ti-bar-chart"></i></span>
                    <span class="pcoded-mtext">Experience Levels</span>
                </a>
            </li>

            <li class="{{ request()->routeIs('admins.salary-ranges*') ? 'active' : '' }}">
                <a href="{{ route('admins.salary-ranges.index') }}" class="waves-effect waves-dark">
                    <span class="pcoded-micon"><i class="ti-money"></i></span>
                    <span class="pcoded-mtext">Salary Ranges</span>
                </a>
            </li>

            <li class="{{ request()->routeIs('admins.jobs*') ? 'active' : '' }}">
                <a href="{{ route('admins.jobs.index') }}" class="waves-effect waves-dark">
                    <span class="pcoded-micon"><i class="ti-check-box"></i></span>
                    <span class="pcoded-mtext">Jobs Approval</span>
                </a>
            </li>

        </ul>


        <!-- USER AREA -->
        <div class="pcoded-navigation-label">Users</div>
        <ul class="pcoded-item pcoded-left-item">

            <li class="{{ request()->routeIs('admins.user.activities') ? 'active' : '' }}">
                <a href="{{ route('admins.user.activities') }}" class="waves-effect waves-dark">
                    <span class="pcoded-micon"><i class="ti-pulse"></i></span>
                    <span class="pcoded-mtext">User Activities</span>
                </a>
            </li>

            <li class="{{ request()->routeIs('admins.kyc*') ? 'active' : '' }}">
                <a href="{{ route('admins.kyc.index') }}" class="waves-effect waves-dark">
                    <span class="pcoded-micon"><i class="ti-id-badge"></i></span>
                    <span class="pcoded-mtext">User KYC</span>
                </a>
            </li>

        </ul>


        <!-- AFFILIATE -->
        <div class="pcoded-navigation-label">Affiliate Section</div>
        <ul class="pcoded-item pcoded-left-item">

            <li class="{{ request()->routeIs('admins.affiliate-categories*') ? 'active' : '' }}">
                <a href="{{ route('admins.affiliate-categories.index') }}" class="waves-effect waves-dark">
                    <span class="pcoded-micon"><i class="ti-layers"></i></span>
                    <span class="pcoded-mtext">Affiliate Categories</span>
                </a>
            </li>

            <li class="{{ request()->routeIs('admins.affiliate-subcategories*') ? 'active' : '' }}">
                <a href="{{ route('admins.affiliate-subcategories.index') }}" class="waves-effect waves-dark">
                    <span class="pcoded-micon"><i class="ti-layers-alt"></i></span>
                    <span class="pcoded-mtext">Affiliate SubCategories</span>
                </a>
            </li>

            <li class="{{ request()->routeIs('admins.affiliate-products*') ? 'active' : '' }}">
                <a href="{{ route('admins.affiliate-products.index') }}" class="waves-effect waves-dark">
                    <span class="pcoded-micon"><i class="ti-package"></i></span>
                    <span class="pcoded-mtext">Affiliate Products</span>
                </a>
            </li>

            <li class="{{ request()->routeIs('admins.affiliate.clicks') ? 'active' : '' }}">
                <a href="{{ route('admins.affiliate.clicks') }}" class="waves-effect waves-dark">
                    <span class="pcoded-micon"><i class="ti-bar-chart"></i></span>
                    <span class="pcoded-mtext">Affiliate Clicks</span>
                </a>
            </li>

        </ul>


        <!-- PAYMENTS -->
        <div class="pcoded-navigation-label">Payments</div>
        <ul class="pcoded-item pcoded-left-item">

            <li class="{{ request()->routeIs('admins.payment.methods') ? 'active' : '' }}">
                <a href="{{ route('admins.payment.methods') }}" class="waves-effect waves-dark">
                    <span class="pcoded-micon"><i class="ti-credit-card"></i></span>
                    <span class="pcoded-mtext">Payment Methods</span>
                </a>
            </li>

            <li class="{{ request()->routeIs('admins.withdraw.index') ? 'active' : '' }}">
                <a href="{{ route('admins.withdraw.index') }}" class="waves-effect waves-dark">
                    <span class="pcoded-micon"><i class="ti-wallet"></i></span>
                    <span class="pcoded-mtext">Withdraw Requests</span>
                </a>
            </li>

        </ul>

    </div>
</nav>
