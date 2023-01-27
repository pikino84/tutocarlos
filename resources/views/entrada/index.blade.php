<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Entradas</title>
</head>
<body>
    <h2>Entradas</h2>
    @foreach ($entradas as $entrada )
        <p>{{ $entrada->titulo }}</p>
    @endforeach
</body>
</html>