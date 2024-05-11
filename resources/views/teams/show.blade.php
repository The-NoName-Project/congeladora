@extends('layouts.app')
@section('title')
    {{ __('Team') }}
@endsection

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
                                                <img src="{{ asset('storage/'.$player->photo)}}" alt="{{$player->name}}" width="100" height="100" class="rounded-full"/>
                                            @else
                                                <img src="{{ asset('assets/images/default.png') }}" width="45" height="45"
                                                     class="img-fluid rounded-circle" alt="spike-img"/>
                                            @endif
                                            <p class="text-2xl font-bold text-capitalize">{{ $player->name }}</p>
                                            <p class="text-gray-500 text-xl font-weight-medium">{{ __('Number') }}: {{ $player->number }}</p>
                                        </div>
                                    </div>
                                @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6" style="padding: 10rem !important;">
                        @if($team->user_id === Auth::user()->id)
                                <a href="{{ route('teams.pdf', $team->id) }}" class="btn btn-danger">{{ __('Codes for my Team') }}</a>
                        @endif
                        <img src="{{ asset('storage/'.$team->logo)}}" alt="{{$team->name}}" width="400" height="400"/>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
