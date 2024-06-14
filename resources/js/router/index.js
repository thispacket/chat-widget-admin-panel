import {createRouter, createWebHistory} from "vue-router";
import App from "../App.vue";
import Login from "../views/Login.vue";
import ChatPage from "@/views/ChatPage.vue";

const routes = [
    {
        path: "/chat",
        name: "chat",
        component: ChatPage,
    },
    {
        path: "/login",
        name: "login",
        component: Login,
    }
]

export const router = createRouter({
    history: createWebHistory(),
    routes
})
