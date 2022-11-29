<template>
    <div class="space-y-3 w-full font-medium uppercase tracking-wide text-gray-500 text-xs overflow-y-auto h-72">
        <div class="space-y-1 w-full">
            <p :class="{'text-red-400': warehouse.name.error}">Имя</p>
            <input class="w-1/2 bg-gray-700 py-1 pl-3 rounded-lg" v-model="warehouse.name.value">
        </div>
        <div class="space-y-1 w-full">
            <p :class="{'text-red-400': warehouse.country.error}" class="">Страна</p>
            <input class="w-1/2 bg-gray-700 py-1 pl-3 rounded-lg" v-model="warehouse.country.value">
        </div>
        <div class="space-y-1 w-full">
            <p :class="{'text-red-400': warehouse.city.error}" class="">Город</p>
            <input class="w-1/2 bg-gray-700 py-1 pl-3 rounded-lg" v-model="warehouse.city.value">
        </div>
        <div class="space-y-1 w-full">
            <p :class="{'text-red-400': warehouse.street.error}" class="">Улица</p>
            <input class="w-1/2 bg-gray-700 py-1 pl-3 rounded-lg" v-model="warehouse.street.value">
        </div>
        <div class="space-y-1 w-full">
            <p :class="{'text-red-400': warehouse.houseNumber.error}" class="">Дом / Строение / ...</p>
            <input class="w-1/2 bg-gray-700 py-1 pl-3 rounded-lg" v-model="warehouse.houseNumber.value">
        </div>
        <div class="space-y-1 w-full">
            <p :class="{'text-red-400': warehouse.telephone.error}" class="">Телефон для связи</p>
            <input class="w-1/2 bg-gray-700 py-1 pl-3 rounded-lg" v-model="warehouse.telephone.value">
        </div>
        <button @click="saveWarehouse()" class="bg-sky-800/50 py-1 px-4 rounded">Создать склад</button>
    </div>
</template>

<script>
import {mapActions} from "vuex";

export default {
   data(){
       return {
           warehouse: {
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
            'warehouseCreate'
        ]),
        validation(){
            if (this.warehouse.name.value === null || this.warehouse.name.value === '') {
                this.warehouse.name.error = true
            } else {
                this.warehouse.name.error = false
            }

            if (this.warehouse.country.value === null || this.warehouse.country.value === '') {
                this.warehouse.country.error = true
            } else {
                this.warehouse.country.error = false
            }

            if (this.warehouse.city.value === null || this.warehouse.city.value === '') {
                this.warehouse.city.error = true
            } else {
                this.warehouse.city.error = false
            }

            if (this.warehouse.street.value === null || this.warehouse.street.value === '') {
                this.warehouse.street.error = true
            } else {
                this.warehouse.street.error = false
            }

            if (this.warehouse.houseNumber.value === null || this.warehouse.houseNumber.value === '') {
                this.warehouse.houseNumber.error = true
            } else {
                this.warehouse.houseNumber.error = false
            }

            if (this.warehouse.telephone.value === null || this.warehouse.telephone.value === '') {
                this.warehouse.telephone.error = true
            } else {
                this.warehouse.telephone.error = false
            }

            if(this.warehouse.name.value && this.warehouse.city.value && this.warehouse.street.value && this.warehouse.country.value && this.warehouse.houseNumber.value && this.warehouse.telephone.value) {
                return true
            } else {
                return false
            }
        },
        saveWarehouse(){
            let validation = this.validation()
            if(validation){this.warehouseCreate(this.warehouse)}
        },
    }

}
</script>
