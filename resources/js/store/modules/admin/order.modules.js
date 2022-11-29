const state = {
    windows:{
        details: false,
    },
    order:{
        id: null,
        details: {},
        list: [],
    }
}
const getters = {
    orderList(state){
      return state.order.list
    },
    orderDetails(state){
        return state.windows.details
    },
    orderData(state){
        return state.order.details
    },
}
const actions = {

    //получить все заказы
    orders({commit}){
        axios.get('/api/get/admin/order/list')
            .then((res) => {
                commit('updateOrderlist', res.data)
            })
    },

    //изменить статус у заказа
    orderEditStatus({commit}, data){
        commit('editStatus', data)
    },

    orderId({commit}, data){
        commit('updateOrderId', data.id)
    },
    orderDetails({commit}, data){
        axios.get('/api/get/admin/order/detail', { params: { id: data.id } })
            .then(res => {
                commit('updateOrderDetail', res.data)
                commit('orderOpenDetails', true)
            })
    },
    orderCloseDetails({commit}){
        commit('orderOpenDetails', false)
    },
    getOrderListFromBD({commit}){
        axios.get('/api/get/admin/order/list')
            .then(res => {
                commit('updateOrderlist', res.data)
            })
    },
}
const mutations = {

    editStatus(state, data) {
        state.order.list.find(order => order.id === data.id).status = data.status
        state.order.details.status = data.status
    },

    orderOpenDetails(state, s) {
        state.windows.details = s
    },
    updateOrderId(state, id) {
        state.order.id = id
    },
    updateOrderlist(state, list) {
        state.order.list = list
    },
    updateOrderDetail(state, data) {
        state.order.details = data
    },
}

export default {
    state,
    getters,
    actions,
    mutations,
}
