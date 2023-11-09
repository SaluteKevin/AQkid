<template>
  <div class="min-h-screen">
    <div class="flex px-16 mt-24 divide-x-2 space-x-10">

      <!--Class information-->
      <div class="w-1/3">
        <div class="rounded-2xl shadow-xl bg-white">
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
              <div class="bg-gray-50 px-4 py-5 rounded-b-2xl">
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

      <div class="w-full">
        <div class="flex justify-center mx-8">
          <div class="flex-grow border-t border-gray-400 mt-4"></div>
          <span class="flex mx-4 text-2xl text-gray-400">Timeslot Student Attendances</span>
          <div class="flex-grow border-t border-gray-400 mt-4"></div>
        </div>

        <button v-on:click="checkAll" ref="checkAll_button"
          class="ml-4 w-fit flex flex-row items-center justify-center  p-2 mb-4 text-sm font-bold bg-green-300 leading-6 capitalize duration-100 transform rounded-sm shadow cursor-pointer focus:ring-4 focus:ring-green-500 focus:ring-opacity-50 focus:outline-none  hover:shadow-lg hover:-translate-y-1 pointer-events-none">
          Check All
          <span class="ml-4">
            <svg viewBox="0 -0.5 25 25" width="20px" height="20px" fill="none" xmlns="http://www.w3.org/2000/svg"
              stroke="#000000">
              <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
              <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
              <g id="SVGRepo_iconCarrier">
                <path d="M5.5 12.5L10.167 17L19.5 8" stroke="#000000" stroke-width="1.5" stroke-linecap="round"
                  stroke-linejoin="round"></path>
              </g>
            </svg>
          </span>
        </button>
        <p class="text-red-500 ml-4 mt-2 mb-2" v-for="error in errors" :key="error">
                                    {{ error }}
       </p>
        <div ref="student_container" class="flex flex-col w-full items-center gap-4 px-4 pointer-events-none">
          <div class="flex bg-white w-full items-center justify-between rounded-2xl shadow-lg p-4">
            <div>Student Image</div>
            <div>Student Name</div>
            <div>Attendance</div>
          </div>

          <CheckName v-for="student in allstudents" :image_path="student.profile_image_path"
            :name="student.first_name + ' ' + student.last_name" :checked="student.pivot.has_attended"
            :id="student.id" @change="onChange">
          </CheckName>

        </div>

        <div v-if="!canEdit" class="flex ml-4">
          <div class="flex gap-3 max-w-sm mt-4 ml-4 items-center">
            <button  v-if="!isCanAttend" v-on:click="canAttend"
              class="py-2.5 px-6 rounded-lg text-sm font-medium text-white bg-teal-600">Edit</button>
              <button  v-if="isCanAttend" v-on:click="canAttend"
              class="py-2.5 px-6 rounded-lg text-sm font-medium text-white bg-red-600">Cancel</button>
          </div>
          <div class="ml-4 flex items-center mt-4">
            <div v-if="isCanAttend" class="text-green-500">{{ showCanAttend }}</div>
            <div v-if="!isCanAttend" class="text-red-500">{{ showCantAttend }}</div>
          </div>
        </div>
        <div v-else>
          This Timeslot is Read-only
        </div>

      </div>
    </div>
  </div>
</template>

<script setup lang="ts">
definePageMeta({
  layout: "teacher",
  middleware: ['is-authorized', 'is-teacher']
})
const route = useRoute();

import dayjs from 'dayjs';



const allstudents = ref([]);

const timeslot = ref({});

async function fetchStudents() {
  const { data: studentData, error: studentError } = await useApiFetch(`api/teacher/getStudentAttend/${route.params.id}`, {});
  
  if (studentData.value) {
    
    for (const student in studentData.value) {
      allstudents.value.push(studentData.value[student])
    }

  }
  else {


  }

}

await fetchStudents();



const errors = ref([])
async function checkAll() {

  const { data: checkData, error: checkError } = await useApiFetch(`api/teacher/checkAll/${route.params.id}`, {
    method: "POST"
  });

  if (checkData.value) {
    
    errors.value = []

    for(const error in checkData.value.errors) {
      errors.value.push(checkData.value.errors[error])
    }

    allstudents.value = []
    await fetchStudents();
  } else {

  }

}

async function onChange(message) {
    errors.value = []
    errors.value.push(message)
    allstudents.value = []
    await fetchStudents();
}

const { data: timeslotData, error: timeslotError } = await useApiFetch(`api/teacher/getTimeslot/${route.params.id}`, {});

if (timeslotData.value) {

  timeslot.value = timeslotData.value

}
else {

}

// edit


const late_datetime = dayjs(new Date(timeslot.value.datetime).setHours(new Date(timeslot.value.datetime).getHours() + 2)).unix()
const currentDatetime = dayjs(new Date()).unix()
const canEdit = ref(currentDatetime > late_datetime)
const showCanAttend = ref("Allow modifications")
const showCantAttend = ref("Do not allow modifications")
const isCanAttend = ref(false)
const student_container = ref()
const checkAll_button = ref()


function canAttend() {
  if (isCanAttend.value == false) {
    student_container.value.classList.remove('pointer-events-none')
    checkAll_button.value.classList.remove('pointer-events-none')
    isCanAttend.value = true
  } else {
  student_container.value.classList.add('pointer-events-none')
  checkAll_button.value.classList.add('pointer-events-none')
  isCanAttend.value = false
  }
}







</script>

