<template>
    <div class="px-16 mt-8">
        <div class="rounded-2xl shadow-xl bg-white ">
            <div class="px-4 py-5">
                <h3 class="text-lg leading-6 font-medium text-gray-900">
                    Timeslot Information Details
                </h3>

            </div>
            <div class="border-t border-gray-200">
                <dl>
                    <div class="bg-gray-50 px-4 py-5 ">
                        <dt class="text-sm font-medium text-gray-500">
                            Timeslot Course
                        </dt>
                        <dd class="mt-1 text-sm text-gray-900 ">
                            {{ timeslot.title }}
                        </dd>
                    </div>
                    <div class="bg-white px-4 py-5 ">
                        <dt class="text-sm font-medium text-gray-500">
                            Datetime
                        </dt>
                        <dd class="mt-1 text-sm text-gray-900 ">
                            {{ dayjs(timeslot.datetime).format('YYYY-MM-DD HH:mm:ss') }}
                        </dd>
                    </div>
                    <div class="bg-gray-50 px-4 py-5">
                        <dt class="text-sm font-medium text-gray-500">
                            Type
                        </dt>
                        <dd class="mt-1 text-sm text-gray-900">
                            {{ timeslot.type }}
                        </dd>
                    </div>


                </dl>
            </div>
            <div class="px-4 py-5 flex flex-col">
                <div class="w-64">
                    <button v-on:click="showRemove = !showRemove"
                        class="w-full bg-gray-500 text-white hover:bg-red-500 active:bg-red-600 font-bold uppercase text-base px-8 py-3 rounded shadow-md hover:shadow-lg outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150">
                        Remove Timeslot
                    </button>

                    <p class="text-red-500 font-normal">
                        {{ errorRemove }}
                    </p>

                    <div v-if="showRemove" class="w-full flex">
                        <button v-on:click="removeTimeslot"
                            class="bg-red-500 w-1/2 text-white active:bg-red-600 font-bold uppercase text-xs px-4 py-2 rounded shadow hover:shadow-md outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150">
                            Confirm
                        </button>
                        <button v-on:click="showRemove = false"
                            class="bg-gray-500 w-1/2 text-white active:bg-green-500 font-bold uppercase text-xs px-4 py-2 rounded shadow hover:shadow-md outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150"
                            type="button">
                            Cancel
                        </button>
                    </div>
                </div>



            </div>
        </div>
    </div>

    <div class="relative flex py-5 items-center w-full px-10 mt-8">
        <div class="flex-grow border-t border-gray-400"></div>
        <span class="flex-shrink mx-4 text-6xl text-gray-400">Timeslot Student Attendances</span>
        <div class="flex-grow border-t border-gray-400"></div>
    </div>


    <div class="flex w-full p-8 gap-4">
        <div class="flex-1 flex flex-col gap-2 border p-4">
            <h1>Attend Students </h1>
            <p class="text-red-500 font-normal">
                {{ errorRemStd }}
            </p>

            <div v-for="student in students">
                <div class="flex justify-between rounded-lg shadow-md p-4 border" v-if="student.expect" :key="student.id">
                    <p>{{ student.first_name }} {{ student.last_name }}</p>
                    <button type="button" v-on:click="RemoveStudent(student.id)"
                        class="bg-gray-800 text-white rounded-md py-2 border-l border-gray-200 hover:bg-red-700 hover:text-white px-3">
                        <div class="flex flex-row align-middle">
                            <span class="mr-2">Remove</span>
                            <svg class="w-5 ml-2" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M12.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-2.293-2.293a1 1 0 010-1.414z"
                                    clip-rule="evenodd"></path>
                            </svg>
                        </div>
                    </button>
                </div>
            </div>

        </div>
        <div class="flex-1 flex flex-col gap-2 border p-4">
            <h1>Student with available enrollment slots.</h1>
            <p class="text-red-500 font-normal">
                {{ errorAddStd }}
            </p>
            
            <div v-for="student in students">
                <div class="flex justify-between rounded-lg shadow-md p-4 border" v-if="!student.expect" :key="student.id">
                    <button type="button" v-on:click="AddStudent(student.id)"
                        class="bg-gray-800 text-white rounded-md border-r border-gray-100 py-2 hover:bg-red-700 hover:text-white px-3">
                        <div class="flex flex-row align-middle">
                            <svg class="w-5 mr-2" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M7.707 14.707a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l2.293 2.293a1 1 0 010 1.414z"
                                    clip-rule="evenodd"></path>
                            </svg>
                            <p class="ml-2">Add</p>
                        </div>
                    </button>
                    <p>{{ student.first_name }} {{ student.last_name }}</p>
                </div>
            </div>

        </div>
    </div>
</template>

<script setup lang="ts">
definePageMeta({layout: "staff",
middleware: ['is-authorized','is-staff']})

import '@vuepic/vue-datepicker/dist/main.css'
import dayjs from 'dayjs';

// test {{ $route.params.id }}
const route = useRoute();

const timeslot = ref({})

const { data: timeslotResponse, error: timeslotError } = await useApiFetch(`api/staff/timeslots/${route.params.id}`, {});

if (timeslotResponse.value) {

    timeslot.value = timeslotResponse.value;

} else {

    if (timeslotError.value) {
        console.log(timeslotError.value)
    }
}


// remove timeslot

const showRemove = ref(false);

const errorRemove = ref("");
async function removeTimeslot() {

    const { data: removeResponse, error: removeError } = await useApiFetch(`api/staff/removeTimeslot/${route.params.id}`, {
        method: "POST"
    });

    if (removeResponse.value) {

        await navigateTo(`/staff/detail/course${removeResponse.value.course_id}`);

    } else {

        if (removeError.value) {

            errorRemove.value = "";

            errorRemove.value = removeError.value.data.message;
        }
    }

}


// students

const students = ref({})
async function fetchStudents() {

    const { data: studentsResponse, error: studentsError } = await useApiFetch(`api/staff/timeslotStudent/${route.params.id}`, {});

    if (studentsResponse.value) {

        students.value = studentsResponse.value;

    } else {

        if (studentsError.value) {
            console.log(studentsError.value)
        }
    }

}

await fetchStudents();

const errorAddStd = ref("")
async function AddStudent(studentId: any) {

    const { data: addResponse, error: addError } = await useApiFetch(`api/staff/addStudent/${route.params.id}/${studentId}`, {
        method: "POST"
    });

    if (addResponse.value) {

        await fetchStudents();

    } else {

        if (addError.value) {

            errorAddStd.value = "";

            errorAddStd.value = addError.value.data.message;

        }
    }


}

const errorRemStd = ref("")
async function RemoveStudent(studentId: any) {

    const { data: removeResponse, error: removeError } = await useApiFetch(`api/staff/removeStudent/${route.params.id}/${studentId}`, {
        method: "POST"
    });

    if (removeResponse.value) {

        await fetchStudents();


    } else {

        if (removeError.value) {

            errorRemStd.value = "";

            errorRemStd.value = removeError.value.data.message;

        }
    }
}


</script>