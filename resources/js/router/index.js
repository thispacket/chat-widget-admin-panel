import {createRouter, createWebHistory} from "vue-router";
import App from "../App.vue";
import Login from "../views/Login.vue";
import ChatPage from "@/views/ChatPage.vue";
import chat from "@/components/chat.vue";

const routes = [
    {
        path: "/chat",
        name: "chat",
        component: ChatPage,
        children: [
            {
                path: ":id",
                name: "chat-page",
                component: chat
            },
        ]
    },
    {
        path: "/login",
        name: "login",
        component: Login,
    },
    {
        path: "/widget",
        name: "widget",
        component: () => import("../views/Widget.vue")
    }
]

export const router = createRouter({
    history: createWebHistory(),
    routes
})
