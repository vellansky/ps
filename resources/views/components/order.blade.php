
    <section class="flex w-full justify-center">
        <div>
            <div>
                <div class="flex flex-nowrap gap-x-3">
                    <p>Номер вашего заказа <span class="italic font-semibold ">{{$order->client_order_id}}</span></p>
                </div>
                <p>Статус заказа: {{$order->status_name}}</p>
                <div class="my-4">
                    <p>Адрес магазина в котором вас ждет заказ: г. <span class="font-semibold">{{$order->city}} ул. {{$order->street}} д. {{$order->house_number}}</span> </p>
                    <p>Телефон для связи с магазином: <a class="text-blue-600" href="tel:{{ $order->telephone }}">{{ $order->telephone }} </a></p>
                </div>
                <div>
                    <a target="_blank" class="block px-3 py-4 border rounded-md bg-green-100  hover:bg-green-200" href="https://telegram.me/share/url?url={{ url('order', $urlOrder) }}">Сохранить в телеграм чтобы не потерять</a>
                </div>
            </div>
            <div class="space-y-5">
                <h5 class="font-semibold">Ваш заказ</h5>
                @foreach ($order->products as $product )
                <div class="border rounded-md  p-5 bg-white ">
                    <p>Товар: {{$product->name}}</p>{{$product->id}}
                    <p>Стоимость:

                        @if( empty($product->new_price) )
                            {{$product->price}}

                        @else
                            {{$product->new_price}}

                        @endif
                        ₽
                    </p>
                    <p>
                        @if ($product->status === 3 )
                            <p class="text-sm text-red-400">К сожалению, на момент бронирования товара в магазине не было. Но как только он появится, мы вам сообщим.</p>
                        @elseif ($product->status === 4)
                            <p class="text-sm text-red-400">Этот товар сейчас в ограниченом количестве, мы забронировали его для вас</p>
                            <p>Количество: {{$product->quantity}}</p>
                        @else
                            <p>Количество: {{$product->quantity}}</p>
                        @endif
                    </p>
                </div>
                @endforeach
            </div>
        </div>
    </section>
