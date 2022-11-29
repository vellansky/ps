
const state = {
  inputSearch: null,
  products: [],
};

const mutations = {
  updateProducts(state, product) {
    state.products.push(product)
  }
};

const getters = {
    shopGetProduct: (state) => (id) => {
      return state.products.find((product) => product.id === id)
    }
};

const actions = {
  shopAddToProductList({commit}, product){
    commit('updateProducts', product)
  }
};
export default {
  state,
  getters,
  actions,
  mutations,
};
