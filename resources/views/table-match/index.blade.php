@extends('layouts.app')
@section('title')
    {{ __('Table Matches') }}
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card mt-3">
            <div class="card">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                    <div class="bg-gradient-primary shadow-primary rounded pt-4 pb-3">
                        <h3 class="text-capitalize ps-3 font-weight-medium ml-lg-4">{{ __('Table Matches') }}</h3>
                        @if(Auth::check() && Auth::user()->rol_id == 1)
                            <div class="d-flex justify-content-end align-items-end mr-lg-5">
                                <button type="button" class="btn btn-outline-light btn-icon-text"
                                        data-bs-toggle="modal"
                                        data-bs-target="#restartSeason">
                                    <i class="ti ti-plus btn-icon-prepend"></i>
                                </button>

                                <div class="modal fade" id="restartSeason" tabindex="-1" aria-labelledby="restartSeasonLabel"
                                     aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h3 class="modal-title fs-5"
                                                    id="exampleModalLabel">{{ __('Restart Season') }}</h3>
                                                <button type="button" class="btn btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close">
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="container">
                                                    <div class="row justify-content-center">
                                                        <div class="col-md-12">
                                                            <form action="{{ route('matches.restart_league', 1) }}" method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                                <p id="banner">{{ __('Are you sure you want to restart this season?') }}</p>
                                                                <div class="modal-footer">
                                                                    <button class="btn btn-secondary" type="button"
                                                                            data-bs-dismiss="modal">{{ __('Cancel')}}
                                                                    </button>
                                                                    <button class="btn btn-danger"
                                                                            type="submit">{{ __('Restart Season') }}</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
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
