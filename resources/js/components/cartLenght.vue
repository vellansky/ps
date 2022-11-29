<template>
    <span v-if="cartLenght" class="absolute text-xs text-white px-2 bg-red-600 rounded-full">{{cartLenght}}</span>
</template>
<script>
import { mapGetters } from "vuex";

export default {
    computed:{
        ...mapGetters([
            'cartGetLenght'
        ]),
        cartLenght(){
            return this.cartGetLenght
        }
    }
}
</script>
