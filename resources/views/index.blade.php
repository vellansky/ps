<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <title>papasmoke.ru - {{$seo->title}}</title>
    <meta name="description" content="{{$seo->description}}">
</head>
<body class="max-w-[1440px] bg-gray-50">
    @isset($banner)
        <div id="banner">
            <banner-head />
        </div>
    @endisset
    <section>
    <div class="md:px-20">
        <div class="w-full mt-5 flex flex-nowrape items-center justify-between">
        <div class=" flex flex-nowrap items-center gap-x-4 text-sm my-5">
            <a class="w-40" href="{{route('index')}}">
                <img src="{{ asset('logo.svg') }}" alt="">
            </a>
                <p class="border-l pl-4 text-gray-400 lowercase font-extralight	">{{$seo->title}}</p>
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
                    <div id="headCity" class="flex flex-wrap w-1/4 border border-black rounded-full bg-gray-50 px-2 py-2">
                        <p class="text-xs">Город: </p><head-city />
                    </div>

                </div>


            </div>
        </div>
        @isset($menulink)
        <div class="px-20 space-x-8 my-5">
            @foreach($menulink as $link)
                <a href="{{$link->url}}" class="bg-gray-200 rounded-xl border border-gray-300 max-w-max px-8 py-3 font-light text-sm tracking-wider">
                    {{$link->name}}    
                </a>
            @endforeach
        </div>
        @endisset
        <div class="w-full min-h-screen">
            <!-- SLIDER -->
            @if ($slider->isNotEmpty())
            <div id="slider" class="w-full h-80 my-5">
                    <banner-slider :slider="{{$slider}}" />
                </div>   
            @endif
            <!-- END SLIDER -->
            <section id="product"  class="md:px-32 mb-20">
                <!-- Категории -->
                <div class="">
                        <div class="flex flex-wrap items-center justify-center gap-x-16 gap-y-10">
                        @foreach($categories as $category)
                                <a href="{{$category->path}}" class="bg-white p-5 rounded-3xl border border-gray-200">
                                    <div class="w-full h-36">
                                        <img class="object-cover object-center w-full h-full block rounded-lg" 
                                                src="
                                                    @if(empty($category->image->url))
                                                        {{'/img/ifEmty.webp'}}
                                                    @else
                                                        {{$category->image->url}}
                                                    @endif
                                                    "
                                                alt="
                                                    @if(empty($category->image->url))
                                                        {{'У товара еще нет фотографии'}}
                                                    @else
                                                        {{$category->image->name}}
                                                    @endif
                                                    "
                                        >  
                                    </div>
                                    <div class="w-full text-center mt-5">
                                        <p>{{$category->name}}</p>
                                    </div>
                                </a>
                        @endforeach
                        </div>
                </div>
                <!-- END Категории -->
                <!-- Товары со скидкой -->
                @if(!empty($productDiscount))
                <div>
                    <h4 class="py-8 text-gray-800 text-2xl font-extrabold tracking-widest">Товары со скидкой</h4>
                    <div class="flex flex-wrap gap-x-16 gap-y-10">
                    @foreach($productDiscount as $product)
                    <div class="relative w-1/5 rounded-lg">
                        <a href="{{route('productShow', $product->slug)}}" class="w-full hover:text-yellow-400">
                            <div class="relative w-full h-36 bg-gray-700 rounded-lg">
                                @if(!empty($product->price->new_price))
                                    <div class="absolute top-2 right-1 ">
                                        <p class="bg-red-500 text-white rounded-lg p-1 uppercase text-xs font-bold">- {{
                                           $product->price->new_price/$product->price->price*100
                                        }} %</p>
                                    </div>
                                @endif
                                <img class="object-cover object-center w-full h-full block rounded-lg" 
                                    src="
                                        @if(empty($product->photo->url))
                                            {{'/img/ifEmty.webp'}}
                                        @else
                                            {{$product->photo->url}}
                                        @endif
                                        "
                                    alt="
                                        @if(empty($product->photo->url))
                                            {{'У товара еще нет фотографии'}}
                                        @else
                                            {{$product->photo->name}}
                                        @endif
                                        "
                                >
                            </div>
                            <div class="h-20 p-2">
                                <div class="flex flex-nowrap gap-x-5 mb-2 text-black">
                                    @if(empty($product->price->new_price))
                                        <p class="">{{$product->price->price}} руб.</p>
                                        @else
                                        
                                        <div>
                                            <p class="font-black">{{$product->price->new_price}} руб.</p>
                                        </div> 
                                        <div class="relative flex items-center justify-center">
                                            <p class="text-sm text-gray-500">{{$product->price->price}} руб.</p>
                                            <div class="absolute w-12 h-0.5 bg-red-600 -rotate-12"></div>
                                        </div>
                                    @endif
                                </div>
                                <p class="text-sm">{{$product->name}}</p>
                            </div>
                            
                        </a>
                        <div class="w-full h-10">
                            <div class=" inset-x-0 bottom-0 w-full h-full bg-green-300"></div>
                        </div>
                    </div>
                    @endforeach
                    </div>
                </div>
                @endif
                <!-- / Товары со скидкой -->



                <!-- Список товаров -->

                <div class="">
                    <h4 class="py-8 text-gray-800 text-2xl font-extrabold tracking-widest">Товары</h4>
                    <div class="flex flex-wrap gap-x-16 gap-y-10">
                    @foreach($products as $product)
                    <div class="relative w-1/5 rounded-lg">
                        <a href="{{route('productShow', $product->slug)}}" class="w-full hover:text-yellow-400">
                            <div class="relative w-full h-36 bg-gray-700 rounded-lg">
                                @if(!empty($product->price->new_price))
                                    <div class="absolute top-2 right-1 ">
                                        <p class="bg-red-500 text-white rounded-lg p-1 uppercase text-xs font-bold">- {{
                                           $product->price->new_price/$product->price->price*100
                                        }} %</p>
                                    </div>
                                @endif
                                <img class="object-cover object-center w-full h-full block rounded-lg" 
                                    src="
                                        @if(empty($product->photo->url))
                                            {{'/img/ifEmty.webp'}}
                                        @else
                                            {{$product->photo->url}}
                                        @endif
                                        "
                                    alt="
                                        @if(empty($product->photo->url))
                                            {{'У товара еще нет фотографии'}}
                                        @else
                                            {{$product->photo->name}}
                                        @endif
                                        "
                                >
                            </div>
                            <div class="h-20 p-2">
                                <div class="flex flex-nowrap gap-x-5 mb-2 text-black">
                                    @if(empty($product->price->new_price))
                                        <p class="">{{$product->price->price}} руб.</p>
                                        @else
                                        
                                        <div>
                                            <p class="font-black">{{$product->price->new_price}} руб.</p>
                                        </div> 
                                        <div class="relative flex items-center justify-center">
                                            <p class="text-sm text-gray-500">{{$product->price->price}} руб.</p>
                                            <div class="absolute w-12 h-0.5 bg-red-600 -rotate-12"></div>
                                        </div>
                                    @endif
                                </div>
                                <p class="text-sm">{{$product->name}}</p>
                            </div>
                            
                        </a>
                        <div class="w-full h-10">
                            <div class=" inset-x-0 bottom-0 w-full h-full bg-green-300"></div>
                        </div>
                    </div>
                    @endforeach
                    </div>
                </div>
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
