import axios from "axios";

const state = {
    itemId: null,
    items: [],
    categories: [],

}
const getters = {
    itemsCategoriesList(state){
        return state.categories
    },
    itemsList(state) {
        return state.items
    },
    itemsDetails(state){
        return state.items.find(item => item.id === state.itemId)
    },
    itemId(state) {
        return state.itemId
    },
}
const actions = {
    //Добавить категории к продукту
    itemsAddCategory({commit}, category){
        axios.post('/api/post/admin/categories/items/create', category)
    },


    //получить детальную информацию о товаре
    itemId({commit,getters, dispatch}, id){
        //сохранить товар если уже есть ид
        if(getters.itemId) {
            dispatch('itemSave')
        }
        commit('updateItemId', id)
    },

    //Сохранить изменения в товаре
    itemSave({commit, getters}){
        axios.post('/api/admin/edit/product', getters.itemsDetails)
    },

    itemUploadPhotoProduct: ({ commit, getters }, file) => {
        const productId = getters.itemId
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
                commit('updateProductImageUrl', res.data.image)
                setTimeout(function () {
                    commit('adminNotificationSuccses', false)
                }, 3000);
            })
    },


    //Изменить стату у товара в магазине
    itemsPostNewStatus({commit, getters}, item){
        const data = {
            shopId: getters.shopGetId,
            itemId: item.id,
            status: item.status
        }
        console.log(data)
        axios.post('/api/post/admin/shop/item/status', data)
            .then((res)=>{
                commit('adminNotificationSuccses', res.data)
                setTimeout(function () {
                    commit('adminNotificationSuccses')
                }, 3000);
            })
    },


    //Сохранить созданные категории
    itemsCategoryCreate({commit}, categories){
        axios.post('/api/post/admin/categories/create', categories)
            .then((res) => {
                commit('updateCategory', res.data)
            })
    },
    itemsGetCategoryList({commit}){
        axios.get('/api/get/admin/categories/list')
            .then((res) => {
                commit('updateCategory', res.data)
            })
    },

    itemsCreateCategoryItems({commit}, data){
        axios.post('/api/post/admin/categories/items/create', data)
    },

    itemsGetList({commit}) {
        axios.get('/api/get/admin/items/list')
            .then((res) => {
                commit('updateItems', res.data)
            })
    },

    //сохранить товары из магазина
    itemsCreateList({commit, getters}){
        for (const [key, value] of Object.entries(getters.menuShopStatus)) {
            if(value === true) {
                if(key === 'itemsList') {
                    const data = {
                        shopId: getters.shopGetId,
                        items: getters.itemsList
                    }
                    axios.post('/api/post/admin/items/update/info', data)
                }
            }
        }
      const data = {
          shopId: getters.shopGetId,
          items: getters.shopGetImport
      }
        if(data.items.length > 0) {
            axios.post('/api/post/admin/items/createList', data)
                .then((res)=>{
                    commit('adminNotificationSuccses', res.data)
                    setTimeout(function () {
                        commit('adminNotificationSuccses')
                    }, 3000);
                })
        }
    },
}
const mutations = {
    updateProductImageUrl(state, image){
        let item = state.items.find(item => item.id === state.itemId)
        item.images.name = image.name
        item.images.url = image.url
    },
    updateItemId(state, id){
        state.itemId = id
    },
    updateCategory(state, categories){
        state.categories = categories
    },
    updateItems(state, items) {
        state.items = items
    },
}

export default {
    state,
    getters,
    actions,
    mutations,
}
