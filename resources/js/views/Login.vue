<script setup>

import Button from "primevue/button";
import InputText from "primevue/inputtext";
import Dialog from "primevue/dialog";
import {ref} from "vue";

const visibleLogin = ref(false);
const visibleRegistration = ref(false);
</script>

<template>
    <div class="login">
        <div class="button-group">
            <Button label="Войти" @click="visibleLogin = true" />
            <p>или</p>
            <Button label="Зарегистрироваться" @click="visibleRegistration = true" />
        </div>


        <Dialog v-model:visible="visibleLogin" modal header="Edit Profile" :style="{ width: '25rem' }">
            <span class="text-surface-500 dark:text-surface-400 block mb-8">Update your information.</span>
            <div class="flex items-center gap-4 mb-4">
                <label for="username" class="font-semibold w-24">Username</label>
                <InputText id="username" class="flex-auto" autocomplete="off" />
            </div>
            <div class="flex items-center gap-4 mb-8">
                <label for="email" class="font-semibold w-24">Email</label>
                <InputText id="email" class="flex-auto" autocomplete="off" />
            </div>
            <div class="flex justify-end gap-2">
                <Button type="button" label="Cancel" severity="secondary" @click="visibleLogin = false"></Button>
                <Button type="button" label="Save" @click="visibleLogin = false"></Button>
            </div>
        </Dialog>

        <Dialog v-model:visible="visibleRegistration" modal header="Edit Profile" :style="{ width: '25rem' }">
            <span class="text-surface-500 dark:text-surface-400 block mb-8">Update your information.</span>
            <div class="flex items-center gap-4 mb-4">
                <label for="username" class="font-semibold w-24">Username</label>
                <InputText id="username" class="flex-auto" autocomplete="off" />
            </div>
            <div class="flex items-center gap-4 mb-8">
                <label for="email" class="font-semibold w-24">Email</label>
                <InputText id="email" class="flex-auto" autocomplete="off" />
            </div>
            <div class="flex justify-end gap-2">
                <Button type="button" label="Cancel" severity="secondary" @click="visibleRegistration = false"></Button>
                <Button type="button" label="Save" @click="visibleRegistration = false"></Button>
            </div>
        </Dialog>
    </div>
</template>

<style scoped>

</style>
