<aside class="left-sidebar with-vertical">
    <!-- ---------------------------------- -->
    <!-- Start Vertical Layout Sidebar -->
    <!-- ---------------------------------- -->
    <div class="brand-logo d-flex align-items-center justify-content-between">
        <a href="{{ Auth::check() ? route('dashboard') : route('home') }}" class="text-nowrap logo-img">
            <img src="../assets/images/logos/logo-light.svg" class="dark-logo" alt="Logo-Dark" />
            <img src="../assets/images/logos/logo-dark.svg" class="light-logo" alt="Logo-light" />
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
                    <span class="hide-menu">Home</span>
                </li>
                <li class="sidebar-item {{ request()->is('/') ? 'active' : '' }}">
                    <a class="sidebar-link sidebar-link primary-hover-bg" href="{{ Auth::check() ? route('dashboard') : route('home') }}" aria-expanded="false">
                <span class="aside-icon p-2 bg-primary-subtle rounded-1">
                  <iconify-icon icon="solar:screencast-2-line-duotone" class="fs-6"></iconify-icon>
                </span>
                        <span class="hide-menu ps-1">Dashboard</span>
                    </a>
                </li>
                <!-- ============================= -->
                <!-- Apps -->
                <!-- ============================= -->
                <li class="nav-small-cap">
                    <iconify-icon icon="solar:menu-dots-bold-duotone" class="nav-small-cap-icon fs-5"></iconify-icon>
                    <span class="hide-menu">Apps</span>
                </li>
                <li class="sidebar-item {{ request()->routeIs('teams.*') ? 'active' : '' }}">
                    <a class="sidebar-link success-hover-bg" href="{{ route('teams.index') }}" aria-expanded="false">
                <span class="aside-icon p-2 bg-success-subtle rounded-1">
                  <iconify-icon icon="solar:smart-speaker-minimalistic-line-duotone" class="fs-6"></iconify-icon>
                </span>
                        <span class="hide-menu ps-1">{{ __('Teams') }}</span>
                    </a>
                </li>

                <li class="sidebar-item {{ request()->routeIs('matches.*') ? 'active' : '' }}">
                    <a class="sidebar-link warning-hover-bg" href="{{ route('matches.index') }}" aria-expanded="false">
                <span class="aside-icon p-2 bg-warning-subtle rounded-1">
                  <iconify-icon icon="solar:pie-chart-3-line-duotone" class="fs-6"></iconify-icon>
                </span>
                        <span class="hide-menu ps-1">{{ __('Soccer Matches') }}</span>
                    </a>
                </li>

{{--                <li class="sidebar-item">--}}
{{--                    <a class="sidebar-link has-arrow danger-hover-bg" href="javascript:void(0)" aria-expanded="false">--}}
{{--                <span class="aside-icon p-2 bg-danger-subtle rounded-1">--}}
{{--                  <iconify-icon icon="solar:user-circle-line-duotone" class="fs-6"></iconify-icon>--}}
{{--                </span>--}}
{{--                        <span class="hide-menu ps-1">User Profile</span>--}}
{{--                    </a>--}}
{{--                    <ul aria-expanded="false" class="collapse first-level">--}}
{{--                        <li class="sidebar-item">--}}
{{--                            <a href="../dark/page-user-profile.html" class="sidebar-link">--}}
{{--                                <span class="sidebar-icon"></span>--}}
{{--                                <span class="hide-menu">Profile One</span>--}}
{{--                            </a>--}}
{{--                        </li>--}}
{{--                        <li class="sidebar-item">--}}
{{--                            <a href="../dark/page-user-profile2.html" class="sidebar-link">--}}
{{--                                <span class="sidebar-icon"></span>--}}
{{--                                <span class="hide-menu">Profile Two</span>--}}
{{--                            </a>--}}
{{--                        </li>--}}
{{--                    </ul>--}}
{{--                </li>--}}
{{--                <li class="sidebar-item">--}}
{{--                    <a class="sidebar-link indigo-hover-bg" href="../dark/app-email.html" aria-expanded="false">--}}
{{--                <span class="aside-icon p-2 bg-indigo-subtle rounded-1">--}}
{{--                  <iconify-icon icon="solar:mailbox-line-duotone" class="fs-6"></iconify-icon>--}}
{{--                </span>--}}
{{--                        <span class="hide-menu ps-1">Email</span>--}}
{{--                    </a>--}}
{{--                </li>--}}
{{--                <li class="sidebar-item">--}}
{{--                    <a class="sidebar-link info-hover-bg" href="../dark/app-calendar.html" aria-expanded="false">--}}
{{--                <span class="aside-icon p-2 bg-info-subtle rounded-1">--}}
{{--                  <iconify-icon icon="solar:calendar-add-line-duotone" class="fs-6"></iconify-icon>--}}
{{--                </span>--}}
{{--                        <span class="hide-menu ps-1">Calendar</span>--}}
{{--                    </a>--}}
{{--                </li>--}}
{{--                <li class="sidebar-item">--}}
{{--                    <a class="sidebar-link success-hover-bg" href="../dark/app-kanban.html" aria-expanded="false">--}}
{{--                <span class="aside-icon p-2 bg-success-subtle rounded-1">--}}
{{--                  <iconify-icon icon="solar:window-frame-line-duotone" class="fs-6"></iconify-icon>--}}
{{--                </span>--}}
{{--                        <span class="hide-menu ps-1">kanban</span>--}}
{{--                    </a>--}}
{{--                </li>--}}
{{--                <li class="sidebar-item">--}}
{{--                    <a class="sidebar-link primary-hover-bg" href="../dark/app-chat.html" aria-expanded="false">--}}
{{--                <span class="aside-icon p-2 bg-primary-subtle rounded-1">--}}
{{--                  <iconify-icon icon="solar:chat-round-unread-line-duotone" class="fs-6"></iconify-icon>--}}
{{--                </span>--}}
{{--                        <span class="hide-menu ps-1">Chat</span>--}}
{{--                    </a>--}}
{{--                </li>--}}
{{--                <li class="sidebar-item">--}}
{{--                    <a class="sidebar-link secondary-hover-bg" href="../dark/app-notes.html" aria-expanded="false">--}}
{{--                <span class="aside-icon p-2 bg-secondary-subtle rounded-1">--}}
{{--                  <iconify-icon icon="solar:notification-unread-lines-line-duotone" class="fs-6"></iconify-icon>--}}
{{--                </span>--}}
{{--                        <span class="hide-menu ps-1">Notes</span>--}}
{{--                    </a>--}}
{{--                </li>--}}
{{--                <li class="sidebar-item">--}}
{{--                    <a class="sidebar-link success-hover-bg" href="../dark/app-contact.html" aria-expanded="false">--}}
{{--                <span class="aside-icon p-2 bg-success-subtle rounded-1">--}}
{{--                  <iconify-icon icon="solar:phone-line-duotone" class="fs-6"></iconify-icon>--}}
{{--                </span>--}}
{{--                        <span class="hide-menu ps-1">Contact Table</span>--}}
{{--                    </a>--}}
{{--                </li>--}}
{{--                <li class="sidebar-item">--}}
{{--                    <a class="sidebar-link warning-hover-bg" href="../dark/app-contact2.html" aria-expanded="false">--}}
{{--                <span class="aside-icon p-2 bg-warning-subtle rounded-1">--}}
{{--                  <iconify-icon icon="solar:list-check-line-duotone" class="fs-6"></iconify-icon>--}}
{{--                </span>--}}
{{--                        <span class="hide-menu ps-1">Contact List</span>--}}
{{--                    </a>--}}
{{--                </li>--}}
{{--                <li class="sidebar-item">--}}
{{--                    <a class="sidebar-link danger-hover-bg" href="../dark/app-invoice.html" aria-expanded="false">--}}
{{--                <span class="aside-icon p-2 bg-danger-subtle rounded-1">--}}
{{--                  <iconify-icon icon="solar:file-text-line-duotone" class="fs-6"></iconify-icon>--}}
{{--                </span>--}}
{{--                        <span class="hide-menu ps-1">Invoice</span>--}}
{{--                    </a>--}}
{{--                </li>--}}
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
                            <img src="{{ asset('assets/images/default.png') }}" width="45" height="45" class="img-fluid rounded-circle" alt="spike-img" />
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
