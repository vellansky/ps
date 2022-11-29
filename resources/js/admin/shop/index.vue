<template>
    <div class="w-full h-full absolute flex items-center justify-center inset-0 cursor-default z-30">
        <div :class="{'w-full h-full': windowFull, 'w-4/5 h-1/2':!windowFull}" class="text-sm text-white shadow-lg shadow-cyan-500/50">

                    <div class="flex flex-nowrap h-full">

                        <div class="flex flex-col overflow-y-auto w-1/4 h-full p-3 rounded-l-2xl bg-black/50 backdrop-blur-md border-r border-black space-y-2 min-w-max cursor-default">
                            <div class="flex flex-nowrap space-x-2 items-center">
                                <div @click="close({menu: 'shop', status: false})" class="w-3 h-3 rounded-full bg-red-400 cursor-pointer"></div>
                                <div @click="windowFull = !windowFull" class="w-3 h-3 rounded-full bg-green-500 cursor-pointer"></div>
                            </div>
                            <div class="my-5">
                                    <div class="flex flex-col overflow-y-auto h-full" v-if="startMenuStatus">
                                        <p class="text-gray-500 text-xs mb-1">Избранное</p>
                                        <p @click="active({action: 'create'})" :class="{'bg-white/20': createStatus}" class="rounded-lg py-1 px-6 cursor-default">Создать магазин</p>
                                    </div>

                                    <div class="flex flex-col overflow-y-auto h-full space-y-2" v-else>
                                        <p class="text-gray-500 text-xs mb-1">Товары</p>
                                        <p @click="active({action: 'shopItemsList'})" class="rounded-lg py-1 px-6 cursor-default" :class="{'bg-white/20': itemsList}">Список</p>
                                        <p @click="active({action: 'shopAddItems'})" class="rounded-lg py-1 px-6 cursor-default" :class="{'bg-white/20': addItems}">Добавить</p>
                                        <p class="text-gray-500 text-xs mb-1">Настройки</p>
                                        <p @click="active({action: 'shopData'})" class=" rounded-lg py-1 px-6 cursor-default" :class="{'bg-white/20': settingData}">Данные</p>
                                        <p @click="active({action: 'shopContacts'})" class=" rounded-lg py-1 px-6 cursor-default" :class="{'bg-white/20': settingContact}">Контакты</p>
                                        <p class="text-gray-500 text-xs mb-1">Уведомления</p>
                                        <p @click="active({action: 'shopTelegram'})" class=" rounded-lg py-1 px-6 cursor-default" :class="{'bg-white/20': settingTgrm}">Telegram</p>
                                    </div>
                            </div>
                        </div>
                        <div class="relative w-3/4 bg-gray-800/90 rounded-r-2xl text-white py-3">
                            <div class="absolute flex flex-nowrap justify-between items-center w-full text-right px-10">
                                <div>
                                    <p @click="active({action: 'start'})">Назад</p>
                                </div>
                                <div v-if="addItems" class="flex flex-nowrap space-x-4">
                                    <p @click="importFile()" class="font-medium text-gray-500">Загрузить из файла</p>
                                    <p @click="saveItemsList()" class="font-medium text-gray-500">Сохранить</p>
                                </div>
                                <p>{{ itemTitle }}</p>
                            </div>
                            <div class="px-10 h-full pt-5 overflow-y-auto">
                            <div class="my-5">
                                <shopList v-if="listStatus"/>
                                <div class="mb-10" v-else>
                                    <itemsListOriginal v-if="itemsList" />
                                    <shopCreate v-if="createStatus"/>
                                    <shopItems v-if="addItems" />
                                    <settingTelegram v-if="settingTgrm" />
                                    <pageGlobalData v-if="settingData"/>
                                    <pageGlobalContact v-if="settingContact" />
                                </div>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
</template>

<script>
import {mapActions, mapGetters} from "vuex";
import shopList from "./list";
import settingTelegram from "./settings/notification/telegram";
import pageGlobalData from "./settings/global/data";
import pageGlobalContact from "./settings/global/contacts";
import shopItems from './items/index';
import shopCreate from './create';
import itemsListOriginal from './itemsList';
export default {
    components:{
        itemsListOriginal,
        shopCreate,
        shopItems,
        shopList,
        settingTelegram,
        pageGlobalData,
        pageGlobalContact,

    },
    data(){
        return {
            shopList: true,
            windowShopCreate:false,
            windowShopItem:false,
            windowFull:false,
            windowGlobalData: false,
            windowGlobalContacts: false,
            windowNotificTelegram: false,
        }
    },
    methods:{
        ...mapActions([
            'managerMenu',
            'managerShopMenu',
            'shopAddItemsFromFile',
            'itemsCreateList'
        ]),
        saveItemsList(){
            this.itemsCreateList()
        },
        importFile(){
            this.shopAddItemsFromFile()
        },
        active(data){
            console.log(data)
            this.managerShopMenu(data)
        },

        allSettingFalse(){
            this.windowShopCreate = false
            this.windowShopItem = false
            this.windowGlobalData = false
            this.windowGlobalContacts = false
            this.windowNotificTelegram = false
        },
        closeSetting(){

        },
        activeSetting(data){
            this.allSettingFalse()
            if(data === 'start'){
                this.shopList = true
                return
            }
            if(data === 'shopCreate') {
                this.shopList = false
                this.windowShopCreate = true
            }

            /*
            if(data === 'tlgrm'){
                this.windowNotificTelegram = true
            } else if(data === 'globalData') {
                this.windowGlobalData = true
            } else if(data === 'globalContacts') {
                this.windowGlobalContacts = true
            } else if (data === 'shopItems') {
                this.windowShopItem = true
            } else if (data === 'shopCreate') {
                this.windowShopCreate = true
            }*/
        },
        close(data){
            this.managerMenu(data)
            this.managerShopMenu('start')

        },
    notSelect(data){
        this.allSettingFalse()
        this.adminSelectSettingShop(data)
    }
    },
    computed:{
        ...mapGetters([
            'menuShopStatus'
        ]),
        itemTitle(){
            for (const [component, value] of Object.entries(this.menuShopStatus)) {
                console.log(component + ' ' + value)
                if (value === true) {
                    if (component === 'list') {
                        return 'Список магазинов'
                    }
                    if (component === 'itemsList') {
                        return 'Товары в магазине'
                    }
                    if (component === 'addItems') {
                        return 'Вы добавляете товары'
                    }
                    if (component === 'create') {
                        return 'Вы создаете магазин'
                    }
                    if (component === 'telegram') {
                        return 'Вы настраиваете уведомления в телеграм'
                    }
                }
            }
        },
        listStatus(){
            return this.menuShopStatus.list
        },
        startMenuStatus(){
            return this.menuShopStatus.startMenu
        },
        createStatus(){
            return this.menuShopStatus.create
        },
        addItems(){
            return this.menuShopStatus.addItems
        },
        itemsList(){
            return this.menuShopStatus.itemsList
        },
        settingTgrm(){
            return this.menuShopStatus.telegram
        },
        settingData(){
            return this.menuShopStatus.data
        },
        settingContact(){
            return this.menuShopStatus.contact
        }


    },
}
</script>
