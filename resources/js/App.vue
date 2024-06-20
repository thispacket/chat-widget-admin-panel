<script setup>
import Menubar from "primevue/menubar";
import {onMounted, ref} from "vue";
import Avatar from "primevue/avatar";
import SplitButton from "primevue/splitbutton";
import useUser from "@/composable/user.js";
import {router} from "@/router/index.js";

const visible = ref(false);

const items = [
    {
        label: 'Главная',
        icon: 'pi pi-fw pi-home',
        url: '/'
    }
];

const profileItems = [
    {
        label: 'Выход',
        icon: 'pi pi-fw pi-power-off',
        url: '/login',
        class: 'p-button-danger'
    }
];

const {user} = useUser();
const letter = ref('A');

</script>

<template>
    <div v-if="router.currentRoute.value.path !== '/widget'" class="navigation">
        <Menubar :model="items"/>

        <SplitButton label="Login" :model="profileItems" class="bg-danger" @click="visible = true">
            <Avatar style="background-color: white; color: #2a1261" :label="user.firstName ? user.firstName[0] : ''" class="mr-2" shape="circle" />
            <span class="info inline-flex flex-col items-start">
                <span class="font-bold">{{ user.firstName }}</span>
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
