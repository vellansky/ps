<template>
    <div class="fixed inset-0 bg-black/60 max-h-screen">
        <div class="absolute inset-y-0 right-0 w-1/3 bg-white overflow-auto">
            <div class="relative w-full h-1/3 bg-gray-500">
                <div class="absolute inset-x-0 bottom-2 flex justify-end px-5">
                    <input class="hidden" type="file" id="file" ref="file" v-on:change="handleFileUpload()" />
                    <button v-if="!photo" @click="upload()" class="bg-black/50 border border-white text-white rounded-full px-3 py-1 text-xs">Изменить фото</button>
                    <button v-if="photo" class="bg-black/80 border text-white rounded-full w-full py-1 text-xs" v-on:click="uploadPhoto()">Обновить фото</button>
                </div>
                <img class="object-cover object-center w-full h-full block" :src="product.photo.path" :alt="product.photo.name">
            </div>
                <div class="px-5 text-sm space-y-5 mt-5 mb-10">
                    <div>
                        <p>Имя</p>
                        <input @input="updateProductName" type="text" class="border border-gray-300 w-full pl-4 py-1 rounded" :value="product.name">
                    </div>
                    <div>
                        <p>Код</p>
                        <input @input="updateProductCode"  type="text" class="border border-gray-300 w-full pl-4 py-1 rounded" :value="product.code">
                    </div>
                    <div>
                        <p>Цена</p>
                        <input @input="updateProductPrice" type="text" class="border border-gray-300 w-full pl-4 py-1 rounded" :value="product.price">
                    </div>
                    <div>
                        <p>Количество</p>
                        <input @input="updateProductQuantity" type="text" class="border border-gray-300 w-full pl-4 py-1 rounded" :value="product.quantity">
                    </div>
                    <div>
                        <p>Выбранная категория</p>
                        <div class="relative">
                            <div @click="categoryEdit = !categoryEdit" class="flex flex-nowrap items-center gap-x-3 cursor-pointer">
                                <div class="w-2 h-2 bg-green-400 rounded-full"></div>
                                <p v-for="(category,index) in product.category" :key="index" class="py-1">{{category.name}}</p>
                            </div>
                            <div v-if="categoryEdit" class="absolute right-5 flex flex-col items-end bg-black text-white p-4 rounded">
                                <p>Выберите категорию</p>
                                <button @click="selectCategory(category.id)" v-for="(category,index) in categories" :key="index" class="py-1 border-b">{{category.name}}</button>
                            </div>
                        </div>
                    </div>
                    <div>
                        <p>Город</p>
                        <input @input="updateProductCity" type="text" class="border border-gray-300 w-full pl-4 py-1 rounded" :value="product.city">
                    </div>
                    <div>
                        <p>Описание</p>
                        <textarea @input="updateProductDescription" class="border border-gray-300 w-full rounded pl-3" :value="product.description" />
                        
                    </div>
                    
                
                </div>
                

                <div class="inset-x-0 bottom-0 px-5 pb-2 space-y-4">
                    <button @click="update()" class="w-full py-2 bg-green-500 rounded text-white">Сохранить</button>
                    <button @click="close" class="w-full py-2 bg-black rounded text-white">Закрыть</button>
                </div>
        </div>

    </div>
</template>
<script>
import { mapActions, mapGetters } from 'vuex';
export default {
    data(){
        return {
            categoryEdit: false,
            btnEditIMG: false,
            photo: null,
        }
    },

    methods:{
        ...mapActions([
            'adminUpdateProductName',
            'adminUpdateProductCode',
            'adminUpdateProductPrice',
            'adminUpdateProductQuantity',
            'adminUpdateProductCity',
            'adminUpdateProductDescription',
            'adminUpdateProduct',
            'adminUploadPhotoProduct',
            'adminSelectProductCategory'
        ]),
        update(){
            this.adminUpdateProduct()
        },
        close(){
            this.$emit('close')
        },
        upload() {
             document.getElementById("file").click();
         },
        handleFileUpload() {
            this.photo = this.$refs.file.files[0];
        },
        uploadPhoto() {
            this.adminUploadPhotoProduct(this.photo)
            this.photo = null
            
        },
        selectCategory(category){
            this.adminSelectProductCategory(category)
            this.categoryEdit = false
        },



        updateProductName (e) {
            this.adminUpdateProductName(e.target.value)
        },
        updateProductCode (e) {
            this.adminUpdateProductCode(e.target.value)
        },
        updateProductPrice (e) {
            this.adminUpdateProductPrice(e.target.value)
        },
        updateProductQuantity (e) {
            this.adminUpdateProductQuantity(e.target.value)
        },
        updateProductCity (e) {
            this.adminUpdateProductCity(e.target.value)
        },
        updateProductDescription (e) {
            this.adminUpdateProductDescription(e.target.value)
        }
    },
    computed: {
        ...mapGetters([
            'adminGetProduct',
            'adminCategories'
        ]),
        product(){
            return this.adminGetProduct
        },
        categories(){
            return this.adminCategories
        }
    }
}
</script>
