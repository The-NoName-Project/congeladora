@php
use App\Utils\DateUtil;
use Carbon\Carbon;
 @endphp

@extends('layouts.app')
@section('title')
    {{ __('Schedules') }}
@endsection

@section('content')
    <div class="row" style="margin-top: 4rem !important;">
        <div class="col-md-12 grid-margin">
            @if( session('status') )
                <div class="alert alert-success alert-dismissible text-dark mb-4" role="alert">
                <span class="text-sm"> <a href="javascript:" class="alert-link text-dark">Excelente</a>.
                    {{ session('status') }}.</span>
                    <button type="button" class="btn btn-close text-lg py-3 opacity-10" data-bs-dismiss="alert"
                            aria-label="Close">
                        <span aria-hidden="true">&times;</span>
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
            <div class="card">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                    <div class="bg-gradient-primary shadow-primary rounded pt-4 pb-3">
                        <h3 class="text-capitalize ps-3 font-weight-medium ml-lg-4">
                            @if(Auth::user()->rol_id === 1)
                                {{ __('List of Schedules') }}
                            @endif
                        </h3>
                        <div class="justify-content-end align-items-end mr-lg-5">
                            <button type="button" class="btn btn-outline-light btn-icon-text"
                                    data-bs-toggle="modal"
                                    data-bs-target="#createSchedule">
                                <i class="ti ti-plus btn-icon-prepend"></i>
                            </button>
                        </div>
                        <div class="modal fade" id="createSchedule" tabindex="-1" aria-labelledby="createScheduleLabel"
                             aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h3 class="modal-title fs-5"
                                            id="exampleModalLabel">{{ __('Create Schedule') }}</h3>
                                        <button type="button" class="btn btn-close" data-bs-dismiss="modal"
                                                aria-label="Close">
                                        </button>
                                    </div>
                                    <form action="{{ route('schedules.store') }}" method="POST">
                                        @csrf
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="form-group row mb-3">
                                                    <label class="col-sm-3 col-form-label"
                                                           for="name_user">{{ __('Date Schedule') }}</label>
                                                    <div class="col-sm-9">
                                                        <select class="form-select" name="date" id="date">
                                                            <option value="">{{ __('Select a date') }}</option>
                                                            @foreach($dates as $date)
                                                                <option value="{{ $date }}">{{ $date }}</option>
                                                            @endforeach
                                                        </select>
                                                        @error('date')
                                                        <div class="text-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="form-group row mb-3">
                                                    <label class="col-sm-3 col-form-label"
                                                           for="number">{{ __('Opening Time') }}</label>
                                                    <div class="col-sm-9 timepicker-ui" id="opening_time">
                                                        <input type="text"
                                                               class="form-control timepicker-ui-input"
                                                               value="12:00 AM"
                                                               name="opening_time"
                                                        />
                                                        @error('number')
                                                            <div class="text-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="form-group row mb-3">
                                                    <label class="col-sm-3 col-form-label"
                                                           for="number">{{ __('Opening Time') }}</label>
                                                    <div class="col-sm-9 timepicker-ui" id="closing_time">
                                                        <input type="text"
                                                               class="form-control timepicker-ui-input"
                                                               value="12:00 AM"
                                                                name="closing_time"
                                                        />
                                                        @error('number')
                                                        <div class="text-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">{{ __('Close') }}</button>
                                            <button type="submit" class="btn btn-success"
                                                    data-bs-dismiss="modal">{{ __('Submit') }}</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body mt-auto">
                    @if(Auth::user()->rol_id === 1)
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>{{ __('Schedule') }}</th>
                                    <th>{{ __('Opening Time') }}</th>
                                    <th>{{ __('Closing Time') }}</th>
                                    <th>{{ __('Actions') }}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($schedules as $schedule)
                                    <tr>
                                        <td class="align-content-center">
                                            <h4 class="font-weight-medium">{{ $loop->index + 1 }}</h4>
                                        </td>
                                        <td class="d-flex align-items-center">
                                            <h2 class="font-weight-medium text-center">{{ DateUtil::translateDateToDayOfWeek(Carbon::parse($schedule->date)->locale('es_ES')) }}</h2>
                                        </td>
                                        <td class="align-items-center">
                                            {{ Carbon::parse($schedule->opening_time)->locale('es_ES')->format('h:i A') }}
                                        </td>

                                        <td class="align-items-center">
                                            {{ Carbon::parse($schedule->closing_time)->subHour()->locale('es_ES')->format('h:i A') }}
                                        </td>
                                        <td>
                                            @if(Auth::user()->rol_id === 1)
                                                <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                                        data-bs-target="#deleteSchedule"
                                                        onclick="deleteSchedule({{$schedule->id}})">
                                                    <i class="ti ti-trash-x btn-icon-prepend"></i>
                                                </button>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
                @if(Auth::user()->rol_id === 1)
                    <div class="modal fade" id="deleteSchedule" tabindex="-1"
                         aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">{{ __('Delete Schedule') }}</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="container">
                                        <div class="row justify-content-center">
                                            <div class="col-md-12">
                                                <form action="" id="deleteForm" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <p id="banner">{{ __('Are you sure you want to delete this record?') }}</p>
                                                    <div class="modal-footer">
                                                        <button class="btn btn-secondary" type="button"
                                                                data-bs-dismiss="modal">{{ __('Cancel')}}
                                                        </button>
                                                        <button class="btn btn-danger"
                                                                type="submit">{{ __('Delete Schedule') }}</button>
                                                    </div>
                                                </form>
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
        <script type="application/javascript">
            // hace una peticion ajax para obtener la informacion de la moto
            function deleteSchedule(id) {
                let form = document.getElementById('deleteForm')
                form.action = route('schedules.delete', id)
                $.ajax({
                    url: route('schedules.json', id),
                    type: 'GET',
                    success: function (response) {
                        $('#banner').html(`{{__('Are you sure you want to delete this record?')}}` + ' ' + response.date);
                    }
                })
            }
        </script>
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const opening_time = document.querySelector("#opening_time");
                const closing_time = document.querySelector("#closing_time");

                const opening_time_picker = new window.tui.TimepickerUI(opening_time, {
                   theme: 'crane-radius', editable: true
                });

                const closing_time_picker = new window.tui.TimepickerUI(closing_time, {
                    theme: 'crane-radius', editable: true
                });

                opening_time_picker.create();
                closing_time_picker.create();
            });
        </script>
    </div>
@endsection
