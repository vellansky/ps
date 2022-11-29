import { result } from "lodash"

const state = {
    items: []
}

const mutations = {
    editItems(state, items) {
        state.items.push(items)
        console.log('ok')
    },
    editItemQuantity(state, index, q) {
        state.items[index].quantity = q
    },
    userShopProductQMinus(state, index) {
        state.items[index].quantity--
    },
    userShopProductQPlus(state, index) {
        state.items[index].quantity++
    }
}

const getters = {
    userShopGetItems(state){
        return state.items
    },
    userShopGetItemID: (state) => (data) => {
        if(data.action === 'id'){
            return state.items.find(item => item.id === data.id)
        } else if(data.action === 'index') {
            return state.items.findIndex(item => item.id === data.id)
        }
    },
    userShopGetItemIDQuantity: (state) => (id) => {
        if(id) {
            const userShopProduct = state.items.find(p => p.id === id)
            console.log(state.items)
            if(!userShopProduct) {
                return false
            } else {
                return userShopProduct.quantity
            }
        }
    }
}

const actions = {
    userShopUpdateItems({commit, getters}, item){
        console.log()
        if(getters.userShopGetItemID(item.id) !== undefined) {
            return
        } else {
            const itemInCart = getters.cartProductQuantity(item.id)
            if(itemInCart === 0) {
                commit('editItems', item)
            } else {
                const result = item.quantity - itemInCart
                item.quantity = result
                commit('editItems', item)
            }
        }
    },

    userShopEditQuantity({commit,getters}, data){
        if(data.action === 'minus') {
            commit('userShopProductQMinus', getters.userShopGetItemID({action: 'index', id: data.id}))
        } else if(data.action === 'plus') {
            commit('userShopProductQPlus', getters.userShopGetItemID({action: 'index', id: data.id}))
        }
    }
}

export default {
    state,
    getters,
    actions,
    mutations,
};