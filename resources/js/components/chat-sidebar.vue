<script setup>
    import ScrollPanel from 'primevue/scrollpanel';
    import Avatar from 'primevue/avatar';
    import Tag from 'primevue/tag';
    import {ref} from "vue";

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
</script>

<template>
    <div class="chat-sidebar">
        <ScrollPanel style="width: 100%; height: 100%;">
            <div class="chat-item" v-for="chat in chats">
                <Avatar style="width: 3rem !important;" :label="chat.name[0]" class="mr-2" size="large" shape="circle" />
                <div class="chat-item__info">
                    <div class="chat-item__name">
                        <div class="name">
                            <span>{{ chat.name }}</span>
                            <Tag v-if="chat.new" value="Новое"></Tag>
                        </div>
                        <div class="date">{{ new Date().toLocaleTimeString() }}</div>
                    </div>
                    <div class="chat-item__text">
                        {{ chat.text }}
                    </div>
                </div>
            </div>
        </ScrollPanel>
    </div>
</template>

<style lang="scss">
.chat-sidebar {
    max-width: 30em;
    height: calc(100vh - 10px - 40px - 40px);
    border: 1px solid #e2e8f0;

    .chat-item {
        width: 100%;
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
