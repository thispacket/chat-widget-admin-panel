<script setup>
import Menubar from "primevue/menubar";
import {ref} from "vue";
import ChatSidebar from "../js/components/chat-sidebar.vue";
import Chat from "../js/components/chat.vue";
import InputText from "primevue/inputtext";
import Divider from "primevue/divider";
import Button from "primevue/button";
import Dialog from "primevue/dialog";

const visible = ref(false);

const items = [
    {
        label: 'Главная',
        icon: 'pi pi-fw pi-home',
        url: '/'
    },
    {
        label: 'Профиль',
        icon: 'pi pi-fw pi-user',
        url: '/profile'
    },
    {
        label: 'Пользователи',
        icon: 'pi pi-fw pi-users',
        url: '/users'
    },
    {
        label: 'Сообщения',
        icon: 'pi pi-fw pi-envelope',
        url: '/messages'
    }
];


</script>

<template>
    <Menubar :model="items"/>

    <router-view/>
</template>

<style>
body {
    overflow-x: hidden;
    overflow-y: hidden;
}

.body {
    margin-top: 10px;
    gap: 20px;
    display: flex;
}

.login {
    display: flex;
    justify-content: center;
    align-items: center;
    height: calc(100vh - 10px - 40px - 40px);
}

.button-group {
    display: flex;
    gap: 10px;
}

</style>
