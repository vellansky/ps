<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <title>Papasmoke - Войти</title>
</head>
<body>
    <div id="login" class="flex flex-col items-center justify-center w-screen h-screen">
        <admin-login />
    </div>
    <script src="{{ mix('js/app.js') }}"></script>
</body>
</html>
