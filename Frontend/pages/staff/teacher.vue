<template>
    <div class="p-16 min-h-screen bg-gradient-to-b to-purple-100 to-60% from-[#bce1ff] from-10%">
        <div class="flex justify-between items-center">
            <h2 class="my-4 text-4xl font-semibold text-gray-600">Teacher List</h2>
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
            <button v-on:click="regisUp"
            class="px-3 py-2 bg-white font-medium text-gray-800 rounded-lg shadow-md border border-gray-300 hover:bg-gray-200">
                Register teacher

            </button>
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

    

    <div v-if="Registration" class="min-h-screen bg-gradient-to-t to-purple-100 to-60% from-[#bce1ff] from-10% flex flex-col items-center justify-center">

        <div class="relative flex py-5 items-center w-full px-10">
            <div class="flex-grow border-t border-gray-400"></div>
            <span class="flex-shrink mx-4 text-gray-400">Teacher Registration</span>
            <div class="flex-grow border-t border-gray-400"></div>
        </div>

        <h2 ref="scrollRegis" class="my-4 text-4xl font-semibold text-gray-600">Registration Form</h2>        
            <div class="mx-auto w-full max-w-[1000px] bg-white px-5 py-5 shadow-2xl rounded-lg">
            <form action="https://formbold.com/s/FORM_ID" method="POST">
            <div class="mb-5">
                <label
                for="name"
                class="mb-3 block text-base font-medium text-[#07074D]"
                >
                Full Name
                </label>
                <input
                type="text"
                name="name"
                id="name"
                placeholder="Full Name"
                class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"
                />
            </div>
            <div class="mb-5">
                <label
                for="email"
                class="mb-3 block text-base font-medium text-[#07074D]"
                >
                Email Address
                </label>
                <input
                type="email"
                name="email"
                id="email"
                placeholder="example@domain.com"
                class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"
                />
            </div>
            <div class="mb-5">
                <label
                for="subject"
                class="mb-3 block text-base font-medium text-[#07074D]"
                >
                Subject
                </label>
                <input
                type="text"
                name="subject"
                id="subject"
                placeholder="Enter your subject"
                class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"
                />
            </div>
            <div class="mb-5">
                <label
                for="message"
                class="mb-3 block text-base font-medium text-[#07074D]"
                >
                Message
                </label>
                <textarea
                rows="4"
                name="message"
                id="message"
                placeholder="Type your message"
                class="w-full resize-none rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"
                ></textarea>
            </div>
            <div class="flex gap-3">
                <button
                class="hover:shadow-form rounded-md bg-[#6A64F1] py-3 px-8 text-base font-semibold text-white outline-none"
                >
                Submit
                </button>
                <button v-on:click="regisDown"
                class="hover:shadow-form rounded-md bg-red-400 py-3 px-8 text-base font-semibold text-white outline-none"
                >
                Cancel
                </button>
            </div>
            </form>
        </div>

            
    </div>

    

		

</template>


<script setup lang="ts">
definePageMeta({layout: "staff"})

const Registration = ref(false)
const scrollRegis = ref()

async function setRegis() {
    Registration.value = !Registration.value;
}

const regisUp  = async() => {

    await setRegis();

    if (scrollRegis.value) {
        const element = scrollRegis.value.getBoundingClientRect();
  
        // Scroll to the element with smooth animation
        window.scrollTo({
            top: element.top + window.scrollY,
            behavior: 'smooth',
        });
    }

};

const regisDown  = async() => {

    await setRegis();

    // Scroll to the element with smooth animation
    window.scrollTo({
        top: 0,
        behavior: 'smooth',
    });

};


</script>