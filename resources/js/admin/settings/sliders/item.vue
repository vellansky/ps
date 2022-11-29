<template>
  <div class="relative rounded bg-gray-50 mt-10 p-10 border" :class="{'border-yellow-300': edit}">
      <button @click="updateSlider()" v-if="edit" class="absolute top-5 right-5 bg-black text-white px-6 py-1 rounded-full">Сохранить</button>
    <div class="flex flex-nowrap items-center gap-x-2">
      <div :class="{'bg-red-400': !statusSlider}" class="w-2 h-2 bg-green-400 rounded-full"></div>
      <p class="text-xs uppercase text-gray-500">{{ statusText() }}</p>
    </div>
    <div class="flex flex-col gap-4 my-5">
      <div>
        <img :src="path" class="w-40" />
          <input class="hidden" type="file" id="file" ref="file" v-on:change="handleFileUpload()" />
          <button @click="clickImgSlider()" :class="{'bg-white text-black': imgSlider, 'bg-black text-white': !imgSlider}" class="my-3 border  rounded py-1 px-3 text-xs">{{buttonImgText}}</button>
      </div>
      <div class="flex flex-nowrap items-center gap-x-4">
        <p>Ссылка:</p>
        <input
          type="text"
          :value="link"
          @input="$emit('update:link', $event.target.value)"
          class="border-0 bg-white/0 border-b w-full text-gray-800 font-extralight"
        />
      </div>
    </div>
    <div class="border rounded py-2 px-5 flex flex-nowrap justify-between">
      <div class="flex flex-nowrap gap-x-3 text-sm text-gray-800 space-x-5">
        <button @click="editStatus(statusSlider = !statusSlider)" :class="{'bg-green-400': !statusSlider}" class="px-3 bg-black text-white rounded">{{textEditStatus()}}</button>
      </div>
      <div>
        <button type="">Удалить</button>
      </div>
    </div>
  </div>
</template>
<script>
import { mapActions } from 'vuex';

export default {
    props: ["id","index", "name", "path", "link", "statusSlider"],
    emits: ['update:statusSlider', 'update:link'],
  data() {
    return {
      buttonImgSliderText: null,
      imgSlider: null,
      edit: false,
    };
  },
  methods: {
    ...mapActions([
      'adminEditInfSlider',
      'adminSliderEditStatus'
    ]),
    clickImgSlider(){
      document.getElementById("file").click();
    },
    updateSlider(){
      let data = {
          inf:{
            id: this.id,
            name: this.name,
            path: this.path,
            link: this.link
          },
          file: this.imgSlider
        }
        this.adminEditInfSlider({data})
        this.imgSlider = null
        this.edit = false
        console.log(this.edit)
    },

    handleFileUpload(){
      this.imgSlider = this.$refs.file.files[0];
    },


    status() {
      if (this.statusSlider) {
        return "Активен";
      } else {
        return "Не активен";
      }
    },
    editStatus(status){
      const slider = {id: this.id, status: status}
      this.adminSliderEditStatus(slider)
    },
    textEditStatus(){
      if(this.statusSlider) {
        return 'Выключить'
      } else {
        return 'Включить'
      }
    },
    statusText() {
      if (this.statusSlider) {
        return "Этот элемент виден пользователям";
      } else {
        return "Этот элемент не виден пользователям";
      }
    },
  },
  updated() {
    this.edit = true;
  },
  computed: {
    buttonImgText(){
      if(this.imgSlider) {
        return 'Изменить изображение'
      } else {
        return 'Выбрать изображение'
      }
    }
  }
};
</script>
