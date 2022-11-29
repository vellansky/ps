<template>
    <div class="w-full">
        <div class="mb-5">
            <div class="w-full border-b flex space-x-5 items-center py-5">
                <div @mouseenter="menuText.select = true" @mouseleave="menuText.select = false" class="relative text-xs">
                    <div @click="selectAll()" class="flex flex-col items-center space-y-2 ">
                        <div class="w-3 h-3 bg-blue-700 rounded-full"></div>
                    </div>
                    <p v-if="menuText.select" class="absolute px-2 bg-gray-700/30 rounded">{{selectText}}</p>
                </div>
                <div @mouseenter="menuText.count = true" @mouseleave="menuText.count = false">
                    {{countInShop}}
                    <p class="absolute px-2 bg-gray-700/30 rounded" v-if="menuText.count">Выбрано товаров</p>
                </div>
                <button @click="stepToShop = !stepToShop" class="border py-1 px-4 rounded">{{textStep}}</button>
                <button v-if="stepToShop" @click="upload()" class="bg-sky-800/50 py-1 px-4 rounded">Загрузить</button>
            </div>
        </div>

        <div class="overflow-y-auto h-52">
            <div class="table text-sm w-full ">
                <div class="table-header-group mb-5">
                    <div class="table-row font-semibold">
                        <div class="table-cell text-left">Имя</div>
                    </div>
                </div>
                <div class="table-row-group ">
                    <div class="table-row cursor-default text-xs text-gray-500 " v-for="(item, index) in items" :key="item.id" :class="{'bg-blue-700': rowBg(item.id)}"  @click="addItemToShop(item, index)">
                        <div class="table-cell text-gray-200">
                            {{item.name}}
                        </div>

                    </div>
                </div>
            </div>
        </div>

    </div>
</template>

<script>
import {mapActions, mapGetters} from "vuex";
import row from "./row";
export default {
    components:{
        row,
    },
    data(){
        return {
            menuText: {
                select: false,
                count: false
            },
            stepToShop: false,
            indexIn: [],
            inShopProduct: [],
        }
    },
    methods: {
        ...mapActions([
            'shopUploadItems'
        ]),
        addItemToShop(item, index){

                const id = item.id

                let indexFind = this.inShopProduct.findIndex((i) => i.id === id);
                if (indexFind === -1) {
                    this.inShopProduct.push(item)
                } else {
                    this.inShopProduct.splice(indexFind, 1);
                }
        },
        selectAll(){
            if(!this.inShopProduct.length)
                for(let item of this.items) {
                    this.inShopProduct.push(item)
                }
            else {
                this.inShopProduct.splice(0);
            }
        },
        rowBg(id){
            let indexFind = this.inShopProduct.findIndex((i) => i.id === id);
            if(indexFind === -1){
                return false
            } else {
                return true
            }
        },
        upload(){
            this.shopUploadItems(this.inShopProduct)

        },
    },
    computed:{
        ...mapGetters([
            'warehouseItems'
        ]),
        countInShop(){
            return this.inShopProduct.length
        },
        items(){
            if (!this.stepToShop) {
                return this.warehouseItems
            } else {
                return this.inShopProduct
            }
        },
        textStep(){
            if(!this.stepToShop) {
                return 'Проверить'
            } else {
                return 'Назад'
            }
        },
        selectText(){
            if (!this.inShopProduct.length) {
                return 'Выделить все'
            } else {
                return 'Снять все выделения'
            }
        }
    }
}
</script>

