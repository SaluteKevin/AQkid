<template>
<div class="mt-24">time: {{ countDown }}
<button v-on:click="clearTime">clear time</button>
</div>
</template>


<script setup lang="ts">

import {useTimeStore} from "~/stores/useTimeStore";
    
const timer = useTimeStore();

const countDown = ref(timer.timer())

console.log(timer.time)
console.log(timer.time_semaphore);
console.log(timer.setTime());
// await timer.clearTime();

const timercount = setInterval(() => {
    if (timer.timer() === 0) {
        timer.clearTime()
        clearInterval(timercount);
    }
    console.log(timer.timer())
    countDown.value = timer.timer();
  }, 1000);


function clearTime() {
    timer.clearTime()
}
</script>