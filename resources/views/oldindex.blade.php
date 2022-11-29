<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <title>Papasmoke</title>
</head>
<body>
    @isset($banner)
        <div id="banner">
            <banner-head />
        </div>
    @endisset
    <section class="md:px-20">
        <div class="w-full mt-5 flex flex-nowrape items-center justify-between">
        <div class=" flex flex-nowrap items-center gap-x-4 text-sm my-5">
            <a class="w-40" href="{{route('index')}}">
                <img src="{{ asset('logo.svg') }}" alt="">
            </a>
                <p class="border-l pl-4 text-gray-400 lowercase font-extralight	">Магазин курительных смесей в Томске</p>
        </div>
            <div id="cartLenght">
                <div class="md:block hidden">
                <a href="{{route('cart')}}">Корзина <cart-lenght /></a> 
                </div>
                <div class="md:hidden fixed inset-x-0 bottom-0 py-5 flex items-center justify-center bg-white border border-black">
                <a href="{{route('cart')}}">Корзина <cart-lenght /></a> 
                </div>
            </div>

        </div>    
            <div class="w-full my-4">
                
                <div class="flex flex-nowrap items-center gap-x-1 font-light">
                    <div id="headCity" class="flex flex-wrap">
                        <head-city />
                    </div>

                </div>


            </div>
        <div class="w-full min-h-screen">
            <!-- SLIDER -->
            @if ($slider->isNotEmpty())
            <div id="slider" class="w-full h-80 my-5">
                    <banner-slider :slider="{{$slider}}" />
                </div>   
            @endif
            <!-- END SLIDER -->
            
            <section id="product" >
            <!-- Карточка товара -->
                @foreach($categories as $category)
                    @if ($category->products->isEmpty())
                        @continue
                    @endif
                    <div class="border border-black rounded  mb-10 p-4">
                        <div class="flex justify-center items-center">
                            <h5 class="text-xl font-extrabold uppercase text-gray-700 mb-5">{{$category->name}}</h5>
                        </div>
                            <div class="flex flex-wrap gap-10 justify-center ">
                            @foreach($category->products as $product)
                                <div class="md:w-1/5">
                                    <a class="flex-none" href="{{route('productShow', ['slug' => $product->slug])}}">
                                            <div class="h-48">
                                                    <img class="object-cover object-center w-full h-full block rounded-lg" src="{{$product->photo->path}}" alt="">
                                            </div>
                                            <div class="h-28 space-y-3 pt-2">
                                                <p> {{$product->price}} руб.</p>
                                                <div class="flex flex-wrap gap-x-2 text-sm">
                                                </div>
                                                <h3 class=" font-black ">
                                                {{ mb_strimwidth($product->name, 0, 30, "...")}}
                                                </h3>
                                            </div>
                                    </a>
                                    <div class="w-full h-14">
                                        <button-addtocart :product="{{$product}}" />
                                    </div>
                                </div>
                            @endforeach
                            </div>
                    </div>
                    @endforeach
            <!-- /Карточка товара -->
            </section>
        </div>
    </section>
    


    <!-- Футер -->
        <footer class="w-full py-5 bg-gray-300 text-gray-600 text-sm font-bold">
            <div class="px-20">
                <p>
                    Данный сайт предназначен для лиц старше 18 лет papasmoke.ru | 2022
                </p>
            </div>
        </footer>
    <!-- /Футер -->
    <div class="modal">
        <profile-city />
    </div>
    <script src="{{ mix('js/app.js') }}"></script>
</body>
</html>
