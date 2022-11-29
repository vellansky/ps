<template>
    <div class="fixed inset-0 flex items-center justify-center bg-black/60">
        <div :class="{ 'max-h-screen': dataFromFile, 'h-2/4': !dataFromFile }" class="relative w-4/5 bg-white rounded-lg">
            <div v-if="dataFromFile" class="w-full mt-5 pl-5 space-x-5 py-5">
                <button @click="importProducts()" class="px-3 py-1 bg-green-400 text-white rounded-lg text-sm">Загрузить товары в магазин</button>
                <button @click="clear()" class="px-3 py-1 bg-gray-300 rounded-lg text-xs">Стереть таблицу</button>
            </div>
            <div v-if="!dataFromFile" class="absolute top-5 right-5">
                <button @click="close()" class="px-3 py-1 bg-gray-300 rounded-lg text-xs">Закрыть</button>
            </div>
            <section :class="{ 'max-h-screen': dataFromFile, 'h-full': !dataFromFile }" class="flex flex-col items-center justify-center w-full">
                <div v-if="!dataFromFile" class="flex flex-col gap-y-5">
                    <p class="text-gray-600 text-sm font-semibold">Для начала загрузите файл</p>
                    <button @click="addFile(file)" class="px-3 py-1 bg-black text-white rounded">Выбрать файл</button>
                </div>
            

                <div v-if="dataFromFile" :class="{'blur-sm':importStatus}" class="w-full h-full p-5 overflow-auto">
                    <table class="my-10 text-sm w-max">
                        <thead>
                        <tr>
                            <th scope="col" class=" pr-2 text-left">Товар</th>
                            <th scope="col" class="w-max pr-2 text-left">ШК товара</th>
                            <th scope="col" class="w-max pr-2 text-left">Город</th>
                            <th scope="col" class="w-max pr-2 text-left">Кол-во (отклонение)</th>
                            <th scope="col" class="w-max pr-2 text-left">Розничная цена</th>
                            <th scope="col" class="w-max pr-2 text-left">Описание</th>
                        </tr>
                        </thead>
                        <tbody>

                        <row v-for="(row, index) in dataFromFile" :key="index"
                            v-model:name="row['Товар']"
                            v-model:code="row['ШК товара']"
                            v-model:city="row['Город']"
                            v-model:quantity="row['Кол-во (отклонение)']"
                            v-model:price="row['Розничная цена']"
                            v-model:description="row['Описание']"/>

                        </tbody>
                    </table>
                </div>
            </section>
        </div>
    </div>
</template>
<script>
import { mapActions, mapGetters } from 'vuex';
import parseXlsx from 'browser-xlsx-parser'
import row from './rowImport.vue'
export default {
    components:{
        row
    },
    data(){
        return {
            dataFromFile: null,
        }
    },
    methods:{
        ...mapActions([
            'adminProductImport',
            'adminUpdateImportSuccess'
        ]),
        close(){
            this.dataFromFile = null
            this.$emit('close')
            this.adminUpdateImportSuccess(false)
        },


        clear(){
            this.dataFromFile = null
            this.adminUpdateImportSuccess(false)
        },
        addFile() {
            parseXlsx().then(json => {
              this.dataFromFile = json
            })
        },
        importProducts(){
            let products = this.dataFromFile
            this.adminProductImport(products)
        }
    },
    computed:{
        ...mapGetters([
            'adminImportStatus'
        ]),
        importStatus(){
            return this.adminImportStatus
        }
    },
}
</script>
