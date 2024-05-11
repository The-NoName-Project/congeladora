<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Equipo {{ $team->name }}</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"
          integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <style>
        .col-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 1rem;
            width: 50%;
        }
    </style>

</head>
<body>
<div class="row">
    <div class="col-12">
        <div class="row">
            <div class="col-12">
                <img src="{{ asset('storage/'.$team->logo)}}" alt="{{$team->name}}" class="img-fluid" />
                <h1
                    style="font-size: 2rem; font-weight: bold; text-align: center; margin-top: 1rem; margin-bottom: 1rem;">
                    {{ __('Team') }}: {{$team->name}}</h1>
                <h3
                    style="font-size: 1.5rem; font-weight: normal; text-align: center; margin-top: 1rem; margin-bottom: 1rem;">
                    Capitan: {{ $team->capitan->name }}</h3>
            </div>
            <div class="col-grid">
                    <h3
                        style="font-size: 1.5rem; font-weight: bold; text-align: center; margin-top: 1rem; margin-bottom: 1rem;">
                        {{ __('Players') }}</h3>
                @foreach($team->codes as $code)
                    <div class="card" style="width: 18rem;">
                        <div class="card-body">
                            <p>{{ $code->code }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
</body>
</html>
