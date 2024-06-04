@extends('layouts.app')
@section('title')
    {{ __('Create Soccer Match') }}
@endsection

@section('content')
    <div class="row">
        <div class="col-12 grid-margin">
            @error('error')
            <div class="alert alert-danger alert-dismissible text-dark mb-4" role="alert">
                <span class="text-sm"> <a href="javascript:" class="alert-link text-dark">Error</a>.
                    {{ $message }}.
                </span>
                <button type="button" class="btn btn-close text-lg py-3 opacity-10" data-bs-dismiss="alert"
                        aria-label="Close">
                    <i class="ti ti-x"></i>
                </button>
            </div>
            @enderror
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title">{{ __('Create Soccer Match') }}</h3>
                    <form class="form-sample" method="post" action="{{ route('matches.store') }}"
                          enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label"
                                           for="home_team_id">{{ __('Local Team') }}</label>
                                    <div class="col-sm-9">
                                        <select class="form-control" name="home_team_id" id="home_team_id">
                                            <option>{{ __('Local Team') }}</option>
                                            @foreach($teams as $team)
                                                <option value="{{ $team->id }}">{{ $team->name }}</option>
                                            @endforeach
                                            @error('home_team_id')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label" for="local_team">{{ __('Image') }}</label>
                                    <div class="col-sm-9">
                                        <div id="local_team" class="text-center ml-10 align-center self-center">

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label"
                                           for="away_team_id">{{ __('Visit Team') }}</label>
                                    <div class="col-sm-9">
                                        <select class="form-control" name="away_team_id" id="away_team_id">
                                            <option>{{ __('Visit Team') }}</option>
                                            @foreach($teams as $team)
                                                <option value="{{ $team->id }}">{{ $team->name }}</option>
                                            @endforeach
                                            @error('away_team_id')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label" for="team_visit">{{ __('Image') }}</label>
                                    <div class="col-sm-9">
                                        <div id="team_visit" class="text-center ml-10 align-center self-center">

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <div class="form-group row mb-3">
                                    <label class="col-sm-3 col-form-label"
                                           for="match_date">{{ __('Day Of Match') }}</label>
                                    <div class="col-sm-9">
                                        <input type="date" name="match_date" id="match_date"
                                               class="form-control">
                                        @error('match_date')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                        <div id="date" hidden="hidden"></div>
                                    </div>
                                </div>
                                <div class="form-group row mb-3" hidden="hidden" id="start">
                                    <label class="col-sm-3 col-form-label"
                                           for="starting_time">{{ __('Starting Time') }}</label>
                                    <div class="col-sm-9">
                                        <div class="btn-group" data-bs-toggle="buttons" id="starting_time">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label" for="capitan_id">{{ __('Referee') }}</label>
                                    <div class="col-sm-9">
                                        <select class="form-control" name="referee_id" id="capitan_id">
                                            @foreach($referees as $referee_id)
                                                <option value="{{ $referee_id->id }}"
                                                        style="font-size: 20px">{{ $referee_id->name }}</option>
                                            @endforeach
                                            @error('referee_id')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @foreach($errors->all() as $error)
                            <div class="text-danger">{{ $error }}</div>
                        @endforeach
                        <div class="row">
                            <div class="col-md-2 ml-4">
                                <a class="btn btn-danger" href="{{ route('matches.index') }}">{{ __('Cancel') }}</a>
                            </div>
                            <div class="col-md-9 justify-end flex justify-items-end mr-10">
                                <button class="btn btn-success" type="submit">{{ __('Create Soccer Match') }}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
    <script type="text/javascript">
        let home_team_id = document.getElementById("home_team_id");
        home_team_id.onchange = function (e) {
            $.ajax({
                url: route('teams.json', home_team_id.value),
                type: 'GET',
                success: function (response) {
                    document.getElementById('local_team').innerHTML = '';
                    // console.log(response)
                    {{--$('#banner').html(`{{__('Are you sure you want to delete this record?')}}` + ' ' + response.name);--}}
                    let imageUrl = response.logo // Assuming 'logo_url' is the key holding the image URL in the response
                    let imageElement = document.createElement('img');
                    let image = route('images.show', imageUrl);
                    // imageUrl = `http://localhost:8000/storage/${imageUrl}`
                    imageElement.setAttribute('src', image);
                    imageElement.width = 150;
                    imageElement.height = 150;
                    // Append the image element to the #local_team container
                    document.getElementById('local_team').appendChild(imageElement);
                }
            })
        }

        let away_team_id = document.getElementById("away_team_id");
        away_team_id.onchange = function (e) {
            $.ajax({
                url: route('teams.json', away_team_id.value),
                type: 'GET',
                success: function (response) {
                    document.getElementById('team_visit').innerHTML = '';
                    console.log(response.name)
                    {{--$('#banner').html(`{{__('Are you sure you want to delete this record?')}}` + ' ' + response.name);--}}
                    let imageUrl = response.logo // Assuming 'logo_url' is the key holding the image URL in the response
                    let imageElement = document.createElement('img');
                    let image = route('images.show', imageUrl);
                    imageElement.setAttribute('src', image);
                    imageElement.width = 150;
                    imageElement.height = 150;
                    // Append the image element to the #local_team container
                    document.getElementById('team_visit').appendChild(imageElement);
                }
            })
        }
        $(document).ready(function () {
            $('#match_date').change(function () {
                let date = $(this).val();
                $.ajax({
                    'url': route('schedules.show', date),
                    'type': 'GET',
                    'success': function (response) {
                        let container = document.querySelector('#start');
                        let date = document.querySelector('#date');
                        date.innerHTML = '';
                        date.setAttribute('hidden', 'hidden');

                        if (response.length > 0) {
                            let html = document.querySelector('#starting_time').innerHTML = '';
                            container.removeAttribute('hidden');

                            response.forEach(function (item) {
                                html += '<label class="btn bg-primary-subtle text-primary">';
                                html += '<div class="form-check">'
                                html += '<input type="checkbox" class="form-check-input" id="checkbox_' + item.id + '" name="match_time" value="' + item.starting_time + '">'
                                html += '<label class="form-check-label" for="checkbox_' + item.id + '">'
                                html += '<span class="d-block d-md-none">' + item.starting_time + '</span>'
                                html += '<span class="d-none d-md-block">' + item.starting_time + '</span>'
                                html += '</label>'
                                html += '</div>'
                                html += '</label>'
                            });
                            html += '</div>'
                            $('#starting_time').html(html);
                        } else if (response.error) {
                            container.setAttribute('hidden', 'hidden');
                            date.removeAttribute('hidden');
                            $('#date').html('<div class="text-danger">' + response.error + '</div>');
                        }
                    }
                })
            });
        });
    </script>
@endsection
