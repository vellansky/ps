<template>
    <div class="table text-sm w-full z-30">
        <div class="table-header-group">
            <div class="table-row font-semibold">
                <div class="table-cell text-left">Имя категории</div>
            </div>
        </div>
        <div class="table-row-group">
            <div v-for="(input, index) in count" :key="index" :class="{'bg-gray-700/30': index % 2}" class="table-row cursor-default text-xs text-gray-500">
                <div class="table-cell">
                    <div class="flex items-center space-x-2">
                        <div @click="del(index)">X</div><input @click="addCategory(index)" :class="ifEmp(index)" class="w-full pl-3 py-1 bg-transparent cursor-default" v-model="category[index]">
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import {mapActions} from "vuex";

export default {
    data(){
        return {
            category: [],
        }
    },
    methods:{
        ...mapActions([
            'itemsCategoryCreate'
        ]),
        del(index){
            this.category.splice(index, 1)
        },
        ifEmp(index){
            if(!this.category[index]) {
                console.log('work 2')
                return {'border rounded': true}
            }
        },
        addCategory(index){
            let clear = this.category.filter((cat) => cat !== '' && cat !== null && cat !== ' ')
            this.category.splice(0)
            this.category = clear
            let count = this.category.length
            count++
            this.category[count] = ''

        },
    },
    deactivated(){
        let arr = this.category.filter((cat) => cat !== '' && cat !== ' ' && cat !== null)
        if(arr.length) {
            this.itemsCategoryCreate(arr)
            this.category.splice(0)
        } else {
            return
        }

    },
    computed:{
        count(){
            let arr = this.category.filter((cat) => cat !== '')
            let count = arr.length
            if(count === 0){
                return 1
            } else {
                return count+1
            }
        },
    }
}
</script>

