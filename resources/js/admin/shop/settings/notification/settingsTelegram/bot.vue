<template>
    <div class="ml-10 space-y-5 w-full">
        <div class="space-y-1 w-full">
            <p class="font-medium uppercase tracking-wide text-gray-500 text-xs">API Token</p>
            <input v-model="botToken" :disabled="botStatus" class="w-1/2 bg-gray-700 py-1 pl-3 rounded-lg">
        </div>
        <button @click="saveBotToken()" class="bg-sky-800/50 py-1 px-4 rounded">Сохранить API Token</button>
    </div>

</template>

<script>
import {mapActions, mapGetters} from "vuex";

export default {
    data(){
        return{
            botToken: null,
        }
    },
    methods: {
        ...mapActions([
            'shopSaveBotToken',
            'shopGetStatusBot'
        ]),
        saveBotToken(){
            if(!this.botStatus) {
                this.shopSaveBotToken({token: this.botToken})
            } else {

            }

        }
    },
    mounted() {
        this.shopGetStatusBot()
    },
    computed:{
        ...mapGetters([
            'shopStatusBot'
        ]),
        botStatus() {
            if(this.shopStatusBot) {
                this.botToken = "◦◦◦◦◦◦◦◦◦◦◦◦"
            }
            return this.shopStatusBot
        },
    }
}
</script>
