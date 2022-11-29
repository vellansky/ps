<template>
    <div v-if="!addStatus">
        <div @click="selectIndex = index" v-for="(category, index) in categories" :key="index" :class="{'bg-gray-700/30': index % 2}" class="flex flex-col cursor-default w-full">
                    <div class="flex justify-between items-center px-5">
                        <div>
                            <input v-if="selectIndex === index" v-model="category.name" class="bg-transparent w-full pl-2">
                            <p v-else class="pl-2">{{category.name}}</p>
                        </div>
                        <div class="flex space-x-2 text-xs">
                            <div @click="addToCategory(category)">Добавить товары</div>
                        </div>
                    </div>
        </div>
    </div>
    <keep-alive v-else>
    <add
         :id="category.id"
        :name="category.name"
    />
    </keep-alive>
</template>

<script>
import {mapActions, mapGetters} from "vuex";
import add from "./addToCategory"
export default {
    components: {
        add,
    },
    data(){
        return {
            selectIndex: null,
            categoryId: null,
            category:{
                id:null,
                name: null,
                i: [],
            }
        }
    },
    methods:{
        ...mapActions([
            'itemsGetCategoryList',
            'managerItemsMenu',
            'itemsGetList'
        ]),

        addToCategory(category){
            let menu = {component:'items', action: 'categoriesList', to: 'addToCategory'}
            this.category.id = category.id
            this.category.name = category.name
            this.itemsGetList()
            this.managerItemsMenu(menu)

        },
    },
    mounted() {
        this.itemsGetCategoryList()
    },
    computed:{
        ...mapGetters([
            'itemsCategoriesList',
            'menuItemsStatus',
        ]),
        categories: {
            get() {
                return this.itemsCategoriesList
            },
            set() {

            }
        },
        addStatus(){
            return this.menuItemsStatus.addItemsCategory
        },
    }
}
</script>
