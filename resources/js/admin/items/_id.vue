<template>
    <div :class="{'w-full h-full': full, 'w-1/6 h-full': !full}" class="absolute inset-y-0 right-0 bg-black/30 backdrop-blur-md w-1/4 text-gray-300 cursor-default space-y-3 overflow-y-auto z-50">
        <div class="flex flex-nowrap space-x-2 items-center ml-3 my-5">
            <div @click="close({action: false})" class="w-3 h-3 rounded-full bg-red-400 cursor-pointer"></div>
            <div @click="full = !full" class="w-3 h-3 rounded-full bg-green-500 cursor-pointer"></div>
        </div>
        <div class="space-y-5 w-full p-5">
            <div @click="upload()" @mouseenter="uploadImg = true" @mouseleave="uploadImg = false" :class="{'w-40 h-40': full, 'w-full h-1/4': !full}" class=" cursor-default relative">
                <img :src="itemsDetails.images.url" :alt="itemsDetails.images.name" class="object-cover object-center w-full h-full block rounded-lg">
                <div v-if="uploadImg" class="absolute inset-x-0 bottom-0 text-xs bg-white/70 text-black rounded-xl shadow-lg shadow-white/50 text-center">
                    <p class="w-full">Новое фото</p>
                </div>
                <input class="hidden" type="file" id="file" ref="file" v-on:change="handleFileUpload()" />
            </div>
            <button v-if="photo" class="text-blue-400 hover:text-blue-300 font-light tracking-wide" v-on:click="uploadPhoto()">Обновить фото</button>
            <div class="space-y-1 ">
                <p class="font-medium uppercase tracking-wide text-xs">ШК Товара</p>
                <input :class="{'w-1/2': full}" class="bg-gray-700 py-1 pl-3 rounded-lg" v-model="itemsDetails.code">
            </div>
            <div class="space-y-1 ">
                <p class="font-medium uppercase tracking-wide text-xs">Имя</p>
                <input :class="{'w-1/2': full}" class="bg-gray-700 py-1 pl-3 rounded-lg" v-model="itemsDetails.name">
            </div>

            <div class="space-y-1 ">
                <p class="font-medium uppercase tracking-wide text-xs">Описание</p>
                <textarea :class="{'w-full': full}" class="bg-gray-700 py-1 pl-3 rounded-lg" v-model="itemsDetails.description"></textarea>
            </div>
            <div class="space-y-1 cursor-default">
                <p class="font-medium uppercase tracking-wide text-xs">Категории</p>
                <div class="flex flex-wrap gap-x-2 gap-y-3 select-none">
                    <div v-for="(category, index) in categories" :key="index">
                        <div class="flex flex-nowrape items-center space-x-2 max-w-min truncate bg-white text-black px-3 text-xs rounded-full">
                            <span @click="delCategory(category.id)">x</span>
                            <p>{{category.name}}</p>
                        </div>
                    </div>
                </div>
                <div class="">
                    <p @click="catList = !catList">Выбрать категории</p>
                    <div v-if="catList" class="p-2 bg-gray-700/50 text-white rounded">
                        <div v-for="(category, index) in itemsCategoriesList" :key="index" @click="addCategory(category)" class="w-full text-xs select-none">
                            <p>{{ category.name }}</p>
                        </div>
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
            currentId: null,
            catList: false,
            newCategory: [],
            full: false,
            photo: null,
            uploadImg: false,
        }
    },
    methods:{
        ...mapActions([
            'menuEditStatusItemsWindowDetail',
            'itemUploadPhotoProduct',
            'itemSave',
            'itemsGetCategoryList',
            'itemsAddCategory'
        ]),
        close(status){
          this.menuEditStatusItemsWindowDetail(status.action)
        },
        delCategory(id){
            let category = this.itemsDetails.categories.find(c => c.id === id)
            category['status'] = 'del'
        },
        addCategory(cat){
            const find = this.itemsDetails.categories.find(c => c.id === cat.id)

            if(find){
                if(find.status === 'del') {
                    find.status = 'add'
                } else {
                    return
                }
            } else {
                cat['product_id'] = this.itemsDetails.id
                cat['status'] = 'add'
                this.itemsDetails.categories.push(cat)
            }
        },

        handleFileUpload() {
            this.photo = this.$refs.file.files[0];
        },
        uploadPhoto() {
            this.itemUploadPhotoProduct(this.photo)

        },
        upload() {
            document.getElementById("file").click();
        },
    },
    mounted() {
        this.currentId = this.itemsDetails.id
        this.itemsGetCategoryList()
    },
    updated(){
        if(this.currentId !== this.itemsDetails.id) {
            if (this.newCategory.length) {
                this.itemsAddCategory(this.newCategory)
                this.newCategory.splice(0)
            }
        }

    },
    deactivated(){
        this.itemSave()
        if(this.newCategory.length){
            this.itemsAddCategory()
            this.newCategory.splice(0)
        }

    },
    computed:{
        ...mapGetters([
            'itemsDetails',
            'itemsCategoriesList'
        ]),
        categories(){
            let c = this.itemsDetails.categories.filter(category => {
                if(category.status !== 'del'){
                    return category
                }
            })
            return c
        }
    },
}
</script>

