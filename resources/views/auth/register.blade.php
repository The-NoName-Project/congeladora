@extends('layouts.guest')

@section('content')
    <div id="main-wrapper" class="p-0 bg-white auth-customizer-none">
        <div
            class="position-relative overflow-hidden radial-gradient min-vh-100 d-flex align-items-center justify-content-center">
            <div class="auth-login-shape-box position-relative">
                <div class="d-flex align-items-center justify-content-center w-100 z-1 position-relative">
                    <div class="card auth-card mb-0 mx-3">
                        <div class="card-body pt-5">
                            <a href="{{ route('home') }}"
                               class="text-nowrap logo-img text-center d-flex align-items-center justify-content-center mb-5 w-100">
                                <img src="{{ asset('logo.png') }}" class="light-logo w-50" alt="Logo-light"
                                     style="width: fit-content"/>
                                <img src="{{ asset('logo.png') }}" class="dark-logo w-50" alt="Logo-light"
                                     style="width: fit-content"/>
                            </a>
                            <h2 class="text-center mb-4">{{ __('Sign Up')}}</h2>
                            @foreach($errors->all() as $error)
                                <div class="alert alert-danger" role="alert">
                                    {{ $error }}
                                </div>
                            @endforeach
                            <form method="POST" action="{{ route('register') }}" id="codeFind">
                                @csrf
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">{{ __('Verify Code') }}</label>
                                    <input type="text" class="form-control" id="code" name="code"
                                           value="{{ old('code') }}" required autofocus>
                                </div>
                                <button type="submit"
                                        class="btn btn-primary w-100 mb-4 rounded-pill">{{ __('Verify Code') }}</button>
                            </form>
                            <form method="POST" action="{{ route('register') }}" id="register" hidden="hidden">
                                @csrf
                                <input type="text" class="form-control" id="code_team" name="code"
                                value="{{ old('code') }}" hidden autofocus>
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">{{ __('Full Name') }}</label>
                                    <input type="text" class="form-control" id="name" name="name"
                                           value="{{ old('name') }}" required autofocus>
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">{{ __('Number') }}</label>
                                    <input type="number" class="form-control" id="number" name="number"
                                           value="{{ old('number') }}" required autofocus autocomplete="number"
                                           min="0" step="1">
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">{{ __('Phone') }}</label>
                                    <input type="number" class="form-control" id="phone" name="phone"
                                           value="{{ old('phone') }}" required autofocus autocomplete="phone">
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">{{ __('Email') }}</label>
                                    <input type="email" class="form-control" id="email" name="email"
                                           value="{{ old('email') }}" required autofocus autocomplete="email"
                                           aria-describedby="emailHelp">
                                </div>

                                <div class="mb-4">
                                    <label for="exampleInputPassword1" class="form-label">{{ __('Password') }}</label>
                                    <input type="password" class="form-control" id="password" name="password" required
                                           autocomplete="current-password">
                                </div>
                                <div class="mb-4">
                                    <label for="exampleInputPassword1" class="form-label">{{ __('Confirm Password') }}</label>
                                    <input type="password" class="form-control" id="password_confirmation"
                                           name="password_confirmation" required autocomplete="current-password">
                                </div>
                                <button type="submit"
                                        class="btn btn-primary w-100 mb-4 rounded-pill">{{ __('Sign Up') }}</button>
                                <div class="d-flex align-items-center justify-content-center">
                                    <p class="fs-4 mb-0 fw-medium">
                                        {{ __('Already have an account?') }}
                                    </p>
                                    <a class="text-primary fw-medium ms-2" href="{{ route('login') }}">{{ __('Log In') }}</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <script>
                    function handleColorTheme(e) {
                        document.documentElement.setAttribute("data-color-theme", e);
                    }
                </script>
                <button
                    class="btn btn-primary p-3 rounded-circle d-flex align-items-center justify-content-center customizer-btn"
                    type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample"
                    aria-controls="offcanvasExample">
                    <i class="icon ti ti-settings fs-7"></i>
                </button>

                <div class="offcanvas customizer offcanvas-end" tabindex="-1" id="offcanvasExample"
                     aria-labelledby="offcanvasExampleLabel">
                    <div class="d-flex align-items-center justify-content-between p-3 border-bottom">
                        <h4 class="offcanvas-title fw-semibold" id="offcanvasExampleLabel">
                            Settings
                        </h4>
                        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                    </div>
                    <div class="offcanvas-body h-n80" data-simplebar>
                        <h6 class="fw-semibold fs-4 mb-2">Theme</h6>

                        <div class="d-flex flex-row gap-3 customizer-box" role="group">
                            <input type="radio" class="btn-check light-layout" name="theme-layout" id="light-layout"
                                   autocomplete="off"/>
                            <label class="btn p-9 btn-outline-primary" for="light-layout">
                                <i class="icon ti ti-brightness-up fs-7 me-2"></i>Light
                            </label>

                            <input type="radio" class="btn-check dark-layout" name="theme-layout" id="dark-layout"
                                   autocomplete="off"/>
                            <label class="btn p-9 btn-outline-primary" for="dark-layout">
                                <i class="icon ti ti-moon fs-7 me-2"></i>Dark
                            </label>
                        </div>

                        <h6 class="mt-5 fw-semibold fs-4 mb-2">Theme Direction</h6>
                        <div class="d-flex flex-row gap-3 customizer-box" role="group">
                            <input type="radio" class="btn-check" name="direction-l" id="ltr-layout"
                                   autocomplete="off"/>
                            <label class="btn p-9 btn-outline-primary" for="ltr-layout">
                                <i class="icon ti ti-text-direction-ltr fs-7 me-2"></i>LTR
                            </label>

                            <input type="radio" class="btn-check" name="direction-l" id="rtl-layout"
                                   autocomplete="off"/>
                            <label class="btn p-9 btn-outline-primary" for="rtl-layout">
                                <i class="icon ti ti-text-direction-rtl fs-7 me-2"></i>RTL
                            </label>
                        </div>

                        <h6 class="mt-5 fw-semibold fs-4 mb-2">Theme Colors</h6>

                        <div class="d-flex flex-row flex-wrap gap-3 customizer-box color-pallete" role="group">
                            <input type="radio" class="btn-check" name="color-theme-layout" id="Blue_Theme"
                                   autocomplete="off"/>
                            <label class="btn p-9 btn-outline-primary d-flex align-items-center justify-content-center"
                                   onclick="handleColorTheme('Blue_Theme')" for="Blue_Theme" data-bs-toggle="tooltip"
                                   data-bs-placement="top" data-bs-title="BLUE_THEME">
                                <div
                                    class="color-box rounded-circle d-flex align-items-center justify-content-center skin-1">
                                    <i class="ti ti-check text-white d-flex icon fs-5"></i>
                                </div>
                            </label>

                            <input type="radio" class="btn-check" name="color-theme-layout" id="Aqua_Theme"
                                   autocomplete="off"/>
                            <label class="btn p-9 btn-outline-primary d-flex align-items-center justify-content-center"
                                   onclick="handleColorTheme('Aqua_Theme')" for="Aqua_Theme" data-bs-toggle="tooltip"
                                   data-bs-placement="top" data-bs-title="AQUA_THEME">
                                <div
                                    class="color-box rounded-circle d-flex align-items-center justify-content-center skin-2">
                                    <i class="ti ti-check text-white d-flex icon fs-5"></i>
                                </div>
                            </label>

                            <input type="radio" class="btn-check" name="color-theme-layout" id="Purple_Theme"
                                   autocomplete="off"/>
                            <label class="btn p-9 btn-outline-primary d-flex align-items-center justify-content-center"
                                   onclick="handleColorTheme('Purple_Theme')" for="Purple_Theme"
                                   data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="PURPLE_THEME">
                                <div
                                    class="color-box rounded-circle d-flex align-items-center justify-content-center skin-3">
                                    <i class="ti ti-check text-white d-flex icon fs-5"></i>
                                </div>
                            </label>

                            <input type="radio" class="btn-check" name="color-theme-layout" id="green-theme-layout"
                                   autocomplete="off"/>
                            <label class="btn p-9 btn-outline-primary d-flex align-items-center justify-content-center"
                                   onclick="handleColorTheme('Green_Theme')" for="green-theme-layout"
                                   data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="GREEN_THEME">
                                <div
                                    class="color-box rounded-circle d-flex align-items-center justify-content-center skin-4">
                                    <i class="ti ti-check text-white d-flex icon fs-5"></i>
                                </div>
                            </label>

                            <input type="radio" class="btn-check" name="color-theme-layout" id="cyan-theme-layout"
                                   autocomplete="off"/>
                            <label class="btn p-9 btn-outline-primary d-flex align-items-center justify-content-center"
                                   onclick="handleColorTheme('Cyan_Theme')" for="cyan-theme-layout"
                                   data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="CYAN_THEME">
                                <div
                                    class="color-box rounded-circle d-flex align-items-center justify-content-center skin-5">
                                    <i class="ti ti-check text-white d-flex icon fs-5"></i>
                                </div>
                            </label>

                            <input type="radio" class="btn-check" name="color-theme-layout" id="orange-theme-layout"
                                   autocomplete="off"/>
                            <label class="btn p-9 btn-outline-primary d-flex align-items-center justify-content-center"
                                   onclick="handleColorTheme('Orange_Theme')" for="orange-theme-layout"
                                   data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="ORANGE_THEME">
                                <div
                                    class="color-box rounded-circle d-flex align-items-center justify-content-center skin-6">
                                    <i class="ti ti-check text-white d-flex icon fs-5"></i>
                                </div>
                            </label>
                        </div>

                        <h6 class="mt-5 fw-semibold fs-4 mb-2">Layout Type</h6>
                        <div class="d-flex flex-row gap-3 customizer-box" role="group">
                            <div>
                                <input type="radio" class="btn-check" name="page-layout" id="vertical-layout"
                                       autocomplete="off"/>
                                <label class="btn p-9 btn-outline-primary" for="vertical-layout">
                                    <i class="icon ti ti-layout-sidebar-right fs-7 me-2"></i>Vertical
                                </label>
                            </div>
                            <div>
                                <input type="radio" class="btn-check" name="page-layout" id="horizontal-layout"
                                       autocomplete="off"/>
                                <label class="btn p-9 btn-outline-primary" for="horizontal-layout">
                                    <i class="icon ti ti-layout-navbar fs-7 me-2"></i>Horizontal
                                </label>
                            </div>
                        </div>

                        <h6 class="mt-5 fw-semibold fs-4 mb-2">Container Option</h6>

                        <div class="d-flex flex-row gap-3 customizer-box" role="group">
                            <input type="radio" class="btn-check" name="layout" id="boxed-layout" autocomplete="off"/>
                            <label class="btn p-9 btn-outline-primary" for="boxed-layout">
                                <i class="icon ti ti-layout-distribute-vertical fs-7 me-2"></i>Boxed
                            </label>

                            <input type="radio" class="btn-check" name="layout" id="full-layout" autocomplete="off"/>
                            <label class="btn p-9 btn-outline-primary" for="full-layout">
                                <i class="icon ti ti-layout-distribute-horizontal fs-7 me-2"></i>Full
                            </label>
                        </div>

                        <h6 class="fw-semibold fs-4 mb-2 mt-5">Sidebar Type</h6>
                        <div class="d-flex flex-row gap-3 customizer-box" role="group">
                            <a href="javascript:void(0)" class="fullsidebar">
                                <input type="radio" class="btn-check" name="sidebar-type" id="full-sidebar"
                                       autocomplete="off"/>
                                <label class="btn p-9 btn-outline-primary" for="full-sidebar">
                                    <i class="icon ti ti-layout-sidebar-right fs-7 me-2"></i>Full
                                </label>
                            </a>
                            <div>
                                <input type="radio" class="btn-check " name="sidebar-type" id="mini-sidebar"
                                       autocomplete="off"/>
                                <label class="btn p-9 btn-outline-primary" for="mini-sidebar">
                                    <i class="icon ti ti-layout-sidebar fs-7 me-2"></i>Collapse
                                </label>
                            </div>
                        </div>

                        <h6 class="mt-5 fw-semibold fs-4 mb-2">Card With</h6>

                        <div class="d-flex flex-row gap-3 customizer-box" role="group">
                            <input type="radio" class="btn-check" name="card-layout" id="card-with-border"
                                   autocomplete="off"/>
                            <label class="btn p-9 btn-outline-primary" for="card-with-border">
                                <i class="icon ti ti-border-outer fs-7 me-2"></i>Border
                            </label>

                            <input type="radio" class="btn-check" name="card-layout" id="card-without-border"
                                   autocomplete="off"/>
                            <label class="btn p-9 btn-outline-primary" for="card-without-border">
                                <i class="icon ti ti-border-none fs-7 me-2"></i>Shadow
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="dark-transparent sidebartoggler"></div>
    </div>

    <script  type="application/javascript">
        document.addEventListener("DOMContentLoaded", function () {
            let code = document.getElementById('code');

            code.addEventListener('change', function () {
                localStorage.setItem('code', code.value);
                let data = new FormData();
                data.append('code', code.value);
                data.append('_token', '{{ csrf_token() }}');
                fetch(route('teams.code', code.value), {
                    method: 'get'
                }).then(response => response.json())
                    .then(data => {
                        if (data.status === 200) {
                            document.getElementById('register').removeAttribute('hidden');
                            document.getElementById('codeFind').setAttribute('hidden', 'hidden');
                            document.getElementById('code_team').value = localStorage.getItem('code');
                        }
                    });
            });
        });
    </script>
@endsection
