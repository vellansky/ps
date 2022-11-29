<template>
    <section class="z-50">
        <button @click="windowCity = true" class="py-5 px-10">
            {{city.name}}
        </button>
        <div v-if="windowCity" class="fixed inset-0 bg-black/50 flex items-center justify-center z-50">
            <div class="relative w-2/3 h-2/3 bg-white rounded-xl z-50 p-10 mt-10">
                <div @click="windowCity = false" class="absolute top-5 right-5 w-7 h-7 cursor-pointer select-none flex items-center justify-center rounded-full border">x</div>
                <span class="font-bold text-xl select-none">Выбрать город</span>
                <div class="flex flex-col gap-y-2 mt-5">
                    <button v-for="one in list" :key="one.id" @click="selectCity(one.id)" class="text-left py-1 pl-3">
                        {{one.name}}
                    </button>
                </div>

            </div>

        </div>
</section>
</template>
<script>
export default {
    props:['city'],
    data(){
        return {
            windowCity: false,
            list: [],
        }
    },
    created(){
        axios.get('/user/city/list', { params: { id: this.city.id } })
        .then((res) => {
            this.windowCity = res.data.status
            this.list = res.data.list
        })
    },
    methods:{
        selectCity(id){
            axios.post('/user/city', {id: id})
            .then(()=>{
                location.reload()
            })
        },
    },

}
</script>
