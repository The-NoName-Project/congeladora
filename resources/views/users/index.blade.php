@extends('layouts.app')
@section('title')
    {{ __('Users') }}
@endsection

@section('content')
    <div class="row" style="margin-top: 4rem !important;">
        <div class="col-md-12 grid-margin">
            @if(session('status'))
                <div class="alert alert-success alert-dismissible text-dark mb-4" role="alert">
                <span class="text-sm"> <a href="javascript:" class="alert-link text-dark">Excelente</a>.
                    {{ session('status') }}.</span>
                    <button type="button" class="btn btn-close text-lg py-3 opacity-10" data-bs-dismiss="alert"
                            aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            @if(session('warning'))
                <div class="alert alert-danger alert-dismissible text-dark mb-4" role="alert">
                <span class="text-sm"> <a href="javascript:" class="alert-link text-dark">Error</a>.
                    {{ session('warning') }}.</span>
                    <button type="button" class="btn-close text-lg py-3 opacity-10" data-bs-dismiss="alert"
                            aria-label="Close">
                    </button>
                </div>
            @endif
            <div class="card">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                    <div class="bg-gradient-primary shadow-primary rounded pt-4 pb-3">
                        <h3 class="text-capitalize ps-3 font-weight-medium ml-lg-4">
                            {{ __('List of Players') }}
                        </h3>
                        <div class="d-flex justify-content-end align-items-end mr-lg-5">
{{--                            <a href="{{route('users.create')}}"--}}
{{--                               class="btn btn-outline-light btn-rounded mt-3 mt-md-0 btn-icon-text"--}}
{{--                               title="{{ __('Add a new User') }}">--}}
{{--                                <i class="ti ti-plus btn-icon-prepend"></i>--}}
{{--                            </a>--}}
                            <a href="{{ route('export.credentials') }}"
                               class="btn btn-outline-indigo btn-rounded mt-3 mt-md-0 btn-icon-text"
                               title="{{ __('Export Users') }}">
                                <i class="ti ti-save-alt btn-icon-prepend"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body mt-auto">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>{{ __('Picture') }}</th>
                                <th>{{ __('Name') }}</th>
                                <th>{{ __('Email') }}</th>
                                <th>{{ __('Team') }}</th>
                                <th>{{ __('Actions') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($players as $player)
                                <tr>
                                    <td class="align-content-center">
                                        <h4 class="font-weight-medium">{{ $loop->index + $players->firstItem() }}</h4>
                                    </td>
                                    <td class="d-flex align-items-center">
                                        <img src="{{ asset($player->user->picture !== null ?
                                                    'storage/' . $player->user->picture :
                                                    'assets/images/default.png') }}"
                                             alt="{{ $player->user->name }}"
                                             style="width: 4rem !important; margin-right: 1rem !important; margin-bottom: 1.4rem;">
                                    </td>
                                    <td>
                                        <h4 class="font-weight-medium">{{ $player->user->name }}</h4>
                                    </td>
                                    <td>{{ $player->user->email }}</td>
                                    <td class="d-flex align-items-center">
                                        <img src="{{ asset('storage/'.$player->team->logo)}}" alt="{{$player->team->name}}"
                                             class="rounded"
                                             style="width: 3rem !important; margin-right: 1rem !important; margin-bottom: 1.4rem;">
                                        <span class="font-weight-medium text-center">{{ $player->team->name }}</span>
                                    </td>
                                    <td>
                                        <a href="{{ route('users.show', Vinkla\Hashids\Facades\Hashids::encode($player->user->id)) }}"
                                           class="btn btn-outline-success">
                                            <i class="ti ti-eye btn-icon-prepend"></i>
                                        </a>
                                        @if(Auth::user()->rol_id === 1)
                                            {{--                                            <a href="{{ route('teams.edit', Vinkla\Hashids\Facades\Hashids::encode($player->user->id)) }}"--}}
                                            {{--                                               class="btn btn-outline-warning">--}}
                                            {{--                                                <i class="ti ti-edit btn-icon-prepend"></i>--}}
                                            {{--                                            </a>--}}
                                            <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                                    data-bs-target="#deleteTeam"
                                                    onclick="deleteTeam({{$player->user->id}})">
                                                <i class="ti ti-trash-x btn-icon-prepend"></i>
                                            </button>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer mt-auto">
                    {{ $players->links() }}
                </div>
                <div class="modal fade" id="deleteUser" tabindex="-1"
                     aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">{{ __('Delete Team') }}</h5>
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
                                                            type="submit">{{ __('Delete Team') }}</button>
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
        </div>
        <script type="application/javascript">
            // hace una peticion ajax para obtener la informacion de la moto
            function deleteUser(id) {
                let form = document.getElementById('deleteForm')
                form.action = route('users.delete', id)
                $.ajax({
                    url: route('users.json', id),
                    type: 'GET',
                    success: function (response) {
                        // console.log(response.name)
                        $('#banner').html(`{{__('Are you sure you want to delete this record?')}}` + ' ' + response.name);
                    }
                })
            }
        </script>
    </div>
@endsection
