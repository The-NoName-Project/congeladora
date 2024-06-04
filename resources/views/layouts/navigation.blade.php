<aside class="left-sidebar with-vertical">
    <!-- ---------------------------------- -->
    <!-- Start Vertical Layout Sidebar -->
    <!-- ---------------------------------- -->
    <div class="brand-logo d-flex align-items-center justify-content-between logo-img d-flex mb-5 w-100">
        <a href="{{ Auth::check() ? route('dashboard') : route('home') }}" class="text-nowrap logo-img">
            <img src="{{ asset('logo.png') }}" class="dark-logo w-50" alt="Logo-Dark" style="width: fit-content"/>
            <img src="{{ asset('logo.png') }}" class="light-logo w-50" alt="Logo-light" style="width: fit-content"/>
        </a>
        <a href="javascript:void(0)" class="sidebartoggler ms-auto text-decoration-none fs-5 d-block d-xl-none">
            <i class="ti ti-x"></i>
        </a>
    </div>

    <div class="scroll-sidebar" data-simplebar>
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav">
            <ul id="sidebarnav" class="mb-0">

                <!-- ============================= -->
                <!-- Home -->
                <!-- ============================= -->
                <li class="nav-small-cap">
                    <iconify-icon icon="solar:menu-dots-bold-duotone" class="nav-small-cap-icon fs-5"></iconify-icon>
                    <span class="hide-menu">{{ __('Dashboard') }}</span>
                </li>
                <li class="sidebar-item {{ request()->is('/') ? 'active' : '' }}">
                    <a class="sidebar-link sidebar-link primary-hover-bg"
                       href="{{ Auth::check() ? route('dashboard') : route('home') }}" aria-expanded="false">
                <span class="aside-icon p-2 bg-primary-subtle rounded-1">
                  <iconify-icon icon="solar:screencast-2-line-duotone" class="fs-6"></iconify-icon>
                </span>
                        <span class="hide-menu ps-1">{{ __('Dashboard') }}</span>
                    </a>
                </li>
                <!-- ============================= -->
                <!-- Apps -->
                <!-- ============================= -->
                <li class="nav-small-cap">
                    <iconify-icon icon="solar:menu-dots-bold-duotone" class="nav-small-cap-icon fs-5"></iconify-icon>
                    <span class="hide-menu">Apps</span>
                </li>

                @if(Auth::check())
                    <li class="sidebar-item {{ request()->routeIs('teams.*') ? 'active' : '' }}">
                        <a class="sidebar-link success-hover-bg" href="{{ route('teams.index') }}"
                           aria-expanded="false">
                                <span class="aside-icon p-2 bg-success-subtle rounded-1">
                                  <iconify-icon icon="solar:smart-speaker-minimalistic-line-duotone" class="fs-6"></iconify-icon>
                                </span>
                            <span class="hide-menu ps-1">{{ __('Teams') }}</span>
                        </a>
                    </li>

                    @if(Auth::user()->rol_id === 1)
                        <li class="sidebar-item {{ request()->routeIs('matches.*') ? 'active' : '' }}">
                            <a class="sidebar-link warning-hover-bg" href="{{ route('matches.index') }}"
                               aria-expanded="false">
                                    <span class="aside-icon p-2 bg-warning-subtle rounded-1">
                                      <iconify-icon icon="solar:football-line-duotone" class="fs-6"></iconify-icon>
                                    </span>
                                <span class="hide-menu ps-1">{{ __('Soccer Matches') }}</span>
                            </a>
                        </li>
                        <li class="sidebar-item {{ request()->routeIs('schedules.*') ? 'active' : '' }}">
                            <a class="sidebar-link indigo-hover-bg" href="{{ route('schedules.index') }}"
                               aria-expanded="false">
                                    <span class="aside-icon p-2 bg-indigo-subtle rounded-1">
                                      <iconify-icon icon="solar:calendar-line-duotone" class="fs-6"></iconify-icon>
                                    </span>
                                <span class="hide-menu ps-1">{{ __('Schedules') }}</span>
                            </a>
                        </li>
                    @endif
                @endif
                <li class="sidebar-item {{ request()->routeIs('table-matches.*') ? 'active' : '' }}">
                    <a class="sidebar-link danger-hover-bg" href="{{ route('table-matches.index') }}"
                       aria-expanded="false">
                            <span class="aside-icon p-2 bg-danger-subtle rounded-1">
                              <iconify-icon icon="solar:clipboard-list-line-duotone" class="fs-6"></iconify-icon>
                            </span>
                        <span class="hide-menu ps-1">{{ __('Table Matches') }}</span>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>

    @if(Auth::check())
        <div class=" fixed-profile mx-3 mt-3">
            <div class="card bg-primary-subtle mb-0 shadow-none">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center justify-content-between gap-3">
                        <div class="d-flex align-items-center gap-3">
                            <img src="{{ asset('assets/images/default.png') }}" width="45" height="45"
                                 class="img-fluid rounded-circle" alt="spike-img"/>
                            <div>
                                <h5 class="mb-1">{{ substr(Auth::user()->name, 0, 5) }}</h5>
                                <p class="mb-0">{{ Auth::user()->rol()->first()->name }}</p>
                            </div>
                        </div>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="position-relative btn btn-sm">
                                <iconify-icon icon="solar:logout-line-duotone" class="fs-8"></iconify-icon>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <!-- ---------------------------------- -->
    <!-- Start Vertical Layout Sidebar -->
    <!-- ---------------------------------- -->
</aside>
