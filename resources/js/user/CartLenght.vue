<template>
    <p v-if="cartProducts.length >= 1" class="bg-red-600 text-white rounded-full p-1 text-xs top-0 right-0 select-none">{{cartProducts.length}}</p>
</template>

<script>
import {mapGetters} from "vuex";

export default {
    name: "CartLenght",
    computed:{
        ...mapGetters([
            'cartProducts'
        ])
    },
}
</script>
