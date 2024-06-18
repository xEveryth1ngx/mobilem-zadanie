import { createApp } from "vue";
import "./style.css";
import App from "./App.vue";
import { createRouter, createWebHistory } from "vue-router";
import Main from "./views/MainView.vue";
import AdvertisementView from "./views/AdvertisementView.vue";
import AdvertisementCreateView from "./views/AdvertisementCreateView.vue";

const app = createApp(App);

const router = createRouter({
    history: createWebHistory(),
    routes: [
        { path: "/", component: Main },
        { path: "/advertisement/create", component: AdvertisementCreateView },
        { path: "/advertisement/:id", component: AdvertisementView },
    ],
});

app.use(router);
app.mount("#app");
