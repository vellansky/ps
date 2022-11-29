
<template>
        <div class="table text-sm w-full">
            <div class="table-header-group mb-5">
                <div class="table-row font-semibold">
                    <div class="table-cell text-left w-5"><div class="h-3 w-3 rounded-full border-0 bg-gray-700/50"></div></div>
                    <div class="table-cell text-left">Имя</div>
                    <div class="table-cell text-left w-12">Цена</div>
                    <div class="table-cell text-left ">Цена со скидкой</div>
                    <div class="table-cell text-left">Количество в магазине</div>
                </div>
            </div>
            <div class="table-row-group ">
                <div @click="selectIndex = index" class="table-row cursor-default text-xs text-gray-500 " v-for="(item, index) in shopItemsList" :key="item.id" :class="{'bg-gray-700/30': index % 2}">
                    <div class=" relative table-cell">
                        <input @click="editStatus(item)"  @mouseenter="suggestHideElement = index" @mouseleave="suggestHideElement = null" type="checkbox" class="h-3 w-3 rounded-full border-0 bg-gray-700/50 checked:bg-gray-700/30" v-model="item.status">
                        <div v-if="index === suggestHideElement" class="absolute left-5 bg-white text-black px-2 rounded">{{textHideElement(item)}}</div>
                    </div>
                    <div class="table-cell text-gray-200">
                        <p>{{item.name}}</p>
                    </div>
                    <div class="table-cell text-gray-200">
                        <input  class="bg-transparent w-full" v-model="item.price">
                    </div>
                    <div class="table-cell text-gray-200">
                        <input  class="bg-transparent w-full" v-model="item.new_price">
                    </div>
                    <div class="table-cell text-gray-200">
                        <input class="bg-transparent w-full" v-model="item.quantity">
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
            suggestHideElement: null,
            selectIndex: null,
            editQuantity: [],
        }
    },
    methods:{
        ...mapActions([
            'shopGetItemsList',
            'itemsPostNewStatus'
        ]),
        editStatus(item){
            this.itemsPostNewStatus(item)
        },
        selectRow(item, index){
            this.selectIndex = index
            this.editQuantity.push(item.id)
        },
        textHideElement(status){
            return 'Скрыть товар'

        },
    },

    mounted() {
        this.shopGetItemsList()
    },
    computed:{
        ...mapGetters([
            'shopGetItems'
        ]),
        shopItemsList(){
            return this.shopGetItems
        }
    }
}
</script>
