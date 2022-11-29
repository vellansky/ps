<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <title>{{$page->product->name}}</title>
</head>
<body>


<section class="min-h-screen">

    <!-- Хедер -->
    <div class="md:px-32 w-full mt-5 flex flex-nowrape items-center justify-between">
            <a href="{{route('index')}}">
                <img src="{{ asset('logo.svg') }}" alt="">
            </a>


            <div class="md:block hidden">
               <a href="{{route('cart')}}">Корзина <cart-lenght /></a> 
            </div>
            <div class="md:hidden fixed inset-x-0 bottom-0 py-5 flex items-center justify-center bg-white border border-black">
               <a href="{{route('cart')}}">Корзина <cart-lenght /></a> 
            </div>

        </div>    
            <div class="w-full my-4">
                
                <div class="flex flex-nowrap items-center gap-x-1 font-light">
                    <div class="flex flex-wrap">
                      <head-city />
                    </div>

                </div>


            </div>
    <!-- /Хедер -->
    <!-- Продукт -->
    <section class="md:px-32">
    <div class="w-full border-b border-b-gray-500 py-4 mb-8">
      <h3 class=" text-gray-800 text-2xl font-extrabold tracking-widest">{{$page->product->name}}</h3>
      <div class="relative w-full flex items-center">
        <div class="absolute right-0">
          <p class="text-green-500">
          </p>
        </div>
      </div>
    </div>
    
    
    <div class="flex flex-nowrap gap-5 justify-between">
        <div class="flex items-center justify-center w-full">
          <img class="object-cover object-center w-full h-full block rounded-lg" alt="" src="{{$page->product->photo->path}}" />
        </div>
        <div class="flex flex-col w-full text-sm space-y-3">
          @foreach($page->product->attributes as $attributes)
            <div class="flex gap-x-5">
              <p class="w-auto"><span class="text-gray-400 mr-4">{{$attributes->attribute->name}}:</span> {{$attributes->value}}</p>
            </div>
          @endforeach
        </div>
        <div class="flex items-center justify-center w-full">
          <div class="shadow-xl shadow-black/20 border border-gray-100 rounded-lg p-5 space-y-5 h-max md:w-72" >
            <div class="border-b border-b-gray-400 text-center space-y-5">
                
                <div class="flex flex-nowrap items-center justify-center py-5 gap-x-7">
                  @if(empty($page->product->price->new_price))
                    <p class="font-bold">{{$page->product->price->price}} руб.</p>
                    @else
                    <div class="relative flex flex-col items-center justify-center">
                      <p class="text-sm text-gray-500">{{$page->product->price->price}} руб.</p>
                      <div class="absolute w-12 h-0.5 bg-red-600 -rotate-12"></div>
                    </div>
                    <div>
                      <p class="font-bold py-1 px-2 bg-yellow-300 rounded-full">{{$page->product->price->new_price}} руб.</p>
                    </div> 
                  @endif
                </div>
                  
            </div>
            <div id="product" class="flex justify-center h-10">
              <button-addtocart :product="{{$page->product}}" />
            </div>
          </div>
        </div>
    </div>
<div class="my-20 p-10 rounded-xl bg-gray-50">
  <h6 class="font-bold text-xl">Описание</h6>
  <p>{{$page->product->description}}</p>
</div>
</section>
<!-- /Продукт -->
<!-- Футер -->
<footer class="w-full py-5 bg-gray-200 text-gray-400 text-sm">
            <div class="px-32">
                <p>
                    Данный сайт предназначен для лиц старше 18 лет papasmoke.ru | 2022
                </p>
            </div>
        </footer>
    <!-- /Футер -->
  <profile-city />
  <script src="{{ mix('js/app.js') }}"></script>
</body>
</html>
