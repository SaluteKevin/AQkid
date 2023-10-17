<template>
    <div class="min-h-screen bg-gradient-to-l to-purple-50 to-60% from-[#bce1ff] from-10%">
        <div class="container mx-auto py-8">
            <div class="grid grid-cols-4 sm:grid-cols-12 gap-6 px-4">
                <div class="col-span-4 sm:col-span-3">
                    <div class="bg-white shadow rounded-lg p-6">
                        <div class="flex flex-col items-center">
                            <img src="https://randomuser.me/api/portraits/men/94.jpg"
                                class="w-32 h-32 bg-gray-300 rounded-full mb-4 shrink-0">


                            <h1 class="text-xl font-bold">{{ teacher.first_name }}</h1>
                            <p class="text-gray-600">{{ teacher.role }}</p>



                        </div>
                        <hr class="my-6 border-t border-gray-300">
                        <div class="mt-6  justify-center">
                            <p class="text-black font-bold">Phone No.</p>
                            <h2>{{ teacher.phone_number }}</h2>
                            <h2 v-if="!teacher.phone_number">No Phone No.</h2>
                        </div>
                        <hr class="my-6 border-t border-gray-300">
                        <div class="mt-6  justify-center">
                            <p class="text-black font-bold">Email</p>
                            <h2>{{ teacher.email }}</h2>
                            <h2 v-if="!teacher.email">No Email</h2>
                        </div>


                    </div>
                </div>
                <div class="col-span-4 sm:col-span-9">
                    <div class="bg-white shadow rounded-lg p-6">
                        <h2 class="text-xl font-bold mb-4">Teacher Information</h2>
                        <p class="text-gray-700">Firstname : {{ teacher.first_name }} </p>
                        <p class="text-gray-700">Middlename : {{ teacher.middle_name }} </p>
                        <p class="text-gray-700">Lastname : {{ teacher.last_name }} </p>
                        <p class="text-gray-700">Age : {{ new Date().getFullYear() - new
                            Date(teacher.birthdate).getFullYear() }} </p>
                        <hr class="my-6 border-t border-gray-300">


                        <h2 class="text-xl font-bold mt-6 mb-4">Courses</h2>


                        <div class="mb-3 shadow-xl border rounded-2xl p-4" v-for="course in teacher.courses"
                            :key="course.id">
                            <div class="flex justify-between  p-4 rounded-lg">
                                <span class="text-gray-600 font-bold">{{ course.title }}</span>
                                <p class="flex flex-col">
                                    <span class="text-gray-600 mr-2">Start : {{ formatDateTime(new
                                        Date(course.start_datetime)) }}</span>
                                    <span class="text-gray-600 mr-2">End : {{ formatDateTime(new
                                        Date(course.start_datetime)) }}</span>

                                </p>

                            </div>
                        </div>



                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup lang="ts">

definePageMeta({ layout: "staff" })

const route = useRoute();

const teacher = ref({})


const { data: teacherResponse, error: teacherError } = await useApiFetch(`api/staff/teachers/${route.params.id}`, {});

if (teacherResponse.value) {
    teacher.value = teacherResponse.value;
}

else {
    if (teacherError.value) {

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