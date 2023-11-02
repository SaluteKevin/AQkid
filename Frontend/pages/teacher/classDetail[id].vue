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
        <div class="flex flex-row justify-end mr-1">
          <div class="h-10 ">
            <button  type="button" class=" text-amber-500 hover:text-white border border-amber-500 hover:bg-amber-400 focus:ring-4 focus:outline-none focus:ring-amber-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2 dark:border-amber-500 dark:text-amber-500 dark:hover:text-white dark:hover:bg-amber-400 dark:focus:ring-amber-400">Add image</button>
          </div>
          <div class="h-10">
            <button  type="button" v-on:click="ReviewStudent(studentSelect.id)"  class=" text-green-700 hover:text-white border border-green-700 hover:bg-green-400 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2 dark:border-green-500 dark:text-green-500 dark:hover:text-white dark:hover:bg-green-600 dark:focus:ring-green-800">Save</button>
          </div>

        </div>

      </div>
      
       
      
    </div>
  </div>
  

  
  <div id="purchaseModal" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
                    <div class="relative w-full max-w-2xl max-h-full">
                        <!-- Modal content -->
                        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                             <!-- Modal header -->
                            <div class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-600">
                                <h1 class="text-4xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-teal-600 via-sky-400 to-cyan-500">
                                    Purchase order
                                </h1>
                                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="purchaseModal">
                                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                    </svg>
                                    <span class="sr-only">Close modal</span>
                                </button>
                            </div>
                            <!-- Modal body -->
                            <div class="p-6 space-y-6">
                                <div class="py-20 bg-white px-2">
                                    <div class="max-w-md mx-auto rounded-lg overflow-hidden md:max-w-xl">
                                        <div class="md:flex">
                                            <div class="w-full p-3">
                                                <div class="relative border-dotted h-48 rounded-lg border-dashed border-2 border-blue-700 bg-gray-100 flex justify-center items-center">
                                                    <div class="absolute">
                                                        <div class="flex flex-col items-center">
                                                            <i class="fa fa-folder-open fa-4x text-blue-700"></i>
                                                            <!-- <span class="block text-gray-400 font-normal">Select file video here</span> -->
                                                            
                                                            <input type="file" name="image" id="inputImage" accept="image/*" required>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="font-xl" id="previewsImg-con" style="display: none">
                                Preview Image
                                <div class="mt-2 gap-1 flex justify-center items-center" id="preview-image">

                                </div>
                            </div>
                            
                            <!-- Modal footer -->
                            <div class="flex items-center p-6 space-x-2 border-t border-gray-200 rounded-b dark:border-gray-600">
                                <button data-modal-hide="purchaseModal" type="button" class="text-white bg-lime-700 hover:bg-lime-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">close</button>
                                  
                                <button type="submit" class="right-5 absolute flex-2 rounded-full bg-green-600 text-white antialiased font-bold hover:bg-green-800 px-12 py-2">Add</button>
                                
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

var studentSelect = ref();

function review(student) {
  // console.log(student);
  selected.value.selecteReview = student.first_name + ' ' + student.last_name;
  selected.value.reviewText = student.pivot.review_comment;
  studentSelect.value = student;
  
  playAnimation();
}


const selected = ref({
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
    var animatedElement = document.getElementById('myDiv');
    animatedElement.classList.remove('slide-right');

    await fetchStudents();


  } else {

    if (removeError.value) {
      console.log(removeError.value)
    }
  }
}

async function ReviewStudent(studentId: int) {

  const formData = new FormData()
  await formData.append('reviewText', selected.value.reviewText);

  const { data: reviewResponse, error: reviewError } = await useApiFetch(`api/teacher/addReviewStudent/${route.params.id}/${studentId}`, {
    method: "POST",
    body: formData,
  });

  if (reviewResponse.value) {
    console.log("VVVVVV");
    console.log(reviewResponse.value);
    var animatedElement = document.getElementById('myDiv');
    animatedElement.classList.remove('slide-right');
    await fetchStudents();


  } else {

    if (reviewError.value) {
      console.log(reviewError.value);
    }
  }
}

</script>

