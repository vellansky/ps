import axios from "axios";

const state = {
    menu:{
        shop: {
            id: null,
            window: false,
            list: true,
            settings: false,
        },
        warehouses: false,
        items: false,
    },
    shopSetting: {
        setting: false,
        contact: false,
        list: false,
        telegram:{
            creatSub: false,
            subscribes: false,
            settingBot: false,
        },

        windowsSetting: true,
        shopId: null,
    },
    now:{
        warehouse: null,
        product: {
            id: null,
            name: null,
            price: null,
            newprice: null,
            status: null,
            code: null,
            description: null,
            image: {
                url: null,
            }
        },
        item: {
            status:false,
            id:null
        },
    },
    shops: [],
    warehouses: [],
    warehouseItems:[],
    products: [],
    categories: [],
    selectProductID: null,
    slider: [],
    notification: {
        text: {
            title: '',
            body: '',
        },
        status: false
    },
    importSuccess: false,
}

const mutations = {

    managerMenuShop(state, status){
        state.menu.shop.list = status
    },

    updateMenuShop(state, status){
        state.menu.shop.window = status
    },
    updateNow(state, data){
        if(data.item === 'items'){
            state.now.item.status = data.status
            state.now.item.id = data.id
            state.now.product.id = data.id
        } else if(data.item === 'warehouse') {
            state.now.warehouse = data.id
        }
    },
    updateMenuWarehouses(state, status){
        state.menu.warehouses = status
    },
    updateMenuItems(state, status){
        state.menu.items = status
    },
    updateslider(state, data) {
        state.slider = data
    },

    updateImportSuccess(state, status) {
        state.importSuccess = status
    },
    updateProducts(state, products) {
        state.products = products
    },
    updateNowProduct(state, data) {
        state.now.product = data
    },
    updateSelectProductID(state, id) {
        state.selectProductID = id
    },
    updateProductName(state, name) {
        state.products.find((products) => products.id === state.selectProductID).name = name;
    },
    updateProductCode(state, code) {
        state.products.find((products) => products.id === state.selectProductID).code = code;
    },
    updateProductPrice(state, price) {
        state.products.find((products) => products.id === state.selectProductID).price = price;
    },
    updateProductQuantity(state, quantity) {
        state.products.find((products) => products.id === state.selectProductID).quantity = quantity;
    },
    updateProductCity(state, city) {
        state.products.find((products) => products.id === state.selectProductID).city = city;
    },
    updateProductDescription(state, description) {
        state.products.find((products) => products.id === state.selectProductID).description = description;
    },
    updateProductPhoto(state, url) {
        state.products.find((products) => products.id === state.selectProductID).photo.path = url;
    },
    updateProduct(state, data) {
        console.log(data)
        state.products.find((products) => products.id === data.id).name = data.name;
        state.products.find((products) => products.id === data.id).status = data.status;
        state.products.find((products) => products.id === data.id).description = data.description;
        state.products.find((products) => products.id === data.id).price = data.price.price;
        state.products.find((products) => products.id === data.id).new_price = data.price.new_price;
    },
    updateShopsItems(state, shops) {
        state.shops = shops;
    },


    updateCategories(state, categories) {
        state.categories = categories
    },

    updateNowProductName(state, data) {
        state.now.product.name = data
    },
    updateNowProductStatus(state, data) {
        state.now.product.status = data
    },
    updateNowProductCode(state, data) {
        state.now.product.code = data
    },
    updateNowProductDescription(state, data) {
        state.now.product.description = data
    },
    updateNowProductPrice(state, data) {
        state.now.product.price = data
    },
    updateNowProductImageUrl(state, data) {
        state.now.product.image.url = data
    },
    updateNowProductNewPrice(state, data) {
        state.now.product.newprice = data
    },

    updateShopSetting(state, data){
        state.menu.shop.settings = data.status
        state.menu.shop.id = data.id
        state.shopSetting.shopId = data.id
    },



    adminNotificationSuccses(state, data) {
        try {
            state.notification.status = !state.notification.status,
            state.notification.text.title = data.title
            state.notification.text.body = data.body
        }
        catch (err) {
            return
        }
    },
}

const actions = {


    //Получить список магазинов
    adminUpdateShops: ({ commit }) => {
        axios.get("/api/get/admin/shop/list")
            .then((res) => {
                commit('updateShopsItems', res.data)
            })
    },
    //Обновить информацию о товаре
    adminUpdateProduct: ({ commit, getters }) => {

        let product = getters.adminGetNowProduct
        axios.post('/api/admin/edit/product', product)
            .then((res) => {
                commit('adminNotificationSuccses', res.data.text)
                commit('updateNowProductNewPrice', null)
                commit('updateProduct', res.data.product)

                setTimeout(function () {
                    commit('adminNotificationSuccses')
                }, 3000);
            })
    },
    //Изменить статус товара
    adminProductShow({commit, getters}){
        const data = {id: getters.adminGetNowProductId, status: !getters.adminGetNowProductStatus }
        axios.post("/api/post/admin/edit/products/status", data)
            .then((res) => {
                commit('updateNowProductStatus', res.data.status)
                commit('adminNotificationSuccses', res.data.text)
                setTimeout(function () {
                    commit('adminNotificationSuccses')
                }, 3000);
            })
    },
    //Выбрать магазин для настройки
    adminSelectSettingShop({commit}, data){
        commit('updateShopSetting', data)
    },
    adminAddNewPrice({commit}, data){
        commit('updateNowProductNewPrice', data)
    },



    //Управление меню магазина
    adminManagerMenuShop({ commit }, data){
        commit('managerMenuShop', data)
    },

    adminUpdateMenu({ commit }, data) {
        if(data.menu === 'shop') {
            commit('updateMenuShop', data.status)
        } else if (data.menu === 'warehouse') {
            commit('updateMenuWarehouses', data.status)
        } else if (data.menu === 'items') {
            commit('updateMenuItems', data.status)
        }
    },

    adminUpdateImportSuccess({ commit }, status) {
        commit('updateImportSuccess', status)
    },
    adminUpdateNow({ commit }, data) {
        commit('updateNow', data)
    },

    adminGetProducts({ commit }) {
        axios.get("/api/admin/products")
            .then((res) => {
                commit('updateProducts', res.data)
            })
    },
    adminGetProductId({ commit, getters }) {
        let productId = getters.adminGetNowItem.id
        axios.post("/api/post/admin/products/id", {productId})
            .then((res) => {
                commit('updateNowProductName', res.data.name)
                commit('updateNowProductCode', res.data.code)
                commit('updateNowProductStatus', res.data.status)
                commit('updateNowProductDescription', res.data.description)
                commit('updateNowProductPrice', res.data.price.price)
                commit('updateNowProductImageUrl', res.data.images.url)
            })
    },
    adminGetCategories({ commit }) {
        axios.get("/api/admin/category")
            .then((res) => {
                commit('updateCategories', res.data)
            })
    },
    adminSelectProductCategory({ commit, getters }, id) {
        const product = getters.adminGetProduct
        axios.post("/api/admin/product/category", { category: id, product: product })
            .then((res) => {
                commit('adminNotificationSuccses', true)
                setTimeout(function () {
                    commit('adminNotificationSuccses', false)
                }, 3000);
            })
    },

    adminSliderEditStatus:({commit},slider) =>{
        axios.post('/api/admin/slider/edit/status', slider)
        .then(()=>{
            commit('adminNotificationSuccses', true)
                setTimeout(function () {
                    commit('adminNotificationSuccses', false)
                }, 2000);
        })
    },

    adminUpdateCategories: ({ commit }, category) => {

        axios.post('/api/admin/create/category', { category: category })
            .then((res) => {
                commit('updateCategories', res.data)
                commit('adminNotificationSuccses', true)
                console.log('ok work')
                setTimeout(function () {
                    commit('adminNotificationSuccses', false)
                }, 3000);
            })
    },

    adminAddProductFromWToS({commit}, data){
        console.log(data)
        axios.post('/api/post/admin/product/fromwarehouse', data)
            .then((res) => {
                commit('adminNotificationSuccses', res.data)
                setTimeout(function () {
                    commit('adminNotificationSuccses', false)
                }, 3000);
            })
    },



    adminUploadPhotoProduct: ({ commit, getters }, file) => {
        let productId = getters.adminGetNowItem.id
        let formData = new FormData();
        formData.append("file", file);
        formData.append('product', productId);
        axios.post("/api/admin/edit/image", formData, {
            headers: {
                "Content-Type": "multipart/form-data",
            },
        })
            .then((res) => {
                commit('adminNotificationSuccses', res.data.text)
                commit('updateNowProductImageUrl', res.data.url)
                setTimeout(function () {
                    commit('adminNotificationSuccses', false)
                }, 3000);
            })
    },
    adminUploadImgSlider: ({ commit, dispatch }, data) => {
        let formData = new FormData();
        formData.append("file", data.file);
        formData.append("id", data.sliderID.id);
        axios.post("/api/admin/edit/slider/img", formData, {
            headers: {
                "Content-Type": "multipart/form-data",
            },
        })
            .then((res) => {
                commit('adminNotificationSuccses', true)
                setTimeout(function () {
                    commit('adminNotificationSuccses', false)
                }, 2000);
            })
    },
    adminEditInfSlider: ({ commit, dispatch }, slider) => {
        axios.post("/api/admin/edit/slider/inf", slider.data.inf)
            .then((res) => {
                dispatch('adminUploadImgSlider', {file: slider.data.file, sliderID: res.data})
            })
    },
    adminUpdateSlider: ({ commit }) => {
        axios.get("/api/admin/slider")
            .then((res) => {
                commit('updateslider', res.data)
            })
    },


    adminAddSelectProductId: ({ commit }, id) => {
        commit('updateSelectProductID', id)
    },


    adminUpdateProductName: ({ commit }, name) => {
        commit('updateProductName', name)
    },
    adminUpdateProductCode: ({ commit }, name) => {
        commit('updateProductCode', name)
    },
    adminUpdateProductPrice: ({ commit }, name) => {
        commit('updateProductPrice', name)
    },
    adminUpdateProductQuantity: ({ commit }, name) => {
        commit('updateProductQuantity', name)
    },
    adminUpdateProductCity: ({ commit }, name) => {
        commit('updateProductCity', name)
    },
    adminUpdateProductDescription: ({ commit }, name) => {
        commit('updateProductDescription', name)
    },






    adminUpdateNowProductName({commit}, data) {
        commit('updateNowProductName', data)
    },
    adminUpdateNowProductStatus({commit}, data) {
        commit('updateNowProductStatus', data)
    },
    adminUpdateNowProductCode({commit}, data) {
        commit('updateNowProductCode', data)
    },
    adminUpdateNowProductDescription({commit}, data) {
        commit('updateNowProductDescription', data)
    },
    adminUpdateNowProductPrice({commit}, data) {
        commit('updateNowProductPrice', data)
    },
    adminUpdateNowImageUrl({commit}, data) {
        commit('updateNowProductImageUrl', data)
    },
}

const getters = {
    adminNowWarehouseID(state){
        return state.now.warehouse
    },
    adminProductsLenght(state) {
        return state.products.length;
    },
    adminMenuShop(state) {
        return state.menu.shop.window;
    },
    adminMenuWarehouses(state) {
        return state.menu.warehouses;
    },
    adminMenuItems(state) {
        return state.menu.items;
    },

    adminWarehouseItems(state) {
        return state.warehouseItems;
    },

    adminCategories(state) {
        return state.categories
    },
    adminProducts(state) {
        return state.products
    },
    adminSelectProductID(state) {
        return state.selectProductID
    },
    adminGetProduct(state) {
        return state.products.find((products) => products.id === state.selectProductID);
    },
    adminNotification(state) {
        return state.notification
    },
    adminImportStatus(state) {
        return state.importSuccess
    },
    adminGetSlider(state) {
        return state.slider
    },
    adminGetShops(state) {
        return state.shops
    },

    adminGetNowItem(state) {
        return state.now.item
    },
    adminGetItemId(state) {
        return state.now.item.id
    },
    adminGetNowProductName(state) {
        return state.now.product.name
    },
    adminGetNowProductId(state) {
        return state.now.product.id
    },
    adminGetNowProductStatus(state) {
        return state.now.product.status
    },
    adminGetNowProductCode(state) {
        return state.now.product.code
    },
    adminGetNowProductDescription(state) {
        return state.now.product.description
    },
    adminGetNowProductPrice(state) {
        return state.now.product.price
    },
    adminGetNowProductImageUrl(state) {
        return state.now.product.image.url
    },
    adminGetNowProduct(state) {
        return state.now.product
    },
    adminGetShopSettingWindow(state) {
        return state.shopSetting.windowsSetting
    },
    adminGetShopSettingTelegram(state) {
        return state.shopSetting.telegram
    },

    //Получить статус Меню Магазин Настройки
    adminGetMenuShopSetting(state) {
        return state.menu.shop.settings
    },
    //Получить статус Меню Магазин псисок
    adminGetMenuShopList(state) {
        return state.menu.shop.list
    },

}

export default {
    state,
    getters,
    actions,
    mutations,
}
