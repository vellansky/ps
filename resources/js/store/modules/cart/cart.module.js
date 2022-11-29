const state = {
  cart: [],
  order: [],
  orderi: [],
};

const mutations = {
  addToCart(state, product) {
    /*
        let indexProductInCart = state.cart.findIndex(item => item.id === product.id);

        if (indexProductInCart !== -1) {
            state.cart[indexProductInCart].quantity++;
            return;
        } else {
            let productFoCart = _.clone(product, true);
            productFoCart.quantity = 1;
            state.cart.push(productFoCart);
        }
        */
  },
  cartPushProduct(state, product) {
    const q = { quantity: 1 };
    let itemForCart = Object.assign({}, product, q);
    state.cart.push(itemForCart);
  },
  updateAddQuantity(state, id) {
    state.cart.find((product) => product.id === id).quantity++;
  },
  updateRemoveQuantity(state, id) {
    let product = state.cart.find((product) => product.id === id)
    if(product.quantity > 1) {
        product.quantity--
    } else {
      let index = state.cart.findIndex(
        (product) => product.id === id);
        state.cart.splice(index, 1);
    }
  },
  cartRemoveQuantity(state, param) {
    let product = state.cart.find(
      (item) => item.id === param || item.slug === param
    );
    if (product.quantity > 1) {
      product.quantity--;
    } else {
      let index = state.cart.findIndex(
        (item) => item.id === param || item.slug === param
      );
      state.cart.splice(index, 1);
    }
  },
  cartMakeEmpty(state) {
    state.cart.splice(0);
  },
  updateRemoveProduct(state, id) {
    const index = state.cart.findIndex((item) => item.id === id);
    state.cart.splice(index, 1);
  },
  removeFromCart(state, id) {
    let index = state.cart.findIndex((item) => item.id === id);
    console.log(index);
    state.cart.splice(index, 1);
  },
  /*
    shopRemoveQuantity(state,product) {
        let indexProductInCart = state.cart.findIndex(item => item.id === product.id);
        let quantityProductInCart = state.cart[indexProductInCart].quantity;
        if (quantityProductInCart > 1) {
            state.cart[indexProductInCart].quantity--;
        } else {
            state.cart.splice(indexProductInCart,1);
        }

    },
*/

  addOrderInfo(state, index) {
    state.orderi = index;
  },

  updateOrder(state, order) {
    state.order = order;
  },
  updateCart(state, cart) {
    state.cart = cart;
  },

  updateOrders(state, orders) {
    state.orders = orders;
  },
};

const actions = {
  cartRemoveProduct({ state, commit, getters, dispatch }, data) {
    const quant = getters.cartGetProductQuantity(data.id);
    dispatch("shopAddRemoteQuantityFromCart", { quantity: quant, id: data.id });
    commit("cartRemoveProduct", data);
  },

  cartAddProduct({ commit, getters }, id) {
    let product = getters.shopGetProduct(id)
    commit("cartPushProduct", product);
  },
  cartAddProductQuantity({ commit }, id) {
    commit("updateAddQuantity", id);
  },
  cartRemoveProductQuantity({ commit }, id) {
    commit("updateRemoveQuantity", id);
  },
  cartRemoveProduct({ commit }, id){
    commit('updateRemoveProduct', id)
  },
  clearCart({ commit }) {
    commit("updateCart", []);
  },

  cartMakeEmpty({ commit }) {
    commit("cartMakeEmpty");
  },

  getOrders({ commit }) {
    /*
        axios.get("/api/orders").then((responce) => {
            commit('updateOrders', responce.data);
        });*/
  },
  cartPostOrder({ commit, state, getters, dispatch }) {
      axios.post("/api/admin/order/add", {
          name: getters.profileGetCustomer.name,
          phoneNumber: getters.profileGetCustomer.phoneNumber,
          address: getters.profileGetCustomer.address,
          order: state.cart,
        })
        .then((res) => {
          //commit("profileUpdateLastOrder", res.data.idOrderCustomer);
          commit("cartMakeEmpty");
          dispatch('profileUpdateThankStatus')
          dispatch('profileUpdateOrderIdFromServer', res.data)
        });

    /*
            
           api.post("/order", {
                name: getters.profileGetCustomer.name,
                phoneNumber: getters.profileGetCustomer.phoneNumber,
                address: getters.profileGetCustomer.address,
                order: state.cart
           }).then ((res) =>{
               console.log('ok')
           })*/
  },
};

const getters = {
  cartGetLenght(state) {
    return state.cart.length;
  },
  cartGetProduct: (state) => (id) => {
    return state.cart.find((product) => product.id === id)
  },
  cartGetProducts(state) {
    return state.cart;
  },
  cartGetLenght(state) {
    return state.cart.length;
  },
  cartGetProductList(state) {
    return state.cart;
  },
  cartGetProductQuantity: (state) => (id) => {
    try {
      return state.cart.find((item) => item.id === id).quantity;
    } catch {
      return 0;
    }
  },
  cartGetProductId(state) {
    try {
      let productId = state.cart.map((productId) => productId.id);
      return productId;
    } catch {
      return 0;
    }
  },
  cartGetProductInf: (state) => (id) => {
    return state.cart.find((item) => item.id === id);
  },
};

export default {
  state,
  getters,
  actions,
  mutations,
};
