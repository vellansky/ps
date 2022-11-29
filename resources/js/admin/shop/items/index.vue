<template>
    <div v-if="!fileStatus" class="table text-sm w-full z-30">
        <div class="table-header-group">
            <div class="table-row font-semibold">
                <div class="table-cell text-left">Имя</div>
                <div class="table-cell text-left">Количество</div>
                <div class="table-cell text-left">Цена</div>
            </div>
        </div>
        <div class="table-row-group">
            <div @click="check()"  v-for="(input, index) in count" :key="index" :class="{'bg-gray-700/30': index % 2}" class="table-row cursor-default text-xs text-gray-500">
                <div class="table-cell">
                    <div class="flex items-center space-x-2">
                        <input :class="ifEmp({index: index, position: 'left'})" class="w-full pl-3 py-1 bg-transparent cursor-default" v-model="newItems[index].name">
                    </div>
                </div>
                <div class="table-cell">
                    <div class="flex items-center space-x-2">
                        <input :class="ifEmp({index: index, position: 'middle'})" class="w-full pl-3 py-1 bg-transparent cursor-default" v-model="newItems[index].quantity">
                    </div>
                </div>
                <div class="table-cell">
                    <div class="flex items-center space-x-2">
                       <input :class="ifEmp({index: index, position: 'right'})" class="w-full pl-3 py-1 bg-transparent cursor-default" v-model="newItems[index].price">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div v-else class="table text-sm w-full z-30">
        <div class="table-header-group">
            <div class="table-row font-semibold">
                <div class="table-cell text-left">Имя</div>
                <div class="table-cell text-left">Штрих код</div>
                <div class="table-cell text-left">Количество</div>
                <div class="table-cell text-left">Цена</div>
            </div>
        </div>
        <div class="table-row-group">
            <div @click="check()"  v-for="(input, index) in count" :key="index" :class="{'bg-gray-700/30': index % 2}" class="table-row cursor-default text-xs text-gray-500">
                <div class="table-cell">
                    <div class="flex items-center space-x-2">
                        <input class="w-full pl-3 py-1 bg-transparent cursor-default" v-model="input['Товар']">
                    </div>
                </div>
                <div class="table-cell">
                    <div class="flex items-center space-x-2">
                        <input class="w-full pl-3 py-1 bg-transparent cursor-default" v-model="input['ШК товара']">
                    </div>
                </div>
                <div class="table-cell">
                    <div class="flex items-center space-x-2">
                        <input class="w-full pl-3 py-1 bg-transparent cursor-default" v-model="input['Кол-во (отклонение)']">
                    </div>
                </div>
                <div class="table-cell">
                    <div class="flex items-center space-x-2">
                        <input class="w-full pl-3 py-1 bg-transparent cursor-default" v-model="input['Розничная цена']">
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
            selectIndex: null,
            file: false,
            newItem:
                [{
                    id: null,
                    name: null,
                    quantity: null,
                    price: null,
                }]
            ,
            newItems: [],
        }
    },
    methods:{
        ...mapActions([
            'itemsCategoryCreate'
        ]),

        editStatusFile(status){
            this.file = status
        },
        del(index){
            this.newItems.splice(index, 1)
        },
        ifEmp(data){
            let chekIndex = data.index + 1
            const chekInput = this.newItems[chekIndex]
            if(!chekInput) {
                if(data.position === 'left') {
                    return {'border-l border-y rounded-l': true}
                }
                if(data.position === 'middle') {
                    return {'border-y': true}
                }
                if(data.position === 'right') {
                    return {'border-r border-y rounded-r': true}
                }
            }
        },
        check(){
            if(this.newItems.length < 1) {
                this.newItems.push({name: null, quantity: null, price: null})
            } else {
                let filter = this.newItems.filter(items => items.name !== null && items.name !== '' && items.name !== ' ')
                this.newItems.splice(0)
                this.newItems = filter
                this.newItems.push({name: null, quantity: null, price: null})
            }

        },
    },
    mounted() {
        this.check()
    },

    deactivated(){

    },
    computed:{
        ...mapGetters([
            'shopGetImport'
        ]),
        count(){
            if(this.shopGetImport.length > 0) {
                return this.shopGetImport
            } else {
                return this.newItems
            }
        },
        fileStatus(){
            if(this.shopGetImport.length > 0) {
                return true
            } else {
                return false
            }
        },
    }
}
</script>

