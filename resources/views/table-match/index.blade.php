@extends('layouts.app')
@section('title')
    {{ __('Table Matches') }}
@endsection

@php
    $user = Auth::user();

    if ($user->rol_id === 4) {
        $team = \App\Models\UserTeam::where('user_id', $user->id)->first();
    }
    elseif ($user->rol_id === 3) {
        $team = \App\Models\Teams::where('user_id', $user->id)->first();
    }
    else {
        $team = null;
    }

    @endphp

@section('content')
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card mt-3">
            <div class="card">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                    <div class="bg-gradient-primary shadow-primary rounded pt-4 pb-3">
                        <h3 class="text-capitalize ps-3 font-weight-medium ml-lg-4">{{ __('Table Matches') }}</h3>
                    </div>
                </div>
                <div class="card-body mt-auto">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>{{ __('Team') }}</th>
                                <th>{{ __('Matches') }}</th>
                                <th>{{ __('Wins') }}</th>
                                <th>{{ __('Draws') }}</th>
                                <th>{{ __('Losses') }}</th>
                                <th>{{ __('Goals') }}</th>
                                <th>{{ __('Goals Against') }}</th>
                                <th>{{ __('Goal Difference') }}</th>
                                <th>{{ __('Points') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($scores as $score)
                                <tr>
                                    <td><p class="font-weight-medium text-xl">{{ $loop->index + 1 }}</p></td>
                                    <td class="align-items-center">
                                        <img src="{{ asset('storage/'.$score->team->logo)}}"
                                             alt="{{$score->team->name}}" class="rounded" style="width: 3rem !important; margin-right: 1rem !important;"/>
                                        <h2 class="font-weight-medium">{{ $score->team->name }}</h2>
                                    </td>
                                    <td>
                                        <h2 class="font-weight-medium">{{ $score->matches }}</h2>
                                    </td>
                                    <td>
                                        <h2 class="font-weight-medium">{{ $score->wins }}</h2>
                                    </td>
                                    <td>
                                        <h2 class="font-weight-medium">{{ $score->draws }}</h2>
                                    </td>
                                    <td>
                                        <h2 class="font-weight-medium">{{ $score->losses }}</h2>
                                    </td>
                                    <td>
                                        <h2 class="font-weight-medium">{{ $score->goals_for }}</h2>
                                    </td>
                                    <td>
                                        <h2 class="font-weight-medium">{{ $score->goals_against }}</h2>
                                    </td>
                                    <td>
                                        <h2 class="font-weight-medium">{{ $score->goal_difference }}</h2>
                                    </td>
                                    <td>
                                        <h2 class="font-weight-medium">{{ $score->points }}</h2>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
