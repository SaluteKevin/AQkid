<template>
    <div class="relative flex place-content-center p-10 min-h-screen bg-gradient-to-b from-sky-300 from-50% to-orange-300">
        <div class="h-auto bg-white rounded-lg p-2 font-semibold grid grid-flow-row ">
                <img class="h-full w-auto" src="https://media.discordapp.net/attachments/711217095681245235/1163756633248256020/screenshot_20231017_153305.png?ex=6540bbd2&is=652e46d2&hm=ed685f35d47d877d7d50a69b0352335448310412b882c321fe23a09c0316768b&=&width=426&height=735">
                <div class="text-center text-2xl bg-cyan-950 text-white p-2">Infomation</div>
                <div class="bg-orange-100 p-2 space-y-2"> 
                    <div class="text-2xl">
                    Student_UsernameStudent_Username<br>
                    <span class="text-2xl text-gray-600">Student_Name</span>
                    </div>
                    <div class="text-lg">Phone_number</div>
                    <div>0811111111</div>
                    <div class="text-lg">Email</div>
                    <div class="">email@gmail.com</div>
                    <div class="flex justify-center">
                        <button class="bg-green-500 px-10 py-1 border-2 border-white hover:bg-green-700 rounded-lg text-lg text-white mx-1">accept</button>
                        <button class="bg-rose-500 px-10 py-1 border-2 border-white hover:bg-rose-700 rounded-lg text-lg text-white mx-1">denied</button>
                    </div>
                    </div>
        </div>
        <div class="absolute left-10 top-10">
            <NuxtLink to="/staff/request">
            <button class="bg-orange-500 px-8 py-1 text-xl text-white border-2 border-white hover:bg-orange-700 duration-150 rounded-lg">
                back
            </button>
            </NuxtLink>
        </div>
    </div>
</template>

<script lang="ts">
import { NuxtLink } from '#build/components';

definePageMeta({layout: "staff"})



</script>