<template>
  <div class="px-16 mt-24">
    <div class="rounded-2xl shadow-xl bg-white ">
      <div class="px-4 py-5">
        <h3 class="text-lg leading-6 font-medium text-gray-900">
          Class Information
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
    </div>
  </div>

  <div class="relative flex py-5 items-center w-full px-10 mt-8">
    <div class="flex-grow border-t border-gray-400"></div>
    <span class="flex-shrink mx-4 text-6xl text-gray-400">Timeslot Student Attendances</span>
    <div class="flex-grow border-t border-gray-400"></div>
  </div>


  <div class="flex w-full p-8 gap-4">
    <div class="flex-1 flex flex-col gap-2 border p-4 bg-green-100">
      <h1>Attend Students </h1>

      <div v-for="student in allstudents">
        <div class="flex justify-between rounded-lg shadow-md p-4 border bg-white" v-if="student.pivot.has_attended == 'TRUE'"
          :key="student.id">
          <p>{{ student.first_name }} {{ student.last_name }}</p>
          <button type="button" v-on:click="RemoveStudent(student.id)"
            class="bg-gray-800 text-white rounded-md py-2 border-l border-gray-200 hover:bg-red-700 hover:text-white px-3">
            <div class="flex flex-row align-middle">
              <span class="mr-2">Remove</span>
              <svg class="w-5 ml-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd"
                  d="M12.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-2.293-2.293a1 1 0 010-1.414z"
                  clip-rule="evenodd"></path>
              </svg>
            </div>
          </button>
        </div>
      </div>

    </div>
    <div class="flex-1 flex flex-col gap-2 border p-4 bg-red-100">
      <h1>Absent Students</h1>

      <div v-for="student in allstudents">
        <div class="flex justify-between rounded-lg shadow-md p-4 border bg-white" v-if="student.pivot.has_attended == 'FALSE'"
          :key="student.id">
          <button type="button" v-on:click="AddStudent(student.id)"
            class="bg-gray-800 text-white rounded-md border-r border-gray-100 py-2 hover:bg-red-700 hover:text-white px-3">
            <div class="flex flex-row align-middle">
              <svg class="w-5 mr-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
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
  <div class="relative flex py-5 items-center w-full px-10 mt-8">
      <div class="flex-grow border-t border-gray-400"></div>
      <span class="flex-shrink mx-4 text-6xl text-gray-400">Review Student</span>
      <div class="flex-grow border-t border-gray-400"></div>
  </div>

  <div class="flex w-full p-8 gap-4">
    <div class="w-1/2 flex flex-col gap-2 border p-4 bg-green-100">
      <h1>review Students</h1>

      <div v-for="student in allstudents">
        <div class="flex justify-between rounded-lg shadow-md p-4 border bg-white" v-if="student.pivot.has_attended == 'TRUE'"
          :key="student.id">
          <p>{{ student.first_name }} {{ student.last_name }}</p>
          <button type="button" v-on:click="review(student)" id="open-sidebar"
            class="bg-gray-800 text-white rounded-md py-2 border-l border-gray-200 hover:bg-red-700 hover:text-white px-3">
            <div class="flex flex-row align-middle">
              <span class="mr-2">Select</span>
              <svg class="w-5 ml-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd"
                  d="M12.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-2.293-2.293a1 1 0 010-1.414z"
                  clip-rule="evenodd"></path>
              </svg>
            </div>
          </button>
        </div>
      </div>

    </div>
    <div class="w-1/2"></div>
    <div id="myDiv" class="w-1/2 absolute transition-transform transform -translate-x-full">
      <div class="bg-red-100 mr-10 ml-1 p-4">
        <h1>Detail Student: {{ selected.selecteReview }}</h1>
          
        <div class="w-full py-4">
            <div class="w-full px-3">
              
                <textarea rows="9" maxlength="450" v-model="selected.reviewText"
                    class=" appearance-none block w-full bg-red-200 text-black border border-gray-200 rounded px-4 leading-tight focus:outline-none focus:bg-red-100 focus:border-gray-500"></textarea>
            </div>
            <div class="flex justify-between w-full px-3">
                
            </div>
        </div>
        <div class="relative h-10 ">
          <button  type="button" class="absolute right-1 text-green-700 hover:text-white border border-green-700 hover:bg-green-600 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2 dark:border-green-500 dark:text-green-500 dark:hover:text-white dark:hover:bg-green-600 dark:focus:ring-green-800">Green</button>
        </div>

      </div>
      
       
      
    </div>
  </div>
  
  



</template>

<style>
    /* เพิ่ม transition property เพื่อทำให้เกิดการเคลื่อนไหว */
    .slide-right {
      animation: slideRight 1s forwards;
    }
    
    @keyframes slideRight {
      from {
        transform: translateX(0);
      }
      to {
        transform: translateX(97%);
      }
    } 
    


</style>


<script setup lang="ts">

definePageMeta({ layout: "teacher" })
const route = useRoute();
import { DelayedRunner } from '@fullcalendar/core/internal';
import dayjs from 'dayjs';



const allstudents = ref([]);

const timeslot = ref({});

async function fetchStudents() {
  const { data: studentData, error: studentError } = await useApiFetch(`api/teacher/getStudentAttend/${route.params.id}`, {});

  if (studentData.value) {

    allstudents.value = studentData.value;

    // for (const i in allstudents.value){
    //   console.log(allstudents.value[i].pivot.has_attended)
    // }

  }
  else {


  }

}

await fetchStudents();



// if (studentData.value) {
//   console.log(studentData.value)
// }

const { data: timeslotData, error: timeslotError } = await useApiFetch(`api/teacher/getTimeslot/${route.params.id}`, {});

if (timeslotData.value) {

  timeslot.value = timeslotData.value

}
else {

}


async function review(student: object) {
  console.log(student);
  selected.value.selecteReview = student.first_name + ' ' + student.last_name;
  selected.value.reviewText = student.pivot.review_comment;

  playAnimation();
}


const textReview = ref('test');
const selected = ref({
  student: 0,
  selecteReview: 'please select the student',
  reviewText: '',

});

function playAnimation() {
  var animatedElement = document.getElementById('myDiv');

    animatedElement.classList.remove('slide-right');
    
    setTimeout(function() {
    // เพิ่มคลาส slide-right เพื่อเริ่มเล่น animation ใหม่
    animatedElement.classList.add('slide-right');
    }, 100);

}





    



// add student attend
async function AddStudent(studentId: int) {

  const { data: addResponse, error: addError } = await useApiFetch(`api/teacher/attendStudent/${route.params.id}/${studentId}`, {
    method: "POST"
  });

  if (addResponse.value) {

    await fetchStudents();

  } else {

    if (addError.value) {
      console.log(addError.value)
    }
  }


}





// remove student attend
async function RemoveStudent(studentId: int) {

  const { data: removeResponse, error: removeError } = await useApiFetch(`api/teacher/absentStudent/${route.params.id}/${studentId}`, {
    method: "POST"
  });

  if (removeResponse.value) {

    await fetchStudents();


  } else {

    if (removeError.value) {
      console.log(removeError.value)
    }
  }
}

</script>

