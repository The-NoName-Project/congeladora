@php
    use App\Models\UserTeam;
    use App\Models\Teams;

        $user = Auth::user();

        if ( $user->rol_id === 4) {
            $team = UserTeam::whereUserId($user->id)->first();
            $team = $team?->team;
        } elseif ( $user->rol_id === 3) {
            $team = Teams::whereUserId($user->id)->first();
        } else {
            $team = null;
        }

@endphp

@extends('layouts.app')

@section('title')
    {{ __('Profile') }}
@endsection

@section('content')
    <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PATCH')
        <div class="position-relative overflow-hidden rounded-3">
            <img src="{{ asset('assets/images/profilebg.jpg') }}" alt="spike-img" class="w-100">
        </div>
        <div class="card mx-9 mt-n5">
            <div class="card-body pb-0">
                <div class="d-md-flex align-items-center justify-content-between text-center text-md-start">
                    <div class="d-md-flex align-items-center">
                        <div class="rounded-circle position-relative mb-9 mb-md-0 d-inline-block">
                            <img
                                src="{{ asset($user->picture !== null ?
                                'storage/' . $user->picture :
                                'assets/images/default.png') }}"
                                alt="spike-img"
                                class="img-fluid rounded-circle"
                                width="100" height="100">
                            <button
                                id="change-profile-image"
                                type="button"
                                class="text-bg-primary rounded-circle text-white d-flex align-items-center justify-content-center position-absolute bottom-0 end-0 p-1 border border-2 border-white">
                                <i class="ti ti-plus"></i>
                            </button>
                        </div>
                        <div class="ms-0 ms-md-3 mb-9 mb-md-0">
                            <div class="d-flex align-items-center justify-content-center justify-content-md-start mb-1">
                                <h4 class="me-7 mb-0 fs-7">{{ $user->name }}</h4>
                                <span
                                    class="badge fs-2 fw-bold rounded-pill bg-primary-subtle text-primary border-primary border">{{ $user->rol->name }}</span>
                            </div>
                            <p class="fs-4 mb-1">{{ $user->rol->name }}</p>
                            <div class="d-flex align-items-center justify-content-center justify-content-md-start">
                                <span class="bg-success p-1 rounded-circle"></span>
                                <h6 class="mb-0 ms-2"></h6>
                            </div>
                        </div>
                    </div>
                </div>
                <ul class="nav nav-pills user-profile-tab mt-4 justify-content-center justify-content-md-start"
                    id="pills-tab" role="tablist">
                    <li class="nav-item me-2 me-md-3" role="presentation">
                        <button
                            class="nav-link position-relative rounded-0 d-flex align-items-center justify-content-center bg-transparent py-6 active"
                            id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button"
                            role="tab" aria-controls="pills-profile" aria-selected="true">
                            <i class="ti ti-user-circle me-0 me-md-6  fs-6"></i>
                            <span class="d-none d-md-block">{{ __('Profile') }}</span>
                        </button>
                    </li>
                </ul>
            </div>
        </div>
        <div class="tab-pane fade show active" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab"
             tabindex="0">
            <div class="row">
                <div class="col-lg-4">
                    <div class="card ">
                        <div class="card-body p-4">
                            <h4 class="fs-6 mb-9">{{ __('About Me') }}</h4>
                            <p class="mb-0 pb-9 text-dark">
                                {{--                            Hello, I’m Mike Nielsen. I’m a professional--}}
                                {{--                            who designs, develops, tests, and maintains--}}
                                {{--                            software applications and systems.--}}
                            </p>
                            <div class="py-9 border-top">
                                <h5 class="mb-9">{{ __('Contact') }}</h5>
                                <div class="d-flex align-items-center mb-9">
                                    <div
                                        class="bg-danger-subtle text-danger fs-14 round-40 rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="ti ti-phone"></i>
                                    </div>
                                    <div class="ms-6">
                                        <h6 class="mb-1">{{ __('Phone') }}</h6>
                                        <p class="mb-0">{{ $user?->phone }}</p>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center mb-9">
                                    <div
                                        class="bg-success-subtle text-success fs-14 round-40 rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="ti ti-mail"></i>
                                    </div>
                                    <div class="ms-6">
                                        <h6 class="mb-1">{{ __('Email') }}</h6>
                                        <p class="mb-0">{{ $user->email }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @if($team !== null)
                        <div class="card">
                            <div class="card-body">
                                <h5 class="mb-9">{{ __('Team') }}</h5>
                                <div class="d-flex align-items-center mb-9">
                                    <div
                                        class="bg-info-subtle text-info fs-14 round-40 rounded-circle d-flex align-items-center justify-content-center">
{{--                                        <i class="ti ti-brand-telegram"></i>--}}
                                        <img src="{{ asset($team->logo !== null ? 'storage/' . $team->logo : 'assets/images/default.png') }}"
                                             alt="spike-img"
                                             class="img-fluid rounded-circle"
                                             width="50" height="50">
                                    </div>
                                    <div class="ms-6">
                                        <h6 class="mb-1">{{ $team?->name }}</h6>
                                        <p class="mb-0">{{ $team->slug }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
                <div class="col-lg-8">
                    <div class="row">
                    @if(Auth::user()->rol_id === 3 || Auth::user()->rol_id === 4)
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-body p-4">
                                    <div class="d-flex align-items-center">
                                        <div
                                            class="bg-primary-subtle text-primary p-6 fs-7 rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="ti ti-template"></i>
                                        </div>
                                        <div class="ms-6">
                                            <h6 class="mb-1 fs-6">10</h6>
                                            <p class="mb-0">{{ __('Goals') }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-body p-4">
                                    <div class="d-flex align-items-center">
                                        <div
                                            class="bg-success-subtle text-success p-6 fs-7 rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="ti ti-layout-grid-add"></i>
                                        </div>
                                        <div class="ms-6">
                                            <h6 class="mb-1 fs-6">4</h6>
                                            <p class="mb-0">{{ __('Fouls') }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-body p-4">
                                    <div class="d-flex align-items-center">
                                        <div
                                            class="bg-danger-subtle text-danger p-6 fs-7 rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="ti ti-id"></i>
                                        </div>
                                        <div class="ms-6">
                                            <h6 class="mb-1 fs-6"></h6>
                                            <p class="mb-0"></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>
                    <div class="card">
                        <div class="card-body p-4">
                            <ul class="nav nav-tabs nav-tabs-user-profile mb-4" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link shadow-none active" data-bs-toggle="tab" href="#feeds" role="tab"
                                       aria-selected="true" tabindex="-1">
                                        <span>{{ __('Profile') }}</span>
                                    </a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active mb-3" id="feeds" role="tabpanel">
                                    <div class="form-group row mt-3 mb-3" hidden="hidden">
                                        <div class="col-md-3">
                                            <label for="picture" class="form-label">{{ __('Picture') }}</label>
                                        </div>
                                        <div class="col-md-9">
                                            <input id="picture_file" type="file" class="form-control" name="picture">
                                        </div>
                                    </div>
                                    <div class="form-group row mt-3 mb-3">
                                        <div class="col-md-3">
                                            <label for="name" class="form-label">{{ __('Name') }}</label>
                                        </div>
                                        <div class="col-md-9">
                                            <input id="name" type="text" class="form-control" name="name"
                                                   value="{{ $user->name }}" required>
                                        </div>
                                    </div>
                                    <div class="form-group row mt-3 mb-3">
                                        <div class="col-md-3">
                                            <label for="email" class="form-label">{{ __('Email') }}</label>
                                        </div>
                                        <div class="col-md-9">
                                            <input id="email" type="email" class="form-control" name="email"
                                                   value="{{ $user->email }}" required>
                                        </div>
                                    </div>
                                    @if($user->number !== null)
                                        <div class="form-group row mt-3 mb-3">
                                            <div class="col-md-3">
                                                <label for="number" class="form-label">{{ __('Number') }}</label>
                                            </div>
                                            <div class="col-md-9">
                                                <input id="number" type="number" class="form-control" name="number"
                                                       value="{{ $user?->number }}" required>
                                            </div>
                                        </div>
                                    @endif
                                    <div class="form-group row mt-3 mb-3">
                                        <div class="col-md-3">
                                            <label for="phone" class="form-label">{{ __('Phone') }}</label>
                                        </div>
                                        <div class="col-md-9">
                                            <input id="phone" type="number" class="form-control" name="phone"
                                                   value="{{ $user?->phone }}" required>
                                        </div>
                                    </div>
                                    <div class="form-group row mt-3 mb-3">
                                        <div class="col-md-3">
                                            <label for="password" class="form-label">{{ __('Password') }}</label>
                                        </div>
                                        <div class="col-md-9">
                                            <input id="password" type="password" class="form-control" name="password">
                                        </div>
                                    </div>
                                    <div class="form-group row mt-3 mb-3">
                                        <div class="col-md-3">
                                            <label for="password_confirmation"
                                                   class="form-label">{{ __('Confirm Password') }}</label>
                                        </div>
                                        <div class="col-md-9">
                                            <input id="password_confirmation" type="password" class="form-control"
                                                   name="password_confirmation">
                                        </div>
                                    </div>
                                    <button type="submit"
                                            class="btn btn-primary w-100 mb-4 rounded-pill">{{ __('Update Profile') }}</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
        <script>
            $(document).ready(function () {
                $('#change-profile-image').on('click', function () {
                    // crea un input de tipo file para seleccionar la imagen y despues la oculta
                    var input = document.createElement('input');
                    input.type = 'file';
                    input.accept = 'image/*';
                    input.name = 'picture_file';
                    input.click();
                    input.onchange = function () {
                        var file = input.files[0];
                        var reader = new FileReader();
                        reader.readAsDataURL(file);
                        reader.onload = function () {
                            $('.rounded-circle').attr('src', reader.result);
                        };
                        document.getElementById('picture_file').files = input.files;
                        $('.form-group').removeAttr('hidden');
                    };
                });
            });
        </script>
    </form>
@endsection
