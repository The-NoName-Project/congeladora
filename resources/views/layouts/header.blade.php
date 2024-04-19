<header class="topbar sticky-top">
    <div class="with-vertical"><!-- ---------------------------------- -->
        <!-- Start Vertical Layout Header -->
        <!-- ---------------------------------- -->
        <nav class="navbar navbar-expand-lg p-0">
            <ul class="navbar-nav">
                <li class="nav-item nav-icon-hover-bg rounded-circle">
                    <a class="nav-link sidebartoggler" id="headerCollapse" href="javascript:void(0)">
                        <iconify-icon icon="solar:list-bold-duotone" class="fs-7 text-dark"></iconify-icon>
                    </a>
                </li>
            </ul>

            <ul class="navbar-nav quick-links d-none d-lg-flex align-items-center">
                <!-- ------------------------------- -->
                <!-- start apps Dropdown -->
                <!-- ------------------------------- -->
                <li class="nav-item dropdown hover-dd d-none d-lg-block me-2">
                <li class="nav-item dropdown-hover d-none d-lg-block me-2">
{{--                    <a class="nav-link" href="../dark/app-chat.html">Chat</a>--}}
                </li>
                <li class="nav-item dropdown-hover d-none d-lg-block me-2">
{{--                    <a class="nav-link" href="../dark/app-calendar.html">Calendar</a>--}}
                </li>
                <li class="nav-item dropdown-hover d-none d-lg-block">
{{--                    <a class="nav-link" href="../dark/app-email.html">Email</a>--}}
                </li>
            </ul>

            <div class="d-block d-lg-none py-3">
                <img src="{{ asset('logo.png') }}" class="dark-logo" alt="Logo-Dark" />
                <img src="{{ asset('logo.png') }}" class="light-logo" alt="Logo-light" />
            </div>


            <a class="navbar-toggler p-0 border-0" href="javascript:void(0)" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                  <span class="p-2">
{{--                    <i class="ti ti-dots fs-7"></i>--}}
                  </span>
            </a>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <div class="d-flex align-items-center justify-content-between">
                    <a href="javascript:void(0)" class="nav-link d-flex d-lg-none align-items-center justify-content-center" type="button" data-bs-toggle="offcanvas" data-bs-target="#mobilenavbar" aria-controls="offcanvasWithBothOptions">
                        <div class="nav-icon-hover-bg rounded-circle ">
                            <i class="ti ti-align-justified fs-7"></i>
                        </div>
                    </a>
                    <ul class="navbar-nav flex-row ms-auto align-items-center justify-content-center">
                        <li class="nav-item dropdown nav-icon-hover-bg rounded-circle d-flex d-lg-none">
                            <a class="nav-link position-relative" href="javascript:void(0)" id="drop3" aria-expanded="false">
                                <iconify-icon icon="solar:magnifer-linear" class="fs-7"></iconify-icon>
                            </a>
                        </li>

                        <li class="nav-item nav-icon-hover-bg rounded-circle">
                            <a class="nav-link moon dark-layout" href="javascript:void(0)">
                                <iconify-icon icon="solar:moon-line-duotone" class="moon fs-7"></iconify-icon>
                            </a>
                            <a class="nav-link sun light-layout" href="javascript:void(0)">
                                <iconify-icon icon="solar:sun-2-line-duotone" class="sun fs-7"></iconify-icon>
                            </a>
                        </li>
                        <!-- ------------------------------- -->
                        <!-- start profile Dropdown -->
                        <!-- ------------------------------- -->

                        @if(Auth::check())
                        <li class="nav-item dropdown">
                            <a class="nav-link position-relative ms-6" href="javascript:void(0)" id="drop1" aria-expanded="false">
                                <div class="d-flex align-items-center flex-shrink-0">
                                    <div class="user-profile me-sm-3 me-2">
                                        <img src="{{ asset('assets/images/default.png') }}" width="45" class="rounded-circle" alt="spike-img">
                                    </div>
                                    <span class="d-sm-none d-block"><iconify-icon icon="solar:alt-arrow-down-line-duotone"></iconify-icon></span>

                                    <div class="d-none d-sm-block">
                                        <h6 class="fw-bold fs-4 mb-1 profile-name">
                                            {{ Auth::user()->name }}
                                        </h6>
                                        <p class="fs-3 lh-base mb-0 profile-subtext">
                                            {{ Auth::user()->email }}
                                        </p>
                                    </div>
                                </div>
                            </a>
                            <div class="dropdown-menu content-dd dropdown-menu-end dropdown-menu-animate-up" aria-labelledby="drop1">
                                <div class="profile-dropdown position-relative" data-simplebar>
                                    <div class="d-flex align-items-center justify-content-between pt-3 px-7">
                                        <h3 class="mb-0 fs-5">{{ __('User Profile') }}</h3>
                                        <button type="button" class="border-0 bg-transparent" aria-label="Close">
                                            <iconify-icon icon="solar:close-circle-line-duotone" class="fs-7 text-muted"></iconify-icon>
                                        </button>
                                    </div>

                                    <div class="d-flex align-items-center mx-7 py-9 border-bottom">
                                        <img src="{{ asset('assets/images/default.png') }}" alt="user" width="90" class="rounded-circle" />
                                        <div class="ms-4">
                                            <h4 class="mb-0 fs-5 fw-normal">{{ Auth::user()->name }}</h4>
                                            <span class="text-muted"></span>
                                            <p class="text-muted mb-0 mt-1 d-flex align-items-center">
                                                <iconify-icon icon="solar:mailbox-line-duotone" class="fs-4 me-1"></iconify-icon>
                                                <span>{{ Auth::user()->email }}</span>
                                            </p>
                                        </div>
                                    </div>

                                    <div class="message-body">
                                        <a href="{{ route('profile.edit') }}" class="dropdown-item px-7 d-flex align-items-center py-6">
                                <span class="btn px-3 py-2 bg-info-subtle rounded-1 text-info shadow-none">
                                  <iconify-icon icon="solar:wallet-2-line-duotone" class="fs-7"></iconify-icon>
                                </span>
                                            <div class="w-75 d-inline-block v-middle ps-3 ms-1">
                                                <h5 class="mb-0 mt-1 fs-4 fw-normal">
                                                    {{ __('Profile') }}
                                                </h5>
                                                <span class="fs-3 text-nowrap d-block fw-normal mt-1 text-muted">Account Settings</span>
                                            </div>
                                        </a>

                                    <div class="py-6 px-7 mb-1">
                                        <form method="POST" action="{{ route('logout') }}">
                                            @csrf
                                            <button type="submit" class="btn btn-outline-primary w-100">{{ __('Logout') }}</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </li>
                        @else
                            <li class="nav-item">
                                <a class="nav-link position-relative ms-6" href="{{ route('login') }}">
                                    {{ __('Login') }}
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link position-relative ms-6" href="{{ route('register') }}">
                                    {{ __('Register') }}
                                </a>
                            </li>
                        @endif
                        <!-- ------------------------------- -->
                        <!-- end profile Dropdown -->
                        <!-- ------------------------------- -->
                    </ul>
                </div>
            </div>
        </nav>
        <!-- ---------------------------------- -->
        <!-- End Vertical Layout Header -->
        <!-- ---------------------------------- -->

        <!-- ------------------------------- -->
        <!-- apps Dropdown in Small screen -->
        <!-- ------------------------------- -->
        <!--  Mobilenavbar -->
        <div class="offcanvas offcanvas-start dropdown-menu-nav-offcanvas" data-bs-scroll="true" tabindex="-1" id="mobilenavbar" aria-labelledby="offcanvasWithBothOptionsLabel">
            <nav class="sidebar-nav scroll-sidebar">
                <div class="offcanvas-header justify-content-between">
                    <img src="../assets/images/logos/favicon.png" alt="spike-img" class="img-fluid" />
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body h-n80" data-simplebar>
                    <ul id="sidebarnav">
                        <li class="sidebar-item">
                            <a class="sidebar-link gap-2 has-arrow" href="javascript:void(0)" aria-expanded="false">
                                <iconify-icon icon="solar:list-bold-duotone" class="fs-7 text-dark"></iconify-icon>
                                <span class="hide-menu">Apps</span>
                            </a>
                            <ul aria-expanded="false" class="collapse first-level my-3">
                                <li class="sidebar-item py-2">
                                    <a href="javascript:void(0)" class="d-flex align-items-center">
                                        <div class="text-bg-light rounded-1 me-3 p-6 d-flex align-items-center justify-content-center">
                                            <img src="../assets/images/svgs/icon-dd-chat.svg" alt="spike-img" class="img-fluid" width="24" height="24" />
                                        </div>
                                        <div class="d-inline-block">
                                            <h6 class="mb-1 bg-hover-primary">Chat Application</h6>
                                            <span class="fs-2 d-block fw-normal text-muted">New messages arrived</span>
                                        </div>
                                    </a>
                                </li>
                                <li class="sidebar-item py-2">
                                    <a href="javascript:void(0)" class="d-flex align-items-center">
                                        <div class="text-bg-light rounded-1 me-3 p-6 d-flex align-items-center justify-content-center">
                                            <img src="../assets/images/svgs/icon-dd-invoice.svg" alt="spike-img" class="img-fluid" width="24" height="24" />
                                        </div>
                                        <div class="d-inline-block">
                                            <h6 class="mb-1 bg-hover-primary">Invoice App</h6>
                                            <span class="fs-2 d-block fw-normal text-muted">Get latest invoice</span>
                                        </div>
                                    </a>
                                </li>
                                <li class="sidebar-item py-2">
                                    <a href="javascript:void(0)" class="d-flex align-items-center">
                                        <div class="text-bg-light rounded-1 me-3 p-6 d-flex align-items-center justify-content-center">
                                            <img src="../assets/images/svgs/icon-dd-mobile.svg" alt="spike-img" class="img-fluid" width="24" height="24" />
                                        </div>
                                        <div class="d-inline-block">
                                            <h6 class="mb-1 bg-hover-primary">Contact Application</h6>
                                            <span class="fs-2 d-block fw-normal text-muted">2 Unsaved Contacts</span>
                                        </div>
                                    </a>
                                </li>
                                <li class="sidebar-item py-2">
                                    <a href="javascript:void(0)" class="d-flex align-items-center">
                                        <div class="text-bg-light rounded-1 me-3 p-6 d-flex align-items-center justify-content-center">
                                            <img src="../assets/images/svgs/icon-dd-message-box.svg" alt="spike-img" class="img-fluid" width="24" height="24" />
                                        </div>
                                        <div class="d-inline-block">
                                            <h6 class="mb-1 bg-hover-primary">Email App</h6>
                                            <span class="fs-2 d-block fw-normal text-muted">Get new emails</span>
                                        </div>
                                    </a>
                                </li>
                                <li class="sidebar-item py-2">
                                    <a href="javascript:void(0)" class="d-flex align-items-center">
                                        <div class="text-bg-light rounded-1 me-3 p-6 d-flex align-items-center justify-content-center">
                                            <img src="../assets/images/svgs/icon-dd-cart.svg" alt="spike-img" class="img-fluid" width="24" height="24" />
                                        </div>
                                        <div class="d-inline-block">
                                            <h6 class="mb-1 bg-hover-primary">User Profile</h6>
                                            <span class="fs-2 d-block fw-normal text-muted">learn more information</span>
                                        </div>
                                    </a>
                                </li>
                                <li class="sidebar-item py-2">
                                    <a href="javascript:void(0)" class="d-flex align-items-center">
                                        <div class="text-bg-light rounded-1 me-3 p-6 d-flex align-items-center justify-content-center">
                                            <img src="../assets/images/svgs/icon-dd-date.svg" alt="spike-img" class="img-fluid" width="24" height="24" />
                                        </div>
                                        <div class="d-inline-block">
                                            <h6 class="mb-1 bg-hover-primary">Calendar App</h6>
                                            <span class="fs-2 d-block fw-normal text-muted">Get dates</span>
                                        </div>
                                    </a>
                                </li>
                                <li class="sidebar-item py-2">
                                    <a href="javascript:void(0)" class="d-flex align-items-center">
                                        <div class="text-bg-light rounded-1 me-3 p-6 d-flex align-items-center justify-content-center">
                                            <img src="../assets/images/svgs/icon-dd-lifebuoy.svg" alt="spike-img" class="img-fluid" width="24" height="24" />
                                        </div>
                                        <div class="d-inline-block">
                                            <h6 class="mb-1 bg-hover-primary">Contact List Table</h6>
                                            <span class="fs-2 d-block fw-normal text-muted">Add new contact</span>
                                        </div>
                                    </a>
                                </li>
                                <li class="sidebar-item py-2">
                                    <a href="javascript:void(0)" class="d-flex align-items-center">
                                        <div class="text-bg-light rounded-1 me-3 p-6 d-flex align-items-center justify-content-center">
                                            <img src="../assets/images/svgs/icon-dd-application.svg" alt="spike-img" class="img-fluid" width="24" height="24" />
                                        </div>
                                        <div class="d-inline-block">
                                            <h6 class="mb-1 bg-hover-primary">Notes Application</h6>
                                            <span class="fs-2 d-block fw-normal text-muted">To-do and Daily tasks</span>
                                        </div>
                                    </a>
                                </li>
                                <ul class="px-8 mt-6 mb-4">
                                    <li class="sidebar-item mb-3">
                                        <h5 class="fs-5 fw-semibold">Quick Links</h5>
                                    </li>
                                    <li class="sidebar-item py-2">
                                        <a class="fw-semibold text-dark" href="javascript:void(0)">Pricing Page</a>
                                    </li>
                                    <li class="sidebar-item py-2">
                                        <a class="fw-semibold text-dark" href="javascript:void(0)">Authentication Design</a>
                                    </li>
                                    <li class="sidebar-item py-2">
                                        <a class="fw-semibold text-dark" href="javascript:void(0)">Register Now</a>
                                    </li>
                                    <li class="sidebar-item py-2">
                                        <a class="fw-semibold text-dark" href="javascript:void(0)">404 Error Page</a>
                                    </li>
                                    <li class="sidebar-item py-2">
                                        <a class="fw-semibold text-dark" href="javascript:void(0)">Notes App</a>
                                    </li>
                                    <li class="sidebar-item py-2">
                                        <a class="fw-semibold text-dark" href="javascript:void(0)">User Application</a>
                                    </li>
                                    <li class="sidebar-item py-2">
                                        <a class="fw-semibold text-dark" href="javascript:void(0)">Account Settings</a>
                                    </li>
                                </ul>
                            </ul>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link gap-2" href="javascript:void(0)" aria-expanded="false">
                                <iconify-icon icon="solar:chat-round-unread-line-duotone" class="fs-6 text-dark"></iconify-icon>
                                <span class="hide-menu">Chat</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link gap-2" href="javascript:void(0)" aria-expanded="false">
                                <iconify-icon icon="solar:calendar-add-line-duotone" class="fs-6 text-dark"></iconify-icon>
                                <span class="hide-menu">Calendar</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link gap-2" href="javascript:void(0)" aria-expanded="false">
                                <iconify-icon icon="solar:mailbox-line-duotone" class="fs-6 text-dark"></iconify-icon>
                                <span class="hide-menu">Email</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
    </div>
    <div class="app-header with-horizontal">
        <nav class="navbar navbar-expand-xl container-fluid p-0">
            <ul class="navbar-nav">
                <li class="nav-item d-none d-xl-block">
                    <a href="../dark/index.html" class="text-nowrap nav-link">
                        <img src="../assets/images/logos/logo-light.svg" class="dark-logo" width="180" alt="spike-img" />
                        <img src="../assets/images/logos/logo-dark.svg" class="light-logo" width="180" alt="spike-img" />
                    </a>
                </li>
            </ul>
            <a class="navbar-toggler p-0 border-0" href="javascript:void(0)" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                  <span class="p-2">
                    <i class="ti ti-dots fs-7"></i>
                  </span>
            </a>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <div class="d-flex align-items-center justify-content-between">
                    <a href="javascript:void(0)" class="nav-link d-flex d-lg-none align-items-center justify-content-center" type="button" data-bs-toggle="offcanvas" data-bs-target="#mobilenavbar" aria-controls="offcanvasWithBothOptions">
                        <div class="nav-icon-hover-bg rounded-circle ">
                            <i class="ti ti-align-justified fs-7"></i>
                        </div>
                    </a>
                    <ul class="navbar-nav flex-row ms-auto align-items-center justify-content-center">
                        <li class="nav-item dropdown nav-icon-hover-bg rounded-circle d-flex d-lg-none">
                            <a class="nav-link position-relative" href="javascript:void(0)" id="drop3" aria-expanded="false">
                                <iconify-icon icon="solar:magnifer-linear" class="fs-7 text-dark"></iconify-icon>
                            </a>
                            <div class="dropdown-menu content-dd dropdown-menu-end dropdown-menu-animate-up" aria-labelledby="drop3">
                                <!--  Search Bar -->

                                <div class="modal-header border-bottom p-3">
                                    <input type="search" class="form-control fs-3" placeholder="Try to searching ..." />

                                </div>
                                <div class="message-body p-3" data-simplebar="">
                                    <h5 class="mb-0 fs-5 p-1">Quick Page Links</h5>
                                    <ul class="list mb-0 py-2">
                                        <li class="p-1 mb-1 bg-hover-light-black rounded">
                                            <a href="javascript:void(0)">
                                                <span class="fs-3 text-dark fw-normal d-block">Modern</span>
                                                <span class="fs-3 text-muted d-block">/dashboards/dashboard1</span>
                                            </a>
                                        </li>
                                        <li class="p-1 mb-1 bg-hover-light-black rounded">
                                            <a href="javascript:void(0)">
                                                <span class="fs-3 text-dark fw-normal d-block">Dashboard</span>
                                                <span class="fs-3 text-muted d-block">/dashboards/dashboard2</span>
                                            </a>
                                        </li>
                                        <li class="p-1 mb-1 bg-hover-light-black rounded">
                                            <a href="javascript:void(0)">
                                                <span class="fs-3 text-dark fw-normal d-block">Contacts</span>
                                                <span class="fs-3 text-muted d-block">/apps/contacts</span>
                                            </a>
                                        </li>
                                        <li class="p-1 mb-1 bg-hover-light-black rounded">
                                            <a href="javascript:void(0)">
                                                <span class="fs-3 text-dark fw-normal d-block">Posts</span>
                                                <span class="fs-3 text-muted d-block">/apps/blog/posts</span>
                                            </a>
                                        </li>
                                        <li class="p-1 mb-1 bg-hover-light-black rounded">
                                            <a href="javascript:void(0)">
                                                <span class="fs-3 text-dark fw-normal d-block">Detail</span>
                                                <span class="fs-3 text-muted d-block">/apps/blog/detail/streaming-video-way-before-it-was-cool-go-dark-tomorrow</span>
                                            </a>
                                        </li>
                                        <li class="p-1 mb-1 bg-hover-light-black rounded">
                                            <a href="javascript:void(0)">
                                                <span class="fs-3 text-dark fw-normal d-block">Shop</span>
                                                <span class="fs-3 text-muted d-block">/apps/ecommerce/shop</span>
                                            </a>
                                        </li>
                                        <li class="p-1 mb-1 bg-hover-light-black rounded">
                                            <a href="javascript:void(0)">
                                                <span class="fs-3 text-dark fw-normal d-block">Modern</span>
                                                <span class="fs-3 text-muted d-block">/dashboards/dashboard1</span>
                                            </a>
                                        </li>
                                        <li class="p-1 mb-1 bg-hover-light-black rounded">
                                            <a href="javascript:void(0)">
                                                <span class="fs-3 text-dark fw-normal d-block">Dashboard</span>
                                                <span class="fs-3 text-muted d-block">/dashboards/dashboard2</span>
                                            </a>
                                        </li>
                                        <li class="p-1 mb-1 bg-hover-light-black rounded">
                                            <a href="javascript:void(0)">
                                                <span class="fs-3 text-dark fw-normal d-block">Contacts</span>
                                                <span class="fs-3 text-muted d-block">/apps/contacts</span>
                                            </a>
                                        </li>
                                        <li class="p-1 mb-1 bg-hover-light-black rounded">
                                            <a href="javascript:void(0)">
                                                <span class="fs-3 text-dark fw-normal d-block">Posts</span>
                                                <span class="fs-3 text-muted d-block">/apps/blog/posts</span>
                                            </a>
                                        </li>
                                        <li class="p-1 mb-1 bg-hover-light-black rounded">
                                            <a href="javascript:void(0)">
                                                <span class="fs-3 text-dark fw-normal d-block">Detail</span>
                                                <span class="fs-3 text-muted d-block">/apps/blog/detail/streaming-video-way-before-it-was-cool-go-dark-tomorrow</span>
                                            </a>
                                        </li>
                                        <li class="p-1 mb-1 bg-hover-light-black rounded">
                                            <a href="javascript:void(0)">
                                                <span class="fs-3 text-dark fw-normal d-block">Shop</span>
                                                <span class="fs-3 text-muted d-block">/apps/ecommerce/shop</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </li>
                        <!-- ------------------------------- -->
                        <!-- start language Dropdown -->
                        <!-- ------------------------------- -->
                        <li class="nav-item dropdown d-none d-lg-block">
                            <a class="nav-link position-relative shadow-none" href="javascript:void(0)" id="drop3" aria-expanded="false">
                                <form class="nav-link position-relative shadow-none">
                                    <input type="text" class="form-control rounded-3 py-2 ps-5 text-dark" placeholder="Try to searching ...">
                                    <iconify-icon icon="solar:magnifer-linear" class="text-dark position-absolute top-50 start-0 translate-middle-y text-dark ms-3"></iconify-icon>
                                </form>
                            </a>
                            <div class="dropdown-menu content-dd dropdown-menu-end dropdown-menu-animate-up" aria-labelledby="drop3">
                                <!--  Search Bar -->

                                <div class="modal-header border-bottom p-3">
                                    <input type="search" class="form-control fs-3" placeholder="Try to searching ..." />

                                </div>
                                <div class="message-body p-3" data-simplebar="">
                                    <h5 class="mb-0 fs-5 p-1">Quick Page Links</h5>
                                    <ul class="list mb-0 py-2">
                                        <li class="p-1 mb-1 bg-hover-light-black rounded">
                                            <a href="javascript:void(0)">
                                                <span class="fs-3 text-dark fw-normal d-block">Modern</span>
                                                <span class="fs-3 text-muted d-block">/dashboards/dashboard1</span>
                                            </a>
                                        </li>
                                        <li class="p-1 mb-1 bg-hover-light-black rounded">
                                            <a href="javascript:void(0)">
                                                <span class="fs-3 text-dark fw-normal d-block">Dashboard</span>
                                                <span class="fs-3 text-muted d-block">/dashboards/dashboard2</span>
                                            </a>
                                        </li>
                                        <li class="p-1 mb-1 bg-hover-light-black rounded">
                                            <a href="javascript:void(0)">
                                                <span class="fs-3 text-dark fw-normal d-block">Contacts</span>
                                                <span class="fs-3 text-muted d-block">/apps/contacts</span>
                                            </a>
                                        </li>
                                        <li class="p-1 mb-1 bg-hover-light-black rounded">
                                            <a href="javascript:void(0)">
                                                <span class="fs-3 text-dark fw-normal d-block">Posts</span>
                                                <span class="fs-3 text-muted d-block">/apps/blog/posts</span>
                                            </a>
                                        </li>
                                        <li class="p-1 mb-1 bg-hover-light-black rounded">
                                            <a href="javascript:void(0)">
                                                <span class="fs-3 text-dark fw-normal d-block">Detail</span>
                                                <span class="fs-3 text-muted d-block">/apps/blog/detail/streaming-video-way-before-it-was-cool-go-dark-tomorrow</span>
                                            </a>
                                        </li>
                                        <li class="p-1 mb-1 bg-hover-light-black rounded">
                                            <a href="javascript:void(0)">
                                                <span class="fs-3 text-dark fw-normal d-block">Shop</span>
                                                <span class="fs-3 text-muted d-block">/apps/ecommerce/shop</span>
                                            </a>
                                        </li>
                                        <li class="p-1 mb-1 bg-hover-light-black rounded">
                                            <a href="javascript:void(0)">
                                                <span class="fs-3 text-dark fw-normal d-block">Modern</span>
                                                <span class="fs-3 text-muted d-block">/dashboards/dashboard1</span>
                                            </a>
                                        </li>
                                        <li class="p-1 mb-1 bg-hover-light-black rounded">
                                            <a href="javascript:void(0)">
                                                <span class="fs-3 text-dark fw-normal d-block">Dashboard</span>
                                                <span class="fs-3 text-muted d-block">/dashboards/dashboard2</span>
                                            </a>
                                        </li>
                                        <li class="p-1 mb-1 bg-hover-light-black rounded">
                                            <a href="javascript:void(0)">
                                                <span class="fs-3 text-dark fw-normal d-block">Contacts</span>
                                                <span class="fs-3 text-muted d-block">/apps/contacts</span>
                                            </a>
                                        </li>
                                        <li class="p-1 mb-1 bg-hover-light-black rounded">
                                            <a href="javascript:void(0)">
                                                <span class="fs-3 text-dark fw-normal d-block">Posts</span>
                                                <span class="fs-3 text-muted d-block">/apps/blog/posts</span>
                                            </a>
                                        </li>
                                        <li class="p-1 mb-1 bg-hover-light-black rounded">
                                            <a href="javascript:void(0)">
                                                <span class="fs-3 text-dark fw-normal d-block">Detail</span>
                                                <span class="fs-3 text-muted d-block">/apps/blog/detail/streaming-video-way-before-it-was-cool-go-dark-tomorrow</span>
                                            </a>
                                        </li>
                                        <li class="p-1 mb-1 bg-hover-light-black rounded">
                                            <a href="javascript:void(0)">
                                                <span class="fs-3 text-dark fw-normal d-block">Shop</span>
                                                <span class="fs-3 text-muted d-block">/apps/ecommerce/shop</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </li>
                        <!-- ------------------------------- -->
                        <!-- end language Dropdown -->
                        <!-- ------------------------------- -->

                        <li class="nav-item nav-icon-hover-bg rounded-circle">
                            <a class="nav-link moon dark-layout" href="javascript:void(0)">
                                <iconify-icon icon="solar:moon-line-duotone" class="moon fs-7"></iconify-icon>
                            </a>
                            <a class="nav-link sun light-layout" href="javascript:void(0)">
                                <iconify-icon icon="solar:sun-2-line-duotone" class="sun fs-7"></iconify-icon>
                            </a>
                        </li>

                        <!-- ------------------------------- -->
                        <!-- start Messages cart Dropdown -->
                        <!-- ------------------------------- -->
                        <li class="nav-item dropdown nav-icon-hover-bg rounded-circle">
                            <a class="nav-link position-relative" href="javascript:void(0)" id="drop3" aria-expanded="false">
                                <iconify-icon icon="solar:chat-dots-line-duotone" class="fs-7"></iconify-icon>
                                <div class="pulse">
                                    <span class="heartbit border-warning"></span>
                                    <span class="point text-bg-warning"></span>
                                </div>
                            </a>
                            <div class="dropdown-menu content-dd dropdown-menu-end dropdown-menu-animate-up" aria-labelledby="drop3">
                                <!--  Messages -->
                                <div class="d-flex align-items-center py-3 px-7">
                                    <h3 class="mb-0 fs-5">Messages</h3>
                                    <span class="badge bg-info ms-3">5 new</span>
                                </div>

                                <div class="message-body" data-simplebar>
                                    <a href="javascript:void(0)" class="dropdown-item px-7 d-flex align-items-center py-6">
                              <span class="flex-shrink-0">
                                <img src="../assets/images/profile/user-2.jpg" alt="user" width="45" class="rounded-circle" />
                              </span>
                                        <div class="w-100 d-inline-block v-middle ps-3">
                                            <div class="d-flex align-items-center justify-content-between">
                                                <h5 class="mb-0 fs-3 fw-normal">
                                                    Roman Joined the Team!
                                                </h5>
                                                <span class="fs-2 text-nowrap d-block text-muted">9:08 AM</span>
                                            </div>
                                            <span class="fs-2 text-nowrap d-block fw-normal mt-1 text-muted">Congratulate him</span>
                                        </div>
                                    </a>

                                    <a href="javascript:void(0)" class="dropdown-item px-7 d-flex align-items-center py-6">
                              <span class="flex-shrink-0">
                                <img src="../assets/images/profile/user-3.jpg" alt="user" width="45" class="rounded-circle" />
                              </span>
                                        <div class="w-100 d-inline-block v-middle ps-3">
                                            <div class="d-flex align-items-center justify-content-between">
                                                <h5 class="mb-0 fs-3 fw-normal">
                                                    New message received
                                                </h5>
                                                <span class="fs-2 text-nowrap d-block text-muted">9:08 AM</span>
                                            </div>
                                            <span class="fs-2 text-nowrap d-block fw-normal mt-1 text-muted">Salma sent you new
                                  message</span>
                                        </div>
                                    </a>

                                    <a href="javascript:void(0)" class="dropdown-item px-7 d-flex align-items-center py-6">
                              <span class="flex-shrink-0">
                                <img src="../assets/images/profile/user-4.jpg" alt="user" width="45" class="rounded-circle" />
                              </span>
                                        <div class="w-100 d-inline-block v-middle ps-3">
                                            <div class="d-flex align-items-center justify-content-between">
                                                <h5 class="mb-0 fs-3 fw-normal">
                                                    New Payment received
                                                </h5>
                                                <span class="fs-2 text-nowrap d-block text-muted">9:08 AM</span>
                                            </div>
                                            <span class="fs-2 text-nowrap d-block fw-normal mt-1 text-muted">Check your
                                  earnings</span>
                                        </div>
                                    </a>

                                    <a href="javascript:void(0)" class="dropdown-item px-7 d-flex align-items-center py-6">
                              <span class="flex-shrink-0">
                                <img src="../assets/images/profile/user-5.jpg" alt="user" width="45" class="rounded-circle" />
                              </span>
                                        <div class="w-100 d-inline-block v-middle ps-3">
                                            <div class="d-flex align-items-center justify-content-between">
                                                <h5 class="mb-0 fs-3 fw-normal">
                                                    New message received
                                                </h5>
                                                <span class="fs-2 text-nowrap d-block text-muted">9:08 AM</span>
                                            </div>
                                            <span class="fs-2 text-nowrap d-block fw-normal mt-1 text-muted">Salma sent you new
                                  message</span>
                                        </div>
                                    </a>

                                    <a href="javascript:void(0)" class="dropdown-item px-7 d-flex align-items-center py-6">
                              <span class="flex-shrink-0">
                                <img src="../assets/images/profile/user-6.jpg" alt="user" width="45" class="rounded-circle" />
                              </span>
                                        <div class="w-100 d-inline-block v-middle ps-3">
                                            <div class="d-flex align-items-center justify-content-between">
                                                <h5 class="mb-0 fs-3 fw-normal">
                                                    Roman Joined the Team!
                                                </h5>
                                                <span class="fs-2 text-nowrap d-block text-muted">9:08 AM</span>
                                            </div>
                                            <span class="fs-2 text-nowrap d-block fw-normal mt-1 text-muted">Congratulate him</span>
                                        </div>
                                    </a>
                                </div>

                                <div class="py-6 px-7 mb-1">
                                    <button class="btn btn-primary w-100">
                                        See All Messages
                                    </button>
                                </div>
                            </div>
                        </li>
                        <!-- ------------------------------- -->
                        <!-- end Messages cart Dropdown -->
                        <!-- ------------------------------- -->

                        <!-- ------------------------------- -->
                        <!-- start shortcut Dropdown -->
                        <!-- ------------------------------- -->
                        <li class="nav-item dropdown nav-icon-hover-bg rounded-circle">
                            <a class="nav-link position-relative" href="javascript:void(0)" id="drop2" aria-expanded="false">
                                <iconify-icon icon="solar:widget-add-line-duotone" class="fs-7"></iconify-icon>
                            </a>
                            <div class="dropdown-menu content-dd dropdown-menu-end dropdown-menu-animate-up" aria-labelledby="drop2">
                                <!--  Shortcuts -->
                                <div class="d-flex align-items-center py-3 px-7 gap-6">
                                    <h3 class="mb-0 fs-5">Shortcuts</h3>
                                </div>

                                <div class="row gx-0">
                                    <div class="col-6">
                                        <a href="../dark/app-invoice.html" class="dropdown-item px-7 border-top border-bottom border-end py-6 d-flex flex-column gap-2 justify-content-center text-center">
                                            <div class="bg-secondary-subtle rounded-3 m-auto round d-flex align-items-center justify-content-center">
                                                <iconify-icon icon="solar:checklist-minimalistic-bold-duotone" class="fs-7 text-secondary"></iconify-icon>
                                            </div>

                                            <h6 class="mb-0 fs-4">Invoice</h6>
                                            <span class="d-block text-body-color fs-3">Get latest invoice</span>
                                        </a>
                                    </div>
                                    <div class="col-6">
                                        <a href="../dark/app-chat.html" class="dropdown-item px-7 border-top border-bottom py-6 d-flex flex-column gap-2 justify-content-center text-center">
                                            <div class="bg-primary-subtle rounded-3 m-auto round d-flex align-items-center justify-content-center">
                                                <iconify-icon icon="solar:chat-square-call-bold-duotone" class="fs-7 text-primary"></iconify-icon>
                                            </div>
                                            <h6 class="mb-0 fs-4">Chat</h6>
                                            <span class="d-block text-body-color fs-3">New messages</span>
                                        </a>
                                    </div>
                                    <div class="col-6">
                                        <a href="../dark/app-contact2.html" class="dropdown-item px-7 border-bottom border-end py-6 d-flex flex-column gap-2 justify-content-center text-center">
                                            <div class="bg-info-subtle rounded-3 m-auto round d-flex align-items-center justify-content-center">
                                                <iconify-icon icon="solar:phone-calling-rounded-bold-duotone" class="fs-7 text-info"></iconify-icon>
                                            </div>
                                            <h6 class="mb-0 fs-4">Contact</h6>
                                            <span class="d-block text-body-color fs-3">2 Unsaved Contacts</span>
                                        </a>
                                    </div>
                                    <div class="col-6">
                                        <a href="../dark/app-email.html" class="dropdown-item px-7 border-bottom py-6 d-flex flex-column gap-2 justify-content-center text-center">
                                            <div class="bg-danger-subtle rounded-3 m-auto round d-flex align-items-center justify-content-center">
                                                <iconify-icon icon="solar:mailbox-bold-duotone" class="fs-7 text-danger"></iconify-icon>
                                            </div>
                                            <h6 class="mb-0 fs-4">Email</h6>
                                            <span class="d-block text-body-color fs-3">Get new emails</span>
                                        </a>
                                    </div>
                                    <div class="col-6">
                                        <a href="../dark/page-user-profile.html" class="dropdown-item px-7 border-end py-6 d-flex flex-column gap-2 justify-content-center text-center">
                                            <div class="bg-warning-subtle rounded-3 m-auto round d-flex align-items-center justify-content-center">
                                                <iconify-icon icon="solar:shield-user-bold-duotone" class="fs-7 text-warning"></iconify-icon>
                                            </div>
                                            <h6 class="mb-0 fs-4">Profile</h6>
                                            <span class="d-block text-body-color fs-3">More information</span>
                                        </a>
                                    </div>
                                    <div class="col-6">
                                        <a href="../dark/app-calendar.html" class="dropdown-item px-7 py-6 d-flex flex-column gap-2 justify-content-center text-center">
                                            <div class="bg-success-subtle rounded-3 m-auto round d-flex align-items-center justify-content-center">
                                                <iconify-icon icon="solar:calendar-mark-bold-duotone" class="fs-7 text-success"></iconify-icon>
                                            </div>
                                            <h6 class="mb-0 fs-4">Calendar</h6>
                                            <span class="d-block text-body-color fs-3">Get dates</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <!-- ------------------------------- -->
                        <!-- end shortcut Dropdown -->
                        <!-- ------------------------------- -->

                        <!-- ------------------------------- -->
                        <!-- start profile Dropdown -->
                        <!-- ------------------------------- -->
                        <li class="nav-item dropdown">
                            <a class="nav-link position-relative ms-6" href="javascript:void(0)" id="drop1" aria-expanded="false">
                                <div class="d-flex align-items-center flex-shrink-0">
                                    <div class="user-profile me-sm-3 me-2">
                                        <img src="../assets/images/profile/user-1.jpg" width="45" class="rounded-circle" alt="spike-img">
                                    </div>
                                    <span class="d-sm-none d-block"><iconify-icon icon="solar:alt-arrow-down-line-duotone"></iconify-icon></span>

                                    <div class="d-none d-sm-block">
                                        <h6 class="fw-bold fs-4 mb-1 profile-name">
                                            Mike Nielsen
                                        </h6>
                                        <p class="fs-3 lh-base mb-0 profile-subtext">
                                            Admin
                                        </p>
                                    </div>
                                </div>
                            </a>
                            <div class="dropdown-menu content-dd dropdown-menu-end dropdown-menu-animate-up" aria-labelledby="drop1">
                                <div class="profile-dropdown position-relative" data-simplebar>
                                    <div class="d-flex align-items-center justify-content-between pt-3 px-7">
                                        <h3 class="mb-0 fs-5">User Profile</h3>
                                        <button type="button" class="border-0 bg-transparent" aria-label="Close">
                                            <iconify-icon icon="solar:close-circle-line-duotone" class="fs-7 text-muted"></iconify-icon>
                                        </button>
                                    </div>

                                    <div class="d-flex align-items-center mx-7 py-9 border-bottom">
                                        <img src="../assets/images/profile/user-1.jpg" alt="user" width="90" class="rounded-circle" />
                                        <div class="ms-4">
                                            <h4 class="mb-0 fs-5 fw-normal">Mike Nielsen</h4>
                                            <span class="text-muted">super admin</span>
                                            <p class="text-muted mb-0 mt-1 d-flex align-items-center">
                                                <iconify-icon icon="solar:mailbox-line-duotone" class="fs-4 me-1"></iconify-icon>
                                                info@spike.com
                                            </p>
                                        </div>
                                    </div>

                                    <div class="message-body">
                                        <a href="../dark/page-user-profile.html" class="dropdown-item px-7 d-flex align-items-center py-6">
                                <span class="btn px-3 py-2 bg-info-subtle rounded-1 text-info shadow-none">
                                  <iconify-icon icon="solar:wallet-2-line-duotone" class="fs-7"></iconify-icon>
                                </span>
                                            <div class="w-75 d-inline-block v-middle ps-3 ms-1">
                                                <h5 class="mb-0 mt-1 fs-4 fw-normal">
                                                    My Profile
                                                </h5>
                                                <span class="fs-3 text-nowrap d-block fw-normal mt-1 text-muted">Account Settings</span>
                                            </div>
                                        </a>

                                        <a href="../dark/app-email.html" class="dropdown-item px-7 d-flex align-items-center py-6">
                                <span class="btn px-3 py-2 bg-success-subtle rounded-1 text-success shadow-none">
                                  <iconify-icon icon="solar:shield-minimalistic-line-duotone" class="fs-7"></iconify-icon>
                                </span>
                                            <div class="w-75 d-inline-block v-middle ps-3 ms-1">
                                                <h5 class="mb-0 mt-1 fs-4 fw-normal">My Inbox</h5>
                                                <span class="fs-3 text-nowrap d-block fw-normal mt-1 text-muted">Messages & Emails</span>
                                            </div>
                                        </a>

                                        <a href="../dark/app-notes.html" class="dropdown-item px-7 d-flex align-items-center py-6">
                                <span class="btn px-3 py-2 bg-danger-subtle rounded-1 text-danger shadow-none">
                                  <iconify-icon icon="solar:card-2-line-duotone" class="fs-7"></iconify-icon>
                                </span>
                                            <div class="w-75 d-inline-block v-middle ps-3 ms-1">
                                                <h5 class="mb-0 mt-1 fs-4 fw-normal">My Task</h5>
                                                <span class="fs-3 text-nowrap d-block fw-normal mt-1 text-muted">To-do and Daily
                                    Tasks</span>
                                            </div>
                                        </a>
                                    </div>

                                    <div class="py-6 px-7 mb-1">
                                        <a href="../dark/authentication-login.html" class="btn btn-primary w-100">Log Out</a>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <!-- ------------------------------- -->
                        <!-- end profile Dropdown -->
                        <!-- ------------------------------- -->
                    </ul>
                </div>
            </div>
        </nav>
    </div>
</header>
