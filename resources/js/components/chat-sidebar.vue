<script setup>
import ScrollPanel from 'primevue/scrollpanel';
import Avatar from 'primevue/avatar';
import Tag from 'primevue/tag';
import InputText from 'primevue/inputtext';
import InputIcon from "primevue/inputicon";
import IconField from "primevue/iconfield";
import Skeleton from 'primevue/skeleton';
import Button from "primevue/button";
import Badge from "primevue/badge";
import ButtonGroup from "primevue/buttongroup";
import {onMounted, ref, watch} from "vue";
import useChat from "../composable/chat.js";
import useUser from "@/composable/user.js";
const {viewChat, chats} = useChat();
const {user} = useUser();
let allChats = ref(chats.value)

const isLoading = ref(false);
watch(() => chats.value, () => {
    allChats.value = chats.value
    console.log(allChats.value)
})
const searchInput = ref(null);

const search = () => {
    watch(() => chats.value, () => {
        allChats.value = chats.value.filter(chat => chat.name.includes(searchInput.value));

        if (allChats.value.length === 0) {
            isLoading.value = true;
        } else {
            isLoading.value = false;
        }

        if (!searchInput.value) {
            allChats.value = chats.value
        }
    })
}

const viewAllChat = () => allChats.value = chats.value;

const viewUnreadChat = () => allChats.value = chats.value.filter(chat => chat.new);


onMounted(() => {
})
</script>

<template>
    <div class="chat-sidebar">
        <IconField class="search">
            <InputIcon>
                <i class="pi pi-search"/>
            </InputIcon>
            <InputText @input="search" v-model="searchInput" type="text" placeholder="Search"/>
        </IconField>

        <ButtonGroup style="display: flex">
            <Button style="width: 100%" @click="viewAllChat" icon="pi pi-eye" label="Все" severity="success" :text="false"/>
            <Button style="width: 100%" @click="viewUnreadChat" icon="pi pi-eye-slash" label="Непрочитанные" severity="help" :text="false"/>
        </ButtonGroup>

        <ScrollPanel v-if="!isLoading" style="width: 100%; calc(100vh - 190px);">
            <div class="chat-item" v-for="chat in allChats" @click="viewChat(chat.id)">
                <Avatar style="width: 3rem !important;" label="A" class="mr-2" size="large" shape="circle"/>
                <div class="chat-item__info">
                    <div class="chat-item__name">
                        <div class="name">
                            <span>{{ chat.client.name }}</span>
                            <Badge v-if="chat.new" size="small" value="3" severity="success"></Badge>

                            <!--                            <Tag v-if="chat.new" value="Новое"></Tag>-->
                        </div>
                        <div class="date">{{ chat.lastMessage ? chat.lastMessage.timestamp : new Date().toLocaleTimeString() }}</div>
                    </div>
                    <div class="chat-item__text">
                        {{ chat.lastMessage ? chat.lastMessage.text : 'Пусто' }}
                    </div>
                </div>
            </div>
        </ScrollPanel>

        <ScrollPanel v-else style="width: 100%; height: calc(100vh - 190px);">
            <div class="chat-item" v-for="i in 20">
                <Skeleton shape="circle" size="4rem" class="mr-2"></Skeleton>

                <div class="chat-item__info skeleton" style="">
                    <div class="chat-item__name">
                        <div class="name">
                        </div>
                    </div>
                    <Skeleton width="100%" class="mb-2"></Skeleton>
                    <Skeleton width="75%"></Skeleton>
                </div>
            </div>
        </ScrollPanel>
    </div>
</template>

<style lang="scss">
.skeleton {
    width: 30em;
}

.chat-sidebar {
    padding: 10px;
    width: 30rem;
    height: calc(100vh - 90px);
    z-index: 2;
    border: 1px solid #e2e8f0;

    .p-scrollpanel-wrapper {
        height: 100%;
    }

    .search {
        margin-bottom: 10px;
        display: flex;
        align-items: center;
        gap: 10px;

        .p-inputtext {
            width: 100%;
        }
    }

    .chat-item {
        width: 25em;
        cursor: pointer;
        display: flex;
        align-items: center;
        padding: 10px;
        gap: 20px;
        border-radius: 8px;

        &__info {
            width: 80%;
            display: flex;
            flex-direction: column;
            gap: 5px;
        }

        &__name {
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-weight: bold;
            gap: 10px;

            .name {
                gap: 10px;
                display: flex;
                align-items: center;
            }
        }

        &__text {
            font-size: 0.8rem;
            overflow: hidden;
            text-wrap: nowrap;
            text-overflow: ellipsis;
        }
    }

    .chat-item:hover {
        background-color: #f3f4f6;
    }
}

</style>
