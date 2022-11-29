<section>

    <template x-data x-if="$store.order.window">
        <div class="fixed flex items-center justify-center inset-0 z-50 bg-white/50">
            <div class="relative w-2/3 h-2/3 flex flex-nowrap bg-gradient-to-bl from-rose-400 via-yellow-400 to-white rounded-md border">
                    <button x-data @click="$store.order.window = false" class="absolute top-5 right-10 px-2 py-1 bg-white rounded-full">Х</button>
                    <div x-data  class="w-full h-full flex flex-col items-center justify-center gap-y-5 px-10">
                            <p :class="{'text-3xl font-bold text-white': $store.order.shop.status}">Где заберете заказ?</p>
                            <div class="relative w-full text-center space-y-4">
                                @foreach ($shopList as $shop)
                                    <p @click="$store.order.shop.yes = {{$shop->id}} " :class="{' bg-white': $store.order.shop.yes === {{$shop->id}} }" class="w-full border-2 border-white py-5 rounded-md cursor-pointer">г. {{$shop->city}}, ул. {{$shop->street}}, д.{{$shop->house_number}}, </p>
                                @endforeach
                            </div>
                            <p>Оплата при получении</p>
                    </div>

                    <div x-data class="w-full h-full flex flex-col items-center justify-center gap-y-5 ">
                        <template x-if="$store.order.status">
                            <div class="space-y-5">
                                <div>
                                    <h5 class="font-semibold italic">Спасибо за заявку</h5>
                                    <p>Мы ждем вас в магазине</p>
                                    <p x-text="$store.order.shop"></p>
                                </div>
                                <div class="space-y-5">
                                    <p>Покажите номер продавцу</p>
                                    <div class="space-y-5">
                                        <div class="flex flex-nowrap gap-x-2">
                                            <p class="font-semibold italic">Номер:</p>
                                            <span class="text-lg italic" x-text="$store.order.id"></span>
                                        </div>
                                        <div class="space-y-4">
                                                <a target="_blank" class="block px-3 py-4 border rounded-md bg-white  hover:bg-gray-50" :href="'{{ url('order') }}' +'/' + $store.order.url">Перейти на страницу заказа</a>
                                                <a target="_blank" class="block px-3 py-4 border rounded-md bg-green-100  hover:bg-green-200" :href="'https://telegram.me/share/url?url={{ url('order') }}' +'/' + $store.order.url">Отправить номер заказа в телеграм</a>
                                        </div>
                                    </div>
                                    </div>
                                    <div>
                                        <p>Телефон для связи</p>
                                        <p x-text="$store.order.tel"></p>
                                    </div>
                                </div>
                            </div>
                        </template>

                        <template x-if="!$store.order.status">
                            <div class="space-y-5">

                                <h5 class="font-semibold italic">Заполните форму</h5>

                                <div>
                                    <p >Как вас зовут?</p>
                                    <input x-model="$store.order.name.input" type="text" :class="{'border border-red-400': $store.order.name.status }" class="rounded-md placeholder:italic placeholder:text-gray-200" type="text" placeholder="Владислав">
                                </div>
                                <div>
                                    <p>Ваш номер телефона?</p>
                                    <input x-model="$store.order.tel.input" type="tel" :class="{'border border-red-400': $store.order.tel.status }" class="rounded-md placeholder:italic placeholder:text-gray-200" type="text" placeholder="8913777777">
                                </div>
                                <button @click="$store.order.check()" class="rounded-md bg-white px-5 py-2">Оформить</button>
                            </div>
                        </template>
                    </div>
            </div>
        </div>
    </template>



     <div class="space-x-2 h-full pt-10 pb-5">
         <h2 class="text-2xl font-medium tracking-wide cursor-default">Корзина</h2>
    </div>
        <template x-data x-if="$store.cart.cart.length <= 0">
            <div class="w-full flex flex-col items-center justify-center rounded-md bg-white py-10 italic">
                <p>Я бы хотел дать тебе всё, чего ты хочешь. Правда. Но ничего нет.</p>
                <p>Но, я вижу, ты пришел сюда не зря, так вернись в наш католог и выбери что тебе нужно.</p>
                <p class="font-bold">Дж. Стэтхэм</p>
            </div>
        </template>
        <template x-data x-if="$store.cart.cart.length > 0">
                <div class="flex flex-nowrap gap-x-5">
                    <div class="w-full">
                        <div class="px-10 border rounded-md py-2 w-full mb-3">
                            <p @click="$store.cart.clearCart()" class="cursor-pointer max-w-max text-xs">Очистить корзину</p>
                        </div>
                        <div class="bg-white rounded-md p-10 space-y-4">
                            <template x-data x-for="(item, index) in $store.cart.cart">
                                <div :class="{'bg-yellow-50': $store.cart.quantity( item.product_id) < 1 }" class="p-3 rounded-md">
                                    <div class="flex flex-nowrap gap-4 w-full">

                                        <div class="flex-none h-24 w-24">
                                            <img class="object-cover object-center w-full h-full block rounded-md" :src="item.image_url">
                                        </div>


                                        <div class="flex-none space-y-2 text-left w-2/3">
                                            <p class="text-sm" x-text="item.name"></p>
                                            <template x-if="item.status != 1">
                                                <p class="text-xs text-red-500 select-none cursor-default" x-text="item.status_name"></p>
                                            </template>
                                            <div class="w-full space-x-5 text-blue-500 text-sm select-none cursor-pointer">
                                                <span>В избранное</span>
                                                <span @click="$store.cart.removeFromCart(index)">Удалить</span>
                                            </div>
                                        </div>

                                        <template x-if="$store.cart.quantity( item.product_id ) > 0">
                                            <div class="flex-none ">
                                                <div class="w-full text-center">
                                                    <p class="font-semibold tracking-wide" x-text="$store.cart.detailPrice( item.product_id )"></p>
                                                </div>
                                                <div :class="{'hidden': item.status != 1}" class="w-full h-10 flex flex-nowrap justify-between items-center border rounded-md select-none">
                                                    <button @click="$store.cart.editQuantity( item.product_id, 'minus', 'cart' )" class="px-5 h-full rounded-full">-</button>
                                                    <p class="text-sm" x-text="$store.cart.quantity(item.product_id)"></p>
                                                    <button @click="$store.cart.editQuantity( item.product_id, 'plus' )" class="px-5 h-full rounded-full">+</button>
                                                </div>
                                            </div>
                                        </template>



                                    </div>

                                </div>
                            </template>
                        </div>
                    </div>
                    <div x-data class="relative w-2/3 px-10">
                        <div class="fixed w-1/3 space-y-2 ">
                            <button @click="$store.order.window = true" class="w-full px-10 py-3 bg-yellow-400 rounded-md">Перейти к оформлению</button>
                            <div class="bg-white w-full flex flex-nowrap gap-x-5 p-5 rounded-2xl">
                                <h3 class="text-lg">Итого:</h3>
                                <span class="text-xl" x-text="$store.cart.sum"></span>
                            </div>
                        </div>
                </div>
        </template>

</section>
