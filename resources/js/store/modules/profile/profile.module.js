import axios from "axios";

const state = {
  customer: {
    city: "Юрга",
    name: null,
    phoneNumber: null,
    address: null,
    lastOrder: null,
    orders: [],
  },
  thanks: false,
  orderIdFromServer: null,
  selectCity: true,
};
const mutations = {
  updateThankStatus(state) {
    state.thanks = !state.thanks;
  },
  updateSelectCity(state) {
    state.selectCity = !state.selectCity;
  },
  updateOrderIdFromServer(state, id) {
    state.orderIdFromServer = id;
  },
  updateCity(state, city) {
    state.customer.city = city;
  },
  updateName(state, name) {
    state.customer.name = name;
  },
  updatePhoneNumber(state, phoneNumber) {
    state.customer.phoneNumber = phoneNumber;
  },
  updateAddress(state, address) {
    state.customer.address = address;
  },
  profileUpdateLastOrder(state, serverIdOrder) {
    state.customer.lastOrder = serverIdOrder;
  },
  updateOrders(state, order) {
    let itemForOrders = Object.assign({}, order);
    console.log(itemForOrders);
    state.customer.orders.push(itemForOrders);
  },
};
const getters = {
  profileGetThanksStatus(state) {
    return state.thanks;
  },
  profileGetSelectCityStatus(state) {
    return state.selectCity;
  },
  profileGetOrderIdFromServer(state) {
    return state.orderIdFromServer;
  },
  profileGetCustomer(state) {
    return state.customer;
  },
  profileGetCity(state) {
    return state.customer.city;
  },
  profileGetOrders(state) {
    return state.customer.orders;
  },
  profileGetLastOrder(state) {
    return state.customer.lastOrder;
  },
};
const actions = {
  profileUpdateOrders({ commit, getters }) {
    let cart = getters.getCart;
    commit("updateOrders", cart);
    commit("cartMakeEmpty");
  },
  profileUpdateCity({ commit, dispatch }, city) {
    dispatch('prodifuleCookieCityUpdate', city)
    commit("updateCity", city);
  },
  prodifuleCookieCityUpdate({ commit }, city) {
    axios.post('/api/cookie/set/city', {city: city})
    .then(() => {
        //location.reload()
        console.log('work')
    })
  },
  profileUpdateSelectCity({ commit }) {
    commit("updateSelectCity");
  },
  profileUpdateThankStatus({ commit }) {
    commit("updateThankStatus");
  },
  profileUpdateOrderIdFromServer({ commit }, id) {
    commit("updateOrderIdFromServer", id);
  },
  profileUpdateLastOrder({ commit }, serverIdOrder) {
    commit("profileUpdateLastOrder", serverIdOrder);
  },
};

export default {
  state,
  mutations,
  actions,
  getters,
};
