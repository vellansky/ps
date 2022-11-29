<template>
    <button @click="addItems = !addItems">Добавить товары на склад</button>
    <addItems @close="addItems = false" v-if="addItems"/>
</template>
<script>
import addItems from '../addItems.vue'
export default {
    components:{
        addItems,
    },
    data(){
        return {
            addItems: false,
        }
    },
}
</script>
