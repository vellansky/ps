<template>
    <div class="absolute inset-y-0 right-0 space-y-5 w-1/3 bg-black/30 overflow-y-auto px-5 cursor-default">
        <div @click="orderCloseDetails()" class="py-5 text-white">
                <p>Закрыть окно</p>
            </div>
        <div class="bg-white rounded-b-md p-5">

            <div>
                <p>Номер заказа: {{orderData.client_order_id}}</p>
                <p>Клиент заберет заказ в магазине: {{orderData.country + ', ' + orderData.city + ', ' + orderData.street + ', ' + orderData.house_number}}</p>
            </div>
            <div>
                <p>Имя клиента: {{orderData.name}}</p>
                <p>{{orderData.contact_name + ': ' + orderData.contact}}</p>
            </div>
        </div>
        <div class="space-y-4">
            <div @click="getListStatus()" class="w-full bg-green-200 rounded-full text-center select-none">
                <p>{{orderData.status}}</p>
            </div>
            <div class="relative w-full">
                <template v-if="listStatus.length > 0">
                    <div class="px-2 absolute rounded-md w-full space-y-4 bg-black/90 p-5">
                        <p class="text-white font-black tracking-widest">Выберите новый статус</p>
                        <p
                        @click="editStatus(status, orderData.id )"
                        v-for="status in listStatus" :key="status.id"
                        class="px-2 rounded-full w-full bg-white "
                        >
                            {{ status.name }}
                        </p>
                    </div>

                </template>
            </div>
            <p class="text-xl text-white font-black">В заказе:</p>
            <div
                v-for="(product, index) in orderData.products" :key="index"
                @click="select = index"
                :class="{'bg-yellow-300': select === index}"
                class="bg-white rounded-md select-none cursor-default p-5"
            >
                <p>Товар: {{product.name}}</p>
                <div>
                    <p>Цена на момент бронирования:</p>
                    <p>Без скидки: {{product.price}}</p>
                    <template v-if="product.new_price != null && product.new_price != 0">
                        <p>Со скидкой: {{product.new_price}}</p>
                        <p>Скидка: {{ Math.floor( ((product.price - product.new_price)/ product.price) * 100 )}} %</p>
                    </template>
                </div>

                <p>Нужное количество: {{product.quantity}}</p>
                <div v-if="product.status_id != 1" class="border rounded-md p-2 italic">
                    <p class="font-medium">Обратите внимание</p>
                    <p v-if="product.status_id === 4">По данным интернет магазина, товар был в ограниченном количестве. Клиент забронировал его максимальное количество. Больше нет.</p>
                    <p v-if="product.status_id === 3">По данным интернет магазина, ваш товар закончился. Клиент забронировал, но увы.</p>
                    <p>Комментарий для клиента:</p>
                    <p>{{product.status}}</p>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import { mapActions, mapGetters } from 'vuex';


export default {
    data(){
        return {
            select: null,
            listStatus: []
        }
    },
    methods:{
        ...mapActions([
            'orderEditStatus',
            'orderCloseDetails'
        ]),
        editStatus(status, id){
            axios.post('/api/post/order/status/edit', {id: id, status: status.id})
            .then(() => {
                this.listStatus = []
                this.orderEditStatus({id: id, status: status.name})
                status.name = status.name
            })
        },
        getListStatus(){
            if(this.listStatus.length === 0) {
                axios.get('/api/get/order/status')
                .then((res)=> {
                    this.listStatus = res.data
                })

            }
            else {
                this.listStatus = []
            }

        }
    },
    computed:{
        ...mapGetters([
            'orderData'
        ]),
    }
}
</script>
