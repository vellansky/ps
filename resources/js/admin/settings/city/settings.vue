<template>
    <div class="fixed inset-0 bg-black/80 z-10">
        <div class="absolute inset-y-0 right-0 w-2/4 py-10 px-5 bg-white z-20 space-y-5">
        <div class="relative w-full h-full">

            <div>
                <p>Вы создаете магазин</p>

            </div>
            <div class="text-sm space-y-5">
                <div>
                    <p>Название</p>
                    <input v-model="shop.name" type="text" class="w-full border pl-5 rounded text-sm placeholder:text-gray-500 placeholder:italic" placeholder="Название магазина">
                </div>
                <div>
                    <p>Город</p>
                    <input v-model="shop.city" type="text" class="w-full border pl-5 rounded text-sm placeholder:text-gray-500 placeholder:italic" placeholder="Город магазина">
                </div>
                <div>
                    <p>Телефон</p>
                    <input v-model="shop.tel" type="text" class="w-full border pl-5 rounded text-sm placeholder:text-gray-500 placeholder:italic" placeholder="Телефон для входящих">
                </div>
                <div>
                    <p>ВК</p>
                    <input v-model="shop.vk" type="text" class="w-full border pl-5 rounded text-sm placeholder:text-gray-500 placeholder:italic" placeholder="Ссылка на ВК">
                </div>
                </div>
            </div>
            <div class="absolute flex flex-nowrap items-center justify-items-center px-5 inset-x-0 bottom-5 text-sm gap-x-10">
                <button @click="close" class="w-full py-2 bg-black rounded text-white">Закрыть</button>
                <button v-if="updateTrue" class="w-full py-2 bg-green-500 rounded text-white">Добавить магазин</button>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    data(){
        return{
            shop:{
                name: null,
                city: null,
                tel: null,
                vk: null,
            },
            updateTrue: false
        }
    },
    methods:{
        close(){
            this.$emit('close')
        },
    },
    updated(){
        console.log('work')
        this.updateTrue = true
    },
}
</script>
