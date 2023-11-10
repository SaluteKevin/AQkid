<template>
    <div class="bg-gradient-to-t from-indigo-400/40 to-blue-300/30 min-h-screen">

        <div class="relative flex pt-5 items-center w-full px-10 mt-20">
            <div class="flex-grow border-t border-gray-400"></div>
            <span class="flex-shrink mx-4 text-6xl text-gray-400">My Current Course</span>
            <div class="flex-grow border-t border-gray-400"></div>
        </div>
        <div class="bg-white p-12 transform ease-in-out m-12 shadow-xl border rounded-2xl gap-4 flex flex-col">

            <NuxtLink :to="`/student/makeupRequest${course.id}`" v-for="course in myCourses"
                class="cursor-pointer flex justify-between px-12 py-2 bg-orange-200 hover:bg-orange-500/60 rounded-lg shadow-lg">
                <div class="text-4xl font-semibold">
                    {{ course.title }}
                </div>
                <div class="text-4xl">
                    Start : {{ formatDateTime(new Date(course.starts_on)) }}
                </div>
            </NuxtLink>



        </div>
    </div>
</template>
  
<script setup lang="ts">
definePageMeta({
    layout: "student",
    middleware: ['is-authorized', 'is-student']
})

import { useAuthStore } from "~/stores/useAuthStore";

const user = useAuthStore().user;

// show my current course
const myCourses = ref({})

const { data: myCourseResponse, error: myCourseError } = await useApiFetch(`api/student/getCurrentCourse/${user.value.id}`, {});

if (myCourseResponse.value) {
    myCourses.value = myCourseResponse.value;
    console.log(myCourses.value)
}

else {
    if (myCourseError.value) {

    }
}



function formatDateTime(date) {
    const year = date.getFullYear();
    const month = String(date.getMonth() + 1).padStart(2, '0'); // Month is 0-based
    const day = String(date.getDate()).padStart(2, '0');
    const hours = String(date.getHours() % 12 || 12).padStart(2, '0'); // Convert to 12-hour format
    const minutes = String(date.getMinutes()).padStart(2, '0');
    const amOrPm = date.getHours() >= 12 ? 'PM' : 'AM';

    const formattedDateTime = `${day}/${month}/${year} ${hours}:${minutes} ${amOrPm}`;
    return formattedDateTime;
}


</script>
  
<style scoped>
.app {
    font-family: Arial, Helvetica Neue, Helvetica, sans-serif;
    font-size: 14px;
}
</style>
