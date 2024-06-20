<script setup>

import Button from "primevue/button";
import InputText from "primevue/inputtext";
import Dialog from "primevue/dialog";
import Password from "primevue/password";
import {ref} from "vue";
import useUser from "@/composable/user.js";

const visibleLogin = ref(false);
const visibleRegistration = ref(false);

const value = ref(null);

const {login} = useUser();

const email = ref("");
const password = ref("");


const loginHandler = () => {
    login({email: email.value, password: password.value});
    visibleLogin.value = false;
}

</script>

<template>
    <div class="login">
        <div class="button-group">
            <Button label="Войти" @click="visibleLogin = true" />
            <p>или</p>
            <Button label="Зарегистрироваться" @click="visibleRegistration = true" />
        </div>


        <Dialog v-model:visible="visibleLogin" modal header="Edit Profile" :style="{ width: '30rem' }">
            <form action="" method="POST" @submit.prevent>
                <div class="flex items-center gap-4 mb-8">
                    <label for="email" class="font-semibold w-24">Email</label>
                    <InputText v-model="email" id="email" class="flex-auto" autocomplete="off" />
                </div>
                <div class="flex items-center gap-4 mb-8">
                    <label for="email" class="font-semibold w-24">Пароль</label>
                    <Password v-model="password" :feedback="false" toggleMask />
                </div>
                <div class="buttons flex justify-end gap-2">
                    <Button type="button" label="Save" @click.prevent="loginHandler"></Button>
                    <Button type="submit" label="Cancel" severity="secondary" @click.prevent="loginHandler"></Button>
                </div>
            </form>
        </Dialog>

        <Dialog v-model:visible="visibleRegistration" modal header="Edit Profile" :style="{ width: '40rem' }">
            <div class="flex items-center gap-4 mb-4">
                <label for="username" class="font-semibold w-24">Имя</label>
                <InputText id="username" class="flex-auto" autocomplete="off" />
            </div>
            <div class="flex items-center gap-4 mb-4">
                <label for="username" class="font-semibold w-24">Фамилия</label>
                <InputText id="username" class="flex-auto" autocomplete="off" />
            </div>
            <div class="flex items-center gap-4 mb-8">
                <label for="email" class="font-semibold w-24">Email</label>
                <InputText id="email" class="flex-auto" autocomplete="off" />
            </div>
            <div class="flex items-center gap-4 mb-8">
                <label for="email" class="font-semibold w-24" >Пароль</label>
                <Password v-model="value" :feedback="false" toggleMask/>
            </div>
            <div class="flex items-center gap-4 mb-8">
                <label for="email" class="font-semibold w-24" >Подтверждение пароля</label>
                <Password v-model="value" :feedback="false" toggleMask/>
            </div>
            <div class="buttons flex justify-end gap-2">
                <Button type="button" label="Cancel" severity="secondary" @click="visibleRegistration = false"></Button>
                <Button type="button" label="Save" @click="visibleRegistration = false"></Button>
            </div>
        </Dialog>
    </div>
</template>

<style >

.flex {
    display: flex;
    align-items: center;
    gap: 10px;
    margin-top: 20px;
    width: 100%;
}

.p-inputtext, .p-password {
    width: 100%;
}

.buttons {
    margin-top: 50px;
}

</style>
