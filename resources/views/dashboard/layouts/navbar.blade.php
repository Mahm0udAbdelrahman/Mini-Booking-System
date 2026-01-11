<nav class="pc-sidebar">
    <div class="navbar-wrapper">
        <div class="m-header flex items-center py-4 px-6 h-header-height">
            <a href="{{ route('Admin.home') }}" class="b-brand flex items-center gap-3">
                <!-- ========   Change your logo from here   ============ -->
                <img src="{{ asset('dashboard/assets/images/logo-white.svg') }}" class="img-fluid logo" alt="logo" />
                <img src="{{ asset('dashboard/assets/images/favicon.svg') }}" class="img-fluid logo logo-sm"
                    alt="logo" />
            </a>
        </div>
        <div class="navbar-content h-[calc(100vh_-_74px)] py-2.5">
            <ul class="pc-navbar">
                <li class="pc-item pc-caption">
                    <label>Dashboard</label>
                </li>
                <li class="pc-item">
                <li class="pc-item">
                    <a href="{{ route('Admin.home') }}" class="pc-link">
                        <span class="pc-micon">
                            <i data-feather="home"></i>
                        </span>
                        <span class="pc-mtext">Dashboard</span>
                    </a>
                </li>
                @can('viewAnyDashboard', \App\Models\Service::class)
                    <li class="pc-item pc-hasmenu">
                        <a href="{{ route('Admin.services.index') }}" class="pc-link">
                            <span class="pc-micon"><i data-feather="briefcase"></i></span>
                            <span class="pc-mtext">Services</span>
                        </a>
                    </li>
                @endcan

                @can('viewAnyDashboard', \App\Models\Booking::class)
                    <li class="pc-item pc-hasmenu">
                        <a href="{{ route('Admin.booking.index') }}" class="pc-link">
                            <span class="pc-micon"><i data-feather="calendar"></i></span>
                            <span class="pc-mtext">Booking</span>
                        </a>
                    </li>
                @endcan


            </ul>
        </div>
    </div>
</nav>
