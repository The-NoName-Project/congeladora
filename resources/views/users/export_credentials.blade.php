<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Credenciales</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
        }

        .card-container {
            width: 100%;
            text-align: center;
        }

        .id-card {
            display: inline-block;
            width: 300px;
            height: 400px;
            background: #ffffff;
            border-radius: 20px;
            margin: 10px;
            vertical-align: top;
            position: relative;
            page-break-inside: avoid;
            border: 1px solid #ddd;
            overflow: hidden;
        }

        .top-bar {
            height: 100px;
            background: #f7f7f7;
            position: relative;
        }

        .top-bar::before {
            content: '';
            position: absolute;
            left: -40px;
            top: 70px;
            width: 70%;
            height: 250px;
            background: #B73E3E;
            transform: skew(-15deg);
        }

        .top-bar::after {
            content: '';
            position: absolute;
            right: -40px;
            top: 100px;
            width: 80%;
            height: 300px;
            background: #2d3748;
            transform: skew(-15deg);
        }

        .photo-circle {
            width: 100px;
            height: 100px;
            background: #fff;
            border-radius: 50%;
            overflow: hidden;
            margin: -15px auto 10px;
            z-index: 2;
            position: relative;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            border: 4px solid #fff6ea;
        }

        .photo-circle img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .employee-name {
            font-size: 18px;
            font-weight: bold;
            color: #ffffff;
            margin-top: 10px;
            z-index: 100;
            position: relative;
        }

        .employee-role {
            font-size: 13px;
            color: #d1d5db;
            margin-top: 5px;
            z-index: 2;
            position: relative;
        }

        .employee-id {
            font-size: 13px;
            color: #ffffff;
            margin-top: 10px;
            z-index: 2;
            position: relative;
        }

        .barcode {
            background: #e5e2e2;
            padding: 8px 16px;
            border-radius: 6px;
            font-family: 'Courier New', monospace;
            font-size: 12px;
            display: inline-block;
            margin-top: 20px;
            z-index: 2;
            position: relative;
        }

        .page-break {
            page-break-after: always;
        }

        .content {
            text-align: center;
            padding: 20px 10px;
            background: linear-gradient(to bottom, transparent 60px, #2d3748 60px);
            height: 300px;
            z-index: 4;
        }

        .company-logo {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-top: 2rem !important;
            margin-bottom: 20px;
            position: relative;
            z-index: 10;
        }

        .team-logo {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-top: 1rem !important;
            margin-bottom: 20px;
            position: relative;
            z-index: 10;
        }

        .card-hole-single {
            width: 30px;
            height: 8px;
            border-radius: 4px;
            position: absolute; /* Para poder posicionarlos con top, left/right */
            top: 20px; /* Misma posición superior que antes */
        }

        .left-hole {
            left: 40px;
        }

        .red-color {
            background: #B73E3E;
        }
        .right-hole {
            right: 40px; /* Posiciona el agujero derecho a 40px del borde derecho */
        }

        .middle-slot {
            width: 20px;
            height: 15px;
            background: #2d3748;
            margin: 0 auto;
            border-radius: 0 0 8px 8px;
        }
    </style>
</head>
<body>
<div class="card-container">
    @foreach($players as $index => $player)
        <div class="id-card">
            <div class="top-bar">
                <div class="company-logo left-hole card-hole-single">
                    <img src="{{ asset('logo.png') }}" alt="{{ env('APP_NAME') }}"  width="100" style="border-radius: 50%;">
                </div>
                <div class="team-logo right-hole card-hole-single">
                    <img src="{{ asset($player->team->logo) }}" alt="{{ env('APP_NAME') }}"  width="70" style="border-radius: 50%;">
                </div>
                <div class="card-hole-single left-hole red-color"></div>
                <div class="card-hole-single right-hole red-color"></div>
                <div class="middle-slot"></div>
            </div>
            <div class="photo-circle">
                <img src="{{ asset('assets/images/default.png') }}" alt="Foto">
            </div>
            <div class="content">
                <div class="employee-name">{{ strtoupper($player->user->name) }}</div>
                <div class="employee-role">{{ strtoupper($player->team->name) }}</div>
                <div class="employee-id">Numero: {{ $player->user->number }}</div>
                <div class="barcode">| | || ||| || || | ||</div>
            </div>
        </div>

        @if (($index + 1) % 4 == 0)
            <div class="page-break"></div>
        @endif
    @endforeach
</div>
</body>
</html>
