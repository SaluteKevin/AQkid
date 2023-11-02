<template>
    <div class="flex flex-col mb-16">
        <!-- Page Scroll Progress -->
        <div class="fixed inset-x-0 top-0 z-50 h-0.5 mt-0.5
            bg-blue-500" :style="`width: ${percent}%`"></div>

        <!-- Navbar -->
        <nav class="flex justify-around py-4 bg-white/80
            backdrop-blur-md shadow-md w-full
            fixed top-0 left-0 right-0 z-20">

            <!-- Logo Container -->
            <div class="flex items-center">
                <!-- Logo -->
                <NuxtLink class="flex items-center space-x-2" to="/student">

                    <div aria-hidden="true" class="flex space-x-1">
                        <img src="/images/AQKids_logo.png" class="h-12">
                    </div>
                    <span class="text-4xl font-bold text-cyan-900">AQKids</span>
                </NuxtLink>
            </div>

            <!-- Links Section -->
            <div class="items-center hidden space-x-8 lg:flex">

            </div>

            <!-- Icon Menu Section -->
            <div class="flex items-center justify-center space-x-6">
                <!-- Profile -->
                <NuxtLink v-if="isStudent()" class="h-full flex text-gray-600 hover:text-blue-500
                    cursor-pointer transition-colors duration-300" to="/student/profile">
                    <div class="h-full flex place-items-center mr-1">
                        {{ user.username }}
                    </div>
                    <img :src="`${config.public.imageBaseURL}${user.profile_image_path}`"
                        class="bg-gray-700 h-12 w-12 rounded-full">
                </NuxtLink>

                <!-- Login -->
                <button v-on:click="logout" class="flex text-gray-600 
                    cursor-pointer transition-colors duration-300
                    font-semibold hover:text-blue-600" to="/auths/login">

                    <svg class="fill-current h-5 w-5 mr-2 mt-0.5" xmlns="http://www.w3.org/2000/svg"
                        xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" width="24" height="24" viewBox="0 0 24 24">
                        <path
                            d="M10,17V14H3V10H10V7L15,12L10,17M10,2H19A2,2 0 0,1 21,4V20A2,2 0 0,1 19,22H10A2,2 0 0,1 8,20V18H10V20H19V4H10V6H8V4A2,2 0 0,1 10,2Z" />
                    </svg>

                    Logout
                </button>





            </div>
        </nav>
    </div>

    <div>
        <slot />
    </div>
    <!-- Slider Component Container -->
    <div class="fixed bottom-6 right-24 mb-4 mr-4 z-20">
        <button @click="toggleChatbox"
            class="bg-blue-500 text-white py-2 px-4 rounded-md hover:bg-blue-600 transition duration-300 flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 mr-2" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
            </svg>
            Chat With Staff
        </button>
    </div>
    <div v-if="isChatboxOpen" v-click-outside="clickOutside" class="z-20 fixed bottom-24 right-28 w-96">
        <div class="bg-white shadow-md rounded-lg max-w-lg w-full">
            <div class="p-4 border-b bg-blue-500 text-white rounded-t-lg flex justify-between items-center">
                <p class="text-lg font-semibold">Staff Chat</p>
                <button v-on:click="clickOutside"
                    class="text-gray-300 hover:text-gray-400 focus:outline-none focus:text-gray-400">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                        </path>
                    </svg>
                </button>
            </div>
            <div class="p-4 h-80 overflow-y-auto" ref="chatContainer">
                <!-- Chat messages will be displayed here -->
                <div v-for="message in messages" :key="message">
                    <div v-if="message.sender_id == user.id" class="mb-2 text-right">
                        <p class="bg-blue-500 text-white rounded-lg py-2 px-4 inline-block">{{ message.message }}</p>
                    </div>
                    <div v-if="message.sender_id != user.id" class="mb-2">
                        <p class="bg-gray-200 text-gray-700 rounded-lg py-2 px-4 inline-block">{{ message.message }}</p>
                    </div>
                </div>

            </div>
            <div class="p-4 border-t flex">
                <input v-model="sendmsg" @keyup.enter="sendMessage" type="text" placeholder="Type a message"
                    class="w-full px-3 py-2 border rounded-l-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                <button v-on:click="sendMessage"
                    class="bg-blue-500 text-white px-4 py-2 rounded-r-md hover:bg-blue-600 transition duration-300">Send</button>
            </div>
        </div>
    </div>
</template>

<script setup lang="ts">
const config = useRuntimeConfig();
const percent = ref(0);

onMounted(() => {
    window.addEventListener('scroll', () => {
        let winScroll = document.body.scrollTop || document.documentElement.scrollTop;
        let height = document.documentElement.scrollHeight - document.documentElement.clientHeight;
        percent.value = Math.round((winScroll / height) * 100);
    });

});

import { useAuthStore } from "~/stores/useAuthStore";
import { useTimeStore } from "~/stores/useTimeStore";

const auth = useAuthStore();
const timer = useTimeStore();

const user = auth.user.value;

await auth.setCSRFCookie();

async function logout() {

    timer.clearTime();

    await auth.clearAuth();

    await navigateTo(`/`);
}


function isStudent() {

    if (auth.user.value.role === "STUDENT" && auth.isLogin) {
        return true;
    }

    return false;


}

// chatbot


const isChatboxOpen = ref(false); // Set the initial state to open

// Function to toggle the chatbox visibility
async function toggleChatbox() {
    // chatContainer.classList.toggle("hidden");
    await chatBoxOpen();

    await scrollBottom();
}

async function chatBoxOpen() {
    isChatboxOpen.value = !isChatboxOpen.value; // Toggle the state
}

const clickOutside = async () => {
    isChatboxOpen.value = false;
};


import Pusher from 'pusher-js';

const messages = ref<any>([]);

const addMessage = (data: any) => {
    messages.value.push(data);
};

const pusher = new Pusher('810b5d5ed78fa9459654', {
    cluster: 'ap1',
});

let channelName = 'chat' + user.id;

let channel = pusher.subscribe(channelName);

channel.bind('message', (data: any) => {
    addMessage(data);
});

const chatContainer = ref();

async function scrollBottom() {

    if (isChatboxOpen.value) {
        const element = chatContainer.value

        element.scrollTop = element.scrollHeight;
    }

};


const { data: chatResponse, error: chatError } = await useApiFetch(`api/message/fetchChatStudent/${user.id}`, {});

if (chatResponse.value) {

    for (const chat in chatResponse.value) {

        addMessage(chatResponse.value[chat]);

    }

    // console.log(messages)

    // await getChannel();

} else {
    if (chatError.value) {

    }

}


const sendmsg = ref('')

async function sendMessage() {

    if (sendmsg.value === '') {

        return;

    } else {

        const { data: sendResponse, error: sendError } = await useApiFetch(`api/message/messageStudent`, {
            method: "POST",
            body: {
                id: user.id,
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

</script>