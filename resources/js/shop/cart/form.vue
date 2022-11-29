<template>
<div class="bg-gradient-to-r from-green-400 to-blue-500 hover:from-pink-500 hover:to-yellow-500 rounded-lg">
  <div class="p-5">
    <h5 class="text-xl font-extrabold uppercase text-white mb-5">И так</h5>
    <div class="my-4 text-base">
      <h5>
        Товары: <span class="text-sm">{{ cartProductLenght }}</span>
      </h5>
      <h5>
        Сумма к оплате: <span class="text-sm">{{ cartSumTotal }}</span>
      </h5>
    </div>
    <div class="space-y-5">
      <div>
        <label class="text-sm font-extrabold uppercase text-white mb-5" for="name"
          >Имя</label
        >
        <input
          type="text"
          id="name"
          name="name"
          v-model="name"
          class="border border-gray-400 rounded h-10 w-full px-5"
        />
      </div>
      <div>
        <label class="text-sm font-extrabold uppercase text-white mb-5" for="phone"
          >Номер телефона</label
        >
        <input
          type="tel"
          id="phone"
          name="phone"
          v-model="phoneNumber"
          pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}"
          required
          class="border border-gray-400 rounded h-10 w-full px-5"
        />
      </div>
      <div>
        <label class="text-sm font-extrabold uppercase text-white mb-5" for="address"
          >Адрес доставки</label
        >
        <input
          type="address"
          id="address"
          name="address"
          v-model="address"
          class="border border-gray-400 rounded h-10 w-full px-5"
        />
      </div>
      <button @click="addOrder()" class="block w-full py-3 rounded bg-black text-white">
        Заказать
      </button>
    </div>
  </div>
  <information v-if="thanksU"/>
</div>
</template>
<script>
import { mapActions, mapGetters } from "vuex";
import information from './components/orderInformation.vue';
export default {
    components:{
        information
    },

  methods: {
      ...mapActions([
          'cartPostOrder'
      ]),
      addOrder() {
      this.cartPostOrder()
    },

      filterName(str) {
      return str.replace(/(^|\s)\S/g, function (a) {
        return a.toUpperCase();
      });
    },
    filterPhone(str) {
      return str.replace(/[^0-9]/g, "");
    },
  },
  computed: {
    ...mapGetters([
        'cartGetProducts',
        'cartGetLenght',
        'profileGetCustomer',
        'profileGetThanksStatus'
    ]),
    thanksU(){
        return this.profileGetThanksStatus
    },
    cartProductLenght() {
      return this.cartGetLenght;
    },
    cart() {
      return this.cartGetProducts;
    },

    cartSumTotal() {
      let sumTotal = this.cart.reduce((acc, item) => acc + item.price * item.quantity, 0);
      return new Intl.NumberFormat().format(sumTotal) + " руб.";
    },

    name: {
      get() {
        var name = this.profileGetCustomer.name;
        if (name) return this.filterName(name);
        return name;
      },
      set(value) {
        this.$store.commit("updateName", value);
      },
    },
    phoneNumber: {
      get() {
        var phoneNumber = this.profileGetCustomer.phoneNumber;
        if (phoneNumber) return this.filterPhone(phoneNumber);
        return phoneNumber;
      },
      set(value) {
        this.$store.commit("updatePhoneNumber", value);
      },
    },
    address: {
      get() {
        return this.profileGetCustomer.address;
      },
      set(value) {
        this.$store.commit("updateAddress", value);
      },
    },
  },
};
</script>
