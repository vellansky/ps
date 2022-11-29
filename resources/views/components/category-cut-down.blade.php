<div>
    @foreach ($category as $category)
        @if(count($category->products) === 0)
            @continue
        @else

                <div class="space-x-2 h-full pt-10 pb-5 ">
                    <div class="w-max py-1 px-3 rounded">
                        <h2 class="text-2xl font-medium tracking-wide cursor-default">{{$category->name}}</h2>
                        @if(count($category->products) > 4)
                        <a href="
                            @if (empty($category->slug_path))
                                {{ route('index', ['city' => $city->path]) }}
                            @else
                                {{ route('category', $category->slug_path) }}
                            @endif
                            "class="text-blue-500 text-xs select-none"
                            target="_blank"
                            >Посмотреть все товары ({{ count($category->products) }})</a>
                        @endif
                    </div>
                </div>


                <div class="grid grid-cols-2 md:flex md:flex-wrap gap-10">
                    @foreach($category->products as $product)
                        <div class="bg-white rounded-xl md:w-1/6 p-2">
                            <a class="flex-none" href="
                            @if(empty($product->slug_path))
                                {{ route('index', $city->path) }}
                            @else
                                {{ route('product', ['city' => $city->path, 'product' => $product->slug_path]) }}
                            @endif
                            "
                            target="_blank"
                            >
                                <div class="relative h-48">
                                    @if($product->new_price)
                                    <div class="absolute top-2 right-5 text-xs bg-yellow-200 px-3 rounded">Скидка {{ floor((($product->price - $product->new_price)/ $product->price) * 100) }}%</div>
                                    @endif
                                    <img class="object-cover object-center w-full h-full block rounded-t-xl z-10" src="{{ $product->image_url }}" alt="">
                                </div>
                                <div class="h-28 space-y-3 pt-2">

                                    @if(empty($product->new_price))
                                        <p> {{$product->price}} руб.</p>
                                    @else
                                        <div class="flex flex-nowrap">
                                            <div>
                                                <p class="font-medium"> {{$product->new_price}} руб.</p>
                                            </div>
                                            <div class="relative flex items-center justify-center ml-5">
                                                <div class="absolute rotate-[-5deg] bg-black h-[1px] w-full"></div>
                                                <p> {{$product->price}} руб.</p>
                                            </div>
                                        </div>
                                    @endif

                                    <div class="flex flex-wrap gap-x-2 text-sm">
                                    </div>
                                    <p class="text-sm">
                                        {{ mb_strimwidth($product->product_name, 0, 30, "...")}}
                                    </p>
                                </div>
                            </a>
                            <div class="h-10">
                                <template x-data x-if="!$store.cart.level_button({{$product->product_id}})">
                                    <button
                                        id="button-{{$product->product_id}}"
                                        @click="$store.cart.pushInCart({{$product}})"
                                        class="w-full py-2 rounded-md bg-yellow-400 font-medium">
                                        Положить в корзину
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
                    @endforeach
                    @if(count($category->products) > 4)
                        <a href="
                           @if (empty($category->slug_path))
                               {{ route('index', $city->path) }}
                           @else
                               {{ route('category', $category->slug_path) }}
                           @endif
                           "
                           class="flex items-center justify-center bg-white border border-yellow-300 rounded-xl md:w-1/6 h-40 md:h-auto text-blue-500 text-xs select-none"
                           target="_blank"
                           >
                                Посмотреть еще {{ count($category->products) }} товаров
                        </a>
                    @endif
                </div>

        @endif
    @endforeach

</div>
