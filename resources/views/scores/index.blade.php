@extends('layouts.app')
@section('title')
    {{ __('Scores') }}
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card mt-3">
            <div class="card">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                    <div class="bg-gradient-primary shadow-primary rounded pt-4 pb-3">
                        <h3 class="text-capitalize ps-3 font-weight-medium ml-lg-4">{{ __('Scores') }}</h3>
                    </div>
                </div>
                <div class="card-body mt-auto">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>{{ __('Team') }}</th>
                                <th>{{ __('Games Played') }}</th>
                                <th>{{ __('Wins') }}</th>
                                <th>{{ __('Draw') }}</th>
                                <th>{{ __('Loses') }}</th>
                                <th>{{ __('Goals Matched') }}</th>
                                <th>{{ __('Goals Conceded') }}</th>
                                <th>{{ __('Difference Goals') }}</th>
                                <th>{{ __('Points') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($scores as $team)
                                <tr>
                                    <td><h3 class="font-weight-medium text-gray">{{ $loop->index + 1 }}</h3></td>
                                    <td>
                                        <img src="{{ asset('storage/'.$team->team?->logo)}}" alt="{{$team->team?->name}}"/>
                                        <h2 class="font-weight-medium">{{ $team->team?->name }}</h2>
                                    </td>
                                    <td><h3 class="text-center">{{ $team->wins + $team->loses + $team->draw }}</h3></td>
                                    <td><h3 class="text-center">{{ $team->wins }}</h3></td>
                                    <td><h3 class="text-center">{{ $team->draws }}</h3></td>
                                    <td><h3 class="text-center">{{ $team->losses }}</h3></td>
                                    <td><h3 class="text-center">{{ $team->goals_for }}</h3></td>
                                    <td><h3 class="text-center">{{ $team->goals_against }}</h3></td>
                                    <td><h3 class="text-center">{{ $team->goal_difference }}</h3></td>
                                    <td><h3 class="text-center">{{ $team->points }}</h3></td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        @if(is_null($scoresFemenil))
            <div class="col-md-12 grid-margin stretch-card mt-3">
                <div class="card">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                        <div class="bg-gradient-primary shadow-primary rounded pt-4 pb-3">
                            <h3 class="text-capitalize ps-3 font-weight-medium ml-lg-4">{{ __('Scores Feminine') }}</h3>
                        </div>
                    </div>
                    <div class="card-body mt-auto">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>{{ __('Team') }}</th>
                                    <th>{{ __('Games Played') }}</th>
                                    <th>{{ __('Wins') }}</th>
                                    <th>{{ __('Draw') }}</th>
                                    <th>{{ __('Loses') }}</th>
                                    <th>{{ __('Goals Matched') }}</th>
                                    <th>{{ __('Goals Conceded') }}</th>
                                    <th>{{ __('Difference Goals') }}</th>
                                    <th>{{ __('Points') }}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($scoresFemenil as $team)
                                    <tr>
                                        <td><h3 class="font-weight-medium text-gray">{{ $loop->index + 1 }}</h3></td>
                                        <td>
                                            <img src="{{ asset('storage/'.$team->team?->logo)}}" alt="{{$team->team?->name}}"/>
                                            <h2 class="font-weight-medium">{{ $team->team?->name }}</h2>
                                        </td>
                                        <td><h3 class="text-center">{{ $team->wins + $team->loses + $team->draw }}</h3></td>
                                        <td><h3 class="text-center">{{ $team->wins }}</h3></td>
                                        <td><h3 class="text-center">{{ $team->draws }}</h3></td>
                                        <td><h3 class="text-center">{{ $team->losses }}</h3></td>
                                        <td><h3 class="text-center">{{ $team->goals_for }}</h3></td>
                                        <td><h3 class="text-center">{{ $team->goals_against }}</h3></td>
                                        <td><h3 class="text-center">{{ $team->goal_difference }}</h3></td>
                                        <td><h3 class="text-center">{{ $team->points }}</h3></td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection
