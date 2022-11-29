import axios from "axios";
import parseXlsx from 'browser-xlsx-parser'
const state = {
    id: null,
    list: [],
    items: [],
    subscriber: {
        token: null,
    },
    bot: {
        status: false,
    },
    import: {
        file: [],
    },
}

const mutations = {

    uploadImportFile(state, data) {
        state.import.file = data
    },

    updateShopId(state, id) {
        state.id = id
    },

    updateItems(state, data) {
        state.items = data
    },

    updateSubscriberToken(state, token) {
        state.subscriber.token = token
    },

    updateShopBotStatus(state, status) {
        state.bot.status = status
    },

}

const actions = {

    //Добавить товары из файла
    shopAddItemsFromFile({commit}){
        parseXlsx()
            .then(json => {

                json.forEach(function(element) {
                        if (Math.sign(element['Кол-во (отклонение)']) < 1) {
                            return element['Кол-во (отклонение)'] = 0
                        } else {
                            element['Кол-во (отклонение)'] = Math.trunc(element['Кол-во (отклонение)'])
                        }
                    });
                console.log(json)
                commit('uploadImportFile', json)
            })
    },

    //Создать магазин
    shopCreate: ({ commit }, data) => {
        axios.post('/api/post/admin/shop/create' , data)
            .then((res) => {
                commit('adminNotificationSuccses', res.data)
                setTimeout(function () {
                    commit('adminNotificationSuccses')
                }, 3000);
            })
    },

    //Изменить имя магазина
    shopEditName({commit, getters}, name) {
        const id = getters.shopGetId
        axios.post('/api/post/admin/shop/edit/data', {id: id,name: name})
            .then((res) => {
                commit('adminNotificationSuccses', res.data)
                setTimeout(function () {
                    commit('adminNotificationSuccses')
                }, 3000);
            })
    },

    //Изменить контакты магазина
    shopEditConact({commit, getters}, data){
        const id = getters.shopGetId
        axios.post('/api/post/admin/shop/edit/contact', {id: id, data})
            .then((res) => {
                commit('adminNotificationSuccses', res.data)
                setTimeout(function () {
                    commit('adminNotificationSuccses')
                }, 3000);
            })
    },

    //Создать подписчика магазина в телеграм
    shopCreateSub({commit, getters}, data){
        const id = getters.shopGetId
        axios.post('/api/post/admin/shop/notification/telegram/subscriber/add', {id: id, data})
            .then((res) => {
                commit('updateSubscriberToke', res.data.token)
                commit('adminNotificationSuccses', res.data.text)
                setTimeout(function () {
                    commit('adminNotificationSuccses')
                }, 3000);

            })
    },
    //Очистить токен подписчика
    shopSubTokenClear({commit}, data){
        commit('updateSubscriberToke', null)
    },

    //Сохранить токен бота
    shopSaveBotToken({commit, getters}, data){
        const id = getters.shopGetId
        axios.post('/api/post/admin/shop/notification/telegram/bot/key', {id: id, data})
            .then((res) => {
                commit('updateShopBotStatus', res.data.bot)
                commit('adminNotificationSuccses', res.data.text)
                setTimeout(function () {
                    commit('adminNotificationSuccses')
                }, 3000);

            })
    },

    shopEditId({commit}, id){
        commit('updateShopId', id)
    },

    shopUpdateItems({commit, getters}){
        axios.post('/api/get/admin/shop/item/list', {id: getters.shopGetId})
            .then((res) => {
                commit('updateItems', res.data)
            })
    },

    //Создать товары со склада в магазин
    shopUploadItems({commit, getters}, items){
        let id = getters.shopGetId
        axios.post('/api/post/admin/shop/item/add', {items: items, shopId: id})
            .then((res) => {
                console.log(res.data)
                commit('adminNotificationSuccses', res.data)
                setTimeout(function () {
                    commit('adminNotificationSuccses', false)
                }, 3000);
            })
    },

    //Загрузить товары с БД в магазин
    shopGetItemsList({commit, getters}){
        let id = getters.shopGetId
        axios.get('/api/get/admin/shop/item/list', { params: { id: id } })
            .then((res) => {
                commit('updateItems', res.data)
            })
    },

    //Узнать статус бота в магазине
    shopGetStatusBot({commit, getters}){
        let id = getters.shopGetId
        axios.get('/api/post/admin/shop/notification/telegram/bot/status', { params: { id: id } })
            .then((res) => {
                commit('updateShopBotStatus', Boolean(res.data))
            })
    }

}

const getters = {
    shopGetId(state){
        return state.id
    },

    shopGetImport(state){
        let items = state.import.file.filter(item => item['Товар'] && item['ШК товара'] && item['Товар'] !== '' && item['Товар'] !== ' ' && item['Товар'] !== null && item['ШК товара'] !== '' && item['ШК товара'] !== ' ' && item['ШК товара'] !== null)
        return items
    },

    shopGetItems(state) {
        return state.items
    },

    shopStatusBot(state) {
        return state.bot.status
    },

    subscriberToken(state) {
        return state.subscriber.token
    },

}

export default {
    state,
    getters,
    actions,
    mutations,
}
