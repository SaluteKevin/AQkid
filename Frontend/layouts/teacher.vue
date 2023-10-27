<template>
    <header
        class="fixed inset-x-0 top-0 z-30 mx-auto w-full max-w-screen-md border border-gray-100 bg-white/80 py-3 shadow backdrop-blur-lg md:top-6 md:rounded-3xl lg:max-w-screen-lg">
        <div class="px-4">
            <div class="flex items-center justify-between">
                <div class="flex shrink-0">
                    <NuxtLink aria-current="page" class="flex items-center" to="/">
                        <img class="h-7 w-auto" src="/images/AQKids_logo.png" alt="">
                    </NuxtLink>
                </div>
                <div class="hidden md:flex md:items-center md:justify-center md:gap-5">
                    <NuxtLink class="flex text-gray-600 hover:text-blue-500
                    cursor-pointer transition-colors duration-300" to="/teacher">
                    Home
                </NuxtLink>
                    
                </div>
                <div class="flex items-center justify-end gap-3">
                    <NuxtLink class="hidden items-center justify-center rounded-xl bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 transition-all duration-150 hover:bg-gray-50 sm:inline-flex"
                        to="/teacher/profile">{{ auth.user.value.username }}</NuxtLink>
                    <button v-on:click='logout' class="inline-flex items-center justify-center rounded-xl bg-red-600 px-3 py-2 text-sm font-semibold text-white shadow-sm transition-all duration-150 hover:bg-blue-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-600"
                       >Logout</button>
                </div>
            </div>
        </div>
    </header>
    <div class="mt-24">
        <slot />
    </div>
</template>

<script setup lang="ts">

import {useAuthStore} from "~/stores/useAuthStore";
const auth = useAuthStore();

await auth.setCSRFCookie();

async function logout() {

    await auth.clearAuth();

    await navigateTo(`/`);
}
    

function isTeacher() {

    if (auth.user.value.role === "TEACHER" && auth.isLogin) {
        return true;
    }

    return false;


}

</script>