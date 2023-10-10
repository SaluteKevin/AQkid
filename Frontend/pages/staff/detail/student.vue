<template>
<div class="col-span-2 h-screen ">
                <!-- component -->
                <div class="mx-auto mt-48 flex items-center justify-center">
                    <div class="w-full">

                        <div class="bg-white relative shadow rounded-lg w-5/6 md:w-5/6  lg:w-4/6 xl:w-3/6 mx-auto">
                            <div class="flex justify-center">
                                    <img src="https://avatars0.githubusercontent.com/u/35900628?v=4" alt="" class="rounded-full mx-auto absolute -top-20 w-32 h-32 shadow-md border-4 border-white transition duration-200 transform hover:scale-110">
                            </div>
                            
                            <div class="mt-16">
                                <h1 class="font-bold text-center text-3xl text-gray-900">Student_Username</h1>
                                <p class="text-center text-xl text-gray-400 font-medium">FirstName LastName</p>
                                <div class="w-full mt-4">
                                    <h3 class="font-medium text-gray-900 text-left px-6">
                                        Birthdate: 
                                        <span class="w-full  text-gray-600 pr-3 w-full ">
                                            12 December 2077
                                        </span>
                                    </h3>

                                    <h3 class="font-medium text-gray-900 text-left px-6">
                                        Tel: 
                                        <span class="w-full  text-gray-600 pr-3 w-full">
                                            081 111 1111
                                        </span>
                                    </h3>

                                    <h3 class="font-medium text-gray-900 text-left px-6">
                                        Email: 
                                        <span class="w-full  text-gray-600 pr-3 w-full">
                                            idontknowthis@email.com
                                        </span>
                                    </h3>
                                </div>

                                <div class="w-full">
                                    <h3 class="font-semibold text-gray-900 text-left px-6 mt-4 text-2xl">Recent activites</h3>
                                    <div class="w-full flex flex-col items-center overflow-hidden text-sm">
                                        <div class="w-full border-t border-gray-100 text-gray-600 py-4 pl-6 pr-3 w-full block hover:bg-gray-100 transition duration-150">
                                            <img src="https://avatars0.githubusercontent.com/u/35900628?v=4" alt="" class="rounded-full h-6 shadow-md inline-block mr-2">
                                                Start new course: 13 Dec 2077
                                        </div>
                                        <div class="w-full border-t border-gray-100 text-gray-600 py-4 pl-6 pr-3 w-full block hover:bg-gray-100 transition duration-150">
                                            <img src="https://avatars0.githubusercontent.com/u/35900628?v=4" alt="" class="rounded-full h-6 shadow-md inline-block mr-2">
                                                Start new course: 13 Dec 2077
                                        </div>
                                        <div class="w-full border-t border-gray-100 text-gray-600 py-4 pl-6 pr-3 w-full block hover:bg-gray-100 transition duration-150">
                                            <img src="https://avatars0.githubusercontent.com/u/35900628?v=4" alt="" class="rounded-full h-6 shadow-md inline-block mr-2">
                                                Start new course: 13 Dec 2077
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
definePageMeta({layout: "staff"})

</script>