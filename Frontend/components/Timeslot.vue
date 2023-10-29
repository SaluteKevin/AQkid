<template>
    <li v-if="classes.type == 'REGULAR'" class="border-l-2 border-green-600 w-[500px]">
        <div class="flex w-full">
            <div class="bg-green-600 w-6 h-6 flex items-center justify-center rounded-full -ml-3.5">
                <svg aria-hidden="true" focusable="false" data-prefix="fas" class="text-white w-3 h-3" role="img"
                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                    <path fill="currentColor"
                        d="M0 464c0 26.5 21.5 48 48 48h352c26.5 0 48-21.5 48-48V192H0v272zm64-192c0-8.8 7.2-16 16-16h288c8.8 0 16 7.2 16 16v64c0 8.8-7.2 16-16 16H80c-8.8 0-16-7.2-16-16v-64zM400 64h-48V16c0-8.8-7.2-16-16-16h-32c-8.8 0-16 7.2-16 16v48H160V16c0-8.8-7.2-16-16-16h-32c-8.8 0-16 7.2-16 16v48H48C21.5 64 0 85.5 0 112v48h448v-48c0-26.5-21.5-48-48-48z">
                    </path>
                </svg>
            </div>

            <div class="flex-1 p-6 rounded-lg shadow-lg bg-green-500  ml-6 mb-10 hover:scale-105 duration-150">
                <div class="flex justify-between mb-4">
                    <div class="font-bold text-3xl text-white duration-300 transition ease-in-out">
                        {{ classes.title }}</div>
                </div>
                <div class="font-medium text-xl text-white  duration-300 transition ease-in-out ">
                    {{ dayjs(classes.datetime).format('YYYY-MM-DD HH: mm: ss') }}</div>
                <div class="font-medium text-xl text-white  duration-300 transition ease-in-out ">
                    {{ classes.duration }} minutes </div>
            </div>
        </div>

    </li>

    <li v-if="classes.type == 'MAKEUP'" class="border-l-2 border-purple-600 w-[500px]">
        <div class="flex w-full">
            <div class="bg-purple-600 w-6 h-6 flex items-center justify-center rounded-full -ml-3.5">
                <svg aria-hidden="true" focusable="false" data-prefix="fas" class="text-white w-3 h-3" role="img"
                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                    <path fill="currentColor"
                        d="M0 464c0 26.5 21.5 48 48 48h352c26.5 0 48-21.5 48-48V192H0v272zm64-192c0-8.8 7.2-16 16-16h288c8.8 0 16 7.2 16 16v64c0 8.8-7.2 16-16 16H80c-8.8 0-16-7.2-16-16v-64zM400 64h-48V16c0-8.8-7.2-16-16-16h-32c-8.8 0-16 7.2-16 16v48H160V16c0-8.8-7.2-16-16-16h-32c-8.8 0-16 7.2-16 16v48H48C21.5 64 0 85.5 0 112v48h448v-48c0-26.5-21.5-48-48-48z">
                    </path>
                </svg>
            </div>
            <div class="flex-1 p-6 rounded-lg shadow-lg bg-purple-500  ml-6 mb-10 hover:scale-105 duration-150">
                <div class="flex justify-between mb-4">
                    <a class="font-bold text-3xl text-white  duration-300 transition ease-in-out ">{{
                        classes.title }}</a>

                </div>
                <div class="font-medium text-xl text-white duration-300 transition ease-in-out ">
                    datetime : {{ dayjs(classes.datetime).format('YYYY-MM-DD HH: mm: ss') }}</div>
                <div class="font-medium text-xl text-white  duration-300 transition ease-in-out ">
                    duration : {{ classes.duration }} minutes</div>


            </div>
        </div>

    </li>
</template>

<script setup lang="ts">
import dayjs from 'dayjs';
const props = defineProps(['timeslot'])
const classes = ref(props.timeslot);


</script>