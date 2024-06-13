@extends('layouts.app')
@section('title')
    {{ __('Team') }}
@endsection

@php
use App\Models\Teams;
use App\Models\UserTeam;
use App\Models\TeamUserCodes;

    $user = Auth::user();
    if ( $user->rol_id === 4) {
            $team = UserTeam::whereUserId($user->id)->first();
            $team = $team?->team;

            $code = null;
    } elseif ( $user->rol_id === 3) {
            $team = Teams::whereUserId($user->id)->first();
            $code = TeamUserCodes::whereTeamId($team?->id)->first()?->code;

    } else {
            $team = null;
            $code = null;
    }

@endphp

@section('content')
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                </div>
                <div class="card-body mt-auto">
                    <div class="row">
                        <div class="col-md-5 m-2">
                            <h1 class="font-weight-medium">{{ __('Team') }}: {{$team->name}}</h1>
                            <h3 class="font-weight-light ">Capitan: {{ $team->capitan->name }}</h3>

                            <div class="card mt-5">
                                <div class="p-0 position-relative mt-n4 mx-3">
                                    <div class="rounded pt-4 pb-3">
                                        <h3 class="text-capitalize ps-3 font-weight-medium text-center">{{ __('Players') }}</h3>
                                    </div>
                                </div>
                                <div class="card-body mt-auto">
                                    <div class="row">
                                        @foreach($team->players as $player)
                                            <div class="card">
                                                <div class="card-body">
                                                    @if(!is_null($player->photo))
                                                        <img src="{{ asset('storage/'.$player->photo)}}"
                                                             alt="{{$player->name}}" width="100" height="100"
                                                             class="rounded-full"/>
                                                    @else
                                                        <img src="{{ asset('assets/images/default.png') }}" width="45"
                                                             height="45"
                                                             class="img-fluid rounded-circle" alt="spike-img"/>
                                                    @endif
                                                    <p class="text-2xl font-bold text-capitalize">{{ $player->name }}</p>
                                                    <p class="text-gray-500 text-xl font-weight-medium">{{ __('Number') }}
                                                        : {{ $player->number }}</p>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6" style="padding: 10rem !important;">
                            @if($team->user_id === Auth::user()->id)
                                <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                        data-bs-target="#exampleModal">
                                    {{ __('Codes for my Team') }} <i class="ti ti-key"></i>
                                </button>

                                <div class="modal fade" id="exampleModal" tabindex="-1"
                                     aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="exampleModalLabel">{{ __('Codes for my Team') }}</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <h3 class="text-center">{{ __('Code for join to my team') }}</h3>
                                                <h1 class="text-center">{{ $code }}</h1>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                                    Close
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            @endif
                            <img src="{{ asset('storage/'.$team->logo)}}" alt="{{$team->name}}" width="400"
                                 height="400" class="rounded-2 p-2"/>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
