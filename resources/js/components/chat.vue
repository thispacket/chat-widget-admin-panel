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


const toast = useToast();

const {getChat} = useChat();
const chat = ref();

watch(router.currentRoute, () => {
    let {params} = router.currentRoute.value;
    chat.value = getChat(+params.id);
})

const invalid = ref(false);
const message = ref("");

const messages = ref([
    {
        id: 1,
        text: "Hello, how are you?",
        sender: "me"
    },
    {
        id: 2,
        text: "I am fine. How about you?",
        sender: "other"
    },
    {
        id: 3,
        text: "I am good too. How about you?",
        sender: "me"
    }
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

    messages.value.push({
        id: messages.value.length + 1,
        text: message.value,
        sender: "me"
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
})
</script>

<template>
    <Toast severity="error" life="3000" position="top-right" message="213" error-icon="pi pi-exclamation-triangle"/>


    <Card v-if="chat" class="chat">
        <template #header>
            <div class="header">
                <Avatar :label="chat.name[0]" class="mr-2" size="large"
                        shape="circle"/>
                <span class="font-bold">{{ chat.name }}</span>

                <Button @click="closeChat" icon="pi pi-times" severity="success" :style="{marginLeft: 'auto'}" text rounded aria-label="Cancel" />
            </div>
        </template>
        <template #content>
            <ScrollPanel style="width: 100%; height: calc(100vh - 235px);">
                <div
                    v-for="message in messages"
                    class="message-panel"
                    :key="message.id">
                    <template v-if="message.sender !== 'me'">
                        <Avatar :label="chat.name[0]" class="mr-2" size="large" style="background-color: #ece9fc; color: #2a1261"
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
