import {createRouter, createWebHistory} from "vue-router";
import Main from "./views/MainView.vue";
import AdvertisementCreateView from "./views/AdvertisementCreateView.vue";
import AdvertisementView from "./views/AdvertisementView.vue";
import AdvertisementUpdateView from "./views/AdvertisementUpdateView.vue";

export const router = createRouter({
    history: createWebHistory(),
    routes: [
        { path: "/", component: Main },
        { path: "/advertisement/create", component: AdvertisementCreateView },
        { path: "/advertisement/:id", component: AdvertisementView },
        { path: "/advertisement/update/:id", component: AdvertisementUpdateView }
    ],
});