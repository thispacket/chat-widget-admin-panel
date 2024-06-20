import {onMounted, ref} from "vue";
import {router} from "@/router/index.js";

export default function useChat() {

    const chats = ref([]);

    const chat = ref({});

    const viewChat = (id) => {
        router.push({name: "chat-page", params: {id: id}})
        chat.value = chats.value.find(item => item.id == id);
    }

    const getChat = (id) => {
        axios({
            method: 'GET',
            url: `/api/chats/${id}`,
        }).then(response => {
            chat.value = response.data.chat;
            console.log(chat.value)
        }).catch(err => {
            console.log(err);
        })
    }

    const getChats = () => {
        axios({
            method: 'GET',
            url: `/api/chats`,
        }).then(response => {
            chats.value = response.data.chats;
        }).catch(err => {
            console.log(err);
        })
    }

    onMounted(() => {
        getChats();

    })

    return {
        viewChat,
        getChat,
        getChats,
        chat,
        chats
    }
}
