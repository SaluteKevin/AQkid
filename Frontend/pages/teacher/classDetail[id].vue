<template>
<div class="max-w-2xl mx-auto mt-24">
  <li class="px-6 py-4" v-for="student in allstudents">
    <div class="flex gap-3 bg-white border border-gray-300 rounded-xl overflow-hidden items-center justify-start">

        <div class="relative w-32 h-32 flex-shrink-0">
            <img class="absolute left-0 top-0 w-full h-full object-cover object-center transition duration-50" loading="lazy" src="https://cdn.discordapp.com/emojis/918728690211389470.webp?size=96&quality=lossless">
        </div>

        <div class="flex flex-col gap-2 py-2">

            <p class="text-lg font-light">{{student.username}}</p>

            <p class="text-black-700">
            {{student.first_name}} 
            {{student.last_name}}
            </p>
        </div>
    </div>
    
  </li>
</div>


</template>

<script setup lang="ts">
const route = useRoute();

const allstudents = ref([]);



const events = ref([]);


const {data: studentData, error: studentError} = await useApiFetch(`api/teacher/getStudentAttend/${route.params.id}`,{});

if(studentData.value){

  allstudents.value = studentData.value;

}


console.log(studentData.value)
// if (studentData.value) {
//   console.log(studentData.value)
// }

const {data: timeslotData, error: timeslotError} = await useApiFetch(`api/teacher/getTimeslot/${route.params.id}`,{});


</script>