@php
    $user = Auth::user();
@endphp

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

            <div class="d-block d-lg-none py-3 text-nowrap logo-img d-flex mb-5 w-100">
                <img src="{{ asset('logo.png') }}" class="dark-logo w-50" alt="Logo-Dark" style="width: fit-content"/>
                <img src="{{ asset('logo.png') }}" class="light-logo w-50" alt="Logo-light"
                     style="width: fit-content;"/>
            </div>


            <a class="navbar-toggler p-0 border-0" href="javascript:void(0)" data-bs-toggle="collapse"
               data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false"
               aria-label="Toggle navigation">
                  <span class="p-2">
{{--                    <i class="ti ti-dots fs-7"></i>--}}
                  </span>
            </a>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <div class="d-flex align-items-center justify-content-between">
                    <a href="javascript:void(0)"
                       class="nav-link d-flex d-lg-none align-items-center justify-content-center" type="button"
                       data-bs-toggle="offcanvas" data-bs-target="#mobilenavbar"
                       aria-controls="offcanvasWithBothOptions">
                        <div class="nav-icon-hover-bg rounded-circle ">
                            <i class="ti ti-align-justified fs-7"></i>
                        </div>
                    </a>
                    <ul class="navbar-nav flex-row ms-auto align-items-center justify-content-center">
                        <li class="nav-item dropdown nav-icon-hover-bg rounded-circle d-flex d-lg-none">
                            <a class="nav-link position-relative" href="javascript:void(0)" id="drop3"
                               aria-expanded="false">
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
                                <a class="nav-link position-relative ms-6" href="javascript:void(0)" id="drop1"
                                   aria-expanded="false">
                                    <div class="d-flex align-items-center flex-shrink-0">
                                        <div class="user-profile me-sm-3 me-2">
                                            <img src="{{ asset($user->picture !== null ?
                                'storage/' . $user->picture :
                                'assets/images/default.png') }}" width="45" class="rounded-circle" alt="spike-img">
                                        </div>
                                        <span class="d-sm-none d-block"><iconify-icon
                                                icon="solar:alt-arrow-down-line-duotone"></iconify-icon></span>

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
                                <div class="dropdown-menu content-dd dropdown-menu-end dropdown-menu-animate-up"
                                     aria-labelledby="drop1">
                                    <div class="profile-dropdown position-relative" data-simplebar>
                                        <div class="d-flex align-items-center justify-content-between pt-3 px-7">
                                            <h3 class="mb-0 fs-5">{{ __('User Profile') }}</h3>
                                            <button type="button" class="border-0 bg-transparent" aria-label="Close">
                                                <iconify-icon icon="solar:close-circle-line-duotone"
                                                              class="fs-7 text-muted"></iconify-icon>
                                            </button>
                                        </div>

                                        <div class="d-flex align-items-center mx-7 py-9 border-bottom">
                                            <img src="{{ asset($user->picture !== null ?
                                'storage/' . $user->picture :
                                'assets/images/default.png') }}" alt="user" width="90" class="rounded-circle"/>
                                            <div class="ms-4">
                                                <h4 class="mb-0 fs-5 fw-normal">{{ Auth::user()->name }}</h4>
                                                <span class="text-muted"></span>
                                                <p class="text-muted mb-0 mt-1 d-flex align-items-center">
                                                    <iconify-icon icon="solar:mailbox-line-duotone"
                                                                  class="fs-4 me-1"></iconify-icon>
                                                    <span>{{ Auth::user()->email }}</span>
                                                </p>
                                            </div>
                                        </div>

                                        <div class="message-body">
                                            <a href="{{ route('profile.edit') }}"
                                               class="dropdown-item px-7 d-flex align-items-center py-6">
                                <span class="btn px-3 py-2 bg-info-subtle rounded-1 text-info shadow-none">
                                  <iconify-icon icon="solar:wallet-2-line-duotone" class="fs-7"></iconify-icon>
                                </span>
                                                <div class="w-75 d-inline-block v-middle ps-3 ms-1">
                                                    <h5 class="mb-0 mt-1 fs-4 fw-normal">
                                                        {{ __('User Profile') }}
                                                    </h5>
                                                    {{--                                                <span class="fs-3 text-nowrap d-block fw-normal mt-1 text-muted">Account Settings</span>--}}
                                                </div>
                                            </a>
                                            <a href="{{ route('change-language', ['locale' => App::getLocale() === 'en' ? 'es' : 'en']) }}"
                                               class="dropdown-item px-7 d-flex align-items-center py-6">
                                                <span class="btn px-3 py-2 bg-info-subtle rounded-1 text-info shadow-none">
                                                  <iconify-icon icon="solar:shield-network-broken" class="fs-7"></iconify-icon>
                                                </span>
                                                <div class="w-75 d-inline-block v-middle ps-3 ms-1">
                                                    <h5 class="mb-0 mt-1 fs-4 fw-normal">
                                                        {{ __('Language') }} <span class="text-muted">{{ App::getLocale() }}</span>
                                                    </h5>
                                                </div>
                                            </a>
                                            <div class="py-6 px-7 mb-1">
                                                <form method="POST" action="{{ route('logout') }}">
                                                    @csrf
                                                    <button type="submit"
                                                            class="btn btn-outline-primary w-100">{{ __('Logout') }}</button>
                                                </form>
                                            </div>
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
    </div>
</header>
