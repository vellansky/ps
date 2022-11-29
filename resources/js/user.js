import Alpine from 'alpinejs'
import axios from 'axios'
import { Button } from 'bootstrap'

window.Alpine = Alpine

Alpine.store('order', {
    window: false,
        status: false,
        id: null,
        shop: null,
        tel: null,
        url: null,
    name:{
        input: null,
        status: false,
    },
    tel:{
        input: null,
        status: false,
    },
    shop:{
        yes: null,
        status: false
    },

    inputName(name){
        this.name.input = name
    },
    inputTel(tel){
        this.tel.input = tel
    },

    check(){
        if(Boolean(this.name.input) && Boolean(this.tel.input) && Boolean(this.shop.yes)) {
            console.log('work')
            this.ok()
        }
        this.name.status = !Boolean(this.name.input)
        this.tel.status = !Boolean(this.tel.input)
        this.shop.status = !Boolean(this.shop.yes)


    },

    ok(){
        axios.post('/api/user/post/order/create', {name: this.name.input, tel: this.tel.input, shop: this.shop.yes, cart: JSON.parse(localStorage.getItem('cart'))})
        .then((res)=> {
            this.id = res.data.id
            this.shop = res.data.shop.city + ', ул. ' + res.data.shop.street + ', д. ' + res.data.shop.house_number
            this.tel = res.data.shop.telephone
            this.url = res.data.slug
            this.status = true
            localStorage.setItem('cart', JSON.stringify([]));
            Alpine.store('cart').cart.splice(0)
        })
    },
})


Alpine.store('cart', {
    init() {
        this.cart = JSON.parse(localStorage.getItem('cart')) || []
        this.sum = this.total('install')
        this.itemList = this.getList()
        //this.itemLength = this.countItemInCart('install')

    },

    sum: 0,
    cart: [],


    itemLength(){
        return this.cart.length

    },

    getList(){
        console.log('work')
        if(this.cart) {
            axios.post('/cart/items')
            .then((res) => {
                if(res.data.length > 0) {
                    console.log(res.data)
                    this.cart = res.data
                } else {
                    this.cart = []
                }
                localStorage.setItem('cart', JSON.stringify(this.cart));
                this.total()

            })

        }
    },

    removeFromCart(index) {
        let id = this.cart[index].id
        axios.post('/cart/deletes/', {id: id})
        .then(() => {
            this.cart.splice(index,1)
            this.cart.forEach((element, index) => {
            if(element.product_id === id) {
                this.cart.splice(index, 1)
                return
            }
            })
        localStorage.setItem('cart', JSON.stringify(this.cart));
        this.total()
        })
      },

      newQuantityCart(index){
            const id = this.cart[index].id
            const quantity = this.cart[index].quantity
            axios.post('/cart/quantity', {id:id, quantity: quantity})
      },

      pushInCart(product){
          console.log(product)
        axios.post('/cart/add', product)
        .then((res) => {
            if(res.data)
            {
                this.cart.push({product_id: product.product_id, quantity: 1, shop_id: product.shop_id, city_id: product.city_id})
                localStorage.setItem('cart', JSON.stringify(this.cart))
                console.log(this.cart)
            }

        })

      },
      level_button(id){
        return Boolean(this.cart.find(i => i.product_id === id))
      },
      editQuantity(id,action, place){
        const index = this.cart.findIndex(i=>i.product_id === id)

        if(action === 'plus') {
            this.cart[index].quantity++
        }
        if(action === 'minus') {
            if(this.cart[index].quantity <= 1) {
                if(place === "cart") {
                    return
                } else {
                    this.removeFromCart(index)
                    this.cart.splice(index, 1)
                }
            } else {
                this.cart[index].quantity--
            }
        }
        localStorage.setItem('cart', JSON.stringify(this.cart))
        this.total()
        this.newQuantityCart(index)

      },



      quantity(id){
        return this.cart.find(i=>i.product_id === id).quantity
      },


      detailPrice(id){
        let item = this.cart.find(i=>i.product_id === id)
        let price
        if(item.new_price) {
            price = item.quantity * item.new_price + ' ' + '₽'
        } else {
            price = item.quantity * item.price + ' ' + '₽'
        }
        return price
      },

      clearCart(){
        axios.post('/cart/clear')
        .then(() => {
            this.cart = []
            localStorage.setItem('cart', JSON.stringify(this.cart))
        })

      },
    total(action) {
        let sum = 0
        if(this.cart){
            for (let [key, value] of Object.entries( this.cart )) {
                if(value.new_price) {
                    sum = sum + (value.new_price * value.quantity)
                } else {
                    sum = sum + (value.price * value.quantity)
                }
            }
            let result = sum + ' ' + '₽'
            if(action === 'install') {
                return result
            } else {
                this.sum = result
            }
    } else {
        const result = 0 + ' ' + '₽'
        if(action === 'install') {
            return result
        } else {
            this.sum = result
        }
    }
    }
})



Alpine.magic( 'policy', () => {
    return {
    buttonPolicy(action) {
        if(action === 'no') {
            window.location.href = 'https://www.youtube.com/watch?v=LbOve_UZZ54';
        } else if (action === 'yes') {
            axios.post('/api/user/policy/ok')
            .then(() => {
                location.reload();
            })
        }

    }
}
})



Alpine.magic( 'itemSearch', () => () => {
    return {
      items: [],
      search: '',
      status:false,

      clear(){
        this.items.length=0
        this.status = false
      },

      getItemsSearch(s){
        if(!s){
            this.clear()
            return

        }
        axios.get('/api/search', { params: { s } })
        .then((res) => {
            this.status = true
            if(res.data.length > 0) {
                this.items = res.data
                console.log(this.items)
            } else {
                this.items.length=0
                this.items.push({name: 'Ничего не найдено'})
            }
        })

      }
    }
  }),



Alpine.start()


