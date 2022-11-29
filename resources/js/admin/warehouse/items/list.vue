<template>
    <div class="relative">
    <div class="table text-sm w-full z-30">
        <div class="table-header-group">
            <div class="table-row font-semibold">
                <div class="table-cell text-left w-1/3">Имя</div>
                <div class="table-cell text-left w-1/3">Штрих код</div>
                <div class="table-cell text-left w-1/3">Количество</div>
            </div>
        </div>
        <div class="table-row-group">
            <div @click="select(row, index)" v-for="(row, index) in items" :key="index" :class="bgColor(row.id, index)" class="table-row cursor-default text-xs text-gray-500">
                <div class="table-cell">
                    <div v-if="selectId === row.id">
                        <input class="w-full bg-transparent" v-model="row.name">
                    </div>
                    <p v-else>{{row.name}}</p>
                </div>
                <div class="table-cell">
                    <div v-if="selectId === row.id">
                        <input class="w-full bg-transparent " v-model="row.code">
                    </div>
                    <p v-else>{{row.code}}</p>
                </div>
                <div class="table-cell text-center">
                    <div v-if="selectId === row.id">
                        <input class="w-full bg-transparent text-center" v-model="row.pivot.quantity">
                    </div>
                    <p v-else>{{row.pivot.quantity}}</p>
                </div>
            </div>
        </div>
    </div>
    </div>
</template>

<script>
import {mapActions, mapGetters} from "vuex";

export default {
    data(){
        return {
            selectId: null,
        }
    },
    methods:{
        ...mapActions([
            'warehouseItemsUpdate',
            'adminUpdateProduct',
            'warehouseEditItems',
            'warehouseEditItemsSave'
        ]),
        select(row){
            this.selectId = row.id
            this.warehouseEditItems(row.id)
        },
        bgColor(id, index){
            if(id !== this.selectId) {
                if (index % 2) {
                    return "bg-gray-700/30"
                } else {
                    return
                }
            } else {
                return "bg-blue-700 text-white"
                }

            }
    },
    deactivated(){
        this.warehouseEditItemsSave()
    },
    mounted() {
        this.warehouseItemsUpdate()
    },
    computed:{
        ...mapGetters([
            'warehouseItems'
        ]),
        items(){
            return this.warehouseItems
        },
    },
}
</script>

