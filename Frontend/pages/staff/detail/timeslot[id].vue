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
                            {{timeslot.title}}
                        </dd>
                    </div>
                    <div class="bg-white px-4 py-5 ">
                        <dt class="text-sm font-medium text-gray-500">
                            Datetime
                        </dt>
                        <dd class="mt-1 text-sm text-gray-900 ">
                            {{dayjs(timeslot.datetime).format('YYYY-MM-DD HH:mm:ss')}}
                        </dd>
                    </div>
                    <div class="bg-gray-50 px-4 py-5">
                        <dt class="text-sm font-medium text-gray-500">
                            Type
                        </dt>
                        <dd class="mt-1 text-sm text-gray-900">
                            {{timeslot.type}}
                        </dd>
                    </div>
                   
                    
                </dl>
            </div>
        </div>
    </div>

    <div class="relative flex py-5 items-center w-full px-10 mt-8">
            <div class="flex-grow border-t border-gray-400"></div>
            <span class="flex-shrink mx-4 text-6xl text-gray-400">Timeslot Student Attendances</span>
            <div class="flex-grow border-t border-gray-400"></div>
        </div>


    <div class="flex w-full p-8 gap-4">
        <div class="flex-1 border p-4">
            <h1>Attend Students</h1>

        </div>
        <div class="flex-1 border p-4">
            <h1>All Students</h1>

        </div>
    </div>
</template>

<script setup lang="ts">
definePageMeta({ layout: "staff" })

import '@vuepic/vue-datepicker/dist/main.css'
import dayjs from 'dayjs';

// test {{ $route.params.id }}
const route = useRoute();

const timeslot = ref({})

const { data: timeslotResponse, error: timeslotError } = await useApiFetch(`api/staff/timeslots/${route.params.id}`, {});

if (timeslotResponse.value) {

    timeslot.value = timeslotResponse.value;

    console.log(timeslot.value)
} else {

    if (timeslotError.value) {
        console.log(timeslotError.value)
    }
}

</script>