<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <title>Papasmoke - Vape Shop в Томске</title>
</head>
<body class="bg-gray-100 px-2 md:px-10 font-light">
<section class="w-full min-h-screen">
    <header class="w-full my-5">
        <div class="flex flex-nowrap justify-between items-center">
            <div class="w-44">
                <a href="{{ route('index', ['city' => $city->path]) }}">
                    <img class="object-contain" src="{{ asset('logo.svg') }}">
                </a>
            </div>

            <div class="flex items-center space-x-2 h-10 w-2/3">
                <div x-data="{open: false}" class="flex flex-col h-full ">
                    <button x-data @click.away="open = false" @click="open = !open" class="px-4 py-1  bg-yellow-400 font-medium rounded-md">Каталог</button>

                    <template x-if="open">
                        <div class="relative">
                            <div class="absolute mt-2 bg-white rounded-md p-5 min-w-max z-50">
                                @foreach ($catalog as $catalog)
                                    <div class="hover:bg-gray-50 px-2 py-2 select-none">
                                        <a href="
                                        @if(empty($catalog->slug))
                                            {{ route('index', ['city' => $city->path]) }}
                                         @else
                                            {{ route('category', ['city' => $city->path, 'category' => $catalog->slug]) }}
                                        @endif
                                        " class="cursor-pointer">{{$catalog->name}}</a>
                                    </div>
                                @endforeach
                        </div>
                    </template>
                </div>


                <div x-data="$itemSearch()" class="flex h-full flex-col w-full">
                    <input
                        type="text"
                        x-model="search"
                        class="w-full border rounded h-full pl-5"
                        placeholder="Найди на Papa Smoke">
                    <p x-text="getItemsSearch(search)"></p>
                    <div class="relative">
                        <template x-if="status">
                        <div class="absolute bg-white rounded-b-md p-5 w-full z-50" >
                            <template x-for="item in items">
                                <div class="flex flex-nowrap items-center gap-x-5">
                                    <div class="w-10">
                                        <img class="object-contain" src="{{ asset('logo.svg') }}">
                                    </div>
                                    <p class="py-2 cursor-pointer tracking-wider text-sm" x-text="item.name"></p>
                                </div>
                            </template>
                        </div>
                        </template>

                    </div>
                </div>
            </div>
            <div class="relative flex flex-nowrap gap-x-2">
                <a href="{{route('cart')}}">
                    <div class="absolute top-0 right-0 text-xs bg-red-500 text-white rounded-full px-1 select-none" x-data>
                        <template x-if="$store.cart.itemLength() >= 1">
                            <span x-text="$store.cart.itemLength()"></span>
                        </template>
                    </div>
                    <p>Корзина</p>
                </a>
            </div>
        </div>
        <div x-data="{list: false}" @click.away="list = false" @click="list = !list" class="w-full pt-5">
            <p class="select-none">{{ $city->name }}</p>
            <template x-if="list">
                <div class="relative">
                    <div class="absolute flex flex-col space-y-5 bg-white rounded-md p-3 pr-10 cursor-pointer">
                        @foreach ($cityList as $s)
                            <a href="{{ route('index', ['city' => $s->path]) }}">{{ $s->name }}</a>
                        @endforeach
                    </div>
                </div>
            </template>
        </div>
    </header>
