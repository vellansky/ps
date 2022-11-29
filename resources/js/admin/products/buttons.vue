<template>
    <button  @click="uploadProducts = true" class="px-3 py-1 bg-green-500 text-white text-sm rounded-lg">Загрузить .XML</button>
    <uploadProducts 
        v-if="uploadProducts"
        @close="uploadProducts = false"

    />
    <notification v-if="notification" />
</template>
<script>
import { mapGetters } from 'vuex';
import uploadProducts from "./components/uploadProducts.vue"
export default {
    components:{
        uploadProducts
    },
    data(){
        return {
            uploadProducts: false
        }
    },
    computed:{
        ...mapGetters([
            'adminNotification'
        ]),
        notification(){
            return this.adminNotification
        }
    }
}
</script>
