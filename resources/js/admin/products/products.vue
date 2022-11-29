<template>
    <div v-if="!productsLenght" class="w-full h-screen flex items-center justify-center my-10 bg-gray-50 rounded">
        <p>Товары не загружены</p>
    </div>
    <table v-else class="mt-5 text-sm w-full min-w-max table-auto">
        <thead>
        <tr class="bg-black text-white">
            <th scope="col" class="text-center"><input class="h-3 w-3 mx-1" type="checkbox"></th>
            <th scope="col" class="text-center">ID</th>
            <th scope="col" class="text-left">Город</th>
            <th scope="col" class="text-left">Имя</th>
            <th scope="col" class="text-left pr-10">Категория</th>
            <th scope="col" class="text-left">Код</th>
            <th scope="col" class="text-left pr-2">Количество</th>
            <th scope="col" class="text-left">Цена</th>
            <div class="h-10"></div>
        </tr>
        </thead>
        <tbody>
            <row class="my-10"
                v-for="(product, index) in products" :key="product.id"
                @click="edit(product.id)"
                :index="index"
                :city="product.city"
                :categories="product.category"
                :id="product.id"
                :name="product.name"
                :code="product.code"
                :quantity="product.quantity"
                :price="product.price"
            />
       
        </tbody>
    </table>

<editProduct @close="editProduct = false" v-if="editProduct" />
<notification v-if="notification" />
</template>
<script>
import { mapActions, mapGetters } from 'vuex';
import row from "./components/row.vue";
import editProduct from "./components/editProduct.vue";

import notification from "../notification/seccsas.vue";


export default {
    components:{
        row,
        editProduct,
        notification
    },
    data(){
        return {
            editProduct: false,
        }
    },
    methods: {
        ...mapActions([
            'adminAddSelectProductId',
        ]),
        edit(id){
            this.adminAddSelectProductId(id)
            this.editProduct = true
        }
    },

    mounted() {
        this.adminGetProducts
        this.adminGetCategories
    },
    computed:{
        ...mapActions([
            'adminGetProducts',
            'adminGetCategories'
        ]),
        ...mapGetters([
            'adminProducts',
            'adminNotification',
            'adminProductsLenght'
        ]),
        products(){
            return this.adminProducts
        },
        notification(){
            return this.adminNotification
        },
        productsLenght(){
            return this.adminProductsLenght
        }
    }
}
</script>
