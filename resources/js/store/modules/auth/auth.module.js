const state = {
  user: {
    login: null,
    role: null,
    access_token: null,
    token_type: null,
  },
};

const mutations = {
  updateUser(state, user) {
    state.user.login = "in";
    state.user.role = "admin";
    state.user.access_token = user.access_token;
    state.user.token_type = user.token_type;
  },

  exitUser(state, index) {
    (state.user.login = null),
      (state.user.role = null),
      (state.user.access_token = null),
      (state.user.token_type = null);
  },
};

const actions = {
  openAdminMenu({ commit }) {
    commit("settingAdminMenu");
  },
  auth: ({ commit }, user) => {
    commit("updateUser", user);
  },
  exitUser({ commit }) {
    commit("exitUser");
  },
};
const getters = {};

export default {
  state,
  getters,
  actions,
  mutations,
};
