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
</template>

<script setup lang="ts">

definePageMeta({ layout: "teacher" })
const route = useRoute();
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