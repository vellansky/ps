import axios from "axios";
import parseXlsx from 'browser-xlsx-parser'
import {commit} from "lodash/seq";

const state = {
    id: null,
    list: [],
    items: [],
    edit: {
        items: [],
    },
    warehouseItems: [],

    itemsFromFile: [],

}

const mutations = {
    updateWarehouseId(state, id){
        state.id = id;
    },
    updateWarehouseslist(state, warehouses) {
        state.list = warehouses;
    },
    updateWarehouseItems(state, data) {
        state.items = data
    },

    updateWarehouseItemsFromFile(state, data) {
        state.itemsFromFile = data
    },

    updateWarehouseEditItems(state, id) {
        state.edit.items.push(id)
    },

}

const actions = {
    warehouseEditId({commit}, id){
        commit('updateWarehouseId', id)
    },

    //Товары для сохранения
    warehouseEditItems({commit}, product){
        commit('updateWarehouseEditItems', product)
    },
    //Сохранить товары которые были изменены
    warehouseEditItemsSave({commit, getters}){
        axios.post('/api/post/admin/warehouse/items/edit', getters.warehouseGetProductForEdit)
            .then((res) => {
                commit('adminNotificationSuccses', res.data)
                setTimeout(function () {
                    commit('adminNotificationSuccses')
                }, 3000);
            })
    },

    warehousesUpdateList: ({ commit }) => {
        axios.get("/api/admin/get/warehouses")
            .then((res) => {
                commit('updateWarehouseslist', res.data)
            })
    },
    warehouseItemsUpdate: ({ commit, getters }) => {
        axios.get("/api/get/admin/warehouse/items/list", {params: {id: getters.warehouseId}})
            .then((res) => {
                commit('updateWarehouseItems', res.data)
            })
    },
    //Создать склад
    warehouseCreate: ({ commit }, data) => {
        axios.post('/api/post/admin/warehouse/create' , data)
            .then((res) => {
                commit('adminNotificationSuccses', res.data)
                setTimeout(function () {
                    commit('adminNotificationSuccses')
                }, 3000);
            })
    },

    //Импорт товаров на склад
    warehouseItemImport: ({ commit, getters }, products) => {
        const warehouseId = getters.warehouseId
        const importItems = getters.warehouseItemsFromFile
        console.log(warehouseId)
        axios.post("/api/post/admin/warehouse/items/import", {items: importItems, warehouseId: warehouseId })
            .then((res) => {
                commit('adminNotificationSuccses', res.data)
                commit('updateImportSuccess', true)
                setTimeout(function () {
                    commit('adminNotificationSuccses', false)
                }, 3000);
            });
    },

    //Добавить товары из файла
    warehouseAddItemsFromFile({commit}){
        parseXlsx()
            .then(json => {
                commit('updateWarehouseItemsFromFile', json)
        })
    },
}

const getters = {
    warehouseGetProductForEdit(state){
        let items = []
        for (let [key, id] of Object.entries(state.edit.items)) {
            let p = state.items.find((products) => products.id === id)
            items.push(p)
        }
        return items
    },

    warehouseId(state) {
        return state.id
    },
    warehousesList(state) {
        return state.list
    },

    warehouseItems(state) {
        return state.items
    },

    warehouseItemsFromFile(state) {
        const items = state.itemsFromFile
        const result = items.filter(item => item['Товар'] && item['ШК товара']);
        return result
    },
}

export default {
    state,
    getters,
    actions,
    mutations,
}
