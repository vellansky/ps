<template>
    <div class="absolute flex items-center justify-center inset-0 z-30 select-none">
        <div :class="{'w-full h-full': windowFull, 'w-4/5 h-1/2':!windowFull}" class="text-sm text-white rounded-2xl shadow-lg shadow-cyan-500/50">
                <div class="flex flex-nowrap h-full">
                    <div class="flex flex-col overflow-y-auto w-1/4 h-full p-3 rounded-l-2xl bg-black/50 backdrop-blur-md border-r border-black space-y-2 min-w-max cursor-default">
                            <div class="flex flex-nowrap space-x-2 items-center">
                                <div @click="close({menu: 'items', status: false})" class="w-3 h-3 rounded-full bg-red-400 cursor-pointer"></div>
                                <div @click="windowFull = !windowFull" class="w-3 h-3 rounded-full bg-green-500 cursor-pointer"></div>
                            </div>
                        <div class="mt-5">
                            <div class="flex flex-col">
                                <p class="text-gray-500 text-xs mb-1">Товары</p>
                                <p @click="activeMenuItems('allItems')" :class="{'bg-white/20': allItemsStatus}" class="rounded-lg py-1 px-6">Список</p>
                            </div>
                            <div class="flex flex-col">
                                <p class="text-gray-500 text-xs mb-1">Категории</p>
                                <p @click="activeMenuItems('categoriesList')" :class="{'bg-white/20': categoryListStatus}" class="rounded-lg py-1 px-6">Список</p>
                                <p @click="activeMenuItems('categoriesCreate')" :class="{'bg-white/20': categoryCreateStatus}" class="rounded-lg py-1 px-6">Создать</p>
                            </div>
                        </div>
                    </div>
                    <div class="relative w-3/4 bg-gray-800/90 rounded-r-2xl text-white py-3">
                        <div class="absolute w-full text-right px-10">
                            <p class="font-medium">{{ itemTitle }}</p>
                        </div>
                        <div class="px-10 h-full pt-5 overflow-y-auto">
                            <itemsList v-if="allItemsStatus"/>
                            <keep-alive>
                                <categoryCreate v-if="categoryCreateStatus" />
                            </keep-alive>
                                <categoryList v-if="categoryListStatus"/>
                        </div>
                    </div>
                </div>
        </div>
    </div>
</template>

<script>
import { mapActions, mapGetters } from 'vuex';
import itemsList from './list'
import categoryCreate from './category/create'
import categoryList from './category/list'
export default {
    components:{
        categoryCreate,
        itemsList,
        categoryList,
    },
    data(){
        return {
            allItems: false,
        }
    },
    methods:{
        ...mapActions([
            'managerMenu',
            'managerItemsMenu',
        ]),
        activeMenuItems(a){
            let menu = {component:'items', action: a}
            this.managerItemsMenu(menu)
        },
        close(data){
            this.managerMenu(data)
            this.managerWarehouseMenu('start')
        },
    },
    computed:{
        ...mapGetters([
            'menuItemsStatus'
        ]),
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
        },
        itemTitle(){
            for (const [component, value] of Object.entries(this.menuItemsStatus)) {
                if (value === true) {
                    if (component === 'allItems') {
                        return 'Список товаров'
                    }
                    if (component === 'categoriesCreate') {
                        return 'Вы создаете категорию'
                    }
                    if (component === 'categoriesList') {
                        return 'Список категорий'
                    }
                }
            }
        },
        allItemsStatus(){
            return this.menuItemsStatus.allItems
        },
        categoryCreateStatus(){
            return this.menuItemsStatus.categoriesCreate
        },
        categoryListStatus(){
            return this.menuItemsStatus.categoriesList
        }
    }
}
</script>

