
<section class="cursor-default space-y-5">
    <div class="py-5">
        @if(!empty($product->category_name)) {
            <p class="text-xs text-gray-700">{{ $product->category_name }}</p>
        }
        @endif
        <h1 class="text-3xl font-semibold tracking-wide ">{{$product->product_name}}</h1>
    </div>
    <div class="flex flex-nowrap bg-white rounded-md p-10">
        <div class="w-1/2">

            <div class="">
                <img class="object-cover object-center w-full h-full block rounded-xl" src="{{ $product->image_url }}" alt="">
            </div>

        </div>
        <div class="w-1/2 px-20 self-center justify-self-center">

            <div>
                <div class="relative shadow shadow-black-500/40 rounded-lg p-3 text-center space-y-3 w-full">

                            @if(empty($product->new_price))
                                <div class="font-black text-2xl ">
                                    <span>{{ $product->price }}</span>
                                    <span>₽</span>
                                </div>
                            @else
                            <div class="w-full flex flex-nowrap items-center justify-center space-x-2 ">
                                <div class="font-black text-2xl ">
                                    <span >{{ $product->new_price }}</span>
                                    <span>₽</span>
                                </div>
                                <div class="relative flex items-center justify-center">
                                    <div class="absolute rotate-[-10deg] bg-yellow-300 h-0.5 w-full"></div>
                                    <span>{{ $product->price }}</span>
                                </div>
                                <span>₽</span>
                                </div>
                            @endif
                            <div class="h-10">
                                <template x-data x-if="!$store.cart.level_button({{$product->product_id}})">
                                    <button
                                        id="button-{{$product->product_id}}"
                                        @click="$store.cart.pushInCart({{$product}})"
                                        class="w-full py-2 rounded-md bg-yellow-400 font-medium">
                                        Положить в корзину
                                        @if(!empty($product->new_price))
                                            <p class="text-sm italic">со скидкой {{ floor( (($product->price - $product->new_price)/ $product->price) * 100 ) }}%</p>

                                        @endif
                                    </button>
                                </template>
                                <template x-data x-if="$store.cart.level_button({{$product->product_id}})">
                                    <div class="w-full h-10 flex flex-nowrap justify-between items-center border rounded-md select-none">
                                        <button @click="$store.cart.editQuantity( {{$product->product_id}}, 'minus')" class="px-5 h-full rounded-full">-</button>
                                        <p class="text-sm" x-text="$store.cart.quantity( {{$product->product_id}} )"></p>
                                        <button @click="$store.cart.editQuantity( {{$product->product_id}}, 'plus' )" class="px-5 h-full rounded-full">+</button>
                                    </div>
                                </template>

                            </div>
                </div>
            </div>
        </div>

    </div>
    <div class="bg-white rounded-md py-10 px-5">
        <h2 class="text-2xl font-semibold tracking-wide">Описание</h2>
        @if(empty($product->description))
            <p>Мы готовим описание для {{ $product->product_name }}. Ставьте таймер, скоро вы его увидите </p>
        @else
            <p>{{ $product->description }}</p>
        @endif
    </div>
</section>
