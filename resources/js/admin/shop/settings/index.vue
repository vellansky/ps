<template>
    <div class="fixed flex items-center justify-center inset-0 bg-black/80 p-5">
        <div :class="{'w-full h-full': windowFull, 'w-4/5 h-1/2':!windowFull}" class="bg-gray-800 text-sm text-white rounded-2xl p-5">
            <div class="flex flex-nowrap items-center">
                <div class="flex flex-nowrap space-x-2 items-center">
                    <div @click="close({menu: 'shop', status: false})" class="w-3 h-3 rounded-full bg-red-400 cursor-pointer"></div>
                    <div @click="windowFull = !windowFull" class="w-3 h-3 rounded-full bg-green-500 cursor-pointer"></div>
                </div>
                <div class="font-medium uppercase tracking-wide text-gray-500 ml-10">{{pageName}}</div>
            </div>

            <div class="w-full h-full">
                <div class="flex flex-nowrap h-full">
                    <div class="flex flex-col overflow-y-auto h-full border-r border-black p-8 space-y-2 min-w-max">
                        <p class="text-gray-500 text-xs mb-1">Общие настройки</p>
                        <button @click="activeSetting('globalData')" :class="{'bg-gray-700': windowGlobalData}" class=" rounded-lg py-1 px-6 cursor-default">Данные</button>
                        <button @click="activeSetting('globalContacts')" :class="{'bg-gray-700': windowGlobalContacts}" class=" rounded-lg py-1 px-6 cursor-default">Контакты</button>
                        <p class="text-gray-500 text-xs mb-1">Уведомления</p>
                        <button @click="activeSetting('tlgrm')" :class="{'bg-gray-700': windowNotificTelegram}" class=" rounded-lg py-1 px-6 cursor-default">Telegram</button>
                    </div>
                    <div class="w-full">
                        <pageNotificTelegram v-if="windowNotificTelegram" />
                        <pageGlobalData v-if="windowGlobalData"/>
                        <pageGlobalContact v-if="windowGlobalContacts" />
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { mapActions } from 'vuex';
import shop from './';
import pageNotificTelegram from './notification/telegram'
import pageGlobalData from './global/data'
import pageGlobalContact from './global/contacts'
export default {
    components:{
        pageNotificTelegram,
        pageGlobalData,
        pageGlobalContact
    },
    data(){
        return {
            windowFull:false,
            windowGlobalData: false,
            windowGlobalContacts: false,
            windowNotificTelegram: false,
        }
    },
    methods:{
        ...mapActions([
            'adminUpdateMenu'
        ]),
        allSettingFalse(){
            this.windowGlobalData = false
            this.windowGlobalContacts = false
            this.windowNotificTelegram = false
        },
        activeSetting(data){
            this.allSettingFalse()
            if(data === 'tlgrm'){
                this.windowNotificTelegram = true
            } else if(data === 'globalData') {
                this.windowGlobalData = true
            } else if(data === 'globalContacts') {
                this.windowGlobalContacts = true
            }
        },
        close(data){
            this.adminUpdateMenu(data)
        },
    },
    computed:{
        pageName(){
            if(this.windowGlobalData === true){
                return 'Общие настройки'
            } else if(this.windowGlobalContacts === true){
                return 'Контакты магазина'
            } else if(this.windowNotificTelegram === true){
                return 'Настройки уведомлений в телеграм'
            } else {
                return 'Настройки'
            }
        }
    }
}
</script>

