<template>
    <div class="w-screen h-screen pt-5">
        <globalMenu />

        <div class="relative w-full h-full z-30">
            <div class="w-full h-full fixed">
                <orders v-if="orderStatus"/>
                <keep-alive>
                    <product v-if="windowProduct"/>
                </keep-alive>
                <shop v-if="shopsStatus" />
                <items v-if="itemsStatus"/>
                <orderDetailsVue v-if="orderDetailStatus"/>
            </div>
        </div>

    </div>


    <successfully />

</template>

<script>
import {mapGetters} from "vuex";

import globalMenu from './menu/index'
import successfully from './notification/seccsas'
import product from "./items/_id"
import orders from "./orders/index"
import shop from './shop/index';
import items from './items/index';
import orderDetailsVue from "./orders/components/orderDetails.vue";
export default {
    components:{
        orders,
        globalMenu,
        successfully,
        product,
        shop,
        items,
        orderDetailsVue,
    },
    computed:{
        ...mapGetters([
            'menuItemsStatus',
            'menuStatus',
            'orderDetails'
        ]),
        windowProduct(){
            return this.menuItemsStatus.windowDetail
        },
        shopsStatus(){
            return this.menuStatus.shop
        },
        warehouseStatus(){
            return this.menuStatus.warehouse
        },
        itemsStatus(){
            return this.menuStatus.item
        },
        orderStatus(){
            return this.menuStatus.order
        },
        citiesStatus(){
            return this.menuStatus.cities
        },
        fileStatus(){
            return this.menuStatus.file
        },

        orderDetailStatus(){
            return this.orderDetails
        },
    }
}
</script>

