<template>
    <div class="px-20 cursor-default z-20">
    <div class="table border-spacing-y-2 text-sm w-full text-gray-500">
        <div class="table-header-group">
            <div class="table-row font-semibold text-white">
                <div class="table-cell text-left">Номер заказа</div>
                <div class="table-cell text-left">Статус заказа</div>
                <div class="table-cell text-left">Магазин куда придет клиент</div>
                <div class="table-cell text-left">Имя клиента</div>
                <div class="table-cell text-left">Телефон клиента</div>
            </div>
        </div>
        <div @click="orderDetails({action: 'details', id: order.id})" v-for="(order, index) in orderList" :key="order.id" :class="{'bg-black/30': index % 2}" class="table-row-group space-y-10 text-white">
            <div class="table-cell text-left">{{ order.client_order_id }}</div>
            <div class="table-cell text-left">{{ order.status }}</div>
            <div class="table-cell text-left">{{ order.country + ', ' + order.city + ', ' + order.street + ', ' + order.house_number }}</div>
            <div class="table-cell text-left">{{ order.name }}</div>
            <div class="table-cell text-left">{{ order.contact }}</div>
        </div>

    </div>
    </div>
</template>
<script>
import {mapActions, mapGetters} from "vuex";
export default {

    methods: {
    ...mapActions([
        'managerOrdersMenu',
        '',
        'orders'
    ]),

    },
    mounted(){
        this.orders()
    },
    computed:{
        ...mapGetters([
            'menuOrdersStatus',
            'orderList'
        ]),
    }
}
</script>
