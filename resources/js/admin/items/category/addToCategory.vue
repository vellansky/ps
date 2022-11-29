<template>
    <div>
        <h5 @click="select()" class="cursor-default select-none">{{name}}</h5>
        <div @click="select(item.id)" v-for="(item, index) in items" :key="item.id" :class="bgColor(item.id, index)" class="flex flex-col cursor-default text-xs text-gray-500 w-full">
            <div class="flex items-center space-x-2">
                <div class="w-1/2">
                    <p class="select-none">{{item.name}}</p>
                </div>
                <div>
                    <p>{{item.code}}</p>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import {mapActions, mapGetters} from "vuex";

export default {
    props:['id','name'],
    data(){
        return {
            category:{
                id:null,
                name: null,
                i: [],
            }
        }
    },
    methods:{
        ...mapActions([
            'itemsGetList',
            'itemsCreateCategoryItems'
        ]),
        bgColor(id, index){
            let itemIn = this.category.i.find((item) => item === id);
            if(!itemIn) {
                return {'bg-gray-700/30': index % 2}
            } else {
                return {'bg-blue-700 text-white': true}
            }

        },
        select(id){
            if(!id){
                if(!this.category.i.length){
                    let items = this.items.map(item => item.id)
                    this.category.i = items
                } else {
                    this.category.i.splice(0)
                }
            } else {
                let findItem = this.category.i.findIndex((item) => item === id);
                if(findItem === -1){
                    this.category.i.push(id)

                } else {
                    this.category.i.splice(findItem, 1)
                }
            }
        },
    },
    mounted() {
        this.itemsGetList()
    },
    deactivated(){
        if(!this.category.i.length) {
            return
        } else {
            this.itemsCreateCategoryItems({caregoryId: this.id, items: this.category.i})
        }

    },
    computed:{
        ...mapGetters([
            'itemsList'
        ]),
        items(){
            return this.itemsList
        },
    }
}
</script>
