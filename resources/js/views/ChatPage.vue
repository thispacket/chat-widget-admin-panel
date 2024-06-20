<script setup>

import Chat from "@/components/chat.vue";
import ChatSidebar from "@/components/chat-sidebar.vue";
import useChat from "@/composable/chat.js";
import Tag from "primevue/tag";
import {router} from "@/router/index.js";
import InlineMessage from "primevue/inlinemessage";
import {onMounted} from "vue";
import useUser from "@/composable/user.js";

const {chat} = useChat();

const {user} = useUser();


</script>

<template>
    <div class="body">
        <ChatSidebar/>

        <div v-if="router.currentRoute.value.name === 'chat'" class="no-chat">
            <InlineMessage severity="info">Выберите чат</InlineMessage>
        </div>

        <router-view v-else/>
    </div>
</template>

<style scoped>

</style>
