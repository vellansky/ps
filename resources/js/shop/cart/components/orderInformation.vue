<template>
    <div class="fixed inset-0 bg-black/60 flex items-center justify-center">
        <div class="md:w-2/5 h-screen w-screen p-5 bg-white flex flex-col items-center justify-center rounded">
            <h5 class="font-black text-xl uppercase font-mono">Поздравляем!</h5>
            <p class="text-xs text-gray-700">Вы оформили заказ </p>
            <p>Номер вашего заказа</p>
            <p class="text-9xl font-black uppercase border-4 border-black p-6 rounded-full my-5">{{orderId}}</p>
            <p>papasmoke.ru - С любовью</p>
            <p class="p-4 bg-yellow-300/50 rounded-lg my-5">Сделайте скриншот, чтобы быстро вспомнить номер</p>
            <button @click="close()" class="border border-black px-3 py-1 rounded">Закрыть</button>
        </div>

    </div>
</template>
<script>
import {mapActions, mapGetters} from 'vuex';
export default {
    methods:{
        ...mapActions([
            'profileUpdateThankStatus'
        ]),
        close(){
           this.profileUpdateThankStatus()
        }
    },
    computed:{
        ...mapGetters([
            'profileGetOrderIdFromServer'
        ]),
        orderId(){
            return this.profileGetOrderIdFromServer
        }
    },
}
</script>
