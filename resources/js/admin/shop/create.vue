<template>
       <div class="space-y-3 w-full font-medium uppercase tracking-wide text-gray-500 text-xs overflow-y-auto h-72">
           <div class="space-y-1 w-full">
               <p :class="{'text-red-400': shop.name.error}">Имя</p>
               <input class="w-1/2 bg-gray-700 py-1 pl-3 rounded-lg" v-model="shop.name.value">
           </div>
           <div class="space-y-1 w-full">
               <p :class="{'text-red-400': shop.country.error}" class="">Страна</p>
               <input class="w-1/2 bg-gray-700 py-1 pl-3 rounded-lg" v-model="shop.country.value">
           </div>
           <div class="space-y-1 w-full">
               <p :class="{'text-red-400': shop.city.error}" class="">Город</p>
               <input class="w-1/2 bg-gray-700 py-1 pl-3 rounded-lg" v-model="shop.city.value">
           </div>
           <div class="space-y-1 w-full">
               <p :class="{'text-red-400': shop.street.error}" class="">Улица</p>
               <input class="w-1/2 bg-gray-700 py-1 pl-3 rounded-lg" v-model="shop.street.value">
           </div>
           <div class="space-y-1 w-full">
               <p :class="{'text-red-400': shop.houseNumber.error}" class="">Дом / Строение / ...</p>
               <input class="w-1/2 bg-gray-700 py-1 pl-3 rounded-lg" v-model="shop.houseNumber.value">
           </div>
           <div class="space-y-1 w-full">
               <p :class="{'text-red-400': shop.telephone.error}" class="">Телефон для связи с магазином</p>
               <input class="w-1/2 bg-gray-700 py-1 pl-3 rounded-lg" v-model="shop.telephone.value">
           </div>
           <button @click="saveShop()" class="bg-sky-800/50 py-1 px-4 rounded">Создать магазин</button>
       </div>
</template>

<script>
import {mapActions} from "vuex";

export default {
    data(){
        return {
            shop: {
                name: {
                    value: null,
                    error: false,

                },
                country: {
                    value: null,
                    error: false,

                },
                city: {
                    value: null,
                    error: false,

                },
                street: {
                    value: null,
                    error: false,

                },
                houseNumber: {
                    value: null,
                    error: false,

                },
                telephone: {
                    value: null,
                    error: false,

                },
            }
        }
    },
    methods:{
        ...mapActions([
            'shopCreate'
        ]),
        validation(){
            if (this.shop.name.value === null || this.shop.name.value === '') {
                this.shop.name.error = true
            } else {
                this.shop.name.error = false
            }

            if (this.shop.country.value === null || this.shop.country.value === '') {
                this.shop.country.error = true
            } else {
                this.shop.country.error = false
            }

            if (this.shop.city.value === null || this.shop.city.value === '') {
                this.shop.city.error = true
            } else {
                this.shop.city.error = false
            }

            if (this.shop.street.value === null || this.shop.street.value === '') {
                this.shop.street.error = true
            } else {
                this.shop.street.error = false
            }

            if (this.shop.houseNumber.value === null || this.shop.houseNumber.value === '') {
                this.shop.houseNumber.error = true
            } else {
                this.shop.houseNumber.error = false
            }

            if (this.shop.telephone.value === null || this.shop.telephone.value === '') {
                this.shop.telephone.error = true
            } else {
                this.shop.telephone.error = false
            }

            if(this.shop.name.value && this.shop.city.value && this.shop.street.value && this.shop.country.value && this.shop.houseNumber.value && this.shop.telephone.value) {
                console.log('work true')
                return true
            } else {
                console.log('work false')
                return false
            }
        },
        saveShop(){
            let validation = this.validation()
            if(validation){this.shopCreate(this.shop)}
        },
    }
}
</script>
