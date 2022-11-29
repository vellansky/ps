<template>
<div class="flex flex-col gap-y-5">
    <div class="w-full space-x-5">
        <input v-model="category" class="border border-gray-400 pl-3 py-1 rounded placeholder:text-gray-400 placeholder:text-sm w-2/4" placeholder="Введите название категории" type="text">
        <button @click="createCategory()" class="px-2 py-1 rounded bg-black text-white">Создать категорию</button>
    </div>
    <div>
        <h5 class="font-bold text-lg my-4">Список созданных категорий</h5>
        <div class="flex flex-col gap-y-4">
            <div v-for="category in categories" :key="category.id" class="flex flex-nowrap gap-x-10 border-b">
                <p class="px-2">{{category.name}}</p>
            </div>
        </div>
    </div>
</div>
<notification v-if="notification" />
</template>
<script>
import notification from "../notification/seccsas.vue";
import { mapActions, mapGetters } from 'vuex';
export default {
    components:{
        notification
    },
    data(){
        return {
            category: null
        }
    },
    methods:{
        ...mapActions([
            'adminUpdateCategories'
        ]),
        createCategory(){
            this.adminUpdateCategories(this.category)
        }
    },
    mounted() {
        this.adminGetCategories
    },
    computed:{
        ...mapActions([
            'adminGetCategories'
        ]),
        ...mapGetters([
            'adminCategories',
            'adminNotification'
        ]),
        categories(){
            return this.adminCategories
        },
        notification(){
            return this.adminNotification
        }
    }
}
</script>
