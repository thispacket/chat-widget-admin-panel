<script setup>

import ScrollPanel from "primevue/scrollpanel";
import Avatar from "primevue/avatar";
import InputGroup from "primevue/inputgroup";
import InputText from "primevue/inputtext";
import Button from "primevue/button";
import Card from "primevue/card";
import Tag from "primevue/tag";
import {onMounted, reactive, ref, watch} from "vue";
import useChat from "@/composable/chat.js";
import {router} from "@/router/index.js";
import Toast from 'primevue/toast';
import {useToast} from "primevue/usetoast";
import axios from "axios";
import Echo from "laravel-echo";


window.Echo = new Echo({
    broadcaster: 'pusher',
    key: 'bfe10eaad2e57259f9bf',
    cluster: 'eu',
    encrypted: false,
    wsHost: window.location.hostname,
    wsPort: 6001,
    disableStats: false,
    forceTLS: false,
});

const toast = useToast();

const {getChat, chat} = useChat();

let currentChat = ref({});

watch(() => chat.value, () => {
    currentChat.value = chat.value
})

watch(router.currentRoute, () => {
    let {params} = router.currentRoute.value;
    chat.value = getChat(+params.id);
})

const invalid = ref(false);
const message = ref("");

const messages = ref([

])

const closeChat = () => {
    chat.value = null
    router.push({name: 'chat'})
}


const sendMessage = () => {
    if (message.value.length === 0) {
        invalid.value = true;
        toast.add({severity: 'error', summary: 'Ошибка', detail: 'Сообщение не должно быть пустым', life: 3000});
        return
    }

    invalid.value = false;

    axios({
        method: 'post',
        url: '/api/chats/' + chat.value.id + '/messages',
        data: {
            chat_id: chat.value.id,
            sender: 'operator',
            text: message.value
        }
    }).then(response => {
    }).catch(err => {
        console.log(err);
    })

    window.Echo.channel('chat')
        .listen('NewChatMessage', (e) => {
            window.Echo.channel('chat')
                .listen('NewChatMessage', (e) => {
                    getChat(chat.value.id)
                });
        });

    setTimeout(() => {
        let element = document.querySelectorAll(".message-panel");
        element[element.length - 1].scrollIntoView({block: "center", behavior: "instant"});
    }, 100)

    message.value = "";
}
onMounted(() => {
    let {params} = router.currentRoute.value;
    chat.value = getChat(+params.id);

    setTimeout(() => {
        let element = document.querySelectorAll(".message-panel");
        element[element.length - 1].scrollIntoView({block: "center", behavior: "instant"});
    }, 100)

    window.Echo.channel('chat')
        .listen('NewChatMessage', (e) => {
            window.Echo.channel('chat')
                .listen('NewChatMessage', (e) => {
                    getChat(chat.value.id)
                });
        });
})
</script>

<template>
    <Toast severity="error" life="3000" position="top-right" message="213" error-icon="pi pi-exclamation-triangle"/>

    <Card v-if="chat" class="chat">
        <template #header>
            <div class="header">
                <Avatar :label="chat.client ? chat.client.name[0] : ''" class="mr-2" size="large"
                        shape="circle"/>
                <span class="font-bold">{{ chat.client ? chat.client.name : ''}}</span>

                <Button @click="closeChat" icon="pi pi-times" severity="success" :style="{marginLeft: 'auto'}" text rounded aria-label="Cancel" />
            </div>
        </template>
        <template #content>
            <ScrollPanel style="width: 100%; height: calc(100vh - 235px);">
                <div
                    v-for="message in chat.messages"
                    class="message-panel"
                    :key="message.id">
                    <template v-if="message.sender !== 'operator'">
                        <Avatar :label="chat.client ? chat.client.name[0] : ''" class="mr-2" size="large" style="background-color: #ece9fc; color: #2a1261"
                                shape="circle"/>
                        <p class="message">{{ message.text }}</p>
                        <p class="date">{{ message.timestamp }}</p>

                    </template>
                    <template v-else>
                        <div class="message-left">
                            <p class="message">{{ message.text }}</p>
                            <p class="date">{{ message.timestamp }}</p>
                        </div>
                    </template>
                </div>
            </ScrollPanel>
        </template>
        <template #footer>
            <InputGroup style="margin-top: 10px; width: 100%; display: flex;">
                <InputText :invalid="invalid" @keydown.enter="sendMessage" type="text" v-model="message" placeholder="Введите сообщение"/>
                <Button  @click="sendMessage" icon="pi pi-send" :severity="invalid ? 'danger' : 'success'"/>
            </InputGroup>
        </template>
    </Card>
</template>

<style lang="scss">
.chat {
    width: 100%;
    border: 1px solid #e2e8f0;
}

.no-chat {
    display: flex;
    justify-content: center;
    align-items: center;
    width: 100%;
    border: 1px solid #e2e8f0;
}

.header {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    padding: 15px;
    border-bottom: 1px solid #e2e8f0;
}

.p-card-content {
}

.p-card-body {
    padding: 0 !important;
}

.p-scrollpanel {
    padding: 10px;
}

.p-scrollpanel-content {
    display: flex !important;
    flex-direction: column;
}

.message-left {
    display: flex !important;
    justify-content: end !important;
    width: 100%;
    margin-top: 1rem;
    gap: 0.5rem;
    padding-right: 15px;
    align-items: flex-end;

    .message {
        background-color: var(--primary-color);
        color: var(--primary-color-text);
    }
}

.message-panel {
    display: flex;
    align-items: start;
    gap: 0.5rem;
    margin-top: 1rem;
}

.message-panel:first-child {
    margin-top: 2rem;
}

.message {
    width: 50%;
    word-wrap: anywhere;
    padding: .5rem;
    border: 2px solid var(--primary-color);
    border-radius: var(--border-radius);
    margin: 0;
}


.date {
    font-size: 0.5rem;
    margin: 0;
    padding: 0;
}
</style>
