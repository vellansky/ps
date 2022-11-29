<template>
    <div @click="select()" class="flex flex-nowrap items-center gap-x-3 cursor-pointer">
        <p class="text-xs">Выберите свой город:</p>
        <p class=" text-sm uppercase">{{city}}</p>
    </div>
</template>
<script>
import {mapActions, mapGetters} from 'vuex';
export default {
    methods:{
        ...mapActions([
            'profileUpdateSelectCity'
        ]),
        select(){
            this.profileUpdateSelectCity(true)
        },
    },
    computed:{
        ...mapGetters([
            'profileGetCity'
        ]),
        city(){
            return this.profileGetCity
        }
    }
}
</script>
