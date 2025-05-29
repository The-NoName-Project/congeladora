@php
    use Carbon\Carbon;
@endphp

@extends('layouts.app')

@section('title')
    {{ __('Dashboard') }}
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card mt-3">
            @if(session()->has('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            @if(session()->has('warning'))
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    {{ session('warning') }}
                    <a href="{{ route('profile.edit') }}" class="alert-link">
                        {{ __('Please change your password') }}
                    </a>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif
            @if (count($soccer) > 0)
                    <div class="card">
                        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                            <div class="rounded pt-4 pb-3 rounded-top">
                                <h3 class="text-capitalize ps-3 font-weight-medium text-center">{{ __('List of Soccer Matches') }}</h3>
                            </div>
                        </div>
                        <div class="card-body mt-auto">
                            <div class="row">
                                @foreach($soccer as $match)
                                    <a href="{{ route('matches.show', Vinkla\Hashids\Facades\Hashids::encode($match->id) ) }}"
                                       style="text-decoration: none; color: #0e1014"
                                       class="col-md-4"
                                    >
                                        <div class="card d-flex align-items-center bg-primary-subtle">
                                            <div class="card-body">
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <div class="text-center ml-lg-2" style="margin-right: 20px">
                                                        <img src="{{ asset('storage/'.$match->home_team->logo)}}"
                                                             alt="{{$match->home_team->name}}" width="100" height="100"
                                                             class="rounded-full"/>
                                                        <p class="text-2xl font-bold text-capitalize">{{ $match->home_team->name }}</p>
                                                        <h3>{{ $match->home_team_goals }}</h3>
                                                    </div>
                                                    <div class="text-center">
                                                        <p class="font-weight-medium">VS</p>
                                                    </div>
                                                    <div class="text-center mr-lg-2" style="margin-left: 20px">
                                                        <img src="{{ asset('storage/'.$match->away_team->logo)}}"
                                                             alt="{{$match->away_team->name}}" width="100" height="100"
                                                             class="rounded-full"/>
                                                        <p class="text-2xl font-bold text-capitalize">{{ $match->away_team->name }}</p>
                                                        <h3>{{ $match->away_team_goals }}</h3>
                                                    </div>
                                                </div>
                                                <label class="badge badge-info">
                                                    Faltan {{ Carbon::now()->diff($match->match_date)->format('%d días con %h horas y %i minutos') }} para el partido.
                                                </label>
                                            </div>
                                        </div>
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endif
            @if (count($played_games) > 0)
                    <div class="card">
                                            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                                                <div class="rounded pt-4 pb-3 rounded-top">
                                                    <h3 class="text-capitalize ps-3 font-weight-medium text-center">{{ __('List of Soccer Matches Played') }}</h3>
                                                </div>
                                            </div>
                        <div class="card-body mt-auto">
                            <div class="row">
                                @foreach($played_games as $played)
                                    <a href="{{ route('matches.show', Vinkla\Hashids\Facades\Hashids::encode($played->id) ) }}"
                                       style="text-decoration: none; color: #0e1014"
                                       class="col-md-4"
                                    >
                                        <div class="card d-flex align-items-center bg-primary-subtle">
                                            <div class="card-body">
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <div class="text-center ml-lg-2" style="margin-right: 20px">
                                                        <img src="{{ asset('storage/'.$played->home_team->logo)}}"
                                                             alt="{{$played->home_team->name}}" width="100" height="100"
                                                             class="rounded-full"/>
                                                        <p class="text-2xl font-bold text-capitalize">{{ $played->home_team->name }}</p>
                                                        <h3>{{ $played->home_team_goals }}</h3>
                                                    </div>
                                                    <div class="text-center">
                                                        <p class="font-weight-medium">VS</p>
                                                    </div>
                                                    <div class="text-center mr-lg-2" style="margin-left: 20px">
                                                        <img src="{{ asset('storage/'.$played->away_team->logo)}}"
                                                             alt="{{$played->away_team->name}}" width="100" height="100"
                                                             class="rounded-full"/>
                                                        <p class="text-2xl font-bold text-capitalize">{{ $played->away_team->name }}</p>
                                                        <h3>{{ $played->away_team_goals }}</h3>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endif
        </div>
    </div>
@endsection
