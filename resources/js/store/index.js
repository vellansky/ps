import vuex from "vuex";



import shopModule from "./modules/shop/shop.module";
import cartModule from "./modules/cart/cart.module";
import orderModule from './modules/order/order.module';
import profile from "./modules/profile/profile.module";
import adminModule from './modules/admin/admin.modules';
import adminMenu from './modules/admin/menu.modules';
import adminShop from './modules/admin/shop.modules';
import adminWarehouse from './modules/admin/warehouse.modules';
import adminItems from './modules/admin/items.modules';
import adminOrder from './modules/admin/order.modules';
import userCart from './modules/user/cart.module';
//import userShop from './modules/user/shop.module';

import createPersistedState from "vuex-persistedstate";
const dataState = createPersistedState({
  paths: ["userCart"],
});



export default new vuex.Store({
  plugins: [dataState],
  modules: {
    admin : adminModule,
    menu : adminMenu,
    adminItems: adminItems,
    adminShop : adminShop,
    adminWarehouse : adminWarehouse,
    order: adminOrder,
    shop: shopModule,
    cart: cartModule,
    profile: profile,
      userCart: userCart,
  },
});
