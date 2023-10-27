<script setup lang="ts">

import {useTimeStore} from "~/stores/useTimeStore";
definePageMeta({layout: "student"})
const route = useRoute();
const teacher = reactive({});
const course = reactive({});

const idCourse = ref(route.params.id);
console.log(`'test'`, route.params.id);

const {data: eventCourse, error: loginError } = await useApiFetch("api/student/showCourse/"+route.params.id, {});

if(eventCourse.value){
    console.log(eventCourse.value);
    teacher.value = eventCourse.value[1];
    console.log(teacher.value.first_name);

    course.value = eventCourse.value[0];
    console.log(course);
}
const time = useTimeStore();
await time.setTime();




</script>

<template>
    <div class="bg-gradient-to-b flex justify-center items-center pt-20 pb-36">
        <div class="w-3/4 p-12 rounded-2xl bg-black-300 border border-gray-200 shadow">
            <div class="p-2 bg-gradient-to-r animate-pulse from-cyan-300 via-cyan-800 to-cyan-300 rounded-2xl mx-5">
                <p class="py-5 text-center text-4xl font-bold text-black dark:text-black">Enroll Course</p>
            </div>
            <div class="flex flex-row">
                <div class="w-1/2 p-5">
                    <p class="pl-5 text-3xl text-black dark:text-black bg-cyan-300 rounded-2xl">Teacher</p>
                    <p v-if="teacher.value" class="pl-5 text-xl text-black dark:text-black pt-4">{{teacher.value.first_name}} {{teacher.value.last_name}}</p>
                </div>
                <div class="w-1/2 p-5">
                    <p class="pl-5 text-3xl text-black dark:text-black bg-cyan-300 rounded-2xl">Date Time</p>
                    <p v-if="course.value" class="pl-5 text-xl text-black dark:text-black pt-4">{{ course.value.title }}</p>
                </div>
            </div>
            <div class="flex flex-row">
                <div class="w-1/2 p-5">
                    <p class="pl-5 text-3xl text-black dark:text-black bg-cyan-300 rounded-2xl">Range age</p>
                    <p v-if="course.value" class="pl-5 text-xl text-black dark:text-black pt-4">{{ course.value.min_age }}-{{ course.value.max_age }}</p>
                </div>
                <div class="w-1/2 p-5">
                    <p class="pl-5 text-3xl text-black dark:text-black bg-cyan-300 rounded-2xl">Capacity</p>
                    <p v-if="course.value" class="pl-5 text-xl text-black dark:text-black pt-4">{{ course.value.capacity }}</p>
                </div>
            </div>
            <div class="flex flex-row">
                <div class="w-1/2 p-5">
                    <p class="pl-5 text-3xl text-black dark:text-black bg-cyan-300 rounded-2xl">Duration</p>
                    <p v-if="course.value" class="pl-5 text-xl text-black dark:text-black pt-4">{{ course.value.duration }}</p>
                </div>
                <div class="w-1/2 p-5">
                    <p class="pl-5 text-3xl text-black dark:text-black bg-cyan-300 rounded-2xl">Quota</p>
                    <p v-if="course.value" class="pl-5 text-xl text-black dark:text-black pt-4">{{ course.value.quota }}</p>
                </div>
            </div>
            <div class="relative p-5">
                <div class="absolute right-0 pr-4">
                    <NuxtLink :to="`/course/paymentDetails${idCourse}`"
                        class="relative inline-flex items-center justify-center p-0.5 mb-2 mr-2 overflow-hidden text-sm font-medium text-black rounded-lg group bg-gradient-to-br from-teal-300 to-teal-300 group-hover:from-blue-300 group-hover:to-blue-300 dark:text-black dark:hover:text-black focus:ring-4 focus:outline-none focus:ring-blue-400 dark:focus:ring-blue-500">
                        <span class="relative px-5 py-2.5 transition-all ease-in duration-75 text-black dark:bg-gray-900 rounded-md group-hover:bg-opacity-0">
                            Confirm
                        </span>
                    </NuxtLink>
                </div>
            </div>
        </div>
    </div>

</template>
