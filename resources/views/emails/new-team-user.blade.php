@php
    use Carbon\Carbon;
@endphp

@extends('layouts.guest')
@section('title')
    {{ __('New Team Assigned') }}
@endsection
@section('content')
    <div class="card">
        <div class="card-body">
            <h1 class="card-title">{{ __('Day') }}: {{  Carbon::now()->locale(app()->getLocale())->translatedFormat('D, d M Y h:i A') }}</h1>
            <p>{{ __('Hi') }} , se le a asignado un equipo dentro de la plataforma de <a href="{{env('APP_URL')}}" target="_blank">{{env('APP_NAME')}}</a> </p>
            <br>
            <div class="card d-flex align-items-center row" style="background-color: #d5d0d0; margin: 4px">
                <div class="card-body">
                </div>
            </div>
            <br>
            <p>Best regards, Canchas Purificadora</p>
        </div>
    </div>
    <div class="dropdown-divider"></div>
@endsection
