import { createApp } from "vue";
import "./style.css";
import App from "./App.vue";
import HelloWorld from "./components/HelloWorld.vue";
import { createRouter, createWebHistory } from "vue-router";

const app = createApp(App);

const router = createRouter({
    history: createWebHistory(),
    routes: [{ path: "/", component: HelloWorld }],
});

app.use(router);
app.mount("#app");
