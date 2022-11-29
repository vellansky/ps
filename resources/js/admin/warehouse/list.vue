<template>
    <div class="table text-sm w-full">
        <div class="table-header-group">
            <div class="table-row font-semibold">
                <div class="table-cell text-left">Имя</div>
                <div class="table-cell text-left">Адрес</div>
            </div>
        </div>
        <div class="table-row-group">
            <div class="table-row cursor-default text-xs text-gray-500"  v-for="(warehouse, index) in warehouses" :key="warehouse.id" @click="active({action:'warehouse', id: warehouse.id})" :class="{'bg-gray-700/30': bgColor(index)}">
                <div class="table-cell text-gray-200"><div class="ml-3 my-1">{{warehouse.name}}</div></div>
                <div class="table-cell">
                    <div class="flex space-x-1">
                        <p>{{warehouse.country}},</p>
                        <p>{{warehouse.city}},</p>
                        <p>{{warehouse.street}},</p>
                        <p>{{warehouse.house_number}},</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <addItems @close="addItems = false" v-if="addItems" />
</template>
<script>
import { mapActions, mapGetters } from 'vuex';
import warehouseMenu from './menu/buttons.vue'
export default {
    components:{
        warehouseMenu,
    },

    methods:{
        ...mapActions([
            'warehousesUpdateList',
            'warehouseEditId',
            'managerWarehouseMenu'
        ]),
        active(data) {
            this.warehouseEditId(data.id)
            this.managerWarehouseMenu(data)
        },
        bgColor(index){
            let result = index % 2
            return result
        }
    },

    mounted(){
        this.warehousesUpdateList()
    },
    computed:{
        ...mapGetters([
            'warehousesList'
        ]),
        warehouses(){
            return this.warehousesList
        }
    }
}
</script>
