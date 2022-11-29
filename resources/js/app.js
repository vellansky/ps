require('./bootstrap')

import { createApp } from "vue";


import router from "./router";
import store from "./store";





const banner = createApp()
const product = createApp()
const slider = createApp()
const cartForm = createApp()
const cartProducts = createApp()
const cartLenght = createApp()
const register = createApp()
const login = createApp()
const productButtuns = createApp()
const logout = createApp()
const adminProduct = createApp()
const adminCategories = createApp()
const adminOrders = createApp()
const profileCity = createApp()
const headCity = createApp()
const adminSettings = createApp()
const adminNotification= createApp()
const adminShopCreate= createApp()
const adminButtomsIndex= createApp()
const adminWarehouse= createApp()
const adminShopList= createApp()
const adminWarehouseList= createApp()
const adminPage = createApp()



product.component('button-buy', require('./user/ButtonBuy').default).use(store).mount(".products");
cartLenght.component('cart-length', require('./user/CartLenght').default).use(store).mount(".cart-length");
profileCity.component('city-select', require('./user/CitySelect').default).mount("#city-select");

 register.component('admin-register', require('./admin/profile/register.vue').default).mount("#register");
 login.component('admin-login', require('./admin/profile/login.vue').default).mount("#login");
 logout.component('admin-logout', require('./admin/profile/logout.vue').default).mount("#logout");
 //тут много весит
 productButtuns.component('product-buttuns', require('./admin/products/buttons.vue').default).use(store).mount(".productButtuns");
 adminProduct.component('admin-product', require('./admin/products/products.vue').default).use(store).mount("#adminProduct");

 adminCategories.component('admin-categories', require('./admin/categories/index.vue').default).use(store).mount("#adminCategories");

 adminOrders.component('admin-orders', require('./admin/orders/index.vue').default).use(store).mount("#adminOrders");
 adminSettings.component('admin-settings', require('./admin/settings/index.vue').default).use(store).use(router).mount(".adminSettings");
 adminNotification.component('admin-notification', require('./admin/notification/seccsas.vue').default).use(store).use(router).mount(".adminNotification");
 adminShopCreate.component('admin-shop', require('./admin/shop/create.vue').default).use(store).mount(".adminShopCreate");
 adminPage.component('admin-index', require('./admin/index').default).use(store).mount("#adminIndex");


adminButtomsIndex.component('admin-menu-buttons', require('./admin/ux/buttomsIndex.vue').default).use(store).mount("#admin-menu");
adminWarehouse.component('admin-warehouse-menu', require('./admin/menu/warehouse.vue').default).use(store).mount(".admin-menu");
adminShopList.component('admin-shop-list', require('./admin/shop/list.vue').default).use(store).mount(".admin-shoplist");
adminWarehouseList.component('admin-warehouse-list', require('./admin/warehouse/list.vue').default).use(store).mount(".admin-warehouselist");


adminMenu.component('admin-global-menu', require('./admin/menu/index').default).use(store).mount("#admin-menu");




 cartProducts.component('cart-products', require('./shop/cart/products.vue').default).use(store).mount("#cartProduct");
 cartForm.component('cart-form', require('./shop/cart/form.vue').default).use(store).mount("#cartForm");

 banner.component('banner-head', require('./banners/headBanner.vue').default).mount("#banner");
 slider.component('banner-slider', require('./banners/slider.vue').default).mount("#slider");
 product.component('button-addtocart', require('./components/buttonAddToCart.vue').default).use(store).mount("#product");


 headCity.component('head-city', require('./profile/city.vue').default).use(store).mount("#headCity");
