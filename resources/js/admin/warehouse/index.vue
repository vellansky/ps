<template>
    <div class="fixed flex items-center justify-center inset-0 bg-black/80 p-5">
        <div :class="{'w-full h-full': windowFull, 'w-4/5 h-1/2':!windowFull}" class="bg-gray-800 text-sm text-white rounded-2xl p-5">
            <div class="flex flex-nowrap items-center cursor-default">
                <div class="flex flex-nowrap space-x-2 items-center">
                    <div @click="close({menu: 'warehouse', status: false})" class="w-3 h-3 rounded-full bg-red-400 cursor-pointer"></div>
                    <div @click="windowFull = !windowFull" class="w-3 h-3 rounded-full bg-green-500 cursor-pointer"></div>
                </div>
                <div @click="activeMenuWarehouse({action: 'start'})" class="px-5 py-2">Назад</div>
                <div class="font-medium uppercase tracking-wide text-gray-500 ml-10">{{pageName}}</div>
            </div>

            <div class="w-full h-full">
                <div class="flex flex-nowrap h-full">
                    <div class="flex flex-col overflow-y-auto h-full border-r border-black p-8 space-y-2 min-w-max cursor-default">
                        <div class="flex flex-col">
                            <div v-if="startMenuStatus" class="cursor-default">
                                <p class="text-gray-500 text-xs mb-1">Избранное</p>
                                <div @click="activeMenuWarehouse({action: 'create'})" :class="{'bg-gray-700': create}" class="rounded-lg py-1 px-6 w-full">Создать склад</div>
                            </div>
                            <div v-else>
                                <p class="text-gray-500 text-xs mb-1">Товары</p>
                                <div @click="activeMenuWarehouse({action: 'itemsList'})" :class="{'bg-gray-700': create}" class="rounded-lg py-1 px-6 w-full">Список</div>
                                <div @click="activeMenuWarehouse({action: 'addItems'})" :class="{'bg-gray-700': create}" class="rounded-lg py-1 px-6 w-full">Добавить</div>
                            </div>
                        </div>
                    </div>
                    <div class="w-full px-10 overflow-y-auto">

                        <createWarehouse v-if="createStatus" />
                        <warehousesList v-if="listStatus" />
                        <addItems v-if="addItemsStatus"/>
                        <keep-alive>
                        <itemsList v-if="itemsListStatus"/>
                        </keep-alive>

                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { mapActions, mapGetters } from 'vuex';
import createWarehouse from './create'
import warehousesList from './list'
import addItems from "@/admin/warehouse/addItems";
import itemsList from "@/admin/warehouse/items/list.vue"

export default {
    components:{
        createWarehouse,
        warehousesList,
        addItems,
        itemsList,
    },
    data(){
        return {
            create: false,
            list: false,
        }
    },
    methods:{
        ...mapActions([
            'adminUpdateMenu',
            'adminUpdateWarehouses',
            'managerMenu',
            'managerWarehouseMenu',
        ]),
        allMenuWarehouseFalse(){
            this.create = false
            this.list = false
        },
        activeMenuWarehouse(data){
            this.managerWarehouseMenu(data)
        },
        close(data){
            this.managerMenu(data)
            this.managerWarehouseMenu('start')
        },
    },
    mounted() {
        this.adminUpdateWarehouses()
    },
    computed:{
        ...mapGetters([
           'adminGetWarehouses',
            'menuWarehouseStatus',
        ]),
        startMenuStatus(){
            return this.menuWarehouseStatus.startMenu
        },
        listStatus(){
            return this.menuWarehouseStatus.list
        },
        createStatus(){
            return this.menuWarehouseStatus.create
        },
       addItemsStatus(){
            return this.menuWarehouseStatus.addItems
        },
        itemsListStatus(){
            return this.menuWarehouseStatus.itemsList
        },

        warehouses(){
            return this.adminGetWarehouses
        },
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

