const state = {
  activeIndexProduct: null,
  menu: {
    status: true,
  },
};

const mutations = {
  updateMenuStatus(state) {
    state.menu.status = !state.menu.status;
  },
  updateActiveIndexProduct(state, id) {
    state.activeIndexProduct = id
  }
};

const getters = {
  settingGetMenuStatus: (state) => {
    return state.menu.status;
  },
  settingGetActiveIndexProduct: (state) => {
    return state.activeIndexProduct
  }
};

const actions = {
  settingActiveMenu({ commit }) {
    console.log("work");
    commit("updateMenuStatus");
  },
  settingUpdateActiveIndexProduct({ commit }, id) {

    commit("settingUpdateActiveIndexProduct", id);
  },
};

export default {
  state,
  actions,
  getters,
  mutations,
};
