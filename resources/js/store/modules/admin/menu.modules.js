
const state = {
    menu :{
        window: {
            shop: false,
            order: false,
            warehouse: false,
            file: false,
            item: false,
            cities: false,
        }
    },
    shop: {
        startMenu: true,
        settingMenu: false,
        itemsList: false,
        list: true,
        addItems: false,
        create:false,
        telegram:false,
        data: false,
        contact:false,
    },
    items: {
        windowDetail: false,
        allItems: true,
        addItemsCategory: false,
        categoriesList: false,
        categoriesCreate: false,
    },
    orders:{
        details: false,
    }
}

const mutations = {
    /* mutations Window */

    updateWindowShop(state, data) {
        state.menu.window.shop = !state.menu.window.shop
    },
    updateWindowOrder(state, data) {
        state.menu.window.order = !state.menu.window.order
    },
    updateWindowWarehouse(state, data) {
        state.menu.window.warehouse = !state.menu.window.warehouse
    },
    updateWindowFail(state, data) {
        state.menu.window.fail = !state.menu.window.fail
    },
    updateWindowCities(state, data){
        state.menu.window.cities = !state.menu.window.cities
    },
    updateWindowItem(state, data) {
        state.menu.window.item = !state.menu.window.item
    },

    /* / mutations Window */

    updateItemsWindowDetail(state, status){
        state.items.windowDetail = status
    },


    /* mutations Shop */
    updateShopMenu(state, action) {
            if(action === 'start') {
                for (let component in state.shop) {
                    if(component !== "startMenu" && component !== "list"){
                        state.shop[component] = false
                    } else {
                        state.shop[component] = true
                    }
                }
            }

            if(action === 'shop') {
                for (let component in state.shop) {
                    state.shop[component] = false
                }
            }

            if(action === 'create') {
                for (let component in state.shop) {
                    if(component !== "startMenu" && component !== "create"){
                        state.shop[component] = false
                    } else {
                        state.shop[component] = true
                    }
                }
            }

            if(action === 'shopTelegram'){
                for (let component in state.shop) {
                    if(component !== "telegram"){
                        state.shop[component] = false
                    } else {
                        state.shop[component] = true
                    }
                }
            }

            if(action === 'shopData'){
                for (let component in state.shop) {
                    if(component !== "data"){
                        state.shop[component] = false
                    } else {
                        state.shop[component] = true
                    }
                }
            }

            if(action === 'shopContacts') {
                for (let component in state.shop) {
                    if(component !== "contact"){
                        state.shop[component] = false
                    } else {
                        state.shop[component] = true
                    }
                }
            }

            if(action === 'shopAddItems') {
                for (let component in state.shop) {
                    if(component !== "addItems"){
                        state.shop[component] = false
                    } else {
                        state.shop[component] = true
                    }
                }
            }

            if(action === 'shopItemsList') {
                for (let component in state.shop) {
                    if(component !== "itemsList"){
                        state.shop[component] = false
                    } else {
                        state.shop[component] = true
                    }
                }
            }
        },


    updateShopStartMenu(state, data) {
        state.shop.startMenu = data
    },
    updateShopList(state, data) {
        state.shop.list = data
    },
    updateShopCreate(state, data) {
        state.shop.settings.create = data
    },
    updateShopSettingMenu(state, data) {
        state.shop.settingMenu = data
    },
    updateShopAddItems(state, data) {
        state.shop.addItems = data
    },

    updateShopItemsList(state, data) {
        state.shop.itemsList = data
    },

    /* / mutations Shop */


    /* mutations Warehouse */
    updateWarehouseMenu(state, action) {
        if(action === 'start') {
            for (let component in state.warehouse) {
                if(component !== "startMenu" && component !== "list"){
                    state.warehouse[component] = false
                } else {
                    state.warehouse[component] = true
                }
            }
        }

        if(action === 'warehouse') {
            for (let component in state.warehouse) {
                state.warehouse[component] = false
            }
        }

        if(action === 'create') {
            for (let component in state.warehouse) {
                if(component !== "startMenu" && component !== "create"){
                    state.warehouse[component] = false
                } else {
                    state.warehouse[component] = true
                }
            }
        }

        if(action === 'itemsList') {
            for (let component in state.warehouse) {
                if(component !== "itemsList"){
                    state.warehouse[component] = false
                } else {
                    state.warehouse[component] = true
                }
            }
        }

        if(action === 'addItems') {
            for (let component in state.warehouse) {
                if(component !== "addItems"){
                    state.warehouse[component] = false
                } else {
                    state.warehouse[component] = true
                }
            }
        }
    },
    /* / mutations Warehouse */

    updateItemsMenu(state, action){

            for (let component in state.items) {
                if(component !== action){
                    state.items[component] = false
                } else {
                    state.items[component] = true
                }
            }
    },

    updateOrdersMenu(state, action){
        for (let component in state.orders) {
            if(component !== action){
                state.orders[component] = false
            } else {
                state.orders[component] = true
            }
        }
    },

    updateCategoryAddItems(state){
        state.items.addItemsCategory = true
    },

    updateOrdersDetails(state, status) {
        state.orders.details = status
    },
}

const actions = {
    /* actions Window */

    managerMenu({commit}, data){
        if(data.menu === 'shop') {
            commit('updateWindowShop', data.status)
        }
        else if (data.menu === 'order') {
            commit('updateWindowOrder', data.status)
        }
        else if (data.menu === 'warehouse') {
            commit('updateWindowWarehouse', data.status)
        }
        else if (data.menu === 'items') {
            commit('updateWindowItem', data.status)
        }
        else if (data.menu === 'file') {
            commit('updateWindowFail', data.status)
        } else if (data.menu === 'cities') {
            commit('updateWindowCities', data.status)
        } else {
            return
        }
    },

    /* / actions Window */

    menuEditStatusItemsWindowDetail({commit}, status){
        commit('updateItemsWindowDetail', status)
    },


    /* actions Shop */

    managerShopMenu({commit, getters, dispatch}, data){
        if(data.action === 'start' || data.action === 'create') {
            dispatch('shopEditId', {id: null})
        }
        commit('updateShopMenu', data.action)
    },

    /* / actions Shop */

    /* actions Shop */

    managerWarehouseMenu({commit, getters, dispatch}, data){


        if(data.action === 'start' || data.action === 'create') {
            dispatch('warehouseEditId', {id: null})
        }
        commit('updateWarehouseMenu', data.action)

        if (data.action === 'addItems' ){
            dispatch('warehouseAddItemsFromFile')
        }
    },

    managerItemsMenu({commit, getters, dispatch}, data){
        commit('updateItemsMenu', data.action)

        if(data.component === 'items') {
            if(data.to === 'addToCategory'){
                commit('updateCategoryAddItems')
            }

        }
    },


    managerOrdersMenu({commit, getters, dispatch}, data){
        if(data.window === 'details') {
            commit('updateOrdersDetails', data.status)
        } else {
            commit('updateOrdersMenu', data.action)
        }
    },

    /* / actions Shop */


}

const getters = {
    /* getters Window */

    menuStatus(state) {
        return state.menu.window
    },

    /* / getters Window */

    /* getters Window */

    menuShopStatus(state) {
        return state.shop
    },
    /* / getters Window */

    menuWarehouseStatus(state) {
        return state.warehouse
    },

    menuItemsStatus(state) {
        return state.items
    },

    menuOrdersStatus(state) {
        return state.orders
    },

}

export default {
    state,
    getters,
    actions,
    mutations,
}
