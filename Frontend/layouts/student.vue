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
                <NuxtLink class="flex items-center space-x-2" to="/student" >
                        
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
                    <img :src="`${config.public.imageBaseURL}${user.profile_image_path}`" class="bg-gray-700 h-12 w-12 rounded-full">
                </NuxtLink>

                <!-- Login -->
                <button v-on:click="logout" class="flex text-gray-600 
                    cursor-pointer transition-colors duration-300
                    font-semibold hover:text-blue-600" to="/auths/login">

                    <svg class="fill-current h-5 w-5 mr-2 mt-0.5" xmlns="http://www.w3.org/2000/svg"
                        xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" width="24" height="24"
                        viewBox="0 0 24 24">
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

import {useAuthStore} from "~/stores/useAuthStore";
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


</script>