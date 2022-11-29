<template>
    <div class="table text-sm w-full text-gray-300">
        <div class="table-header-group">
            <div class="table-row font-semibold">
                <div class="table-cell text-left">Товар</div>
            </div>
        </div>
        <div class="table-row-group">
            <div @click="getProduct({action: true , id: item.id})" v-for="(item, index) in items" :key="item.id" :class="{'bg-gray-700/30': index % 2}" class="table-row cursor-default">
                <div class="table-cell">{{item.name}}</div>
            </div>
        </div>
    </div>
</template>

<script>
import {mapActions, mapGetters} from "vuex";
import item from "./_item";
export default {
    components:{
        item
    },
    data(){
        return {
            activeIndex: null,
        }
    },
    methods:{
        ...mapActions([
            'itemsGetList',
            'menuEditStatusItemsWindowDetail',
            'itemId'
        ]),
        getProduct(data){
            this.menuEditStatusItemsWindowDetail(data.action)
            this.itemId(data.id)
            //откыть окно с товаром
            //получить данные товара
        },
    },
    mounted() {
            this.itemsGetList()
    },
    computed:{
        ...mapGetters([
           'itemsList',

        ]),
        items(){
            return this.itemsList
        },

    }
}
</script>

