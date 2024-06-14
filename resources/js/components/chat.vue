<script setup>

import ScrollPanel from "primevue/scrollpanel";
import Avatar from "primevue/avatar";
import InputGroup from "primevue/inputgroup";
import InputText from "primevue/inputtext";
import Button from "primevue/button";
import Tag from "primevue/tag";
import {onMounted, reactive, ref} from "vue";

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

const sendMessage = () => {
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
    setTimeout(() => {
        let element = document.querySelectorAll(".message-panel");
        element[element.length - 1].scrollIntoView({block: "center", behavior: "instant"});
    }, 100)
})
</script>

<template>
    <div class="chat">
        <ScrollPanel style="width: 100%; height: 100%;">
            <div
                v-for="message in messages"
                class="message-panel"
                :key="message.id">
                <template v-if="message.sender !== 'me'">
                    <Avatar label="O" class="mr-2" size="large" style="background-color: #ece9fc; color: #2a1261"
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
        <InputGroup style="margin-top: 10px; width: 100%; display: flex;">
            <InputText @keydown.enter="sendMessage" type="text" v-model="message" placeholder="Введите сообщение"/>
            <Button @click="sendMessage" icon="pi pi-send" severity="success"/>
        </InputGroup>
    </div>

<!--    <div v-else class="no-chat">-->
<!--        <Tag style="font-size: 1rem" severity="info" value="Выберите чат"></Tag>-->
<!--    </div>-->
</template>

<style lang="scss">
.chat {
    width: 100%;
    height: calc(100vh - 90px - 46px);
    border: 1px solid #e2e8f0;
}

.no-chat {
    display: flex;
    justify-content: center;
    align-items: center;
    width: 100%;
    border: 1px solid #e2e8f0;
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
