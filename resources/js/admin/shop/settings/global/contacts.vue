<template>
    <div class="space-y-5 w-full">
        <div class="space-y-1 w-full">
            <p class="font-medium uppercase tracking-wide text-gray-500 text-xs">Телефон для связи с магазином</p>
            <input v-model="data.telephone" class="w-1/2 bg-gray-700 py-1 pl-3 rounded-lg">
        </div>
        <div class="space-y-5">
            <h5>Адрес</h5>
            <div class="space-y-1">
                <p class="font-medium uppercase tracking-wide text-gray-500 text-xs">Страна</p>
                <input v-model="data.address.country" class="w-1/2 bg-gray-700 py-1 pl-3 rounded-lg">
            </div>
            <div class="space-y-1">
                <p class="font-medium uppercase tracking-wide text-gray-500 text-xs">Город</p>
                <input v-model="data.address.city" class="w-1/2 bg-gray-700 py-1 pl-3 rounded-lg">
            </div>
            <div class="space-y-1">
                <p class="font-medium uppercase tracking-wide text-gray-500 text-xs">Улица</p>
                <input v-model="data.address.street" class="w-1/2 bg-gray-700 py-1 pl-3 rounded-lg">
            </div>
            <div class="space-y-1">
                <p class="font-medium uppercase tracking-wide text-gray-500 text-xs">ДОМ / СТРОЕНИЕ / ...</p>
                <input v-model="data.address.house_number" class="w-1/2 bg-gray-700 py-1 pl-3 rounded-lg">
            </div>
        </div>
        <button @click="save" class="bg-sky-800/50 py-1 px-4 rounded">Сохранить</button>
    </div>
</template>

<script>
import {mapActions} from "vuex";

export default {
    data(){
        return {
            data: {
                telephone: null,
                address: {
                    country: null,
                    city: null,
                    street: null,
                    house_number: null,
                }
            }
        }
    },
    methods:{
        ...mapActions([
            'shopEditConact'
        ]),
        save(){
            this.shopEditConact(this.data)
        }
    }
}
</script>

