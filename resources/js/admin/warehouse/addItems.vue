<template>
    <div class="relative">
        <button @click="saveItems">Сохранить</button>
        <div class="table text-sm w-full">
            <div class="table-header-group">
                <div class="table-row font-semibold">
                    <div class="table-cell text-left">Имя</div>
                    <div class="table-cell text-left">Штрих код</div>
                    <div class="table-cell text-left">Количество</div>
                    <div class="table-cell text-left">Цена за шт.</div>
                    <div class="table-cell text-left">Описание</div>
                </div>
            </div>
            <div class="table-row-group">
                <div v-for="(row, index) in itemsFromFile" :key="index" :class="{'bg-gray-700/30': index % 2}" class="table-row cursor-default text-xs text-gray-500">
                    <div class="table-cell">{{row['Товар']}}</div>
                    <div class="table-cell">{{row['ШК товара']}}</div>
                    <div class="table-cell text-center">{{ сhekQuantity(row['Кол-во (отклонение)']) }}</div>
                    <div class="table-cell text-center">{{row['Розничная цена']}}</div>
                    <div class="table-cell">{{row['Описание']}}</div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import { mapActions, mapGetters } from 'vuex';
import parseXlsx from 'browser-xlsx-parser'
import row from './upload/rowImport.vue'
export default {
    components:{
        row
    },
    data(){
        return {
            fullWindow: false,
            dataFromFile: null,
        }
    },
    methods:{
        ...mapActions([
            'warehouseItemImport',
        ]),
        saveItems(){
            this.warehouseItemImport()
        },
        сhekQuantity(quantity){
            const q = Math.sign(quantity)
            if(q === -1 || q === 0){
                return 0
            } else {

                return Math.trunc(quantity)
            }
        },
        close(){
            this.dataFromFile = null
            this.$emit('close')
        },

        clear(){
            this.dataFromFile = null
        },
        importProducts(){
            let products = this.dataFromFile
            this.warehouseItemImport(products)
        },
    },
    computed:{
        ...mapGetters([
            'warehouseItemsFromFile'
        ]),
        itemsFromFile(){
            return this.warehouseItemsFromFile
        },
    },
}
</script>
