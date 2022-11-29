<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <title>Papasmoke - админка</title>
</head>
<body>
    <div class="w-full justify-between px-20 flex flex-nowrap py-2 bg-gray-100 text-sm">
        <a href="{{route('index')}}">В магазин</a>
        <div id="logout"><admin-logout /></div>

    </div>
    <section class="px-20">

        <div class=" flex flex-nowrap items-center gap-x-4 text-sm my-5">
                <img class="w-40" src="{{ asset('logo.svg') }}" alt="">
                <p class="border-l pl-4 text-gray-400 lowercase font-extralight	">Админка</p>
                <p class="border-l pl-4 text-gray-400 lowercase font-extralight	">Управление категориями</p>
            </div>
        <div class="py-1 flex flex-nowrap gap-x-3 font-semibold text-sm uppercase text-gray-300 my-4">
            <a class="hover:text-black" href="{{route('AdminProducts')}}">Товары</a>
            <a class="hover:text-black" href="{{route('AdminСategories')}}">Категории</a>
            <a class="hover:text-black" href="{{route('AdminOrders')}}">Заказы</a>
            <a class="hover:text-black" href="{{route('AdminSettings')}}">Настройки</a>
        </div>
        <div id="adminCategories">
            <admin-categories />
        </div>
            
    </section>
    <script src="{{ mix('js/app.js') }}"></script>
</body>
</html>
