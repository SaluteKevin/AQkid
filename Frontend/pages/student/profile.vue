<template>
    <!-- <AppHeaderStudent /> -->
    <div class="min-h-screen bg-gradient-to-l to-purple-50 to-60% from-[#bce1ff] from-10%">
        <div class="container mx-auto py-8">
            <div class="grid grid-cols-4 sm:grid-cols-12 gap-6 px-4">
                <div class="col-span-4 sm:col-span-3">
                    <div class="bg-white shadow rounded-lg p-6">
                        <div class="flex flex-col items-center">
                            <img :src="`${config.public.imageBaseURL}${user.value.profile_image_path}`" class="w-32 h-32 bg-gray-300 rounded-full mb-4 shrink-0">
    
                            
                            <h1 class="text-xl font-bold">{{ user.value.username }}</h1>
                            <div class="mt-6 flex flex-wrap gap-4 justify-center">
                                <NuxtLink class="bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded" to="/auths/editprofile">Edit Profile</NuxtLink>
                            </div>
                        </div>
                        <hr class="my-6 border-t border-gray-300">
                        <div class="flex flex-col">
                            <span class="text-gray-600 uppercase font-bold tracking-wider mb-2">Student Profile</span>
                            <ul>
                                <p>Firstname : {{ user.value.first_name }}</p>
                                <p>Middlename : {{ user.value.middle_name }}</p>
                                <p>Lastname : {{ user.value.last_name }}</p>
                                <p>Email : {{ user.value.email }}</p>
                                <p>birthdate : {{ user.value.birthdate }}</p>
                            </ul>
                        </div>
                    </div>
                </div>
                <!--Card Courses-->
                <div class="col-span-4 sm:col-span-6 items-center">
                    <div class="bg-white shadow rounded-lg p-6">
                        <h2 class="flex justify-center text-xl font-bold mb-4 ">HISTORY & COURSES</h2>
                        <div class="flex flex-col gap-4 w-full ">
                            <div
                                class="w-full group relative cursor-pointer overflow-hidden bg-white px-6 pt-10 pb-8 shadow-xl ring-1 ring-gray-900/5 transition-all duration-300 hover:-translate-y-1 hover:shadow-2xl ">
                                <span class="absolute top-10 z-0 h-20 w-20 rounded-full bg-sky-500 transition-all duration-700 group-hover:scale-[30]"></span>
                                <div class="relative z-10 mx-auto ">
                                    <span class="grid h-20 w-20 place-items-center rounded-full bg-sky-500 transition-all duration-300 group-hover:bg-sky-400">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-10 w-10 text-white transition-all">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M8.625 9.75a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0H8.25m4.125 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0H12m4.125 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0h-.375m-13.5 3.01c0 1.6 1.123 2.994 2.707 3.227 1.087.16 2.185.283 3.293.369V21l4.184-4.183a1.14 1.14 0 01.778-.332 48.294 48.294 0 005.83-.498c1.585-.233 2.708-1.626 2.708-3.228V6.741c0-1.602-1.123-2.995-2.707-3.228A48.394 48.394 0 0012 3c-2.392 0-4.744.175-7.043.513C3.373 3.746 2.25 5.14 2.25 6.741v6.018z" />
                                        </svg>
                                    </span>
                                    <div
                                        class="space-y-6 pt-5 text-base leading-7 text-gray-600 transition-all duration-300 group-hover:text-white/90">
                                        <p>Goodjob You pass</p>
                                    </div>
                                    <div class="pt-5 text-base font-semibold leading-7">
                                        <p>
                                            <a href="#" class="text-sky-500 transition-all duration-300 group-hover:text-white">Read the docs
                                                &rarr;
                                            </a>
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <div
                                class="w-full group relative cursor-pointer overflow-hidden bg-white px-6 pt-10 pb-8 shadow-xl ring-1 ring-gray-900/5 transition-all duration-300 hover:-translate-y-1 hover:shadow-2xl ">
                                <span class="absolute top-10 z-0 h-20 w-20 rounded-full bg-sky-500 transition-all duration-700 group-hover:scale-[30]"></span>
                                <div class="relative z-10 mx-auto ">
                                    <span class="grid h-20 w-20 place-items-center rounded-full bg-sky-500 transition-all duration-300 group-hover:bg-sky-400">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-10 w-10 text-white transition-all">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M8.625 9.75a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0H8.25m4.125 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0H12m4.125 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0h-.375m-13.5 3.01c0 1.6 1.123 2.994 2.707 3.227 1.087.16 2.185.283 3.293.369V21l4.184-4.183a1.14 1.14 0 01.778-.332 48.294 48.294 0 005.83-.498c1.585-.233 2.708-1.626 2.708-3.228V6.741c0-1.602-1.123-2.995-2.707-3.228A48.394 48.394 0 0012 3c-2.392 0-4.744.175-7.043.513C3.373 3.746 2.25 5.14 2.25 6.741v6.018z" />
                                        </svg>
                                    </span>
                                    <div
                                        class="space-y-6 pt-5 text-base leading-7 text-gray-600 transition-all duration-300 group-hover:text-white/90">
                                        <p>Perfect for learning how the framework works, prototyping a new idea, or creating a demo to share
                                            online.</p>
                                    </div>
                                    <div class="pt-5 text-base font-semibold leading-7">
                                        <p>
                                            <a href="#" class="text-sky-500 transition-all duration-300 group-hover:text-white">Read the docs
                                                &rarr;
                                            </a>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script setup lang="ts">

import {useAuthStore} from "~/stores/useAuthStore";
const config = useRuntimeConfig()

const user = useAuthStore().user;
definePageMeta({ layout: "student" })
console.log(user.value.id);


</script>