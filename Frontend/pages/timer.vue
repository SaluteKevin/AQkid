<template>
<!-- <div class="mt-24">time: {{ countDown }}
<button v-on:click="clearTime">clear time</button>
</div> -->
<VueDatePicker class="text-black mt-40" v-model="date" :is-24="true" enable-seconds
                                hours-increment="1" minutes-increment="0" seconds-increment="0" placeholder="Select Date"
                                no-minutes-overlay no-seconds-overlay :min-time="{ hours: 10, minutes: 0, seconds: 0 }"
                                :max-time="{ hours: 17, minutes: 0, seconds: 0 }"
                                :start-time="{ hours: 10, minutes: 0, seconds: 0 }" :state="datePickerState"
                                :disabled-week-days="[1]" ></VueDatePicker>


                    <div>{{ date }}</div>
                    <div>{{ dateformat }}</div>
</template>


<script setup lang="ts">

import VueDatePicker from '@vuepic/vue-datepicker';
import '@vuepic/vue-datepicker/dist/main.css'
import dayjs from 'dayjs';

const date = ref();
const dateformat = ref(dayjs("Wed Oct 11 2023 10:00:00 GMT+0700 (Indochina Time)").format('YYYY-MM-DD HH:mm:ss'));
// import {useTimeStore} from "~/stores/useTimeStore";
    
// const timer = useTimeStore();

// const countDown = ref(timer.timer())

// console.log(timer.time)
// console.log(timer.time_semaphore);
// console.log(timer.setTime());
// // await timer.clearTime();

// const timercount = setInterval(() => {
//     if (timer.timer() === 0) {
//         timer.clearTime()
//         clearInterval(timercount);
//     }
//     console.log(timer.timer())
//     countDown.value = timer.timer();
//   }, 1000);


// function clearTime() {
//     timer.clearTime()
// }
</script>