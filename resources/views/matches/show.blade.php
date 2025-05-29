@php use Carbon\Carbon; @endphp
@extends('layouts.app')
@section('title')
    {{ __('Soccer Match') }}
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                </div>
                <div class="card-body mt-auto">
                    <div class="row">
                        <div class="col-md-12 m-2 table-responsive">
                            <h1 class="font-weight-medium">{{ __('Day Of Match') }}
                                : {{Carbon::parse($match->dayOfMatch)->locale(app()->getLocale())->translatedFormat('D, d M Y H:i A')}}</h1>
                            <div class="card mt-5">
                                <div class="p-0 position-relative mt-n4 mx-3">
                                    <div class="rounded pt-4 pb-3">
                                        <h3 class="text-capitalize ps-3 font-weight-medium text-center">{{ __('Teams') }}</h3>
                                    </div>
                                </div>
                                <div class="card-body mt-auto">
                                    <div class="row">
                                        <div class="d-flex justify-content-between align-items-center col-lg-12">
                                            <div class="col-lg-5">
                                                <div class="text-center ml-lg-2">
                                                    <h2 class="text-2xl font-weight-medium text-capitalize">{{ $match->home_team->name }}</h2>
                                                    <h1>{{ $match->home_team_goals }}</h1>
                                                    <img src="{{ asset('storage/'.$match->home_team->logo)}}"
                                                         alt="{{$match->home_team->name}}"
                                                         class="rounded-full card-img"/>
                                                </div>
                                            </div>
                                            <div class="col-lg-2">
                                                <div class="text-center">
                                                    <h2 class="font-weight-medium">VS</h2>
                                                </div>
                                            </div>
                                            <div class="col-lg-5">
                                                <div class="text-center mr-lg-2">
                                                    <h2 class="text-2xl font-weight-medium text-capitalize">{{ $match->away_team->name }}</h2>
                                                    <h1>{{ $match->away_team_goals }}</h1>
                                                    <img src="{{ asset('storage/'.$match->away_team->logo)}}"
                                                         alt="{{$match->away_team->name}}"
                                                         class="rounded-full card-img"/>
                                                </div>
                                            </div>
                                        </div>
                                        @if($match->finished !== 1 && Auth::check() &&Auth::user()->role_id != 3 && Auth::user()->role_id != 4)
                                            <h3>{{ __('Add Goals') }}</h3>
                                            <form method="POST"
                                                  action="{{ route('matches.team_goals', $match->id) }}"
                                                  class="pt-3 d-flex justify-content-between align-items-center col-lg-12">
                                                @csrf
                                                <div class="col-lg-5">
                                                    <div class="form-group row mb-3">
                                                        <label class="col-lg-3 col-form-label"
                                                               for="player_id_local">{{ __('Players') }}</label>
                                                        <div class="col-lg-9">
                                                            @if(!is_null($team_local_users))
                                                                <select class="js-example-basic-multiple w-100"
                                                                        multiple="multiple" name="player_id_local[]"
                                                                        id="player_id_local">
                                                                    @foreach($team_local_users as $player_local)
                                                                        <option
                                                                            value="{{ $player_local->user->id }}">{{ $player_local->user->name }}</option>
                                                                    @endforeach
                                                                </select>
                                                                @error('player_id_local')
                                                                <div class="text-danger">{{ $message }}</div>
                                                                @enderror
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="form-group row mb-3">
                                                        <label class="col-sm-3 col-form-label"
                                                               for="home_team_goals">{{ __('Goals') }}</label>
                                                        <div class="col-sm-9">
                                                            <input type="number"
                                                                   class="form-control" id="home_team_goals"
                                                                   name="home_team_goals">
                                                            @error('home_team_goals')
                                                            <div class="text-danger">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-5">
                                                    <div class="form-group row mb-3">
                                                        <label class="col-lg-3 col-form-label"
                                                               for="player_id_visit">{{ __('Players') }}</label>
                                                        <div class="col-lg-9">
                                                            @if(!is_null($team_visit_users))
                                                                <select class="js-example-basic-multiple w-100"
                                                                        multiple="multiple" name="player_id_visit[]"
                                                                        id="player_id_visit">
                                                                    @foreach($team_visit_users as $player_visit)
                                                                        <option
                                                                            value="{{ $player_visit->user->id }}">{{ $player_visit->user->name }}</option>
                                                                    @endforeach
                                                                </select>
                                                            @endif
                                                            @error('player_id_visit')
                                                            <div class="text-danger">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="form-group row mb-3">
                                                        <label class="col-sm-3 col-form-label"
                                                               for="away_team_goals">{{ __('Goals') }}</label>
                                                        <div class="col-sm-9">
                                                            <input type="number"
                                                                   class="form-control" id="away_team_goals"
                                                                   name="away_team_goals">
                                                            @error('away_team_goals')
                                                            <div class="text-danger">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-md-9 justify-end flex justify-items-end mr-10">
                                                        <button class="btn btn-success"
                                                                type="submit">{{ __('Add Goals') }}</button>
                                                    </div>
                                                </div>
                                            </form>
                                        @endif
                                    </div>
                                </div>
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
            $('#player_id_local').select2();
            $('#player_id_visit').select2();
        });
    </script>
@endsection
