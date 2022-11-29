import { createRouter, createWebHashHistory } from "vue-router";

const router = createRouter({
  history: createWebHashHistory(),
  routes: [
    {
      path: "/sliders/",
      name: "settingsSlider",
      component: () => import("../admin/settings/sliders/index.vue"),
    },
    {
      path: "/city/",
      name: "settingsCity",
      component: () => import("../admin/settings/city/index.vue"),
    },
    {
      path: "/banners/head",
      name: "settingsBannerHead",
      component: () => import("../admin/settings/banners/index.vue"),
    },
  ],
});

export default router;
