<template>
    <div class="table-row cursor-default" :class="bgColor" @click="activeRow({item: 'items', status: true, id: id})">
        <div class="table-cell">{{name}}</div>
    </div>
</template>

<script>
import {mapActions, mapGetters} from "vuex";

export default {
    props:["index","id","name"],
    methods:{
        ...mapActions([
            'adminUpdateNow',
            'adminGetProductId'
        ]),
         activeRow(data){
            this.adminUpdateNow(data)
            this.adminGetProductId()
        },
    },
    computed:{
        ...mapGetters([
            'adminGetItemId'
        ]),
        bgColor(){
            if(this.adminGetItemId === this.id) {
                return "text-white bg-blue-700"
            } else {
                let res = this.index % 2
                if (res) {
                    return "bg-gray-700/50"
                } else {
                    return
                }

            }
        },
    },
}
</script>

