@php
    use Carbon\Carbon;
    use Vinkla\Hashids\Facades\Hashids;
@endphp
@extends('layouts.app')
@section('title')
    {{ __('Soccer Matches') }}
@endsection

@section('content')
    <div class="row">
        @if( session('status') )
            <div class="alert alert-success alert-dismissible text-dark mb-4" role="alert">
                <span class="text-sm"> <a href="javascript:" class="alert-link text-dark">Excelente</a>.
                    {{ session('status') }}.</span>
                <button type="button" class="btn-close text-lg py-3 opacity-10" data-bs-dismiss="alert"
                        aria-label="Close">
                </button>
            </div>
        @endif
        @if( session('statusError') )
            <div class="alert alert-danger alert-dismissible text-dark mb-4" role="alert">
                <span class="text-sm"> <a href="javascript:" class="alert-link text-dark">Error</a>.
                    {{ session('statusError') }}.</span>
                <button type="button" class="btn-close text-lg py-3 opacity-10" data-bs-dismiss="alert"
                        aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        <div class="col-md-12 grid-margin stretch-card mt-3">
            <div class="card">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                    <div class="bg-gradient-primary shadow-primary rounded pt-4 pb-3">
                        <h3 class="text-capitalize ps-3 font-weight-medium ml-lg-4">{{ __('List of Soccer Matches') }}</h3>
                        @auth
                        @if(Auth::user()->rol_id === 1)
                            <div class="float-right justify-content-end align-items-end mr-lg-5">
                                <a href="{{route('matches.create')}}" class="btn btn-primary"
                                   title="{{ __('Create Soccer Match') }}">
                                    <i class="ti ti-plus btn-icon-prepend"></i>
                                </a>
                            </div>
                        @endif
                        @endauth
                    </div>
                </div>
                <div class="card-body mt-auto calender-sidebar app-calendar">
                    <div id="calendar" class="fc fc-media-screen fc-direction-ltr fc-theme-standard fc-liquid-hack"
                         style="height: 1052px;">
                    </div>
                    <div class="modal fade" id="eventModal" tabindex="-1" aria-labelledby="eventModalLabel"
                         aria-hidden="true">
                        <div class="modal-dialog modal-dialog-scrollable modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="eventModalLabel">
                                        {{ __('Soccer Match') }}
                                    </h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div>
                                                <label class="form-label">
                                                    {{ __('Soccer Match') }}
                                                </label>
                                                <input id="event-title" type="text" class="form-control" readonly>
                                            </div>
                                        </div>
                                        <div class="col-md-12 mt-6">
                                            <div>
                                                <label class="form-label">{{ __('Match Date') }}</label>
                                                <input id="event-start-date" type="date" class="form-control" readonly>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn bg-danger-subtle text-danger"
                                            data-bs-dismiss="modal">
                                        Close
                                    </button>
{{--                                    <button type="button" class="btn btn-success btn-update-event"--}}
{{--                                            data-fc-event-public-id="">--}}
{{--                                        Update changes--}}
{{--                                    </button>--}}
{{--                                    <button type="button" class="btn btn-primary btn-add-event">--}}
{{--                                        Add Event--}}
{{--                                    </button>--}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="{{ asset('assets/js/calendar.init.js') }}"></script>
        <script src="{{ asset('assets/js/fullcalendar.js') }}"></script>
    </div>
@endsection
