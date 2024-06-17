import { createApp } from "vue";
import "./style.css";
import App from "./App.vue";
import { createRouter, createWebHistory } from "vue-router";
import Test from "./components/Test.vue";
import Advertisement from "./components/Advertisements/Advertisement.vue";
import AdvertisementForm from "./components/Advertisements/AdvertisementForm.vue";
import Main from "./views/Main.vue";

const app = createApp(App);

const router = createRouter({
    history: createWebHistory(),
    routes: [
        { path: "/", component: Main },
        { path: "/test", component: Test},
        { path: "/advertisement/create", component: AdvertisementForm },
        { path: "/advertisement", component: Advertisement },
    ],
});

app.use(router);
app.mount("#app");
