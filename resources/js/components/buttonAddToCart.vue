<template>
  <div
    :class="{ 'flex flex-nowrap gap-x-1 items-center': cartProduct }"
    class="w-full"
  >
    <div>
      <button
        @click="cartPushProduct()"
        :class="{
          'bg-green-500 w-max px-3': cartProduct,
          'bg-teal-500 w-full': !cartProduct,
          'bg-gray-400 cursor-not-allowed': notAvailable,
        }"
        class="w-full py-2 rounded uppercase font-semibold text-white text-xs"
      >
        {{ buttonText }}
      </button>
    </div>
    <div v-if="cartProduct" class="flex items-center justify-around w-full">
      <button
        @click="cartRemoveQuantity()"
        class="px-2 py-1 font-bold text-sm rounded bg-black text-white"
      >
        -
      </button>
      <div class="px-1 space-x-1">
        <span class="text-xs text-center">{{ cartProduct.quantity }}</span
        ><span class="text-xs">шт.</span>
      </div>
      <button
        @click="cartAddQuantity()"
        class="px-2 py-1 font-bold text-sm rounded bg-black text-white"
      >
        +
      </button>
    </div>
  </div>
</template>
<script>
import { mapActions, mapGetters, mapMutations } from "vuex";
export default {
    props:['product'],
  data(){
      return {
          buttonText: null,
          notAvailable: false,
          quantity: this.product.quantity,
      }
  },
  methods:{
      ...mapActions([
          'cartAddProduct',
          'cartAddProductQuantity',
          'cartRemoveProductQuantity',
          'shopAddToProductList'
      ]),
        updateProductsList(){
            this.shopAddToProductList(this.product)
        },


      cartRemoveQuantity(){
            this.cartRemoveProductQuantity(this.product.id)
            this.quantity++
      },
      cartAddQuantity(){
          if(this.quantity <= 0){
              return
          } else {
            this.cartAddProductQuantity(this.product.id)
            this.quantity--
          }
       
      },
      cartPushProduct(){
          if(this.quantity <= 0) {
              return
          } else {
              if(this.cartProduct){
                  this.cartAddQuantity()
              } else {
                this.cartAddProduct(this.product.id)
                this.quantity--
              }
          }
      },
      newQuantity(){
            if(this.cartProduct){
            const newQuantity = this.quantity-this.cartProduct.quantity
            console.log(newQuantity)
            this.quantity = newQuantity
          } 
      },
      check(){
          if(this.quantity > 0) {
              this.notAvailable = false
            if(this.cartProduct){
                this.buttonText = 'в корзине'
            } else {
                this.buttonText = 'добавить в корзину'
            }
          } else {
              this.buttonText = 'нет в наличии'
              this.notAvailable = true
          }
      }
  },
  updated(){
      this.check()
  },
  mounted() {
      this.updateProductsList()
      this.newQuantity()
      this.check()
      
      
  },

  computed:{
      ...mapGetters([
          'cartGetProduct',
          'getCart'
      ]),
      
      cartProduct(){
          return this.cartGetProduct(this.product.id)
      },
  }
};
</script>
