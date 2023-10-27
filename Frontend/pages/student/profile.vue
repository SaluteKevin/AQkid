<template>
    <!-- <AppHeaderStudent /> -->
    <div class="min-h-screen bg-gradient-to-l to-purple-50 to-60% from-[#bce1ff] from-10%">
        <div class="container mx-auto py-8">
            <div class="grid grid-cols-4 sm:grid-cols-12 gap-6 px-4">
                <div class="col-span-4 sm:col-span-3">
                    <div class="bg-white shadow rounded-lg p-6">
                        <div class="flex flex-col items-center">
                            <img :src="`${config.public.imageBaseURL}${user.value.profile_image_path}`"
                                class="w-32 h-32 bg-gray-300 rounded-full mb-4 shrink-0">


                            <h1 class="text-xl font-bold">{{ user.value.username }}</h1>
                            <div class="mt-6 flex flex-wrap gap-4 justify-center">
                                <NuxtLink class="bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded"
                                    to="/auths/editprofile">Edit Profile</NuxtLink>
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
                        <div v-for="course in courses">
                            <div v-if="course.status === 'ACTIVE'"
                                class="mb-3 shadow-xl border bg-green-100 rounded-2xl p-4">
                                <div class="flex justify-between  p-4 rounded-lg">
                                    <span class="text-gray-600 font-bold">{{ course.title }}</span>
                                    <p class="flex flex-col">
                                        <span class="text-gray-600 mr-2">Start : {{ formatDateTime(new
                                            Date(course.starts_on)) }}</span>

                                    </p>

                                </div>
                            </div>

                            <div v-if="course.status !== 'ACTIVE'" class="mb-3 shadow-xl border  rounded-2xl p-4">
                                <div class="flex justify-between  p-4 rounded-lg">
                                    <span class="text-gray-600 font-bold">{{ course.title }}</span>
                                    <p class="flex flex-col">
                                        <span class="text-gray-600 mr-2">Start : {{ formatDateTime(new
                                            Date(course.starts_on)) }}</span>

                                    </p>

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

import { useAuthStore } from "~/stores/useAuthStore";
const config = useRuntimeConfig()

const user = useAuthStore().user;
definePageMeta({ layout: "student" })

const courses = ref({})


const { data: courseResponse, error: courseError } = await useApiFetch(`api/student/getAllCourses/${user.value.id}`, {});

if (courseResponse.value) {
    courses.value = courseResponse.value;
}

else {
    if (courseError.value) {

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