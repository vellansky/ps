<template>
    <div>
        <button @click="openCreateShop()" class="px-2 py-1 text-sm bg-gray-100 border rounded">Создать магазин</button>
        <createShop @close="create = false" v-if="create"/>
    </div>
</template>

<script>
import createShop from "../shop/create.vue"
export default {
    components:{
        createShop,
    },
    data(){
        return{
            create: false,
        }
    },
    methods:{
        openCreateShop(){
            this.create = true
        }
    }
}
</script>
