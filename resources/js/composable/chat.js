import {ref} from "vue";
import {router} from "@/router/index.js";

export default function useChat() {

    const chats = ref([
        {
            id: 1,
            name: "Павел",
            text: "Согласен. Теперь я полон сил и готов к работе.213321312312123123",
            new: true
        },
        {
            id: 2,
            name: "Олег",
            text: "Согласен. Теперь я полон сил и готов к работе.213321312312123123",
            new: false
        },
        {
            id: 3,
            name: "Игорь",
            text: "Согласен. Теперь я полон сил и готов к работе.213321312312123123",
            new: true
        }
    ])

    const chat = ref({});

    const viewChat = (id) => {
        router.push({name: "chat-page", params: {id: id}})
        chat.value = chats.value.find(item => item.id === id);
    }

    const getChat = (id) => {
        chat.value = chats.value.find(item => item.id === id);
        return chat.value;
    }

    return {
        viewChat,
        getChat,
        chat,
        chats
    }
}
