<template>
    <!-- active user  -->
    <div class="p-16 min-h-screen bg-gradient-to-b to-orange-200 to-60% from-[#bce1ff] from-10%">
        <div class="flex justify-between items-center">
            <h2 class="my-4 text-4xl font-semibold text-gray-600 w-1/3">Student List</h2>
            <label
                class="relative bg-white min-w-sm max-w-2xl flex flex-col md:flex-row items-center justify-center border  px-2 rounded-2xl shadow-2xl focus-within:border-gray-300 w-1/2"
                for="search-bar">
                <input id="search-bar" placeholder="student name" v-on:change="handleSearchStudent"
                    class="px-6 py-2 w-full rounded-md flex-1 outline-none bg-white">
                <button
                    class="w-full md:w-auto px-4 py-1 bg-black border-black text-white fill-white active:scale-95 duration-100 border will-change-transform overflow-hidden relative rounded-xl transition-all disabled:opacity-70">

                    <div class="relative">

                        <!-- Loading animation change opacity to display -->
                        <div
                            class="flex items-center justify-center h-3 w-3 absolute inset-1/2 -translate-x-1/2 -translate-y-1/2 transition-all">
                            <svg class="opacity-0 animate-spin w-full h-full" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4">
                                </circle>
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

            <div class="relative inline-block text-left flex gap-3 items-center">
                <div>Filter : </div>
                <div>
                    <button v-on:click="filter = !filter" type="button"
                        class="inline-flex w-full justify-center gap-x-1.5 rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50"
                        id="menu-button" aria-expanded="true" aria-haspopup="true">
                        {{ filterSelect }}
                        <svg class="-mr-1 h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd"
                                d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z"
                                clip-rule="evenodd" />
                        </svg>
                    </button>
                </div>


                <div v-if="filter" v-click-outside="clickOutside"
                    class="absolute right-0 z-10 mt-2 w-56 origin-top-right rounded-md bg-white shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none"
                    role="menu" aria-orientation="vertical" aria-labelledby="menu-button" tabindex="-1">
                    <div class="py-1" role="none">
                        <!-- Active: "bg-gray-100 text-gray-900", Not Active: "text-gray-700" -->
                        <div v-on:click="selectFilter('all')"
                            class="text-gray-700 block px-4 py-2 text-sm hover:bg-gray-300" role="menuitem" tabindex="-1"
                            id="menu-item-0">All</div>
                        <div v-on:click="selectFilter('active')"
                            class="text-gray-700 block px-4 py-2 text-sm hover:bg-gray-300" role="menuitem" tabindex="-1"
                            id="menu-item-1">Active </div>
                        <div v-on:click="selectFilter('inactive')"
                            class="text-gray-700 block px-4 py-2 text-sm hover:bg-gray-300" role="menuitem" tabindex="-1"
                            id="menu-item-2">Non Active </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="pb-2 flex items-center justify-between text-gray-600">
            <!-- Header -->
            <div>
                <span>
                    <span class="text-green-400">
                        {{studentsCount}}
                    </span>
                    Students
                </span>
                
            </div>

        </div>

        <!-- card -->
        <div class="flex flex-col gap-2">
            <div v-for="student in showStudents" :key="student.username" class="flex  px-2 py-2 justify-between bg-white
                    shadow-lg cursor-pointer w-full">
                <!-- Card -->


                <!-- Left side -->

                <img class="h-14 w-14 rounded-full object-cover" src="https://inews.gtimg.com/newsapp_match/0/8693739867/0"
                    alt="" />

                <div class="ml-4 mt-4 flex capitalize text-black w-1/4">
                    <span class="mr-2">name:</span>
                    <span class="text-gray-600">
                        {{ student.username }}
                    </span>
                </div>

                <div class="ml-12 mt-1 capitalize text-black w-1/4">
                    <span class="mr-2">Phone Number: </span>
                    <span class="text-gray-600">
                        {{ student.phone_number }}
                    </span><br>
                    <div>
                        <span>Email: </span>
                    <span v-if="student.email" class="mr-2 text-gray-600">
                        {{ student.email }}
                    </span>
                    <span v-else="student.email" class="mr-2 text-gray-600">
                        none
                    </span>
                    </div>
                </div>

                <div class="ml-12 flex flex-col capitalize text-black w-1/4">
                    <span>Active Courses</span>
                    <span class="text-red-400" v-if="student.courses_count == 0">
                                No courses
                     </span>
                    <span class="text-green-600" v-if="student.courses_count != 0">
                        {{ student.courses_count }}
                    </span>
                </div>


                <div class="mr-16 flex flex-col capitalize text-gray-600">
                    <span>Profile info</span>

                    <NuxtLink :to="`/staff/detail/student${student.id}`">
                        <span class="text-gray-600">see more...</span>
                    </NuxtLink>
                </div>



            </div>



        </div>
        <Paginate class="mt-8" @change-page="onChangePage" :from="currentpage" :last_page="last_page" />



    </div>
</template>

<script setup lang="ts">
definePageMeta({ layout: "staff" })
import { usePaginateStore } from '~/stores/usePaginateStore'
const paginate = usePaginateStore();


// fitler section
const filter = ref(false)
const filterSelect = ref(paginate.student_filter)

const clickOutside = () => {
    filter.value = false;
};

const selectFilter = async (select: string) => {

    if (filterSelect.value === select) {

        filter.value = false;


    }
    else {

        filterSelect.value = select;
        filter.value = false;

        await paginate.setStudentPage(1);

        await paginate.setStudentFilter(select);

        // await fetchStudents(paginate.student_page);
        
        window.location.reload();

    }
    


}


// allStudents

const allStudents = ref({})
const showStudents = ref({})
const studentsCount = ref<Number>(0)

// await fetchStudents();

async function fetchStudents(page: number) {

    const { data: studentResponse, error: studentError } = await useApiFetch("api/staff/filterStudents?page=" + page, {
        method: "POST",
        body: {
            filter: filterSelect.value
        }
    });

    if (studentResponse.value) {

        last_page.value = studentResponse.value.last_page;

        allStudents.value = studentResponse.value.data;

        showStudents.value = allStudents.value;

        studentsCount.value = showStudents.value.length;


    }
    else {

        if (studentError.value) {
            console.log(studentError.value);
        }

    }


}

// paginate


const currentpage = ref(paginate.student_page)
const last_page = ref<Number>(0)

async function onChangePage(page: any) {

    // console.log(page.value)
    // currentpage.value = page.value

    await paginate.setStudentPage(page.value);

    await fetchStudents(paginate.student_page);

}

await fetchStudents(paginate.student_page);


// Search student

async function handleSearchStudent(event) {

    // event.target.value.toLowerCase()

    if (event.target.value === '') {

        window.location.reload();

    }

    else {

        const { data: studentResponse, error: studentError } = await useApiFetch("api/staff/searchStudent", {
            method: "POST",
            body: {
                search: event.target.value
            },
        });

        if (studentResponse.value) {

            showStudents.value = studentResponse.value;

            studentsCount.value = showStudents.value.length;

        }
        else {

            if (studentError.value) {
                console.log(studentError.value);
            }

        }

    }


}



</script>