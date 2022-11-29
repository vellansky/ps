<template>
    <div class="ml-10 space-y-5 w-full">
        <div v-if="!token" class="space-y-5">
            <div  class="space-y-1 w-full">
                <p class="font-medium uppercase tracking-wide text-gray-500 text-xs">Имя подписчика</p>
                <input v-model="subName" class="w-1/2 bg-gray-700 py-1 pl-3 rounded-lg">
            </div>
            <button @click="createSub()" class="bg-sky-800/50 py-1 px-4 rounded">Создать подписчика</button>
        </div>
        <div v-else class="space-y-10">
            <div class="space-y-2">
                <p class="font-medium uppercase tracking-wide text-gray-500 text-xs">Токен</p>
                <div @click="copy(token)" class="relative flex flex-nowrap items-center">
                    <p class="bg-gray-700 py-1 px-5 rounded-lg">{{token}}</p>
                    <button :class="{'bg-green-500': statusCopy}" class="bg-red-500 px-1 rounded ml-2">{{copyText}}</button>
                </div>
                <p class="text-xs text-red-400">Скопируйте токен. Вы его больше никогда не увидите!</p>
            </div>
            <div class="flex flex-nowrap items-center space-x-5">
                <input v-model="agreement" type="checkbox" class="appearance-none checked:bg-blue-500" />
                <button @click="clear()" class="bg-sky-800/50 py-1 px-4 rounded">Я передал токен сотруднику</button>
            </div>
        </div>

    </div>
</template>

<script>
import {mapActions, mapGetters} from "vuex";

export default {
    data(){
      return {
          subName: null,
          statusCopy: false,
          agreement: false,
      }
    },
    methods:{
        ...mapActions([
            'shopCreateSub',
            'shopSubTokenClear'
        ]),
        clear(){
            if(this.agreement) {
                this.shopSubTokenClear()
            } else {
                return
            }
        },
        createSub(){
            this.shopCreateSub({name: this.subName})
        },
        copy(token){
            navigator.clipboard.writeText(token)
            this.statusCopy = true
        }
    },
    computed:{
        ...mapGetters([
            'subscriberToken'
        ]),
        copyText(){
            if(this.statusCopy === true) {
                return 'Скопировано в буфер'
            } else {
                return 'Скопировать!'
            }
        },
        token(){
            return this.subscriberToken
        }
    }
}
</script>

