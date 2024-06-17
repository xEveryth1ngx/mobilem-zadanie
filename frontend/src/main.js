import { createApp } from "vue";
import "./style.css";
import App from "./App.vue";
import { createRouter, createWebHistory } from "vue-router";
import AdvertisementForm from "./components/Advertisements/AdvertisementForm.vue";
import Main from "./views/MainView.vue";
import AdvertisementView from "./views/AdvertisementView.vue";

const app = createApp(App);

const router = createRouter({
    history: createWebHistory(),
    routes: [
        { path: "/", component: Main },
        { path: "/advertisement/create", component: AdvertisementForm },
        { path: "/advertisement/:id", component: AdvertisementView },
    ],
});

app.use(router);
app.mount("#app");
