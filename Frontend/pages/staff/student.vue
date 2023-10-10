<template>
    <!-- active user  -->
<div class="p-16 min-h-screen bg-gradient-to-b to-purple-100 to-60% from-[#bce1ff] from-10%">
        <div class="flex justify-between items-center">
            <h2 class="my-4 text-4xl font-semibold text-gray-600">Student List</h2>
            <label
                class="relative bg-white min-w-sm max-w-2xl flex flex-col md:flex-row items-center justify-center border  px-2 rounded-2xl gap-2 shadow-2xl focus-within:border-gray-300"
                for="search-bar">
                <input id="search-bar" placeholder="teacher name"
                    class="px-6 py-2 w-full rounded-md flex-1 outline-none bg-white">
                <button
                    class="w-full md:w-auto px-4 py-1 bg-black border-black text-white fill-white active:scale-95 duration-100 border will-change-transform overflow-hidden relative rounded-xl transition-all disabled:opacity-70">
                    
                    <div class="relative">

                        <!-- Loading animation change opacity to display -->
                        <div
                            class="flex items-center justify-center h-3 w-3 absolute inset-1/2 -translate-x-1/2 -translate-y-1/2 transition-all">
                            <svg class="opacity-0 animate-spin w-full h-full" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                    stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor"
                                    d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                </path>
                            </svg>
                        </div>

                        <div class="flex items-center transition-all opacity-1 valid: "><span
                                class="text-sm font-semibold whitespace-nowrap  mx-auto">
                                Search
                            </span>
                        </div>

                    </div>
                    
                </button>
            </label>    
            
            <div class="relative inline-block text-left">
                <div>
                    <button v-on:click="filter = !filter" type="button" class="inline-flex w-full justify-center gap-x-1.5 rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50" id="menu-button" aria-expanded="true" aria-haspopup="true">
                    Filters
                    <svg class="-mr-1 h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                        <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z" clip-rule="evenodd" />
                    </svg>
                    </button>
                </div>

                
                <div v-if="filter" v-click-outside="clickOutside" class="absolute right-0 z-10 mt-2 w-56 origin-top-right rounded-md bg-white shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none" role="menu" aria-orientation="vertical" aria-labelledby="menu-button" tabindex="-1">
                    <div class="py-1" role="none">
                    <!-- Active: "bg-gray-100 text-gray-900", Not Active: "text-gray-700" -->
                        <a href="#" class="text-gray-700 block px-4 py-2 text-sm" role="menuitem" tabindex="-1" id="menu-item-0">Active Students</a>
                        <a href="#" class="text-gray-700 block px-4 py-2 text-sm" role="menuitem" tabindex="-1" id="menu-item-1">Non Active Students</a>
                    
                    </div>
                </div>
            </div>

        </div>
                <div class="pb-2 flex items-center justify-between text-gray-600">
                    <!-- Header -->
                    <div>
                        <span>
                            <span class="text-green-400">
                                431
                            </span>
                            teachers
                        </span>
                        <span>
                            <span class="text-green-400">
                                22
                            </span>
                            courses
                        </span>
                    </div>

                </div>

        <!-- card -->
            <div class="flex flex-col gap-2">
                <div
                    class="mt-2 flex  px-4 py-4 justify-between bg-white
                    shadow-2xl rounded-lg cursor-pointer w-full">
                    <!-- Card -->

                    
                        <!-- Left side -->

                        <img
                            class="h-12 w-12 rounded-full object-cover"
                            src="https://inews.gtimg.com/newsapp_match/0/8693739867/0"
                            alt="" />

                        <div
                            class="ml-4 flex flex-col capitalize text-black">
                            <span>name</span>
                            <span class="mt-2 text-gray-600">
                                carmen beltran
                            </span>
                        </div>

                        <div
                            class="ml-12  flex flex-col capitalize text-black">
                            <span>Phone Number</span>
                            <span class="mt-2 text-gray-600">
                                097-232-2233
                            </span>

                        </div>

                        <div
                            class="mr-16 flex flex-col text-black">
                            <span>Email</span>
                            <span class="mt-2 text-gray-600">
                                ingfosbreak@outlook.com
                            </span>
                            
                        </div>

                        <div
                            class="ml-12 flex flex-col capitalize text-black">
                            <span>Courses</span>
                            <span class="text-red-400">
                                No courses
                            </span>
                        </div>


                        <div
                            class="mr-16 flex flex-col capitalize text-gray-600">
                            <span>Profile info</span>
                            <NuxtLink to="/staff/detail/teacher">
                            <span class="text-gray-600">see more...</span>
                            </NuxtLink>
                        </div>



                </div>

                <div
                    class="mt-2 flex px-4 py-4 justify-between bg-white
                    shadow-2xl rounded-lg cursor-pointer w-full">
                    <!-- Card -->

                    
                        <!-- Left side -->

                        <img
                            class="h-12 w-12 rounded-full object-cover"
                            src="https://inews.gtimg.com/newsapp_match/0/8693739867/0"
                            alt="" />

                        <div
                            class="ml-4 flex flex-col capitalize text-black">
                            <span>name</span>
                            <span class="mt-2 text-gray-600">
                                carmen beltran
                            </span>
                        </div>

                        <div
                            class="ml-12  flex flex-col capitalize text-black">
                            <span>Phone Number</span>
                            <span class="mt-2 text-gray-600">
                                097-232-2233
                            </span>

                        </div>

                        <div
                            class="mr-16 flex flex-col text-black">
                            <span>Email</span>
                            <span class="mt-2 text-gray-600">
                                ingfosbreak@outlook.com
                            </span>
                            
                        </div>

                        <div
                            class="ml-12 flex flex-col capitalize text-black">
                            <span>Courses</span>
                            <span class="text-red-400">
                                No courses
                            </span>
                        </div>


                        <div
                            class="mr-16 flex flex-col capitalize text-gray-600">
                            <span>Profile info</span>
                            <NuxtLink to="/staff/detail/teacher">
                            <span class="text-gray-600">see more...</span>
                            </NuxtLink>
                        </div>



                </div>

            </div>
            <Paginate class="mt-8" :from="1" :last_page="10"/>


</div>

    

    
   



</template>

<script setup lang="ts">
definePageMeta({layout: "staff"})

const filter = ref(false)

const clickOutside = () => {
  filter.value = false;
};


</script>