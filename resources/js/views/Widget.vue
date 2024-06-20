<script setup>
import Card from "primevue/card";
import Avatar from "primevue/avatar";
import ScrollPanel from "primevue/scrollpanel";
import InputText from "primevue/inputtext";
import Button from "primevue/button";
import {computed, onMounted, ref, watch} from "vue";

import Echo from 'laravel-echo';
import Pusher from "pusher-js";
import useChat from "@/composable/chat.js";

const {getChat, chat} = useChat();

window.Pusher = Pusher;

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

const message = ref("");

const messages = ref(chat.value.messages);
watch(() => chat.value, () => {
    messages.value = chat.value.messages
})

const sendMessage = () => {
    axios({
        method: "POST",
        url: "/api/chats/1/messages",
        data: {
            chat_id: 1,
            text: message.value,
            sender: "client"
        }
    }).then(response => {

    })

    message.value = "";

    setTimeout(() => {
        const element = document.querySelector(".p-scrollpanel-content");
        element.scrollTop = element.scrollHeight;
    }, 100)

}

onMounted(() => {
    setTimeout(() => {
        const element = document.querySelector(".p-scrollpanel-content");
        element.scrollTop = element.scrollHeight;
    }, 100)

    window.Echo.channel('chat')
        .listen('NewChatMessage', (e) => {
            getChat(1);
        });
})

const style = computed(() => {
    return "background-color: var(--primary-color); color: var(--primary-color-text); border-radius: var(--border-radius)"
})
</script>

<template>
    <div>
        <Card style="width: 25rem; position: absolute; right: 0; bottom: 0; overflow: hidden; padding: .5rem" class="chat-widget">
            <template #header>
                <div :style="style" class="header">
                    <Avatar label="O" class="mr-2" size="large" style="background-color: #ece9fc; color: #2a1261"
                            shape="circle"/>
                    <span class="font-bold">Оператор</span>
                </div>
            </template>
            <template style="padding: 0 !important;" #content>
                <ScrollPanel style="width: 100%; height: 25rem;" class="massage-content">
                    <div
                        v-for="message in messages"
                        class="message-panel"
                        :key="message.id">
                        <template v-if="message.sender !== 'client'">
                            <Avatar label="O" class="mr-2" size="large"
                                    style="background-color: #ece9fc; color: #2a1261"
                                    shape="circle"/>
                            <p class="message">{{ message.text }}</p>
                            <p class="date">{{ new Date().toLocaleTimeString() }}</p>

                        </template>
                        <template v-else>
                            <div class="message-left">
                                <p class="message">{{ message.text }}</p>
                                <p class="date">{{ new Date().toLocaleTimeString() }}</p>
                            </div>
                        </template>
                    </div>
                </ScrollPanel>

<!--                <form action="" method="POST" @submit.prevent>-->
<!--                    <div class="flex items-center gap-4 mb-8">-->
<!--                        <label for="email" class="font-semibold w-24">Email</label>-->
<!--                        <InputText v-model="email" id="email" class="flex-auto" autocomplete="off"/>-->
<!--                    </div>-->
<!--                    <div class="flex items-center gap-4 mb-8">-->
<!--                        <label for="email" class="font-semibold w-24">Пароль</label>-->
<!--                        <Password v-model="password" :feedback="false" toggleMask/>-->
<!--                    </div>-->
<!--                    <div class="buttons flex justify-end gap-2">-->
<!--                        <Button type="button" label="Save" @click.prevent=""></Button>-->
<!--                        <Button type="submit" label="Cancel" severity="secondary" @click.prevent=""></Button>-->
<!--                    </div>-->
<!--                </form>-->
            </template>
            <template #footer>
                <InputGroup style="display:flex; gap: .5rem; width: 100%;">
                    <InputText @keydown.enter="sendMessage" style="width: 100%;" type="text" v-model="message"
                               placeholder="Введите сообщение"/>
                    <Button @click="sendMessage" icon="pi pi-send" severity="success"/>
                </InputGroup>
            </template>
        </Card>
    </div>
</template>

<style lang="scss">

.p-card-body {
    padding: 0 !important;
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

.message {
    width: 50%;
    word-wrap: anywhere;
    padding: .5rem;
    border: 2px solid var(--primary-color);
    border-radius: var(--border-radius);
    margin: 0;
}

.header {
    padding: 1rem;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.date {
    font-size: 0.5rem;
    margin: 0;
    padding: 0;
}

</style>
