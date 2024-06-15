<script setup>
import Menubar from "primevue/menubar";
import {ref} from "vue";
import Button from "primevue/button";
import Avatar from "primevue/avatar";
import Ripple from "primevue/ripple";
import SplitButton from "primevue/splitbutton";

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

const profileItems = [
    {
        label: 'Выход',
        icon: 'pi pi-fw pi-power-off',
        url: '/logout',
        class: 'p-button-danger'
    }
];

</script>

<template>
    <div class="navigation">
        <Menubar :model="items"/>

        <SplitButton label="Login" :model="profileItems" class="bg-danger" @click="visible = true">
            <Avatar style="background-color: #86B32D;" label="Е" class="mr-2" shape="circle" />
            <span class="info inline-flex flex-col items-start">
                <span class="font-bold">Егор</span>
                <span class="text-sm-end">Admin</span>
            </span>
        </SplitButton>
    </div>


    <router-view/>
</template>

<style>
body {
    overflow-x: hidden;
    overflow-y: hidden;
}

.text-sm-end {
    font-size: 12px
}

.info {
    display: inline-flex;
    flex-direction: column;
    align-items: flex-start;
    gap: 4px;
    margin-left: 20px;
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

.navigation {
    display: flex;
    justify-content: space-between;
}

</style>
