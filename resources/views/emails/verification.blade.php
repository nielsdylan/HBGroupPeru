<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>HB GROUP PERU S.R.L.</title>
</head>
<body>
    <p>Señor {{ $data['last_name'] }}, {{ $data['name'] }} </p>

    <p>{{ $data['message_1'] }}</p>
    <p>{{ $data['message_2'] }}</p>
    <p>{{ $data['message_3'] }}</p>

    <a href="{{ url("/autenticacion?code=").$data['rand'] }}" target="_blank"> {{ $data['button'] }}</a>
</body>
</html>
