<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <title>Papasmoke - админка</title>
</head>
<body id="app" class="px-20">
    <div>
        <p>LOGO | Админ панель</p> 
    </div>
    <div class="py-1 flex flex-nowrap gap-x-3">
        <a href="{{route('AdminProducts')}}">Товары</a>
        <a href="{{route('AdminСategories')}}">Категории</a>
        <a href="{{route('AdminOrders')}}">Заказы</a>
    </div>
    <div>
        <product-buttuns />
    </div>
    <div>
        <admin-product />
    </div>
    <script src="{{ mix('js/app.js') }}"></script>
</body>
</html>
