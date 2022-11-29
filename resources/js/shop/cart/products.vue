<template>
    <div >
        <div v-if="!cartLenght" class="w-full flex flex-col items-center my-10">
            <p>Кажется, она пустая</p>
            <a class="px-2 py-1 bg-black rounded text-white " href="/">Перейдем к товарам?</a>
        </div>
        <div v-for="product in cartProduct" :key="product.id" class=" mb-5">
            <div class="border border-black rounded py-5 ">
                <div class="flex flex-nowrap gap-x-5 md:items-center justify-around px-5 text-xs">
                    <div>
                        <p>{{product.name}}</p>
                        <p class="md:text-sm py-3">Количество: {{product.quantity}} шт.</p>
                        <button @click="remove(product.id)" class="text-xs text-blue-400">убрать из корзины</button>
                    </div>
                    <div>
                        <p>Цена за единицу: {{product.price}} руб.</p> 
                    </div>
                    <div>
                        <p>Сумма: {{summa(product.price, product.quantity)}} руб.</p>
                    </div>
                </div>
            
            </div>

        </div>
    </div>
</template>
<script>
import { mapActions,mapGetters} from 'vuex';
export default {
    methods:{
        ...mapActions([
            'cartRemoveProduct'
        ]),
        remove(id){
            this.cartRemoveProduct(id)
        },
        summa(price,quantity){
            const summa = price*quantity
            return summa
        }
    },
    computed:{
        ...mapGetters([
            'cartGetProducts',
            'cartGetLenght'
        ]),
        cartProduct(){
            return this.cartGetProducts
        },
        cartLenght(){
            return this.cartGetLenght
        }

    }
}
</script>
