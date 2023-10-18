<script setup lang="ts">

const route = useRoute();
const teacher = reactive({
});

const course = reactive({});

console.log(`'test'`, route.params.id);

const {data: eventCourse, error: loginError } = await useApiFetch("api/student/showCourse/"+route.params.id, {});

if(eventCourse.value){
    console.log(eventCourse.value);
    teacher.value = eventCourse.value[1];
    console.log(teacher.value.first_name);

    course.value = eventCourse.value[0];
    console.log(course);
    
}



</script>

<template>
    <div class="bg-gradient-to-b flex justify-center items-center pt-20 pb-36">
        <div class="w-3/4 p-12 rounded-2xl bg-white-300 border border-gray-200 shadow">
            <div class="p-2 bg-gradient-to-r animate-pulse from-cyan-300 via-cyan-800 to-cyan-300 rounded-2xl mx-5">
                <p class="py-5 text-center text-4xl font-bold text-white dark:text-white">Enroll Course</p>
            </div>
            <div class="flex flex-row">
                <div class="w-1/2 p-5">
                    <p class="pl-5 text-3xl text-white dark:text-white bg-orange-500 rounded-2xl">Teacher</p>
                    <p v-if="teacher.value" class="pl-5 text-xl text-white dark:text-white pt-4">{{teacher.value.first_name}} {{teacher.value.last_name}}</p>
                </div>
                <div class="w-1/2 p-5">
                    <p class="pl-5 text-3xl text-white dark:text-white bg-orange-500 rounded-2xl">Time</p>
                    <p class="pl-5 text-xl text-white dark:text-white pt-4">Tue 10am</p>
                </div>
            </div>
            <div class="flex flex-row">
                <div class="w-1/2 p-5">
                    <p class="pl-5 text-3xl text-white dark:text-white bg-orange-500 rounded-2xl">Range age</p>
                    <p class="pl-5 text-xl text-white dark:text-white pt-4">0-6 year</p>
                </div>
                <div class="w-1/2 p-5">
                    <p class="pl-5 text-3xl text-white dark:text-white bg-orange-500 rounded-2xl">Capacity</p>
                    <p class="pl-5 text-xl text-white dark:text-white pt-4">4</p>
                </div>
            </div>
            <div class="flex flex-row">
                <div class="w-1/2 p-5">
                    <p class="pl-5 text-3xl text-white dark:text-white bg-orange-500 rounded-2xl">Duration</p>
                    <p class="pl-5 text-xl text-white dark:text-white pt-4">60 minutes</p>
                </div>
                <div class="w-1/2 p-5">
                    <p class="pl-5 text-3xl text-white dark:text-white bg-orange-500 rounded-2xl">Quota</p>
                    <p class="pl-5 text-xl text-white dark:text-white pt-4">10</p>
                </div>
            </div>
            <div class="relative p-5">
                <div class="absolute right-0 pr-4">
                    <button class="relative inline-flex items-center justify-center p-0.5 mb-2 mr-2 overflow-hidden text-sm font-medium text-white rounded-lg group bg-gradient-to-br from-teal-300 to-teal-300 group-hover:from-orange-300 group-hover:to-orange-300 dark:text-white dark:hover:text-white focus:ring-4 focus:outline-none focus:ring-orange-400 dark:focus:ring-orange-800">
                        <span class="relative px-5 py-2.5 transition-all ease-in duration-75 text-gray-900 dark:bg-gray-900 rounded-md group-hover:bg-opacity-0">
                            Confirm
                        </span>
                    </button>
                </div>
            </div>
        </div>
    </div>

</template>
