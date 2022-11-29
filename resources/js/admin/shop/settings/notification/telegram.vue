<template>
<div class="flex flex-nowrap h-full">
    <div class="flex flex-col h-full border-r border-black space-y-2 px-3 w-1/6">
        <button @click="activeSetTm('subscribers')" :class="{'bg-gray-700': windowTlgtmSub}" class=" rounded-lg py-1 px-2 cursor-default">Подписчики</button>
        <button @click="activeSetTm('createSubscriber')" :class="{'bg-gray-700': windowTlgrmCreateSub}" class=" rounded-lg py-1 px-2 cursor-default">Создать подписчика</button>
        <button @click="activeSetTm('settingsBot')" :class="{'bg-gray-700': windowTlgrmSetBot}" class=" rounded-lg py-1 px-2 cursor-default">Настройки бота</button>
    </div>
    <div class="w-full h-full overflow-y-auto px-5">
        <subscribes v-if="subscribes"/>
        <bot v-if="windowTlgrmSetBot"/>
        <createSubscribe v-if="windowTlgrmCreateSub"/>
    </div>
</div>
</template>

<script>
import subscribes from "./settingsTelegram/subscribes";
import bot from "./settingsTelegram/bot";
import createSubscribe from "./settingsTelegram/createSubscribe";
import {mapGetters} from "vuex";
export default {
    components:{
        subscribes,
        bot,
        createSubscribe
    },
    data(){
        return {
            windowTlgtmSub: false,
            windowTlgrmSetBot: false,
            windowTlgrmCreateSub: false,
        }
    },
    methods:{
        allSettingTmFalse(){
            this.windowTlgtmSub = false
            this.windowTlgrmSetBot = false
            this.windowTlgrmCreateSub = false
        },
        activeSetTm(data){
            this.allSettingTmFalse()
            if(data === 'subscribers'){
                this.windowTlgtmSub = true
            } else if(data === 'settingsBot') {
                this.windowTlgrmSetBot = true
            } else if(data === 'createSubscriber') {
                this.windowTlgrmCreateSub = true
            }
        },
    },

}

</script>

