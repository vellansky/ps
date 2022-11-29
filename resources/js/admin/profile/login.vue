<template>
  <div class="flex flex-col gap-y-5 w-2/4 rounded bg-white text-black border-2 border-black text-sm p-10">
    <h3 class="uppercase text-gray-700 font-semibold text-lg">Ты хочешь войти?</h3>
    <div>
      <p class="uppercase">E-e-e-e-e-e-e-e-e-maaail (емейл)</p>
      <input
        class="bg-white border border-gray-300 text-black pl-3 rounded w-full h-10"
        v-model="login"
      />
    </div>
    <div>
      <p class="uppercase">PassssssWORD (пароль - на горшке сидел король)</p>
      <input
        class="bg-white border border-gray-300 text-black pl-3 rounded w-full h-10"
        type="password"
        v-model="password"
      />
    </div>
    <button @click="enterInPapasmoke()" class="w-full py-3 bg-blue-500 uppercase text-white rounded">Кнопочка</button>
  </div>
  <notification v-if="notif" />
</template>
<script>
import notification from '../notification/error.vue'
export default {
  components:{
    notification
  },
    data(){
        return{
            notif: false,
            login: null,
            password: null,
        }
    },
    methods:{
      error(){
        this.notif = true
        this.password = null
        setTimeout(() => { this.notif = false }, 2000)
      },

        enterInPapasmoke(){
            axios.post('/auth', {email: this.login, password: this.password})
            .then(() => {
                location="/admin/products";
            })
            .catch(() => {
              this.error()
            })
        }
    }
}
</script>
