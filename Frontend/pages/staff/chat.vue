<template>
    <div class="flex h-[46rem] overflow-hidden">
        <!-- Sidebar -->
        <div class="w-1/4 bg-white border-r border-gray-300">
            <!-- Sidebar Header -->
            <header class="p-4 border-b border-gray-300 flex justify-between items-center bg-blue-600 text-white">
                <h1 class="text-2xl font-semibold">AQKids Chats</h1>
            </header>

            <!-- Contact List -->
            <div class="overflow-y-auto h-full p-3  pb-20">
                <div v-for="channel in allChannels">
                    <Contract @see-chat="onClickChat" :id="channel.id" :first_name="channel.first_name" :last_name="channel.last_name" :profile_image_path="channel.profile_image_path" :last_message="channel.last_message.message"
                        :has_read="channel.last_message.has_read">
                    </Contract>
                </div>
            </div>
        </div>

        <!-- Main Chat Area -->
        <div v-if="showChat" v-click-outside="clickOutside" class="flex-1 bg-gray-200">
            <!-- Chat Header -->
            <header class="bg-gray-600 text-white p-4 flex">
                <h1 class="text-2xl font-semibold">{{ chatName }}</h1>
                <h1 class="text-2xl text-gray-600 font-semibold">|</h1>
            </header>

            <!-- Chat Messages -->
            <div class="h-full overflow-y-auto p-4 pb-36" ref="chatContainer">
                <div v-for="message in messages" :key="message">
                    <!-- Incoming Message -->
                    <div v-if="message.sender_id != auth.user.value.id" class="flex mb-4">
                        <div class="w-9 h-9 rounded-full flex items-center justify-center mr-2">
                            <img src="https://placehold.co/200x/ffa8e4/ffffff.svg?text=ʕ•́ᴥ•̀ʔ&font=Lato" alt="User Avatar"
                                class="w-8 h-8 rounded-full">
                        </div>
                        <div class="flex max-w-96 bg-white rounded-lg p-3 gap-3">
                            <p class="text-gray-700">{{ message.message }}</p>
                        </div>
                    </div>

                    <!-- Outgoing Message -->
                    <div v-if="message.sender_id == auth.user.value.id" class="flex justify-end mb-4">
                        <div class="flex max-w-96 bg-indigo-500 text-white rounded-lg p-3 gap-3">
                            <p>{{ message.message }}</p>
                        </div>
                        <div class="w-9 h-9 rounded-full flex items-center justify-center ml-2">
                            <img src="https://placehold.co/200x/b7a8ff/ffffff.svg?text=ʕ•́ᴥ•̀ʔ&font=Lato" alt="My Avatar"
                                class="w-8 h-8 rounded-full">
                        </div>
                    </div>

                </div>

            </div>

            <!-- Chat Input -->
            <footer class="bg-white border-t border-gray-300 p-4 absolute bottom-0 w-3/4" >
                <div class="flex items-center">
                    <input v-model="sendmsg" @keyup.enter="sendMessage" type="text" placeholder="Type a message..."
                        class="w-full p-2 rounded-md border border-gray-400 focus:outline-none focus:border-blue-500">
                    <button v-on:click="sendMessage"
                        class="bg-indigo-500 text-white px-4 py-2 rounded-md ml-2">Send</button>
                </div>
            </footer>
        </div>

    </div>
</template>
  
<script setup lang="ts">
definePageMeta({layout: "staff",
middleware: ['is-authorized','is-staff']})
import { useAuthStore } from "~/stores/useAuthStore";
const auth = useAuthStore();
import Pusher from 'pusher-js';

const messages = ref<any>([]);

const addMessage = (data: any) => {
    messages.value.push(data);
};


// Enable pusher logging - don't include this in production
Pusher.logToConsole = true;

const pusher = new Pusher('810b5d5ed78fa9459654', {
    cluster: 'ap1',
});

let channelName = 'chat';

let channel = pusher.subscribe(channelName);

// channel.bind('message', (data: any) => {
//     addMessage(data);
// });

const binding = ref(0)
const chatName = ref('')
const showChat = ref(false)

async function onClickChat(id: any, first_name: any) {

    messages.value = [];

    binding.value = id;

    await fetchChat(id);

    channel.unbind_all();

    channel.unsubscribe();

    channel = pusher.subscribe('chat' + id);

    channel.bind('message', (data: any) => {
        addMessage(data);
    });


    chatName.value = first_name;

    await showChatTrue();

    await scrollBottom();

}

const clickOutside = async() => {
    showChat.value = false;
};

async function showChatTrue() {
    showChat.value = true;
}

const chatContainer = ref();

async function scrollBottom() {

    if (showChat.value) {
        const element = chatContainer.value

        element.scrollTop = element.scrollHeight;
    }

};

// allStaffChannels

const allChannels = ref([])

async function getChannel() {
    const { data: channelsResponse, error: channelsError } = await useApiFetch(`api/message/getStaffChannels`, {});

    if (channelsResponse.value) {

        // allChannels.value = channelsResponse.value;
        allChannels.value = [];

        for (const channel in channelsResponse.value) {

            if (channelsResponse.value[channel].id == auth.user.value.id) {
                continue;
            }
            allChannels.value.push(channelsResponse.value[channel])

        }

        allChannels.value.sort((a, b) => {
            const createdAtA = new Date(a.last_message.created_at);
            const createdAtB = new Date(b.last_message.created_at);

            return createdAtB - createdAtA;
        });

    } else {
        if (channelsError.value) {


        }
    }
}

await getChannel();

// fetch chat

async function fetchChat(id: any) {

    const { data: chatResponse, error: chatError } = await useApiFetch(`api/message/fetchChatStaff/${id}`, {});

    if (chatResponse.value) {

        for (const chat in chatResponse.value) {

            addMessage(chatResponse.value[chat]);

        }

        // await getChannel();

    } else {
        if (chatError.value) {

        }

    }


}

// send message
const sendmsg = ref('')

async function sendMessage() {

    if (sendmsg.value === '') {

        return;

    } else {

        const { data: sendResponse, error: sendError } = await useApiFetch(`api/message/messageStaff`, {
            method: "POST",
            body: {
                channel_id: binding.value,
                sender_id: auth.user.value.id,
                message: sendmsg.value

            }
        });

        if (sendResponse.value) {

            sendmsg.value = ''

            // await getChannel();

        } else {
            if (sendError.value) {

                alert(sendError.value.data.message);

            }
        }

    }

}

// Chat Change

const pusher2 = new Pusher('810b5d5ed78fa9459654', {
    cluster: 'ap1',
});

let channelName2 = 'my-channel';

let channel2 = pusher2.subscribe(channelName2);

channel2.bind('my-event', async() => {
    await getChannel();
});

</script>
  