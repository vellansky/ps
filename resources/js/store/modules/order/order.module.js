const state = {
  orders: [],
  selectOrderId: null,
};
const mutations = {
  updateOrderStatus(state, order) {
    let orderIndex = state.orders.findIndex((item) => item.id === order.id);
    state.orders[orderIndex].status = "Закрыто";
    return;
  },
  updateOrders(state, orders) {
    state.orders = orders;
  },
  updateSelectOrderId(state, id) {
    state.selectOrderId = id;
  },
};

const actions = {
  ordersUpdate({ commit }) {
    axios.get("/api/admin/orders").then((responce) => {
        commit("updateOrders", responce.data);
    });
  },
  ordersUpdateSelectOrderId({ commit }, id) {
    commit('updateSelectOrderId', id)
  }
};

const getters = {
  ordersGet: (state) => {
    return state.orders
  },
  ordersSelectOrderId: (state) => {
    return state.selectOrderId
  },
  ordersGetId: (state, getters) => {
    return state.orders.find((order) => order.id === getters.ordersSelectOrderId);
  },
};
export default {
  state,
  actions,
  mutations,
  getters,
};
