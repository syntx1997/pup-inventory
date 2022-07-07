<!-- ========== Left Sidebar Start ========== -->
<div class="leftside-menu">

    <!-- LOGO -->
    <a href="/" class="logo text-center logo-light">
                    <span class="logo-lg">
                        <img src="{{ asset('images/pup-logo.png') }}" alt="" height="50">
                    </span>
        <span class="logo-sm">
                        <img src="{{ asset('images/pup-logo.png') }}" alt="" height="50">
                    </span>
    </a>

    <!-- LOGO -->
    <a href="/" class="logo text-center logo-dark">
                    <span class="logo-lg">
                        <img src="{{ asset('images/pup-logo.png') }}" alt="" height="50">
                    </span>
        <span class="logo-sm">
                        <img src="{{ asset('images/pup-logo.png') }}" alt="" height="50">
                    </span>
    </a>

    <div class="h-100" id="leftside-menu-container" data-simplebar="">

        <!--- Sidemenu -->
        <ul class="side-nav">

            <li class="side-nav-title side-nav-item text-center text-white">
                <strong>
                    PUP BANSUD <br>
                    INVENTORY SYSTEM
                </strong>
                <hr>
            </li>
            <li class="side-nav-title side-nav-item">Navigation</li>

            <li class="side-nav-item">
                <a href="{{ $dashboardLink.'index' }}" class="side-nav-link">
                    <i class="uil-home-alt"></i>
                    <span> Dashboard </span>
                </a>
            </li>

            <li class="side-nav-title side-nav-item">Setup</li>

            <li class="side-nav-item">
                <a href="{{ $dashboardLink.'categories' }}" class="side-nav-link">
                    <i class="uil-list-ul"></i>
                    <span> Categories </span>
                </a>
            </li>

            <li class="side-nav-item">
                <a href="{{ $dashboardLink.'supplies' }}" class="side-nav-link">
                    <i class="uil-cart"></i>
                    <span> Supplies </span>
                </a>
            </li>

            <li class="side-nav-item">
                <a href="{{ $dashboardLink.'equipments' }}" class="side-nav-link">
                    <i class="uil-print"></i>
                    <span> Equipments </span>
                </a>
            </li>

            <li class="side-nav-item">
                <a href="{{ $dashboardLink.'inventory' }}" class="side-nav-link">
                    <i class="uil-file"></i>
                    <span> Inventory </span>
                </a>
            </li>

            <li class="side-nav-item">
                <a href="{{ $dashboardLink.'requests' }}" class="side-nav-link">
                    <i class="uil-file"></i>
                    <span class="badge bg-secondary text-light float-end">0</span>
                    <span> Requests </span>
                </a>
            </li>

            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#sidebarEcommerce" aria-expanded="false" aria-controls="sidebarEcommerce" class="side-nav-link">
                    <i class="uil-user"></i>
                    <span> User Management </span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="sidebarEcommerce">
                    <ul class="side-nav-second-level">
                        <li>
                            <a href="{{ $dashboardLink.'employees' }}">Employees</a>
                        </li>
                    </ul>
                </div>
            </li>

        </ul>

        <!-- End Sidebar -->

        <div class="clearfix"></div>

    </div>
    <!-- Sidebar -left -->

</div>
