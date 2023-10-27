<template>
    
    <div class="min-h-screen bg-gradient-to-b from-sky-200 from-40% to bg-orange-100 text-gray-900 flex justify-center px-20">
        <div class="m-10 bg-white shadow sm:rounded-lg flex justify-center flex-1">
            <div class="lg:w-1/2 xl:w-5/12 p-6 sm:p-12">
                <div>
                    <NuxtLink to="/" class="flex">
                        <img src="/images/AQKids_logo.png"
                            class="w-1/3"/>
                        <div class="p-4 flex text-6xl font-bold text-cyan-900 justify-center items-center">
                            AquaKids
                        </div>
                    </NuxtLink>
                </div>
                <div class="mt-12 flex flex-col items-center">
                    <form class="w-full flex-1 mt-8" @submit.prevent="handleLogin()">
                        <div class="mx-auto max-w-xs text-lg space-y-6">
                            <div>
                                Username
                                <input v-model="loginForm.username"
                                    class="w-full px-8 py-4 rounded-lg font-medium bg-gray-100 border border-gray-200 placeholder-gray-500 text-sm focus:outline-none focus:border-gray-400 focus:bg-white"
                                    type="text" name="username" placeholder="Email or Username" />
                                <p class="text-red-500" v-for="error in loginErrors['username']" :key="error">
                                    {{ error }}
                                </p>
                            </div>
                            <div>
                                Password
                                <input v-model="loginForm.password"
                                    class="w-full px-8 py-4 rounded-lg font-medium bg-gray-100 border border-gray-200 placeholder-gray-500 text-sm focus:outline-none focus:border-gray-400 focus:bg-white"
                                    type="password" name="password" placeholder="Password" />
                                <p class="text-red-500" v-for="error in loginErrors['password']" :key="error">
                                    {{ error }}
                                </p>
    
                                <p class="text-red-500" v-for="error in loginErrors['error']" :key="error">
                                    {{ error }}
                                </p>
                            </div>
                            <button type="submit"
                                class="mt-5 tracking-wide font-semibold bg-orange-500 text-white-500 w-full py-4 rounded-lg text-white hover:bg-white hover:shadow-xl hover:text-black transition-all duration-300 ease-in-out flex items-center justify-center focus:shadow-outline focus:outline-none">
                                <svg class="w-6 h-6 -ml-2" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M16 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2" />
                                    <circle cx="8.5" cy="7" r="4" />
                                    <path d="M20 8v6M23 11h-6" />
                                </svg>
                                <span class="ml-">
                                    Sign In
                                </span>
                            </button>
                            <p class="text-lg font-light text-gray-700 pt-2">
                                Don't have an account yet? <NuxtLink class="font-medium text-primary-600 hover:underline" to="/auths/register">Sign up</NuxtLink>
                            </p>
                        </div>
                    </form>
                </div>
            </div>
            <div class="flex-1 bg-orange-500 text-center hidden lg:flex rounded-r-lg">
               
                <img class="w-full object-cover rounded-r-lg" src="https://media.discordapp.net/attachments/1077532767052628008/1167475946253713508/325403789_480050984314793_2213944775772322129_n.png?ex=654e43b4&is=653bceb4&hm=73ba4c52b0222f625bc07fb4be0e2cef943a2e165a960e4dd91609ba8f89a7a5&=&width=991&height=735">
            
            </div>
        </div>
    </div>
    
    
</template>
    
    
<script setup lang="ts">
    
definePageMeta({layout: false})
    import {useAuthStore} from "~/stores/useAuthStore";
    
    const auth = useAuthStore();
    
    const loginForm = ref({
      username: "",
      password: ""
    });

    const loginErrors = ref<{ [k: string]: any }>({});

    async function handleLogin() {
    
        await auth.setCSRFCookie();
         
        const {data: loginResponse, error: loginError } = await useApiFetch("api/auth/login", {
            method: "POST",
            body: {
                username: loginForm.value.username,
                password: loginForm.value.password
            },
        });
        
        if (loginResponse.value) {

            await auth.setJWTToken(loginResponse.value.access_token);

            await auth.fetchAuthUser();

            if (auth.user.value.role === "STAFF") {

                await navigateTo(`/staff`);

            }

            if (auth.user.value.role === "TEACHER") {

                await navigateTo(`/teacher`);

            }

            if (auth.user.value.role === "STUDENT") {

                await navigateTo(`/student`);

            }
             
            

        } 

        else {

            if (loginError.value) {

                const errors = loginError.value.data.errors;

                loginErrors.value = {};

                for (const key in errors) {

                    if (errors.hasOwnProperty(key)) {

                    const errorMessages = errors[key];

                    loginErrors.value[key] = errorMessages;
                    
                    }

                }

            }


        }

    }
    
    
</script>