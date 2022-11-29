<template>
    <div class="space-y-10">
        <h5 class="text-gray-500 uppercase">Управление магазинами</h5>
        <div>
            <button @click="create = !create" class="bg-black text-white px-5 py-1 rounded-full">Создать магазин</button>
        </div>
        <div>
            <h6>Магазины</h6>
            <div class="flex flex-nowrap gap-10">
                <div class="p-10 border text-sm rounded">
                    <p>Название</p>
                    <p>Адресс</p>
                    <p>Телефон</p>
                    <p>VK</p>
                    <p>inst</p>
                </div>
            </div>
        </div>
        <div>
            <h6>Города присутствия:</h6>
            <div class="flex flex-nowrape gap-10 text-sm">
                <div class="flex items-center justify-items-center p-10 border rounded uppercase">
                    <p>Юрга</p>
                </div>
                <div class="flex items-center justify-items-center p-10 border rounded uppercase">
                    <p>Томск</p>
                </div>
            </div>
        </div>
     <shopCreate @close="create = false"  v-if="create" />
    </div>
</template>
<script>
import shopCreate from './settings.vue'
export default {
    components:{
        shopCreate
    },
    data(){
        return{
            create: false
        }
    },
    methods:{
    }
}
</script>
