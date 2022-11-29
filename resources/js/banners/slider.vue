<template>
    <div class="w-full h-full relative flex items-center">
        <a target="_blank" v-for="(slider, index) in slider" :class="{hidden: index != indexSlider}" :key="index" class="absolute object-fill object-center w-full h-full rounded-lg z-10 cursor-pointer" :href="slider.link">
            <img :src="slider.img.path" class="object-cover object-center w-full h-full block">
        </a>
        <div v-if="lenght>1" class="w-full z-20 flex flex-nowrap items-center justify-between text-white mx-10">
            <div @click="back()" class="cursor-pointer font-black uppercase text-yellow-400">сюда</div>
            <div @click="next()" class="cursor-pointer font-black uppercase text-yellow-400">туда</div>
        </div>
        <div v-if="lenght>1" class="absolute inset-x-0 bottom-3 z-20 flex flex-nowrap gap-x-2 items-center justify-center">
            <div v-for="(nav, index) in slider" :key="index" @click="select(index)" :class="{'bg-gray-500/50': index == indexSlider}" class="rounded-full bg-yellow-400 border border-black w-3 h-3 cursor-pointer">
            </div>
        </div>

    </div>
    
</template>
<script>
export default {
    props:['slider'],
    data(){
        return{
            indexSlider: 0,
        }
    },
    methods:{
        select(index){
            this.indexSlider = index
        },
        next(){
            let lenght = this.lenght
            if(lenght > 1){
                lenght--
                if(lenght != this.indexSlider) {
                    this.indexSlider++
                } else {
                    this.indexSlider = 0
                }
                
            } else {
                this.indexSlider = 0
            } 
        },
        back(){
            let lenght = this.lenght-1
            if(this.indexSlider == 0){
                this.indexSlider = lenght
            } else {
                this.indexSlider--
            }
        }
    },
    computed: {
        colorNav(){

        },
        slider(){
            return this.slider
        },
        lenght(){
            return this.slider.length
        }
    }
}
</script>
