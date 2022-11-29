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
const adminWaterhouseMenu= createApp()


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
 
 
adminButtomsIndex.component('admin-menu-buttons', require('./admin/ux/buttomsIndex.vue').default).use(store).mount("#admin-menu");
adminWaterhouseMenu.component('admin-WaterhouseMenu', require('./admin/menu/waterhouse.vue').default).use(store).mount("#huivrot");




 cartLenght.component('cart-lenght', require('./components/cartLenght.vue').default).use(store).mount("#cartLenght");
 cartProducts.component('cart-products', require('./shop/cart/products.vue').default).use(store).mount("#cartProduct");
 cartForm.component('cart-form', require('./shop/cart/form.vue').default).use(store).mount("#cartForm");

 banner.component('banner-head', require('./banners/headBanner.vue').default).mount("#banner");
 slider.component('banner-slider', require('./banners/slider.vue').default).mount("#slider");
 product.component('button-addtocart', require('./components/buttonAddToCart.vue').default).use(store).mount("#product");

 profileCity.component('profile-city', require('./profile/selectCity.vue').default).use(store).mount(".modal");
 headCity.component('head-city', require('./profile/city.vue').default).use(store).mount("#headCity");
