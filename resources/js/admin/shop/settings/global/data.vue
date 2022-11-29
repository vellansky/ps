<template>
    <div class="text-sm w-full space-y-6">
            <div class="space-y-1 w-full">
                <p class="font-medium uppercase tracking-wide text-gray-500 text-xs">Имя магазина</p>
                <input v-model="name" class="w-1/2 bg-gray-700 py-1 pl-3 rounded-lg">
            </div>
            <button @click="shopNameEdit()" class="bg-sky-800/50 py-1 px-4 rounded">Сохранить</button>
    </div>
</template>

<script>
import {mapActions} from "vuex";

export default {
    data(){
        return {
            name: null,
        }
    },
    methods:{
        ...mapActions([
            'shopEditName'
        ]),
        shopNameEdit(){
            this.shopEditName(this.name)
        }
    }
}
</script>
