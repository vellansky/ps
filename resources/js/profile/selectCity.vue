<template>
    <div v-if="selectCity" class="fixed inset-0 flex flex-col items-center justify-center bg-black/60 z-50">
        <div class="relative w-screen h-screen md:w-4/6 md:h-4/6 bg-white rounded p-10">
            <div @click="close()" class="absolute top-5 right-5 border border-black rounded-full px-2 cursor-pointer">X</div>
            <h3 class="py-5">Выберите город</h3>
            <div class="w-full flex flex-col">
                <button @click="myCity('Юрга')" class="border border-black mb-5 py-5 bg-gradient-to-r hover:from-pink-500  hover:to-yellow-500 hover:text-white rounded font-semibold uppercase" type="">Юрга</button>
                <button @click="myCity('Томск')" class="border border-black mb-5 py-5 bg-gradient-to-r hover:from-pink-500  hover:to-yellow-500 hover:text-white rounded font-semibold uppercase" type="">Томск</button>
            </div>
        </div>

    </div>
</template>
<script>
import {mapAction, mapActions, mapGetters} from 'vuex';
export default {
    methods:{
        ...mapActions([
            'profileUpdateCity',
            'profileUpdateSelectCity'
        ]),
        myCity(city){
            this.profileUpdateCity(city)
            this.close()
        },
        close(){
            this.profileUpdateSelectCity()
        },
    },
    computed:{
        ...mapGetters([
            'profileGetSelectCityStatus'
        ]),
        selectCity(){
            return this.profileGetSelectCityStatus
        }
    }
}
</script>
