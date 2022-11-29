<template>
    <div class="fixed inset-x-0 top-0 bg-gray-800/75 text-white text-sm font-semibold cursor-default select-none z-50">
        <div class="flex flex-nowrap justify-between px-4 ">
            <div class="flex flex-nowrap space-x-4">
                <div class="relative">
                <p @click="menuProfile = !menuProfile">papasmoke</p>
                <div v-if="menuProfile" class="absolute border-0 bg-black/80 text-white px-5 py-3 min-w-max rounded space-y-4 ">
                    <p>Управление профилем</p>
                    <p class="w-full" @click="logout()">Выйти</p>
                </div>
                </div>
                <p @click="activeMenu({menu: 'shop', status: true})">Магазины</p>
                <p @click="activeMenu({menu: 'items', status: true})">Товары</p>
                <p @click="activeMenu({menu: 'order', status: true})">Заказы</p>
            </div>
            <div>
                <p>{{ menuTitle }}</p>
            </div>
        </div>
    </div>

</template>

<script>
import {mapActions, mapGetters} from 'vuex';
import axios from "axios";
export default {

    data(){
        return {
        menuProfile: false,
    }
    },
    methods:{
        ...mapActions([
            'managerMenu',
        ]),
        activeMenu(data){

           this.managerMenu(data)
        },
        logout(){
            console.log('work')
            axios.post('/logout')
                .then(() => {
                    location="/";
                })
        }
    },
    computed: {
        ...mapGetters([
            'menuStatus',
            'orderDetails'
        ]),
        menuTitle() {
            for (const [window, value] of Object.entries(this.menuStatus)) {
                if (value === true) {
                    if (window === 'shop') {
                        return 'Настройки магазина'
                    }
                    if (window === 'item') {
                        return 'Настройки товаров'
                    }
                    if (window === 'order') {
                        return 'Заказы'
                    }
                }
            }
        }
    }
}
</script>
