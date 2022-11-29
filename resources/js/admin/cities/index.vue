<template>
    <div class="fixed flex items-center justify-center inset-0 bg-black/80 p-5">
        <div :class="{'w-full h-full': windowFull, 'w-4/5 h-1/2':!windowFull}" class="bg-gray-800 text-sm text-white rounded-2xl p-5 shadow-lg shadow-cyan-500/50">
            <div class="flex flex-nowrap items-center">
                <div class="flex flex-nowrap space-x-2 items-center">
                    <div @click="close({menu: 'cities', status: false})" class="w-3 h-3 rounded-full bg-red-400 cursor-pointer"></div>
                    <div @click="windowFull = !windowFull" class="w-3 h-3 rounded-full bg-green-500 cursor-pointer"></div>
                </div>
                <div class="font-medium uppercase tracking-wide text-gray-500 ml-10">{{pageName}}</div>
            </div>

            <div class="w-full h-full">
                <div class="flex flex-nowrap h-full">
                    <div class="flex flex-col overflow-y-auto h-full border-r border-black p-8 space-y-2 min-w-max cursor-default">
                        <div class="flex flex-col">
                            <p class="w-full">Список городов</p>
                            <p class="w-full">Добавить города</p>
                        </div>
                        <div class="flex flex-col">
                            <p class="w-full">Сп</p>
                        </div>
                    </div>
                    <div class="w-full px-10 overflow-y-auto">
                        тут окна
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import {mapActions} from "vuex";

export default {
    methods:{
        ...mapActions([
            'managerMenu'
        ]),
        close(data){
            this.managerMenu(data)
            this.managerWarehouseMenu('start')
        },
    }
}
</script>
