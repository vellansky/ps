<template>
    {{product.quantity }}
    <div class="flex flex-nowrape gap-x-4 select-none">
        <button v-if="!cartProductQuantity(product.product_id)" @click="addToCart()" :class="{'cursor-default bg-gray-300 text-white': product.quantity <= 0, 'bg-emerald-400': product.quantity > 0}" class="w-full py-2 rounded-md px-5 text-white text-sm">
            <p class="font-semibold">{{ textButton() }}</p>
        </button>
        <div v-else class="w-full py-2 flex flex-nowrap justify-between items-center border rounded-md">
            <button @click="addToCart({action:'minus', product: product})" class="px-5 h-full rounded-full">-</button>
            <p>{{ cartProductQuantity(product.product_id) }}</p>
            <button @click="addToCart({action:'', product: product})" class="px-5 h-full rounded-full">+</button>
        </div>
    </div>
</template>

<script>
import { assertExpressionStatement } from "@babel/types";
import {mapActions, mapGetters} from "vuex";

export default {
    name: "ButtonBuy",
    props:['product'],
    methods:{
        ...mapActions([
            //'addToCart'
        ]),
        addToCart(){
            axios.post('/add/cart', this.product)
        },
        textButton(){
            if(this.product.quantity <= 0) {
                return 'Нет в наличии'
            } else {
                return 'В корзину'
            }
        }
    },
    created(){
        this.product.quantity = this.product.quantity - this.cartProductQuantity(this.product.product_id)
    },

    computed:{
        ...mapGetters([
            'cartProductQuantity'
        ]),
        
    },
}
</script>
