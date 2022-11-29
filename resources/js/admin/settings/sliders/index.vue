<template>
    <div class="space-y-8">
        <div class="w-full">
            <h5 class="text-gray-500 uppercase">Настройки слайдера на главной</h5>
        </div>
        <div class="text-sm">
            <button class="bg-green-500 text-white rounded-full py-1 px-10 ">Добавить в слайдер</button>
        </div>

        <div>
            <h6 class="text-gray-500 uppercase text-sm">Элементы:</h6>
            <div class="relative my-8 text-sm">
                <adminSettingsItemSlider v-for="(slider, index) in sliders" :key="index"
                    :id="slider.id"
                    :index="index"
                    :name="slider.name"
                    :path="slider.img.path"
                    v-model:link="slider.link"
                    :statusSlider="slider.status" />
            </div>
        </div>
    </div>
</template>
<script>
import adminSettingsItemSlider from './item.vue';
import { mapActions, mapGetters } from 'vuex';

export default {
    components:{
        adminSettingsItemSlider
    },
    mounted() {
       this.adminUpdateSlider
    },
    computed:{
        ...mapActions([
            'adminUpdateSlider'
        ]),
        ...mapGetters([
            'adminGetSlider'
        ]),
        sliders(){
            return this.adminGetSlider
        }
    }
}
</script>
