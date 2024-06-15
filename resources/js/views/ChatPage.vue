<script setup>

import Chat from "@/components/chat.vue";
import ChatSidebar from "@/components/chat-sidebar.vue";
import useChat from "@/composable/chat.js";

const {chat} = useChat();

</script>

<template>
    <div class="body">
        <ChatSidebar/>
        <router-view :chat="chat"/>
    </div>
</template>

<style scoped>

</style>
