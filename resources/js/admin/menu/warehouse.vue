<template>
    <div>
        <button @click="openCreateWarehouse()" class="px-2 py-1 text-sm bg-gray-100 border rounded">Создать склад</button>
        <createWarerhouse @close="create = false" v-if="create"/>
    </div>
</template>

<script>
import createWarerhouse from "../warehouse/create.vue"
export default {
    components:{
        createWarerhouse,
    },
    data(){
        return{
            create: false,
        }
    },
    methods:{
        openCreateWarehouse(){
            this.create = true
        }
    }
}
</script>
