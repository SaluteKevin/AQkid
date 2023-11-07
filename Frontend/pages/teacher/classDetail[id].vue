<template>
  <div class="min-h-screen bg-gradient-to-t from-cyan-400 from-20% to-white to-70%">
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

        <div class="flex w-full p-8 gap-4 ">
          <div
            class="rounded-lg shadow-lg flex-1 flex flex-col gap-2 border p-4 bg-gradient-to-b from-80% from-green-100">
            <h1>Attend Students </h1>
            <p class="text-red-500 font-normal">
              {{ errorRemStd }}
            </p>

            <div v-for="student in allstudents">
              <div class="flex justify-between rounded-lg shadow-md p-4 border bg-white"
                v-if="student.pivot.has_attended == 'TRUE'" :key="student.id">
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
          <div class="rounded-lg shadow-lg flex-1 flex flex-col gap-2 border p-4 bg-gradient-to-b from-80% from-red-100">
            <h1>Absent Students</h1>
            <p class="text-red-500 font-normal">
              {{ errorAddStd }}
            </p>

            <div v-for="student in allstudents">
              <div class="flex justify-between rounded-lg shadow-md p-4 border bg-white"
                v-if="student.pivot.has_attended == 'FALSE'" :key="student.id">
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
          <span class="flex-shrink mx-4 text-2xl text-gray-400">Review Student</span>
          <div class="flex-grow border-t border-gray-400"></div>
        </div>

        <div class="flex w-full p-8 gap-4">
          <div class="w-1/2 flex flex-col gap-2 border p-4 bg-green-100" >
            <h1>Review Students</h1>

            <div v-for="student in allstudents">
              <div class="flex justify-between rounded-lg shadow-md p-4 border bg-white"
                v-if="student.pivot.has_attended == 'TRUE'" :key="student.id">
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

          <div id="myDiv" class="w-1/2 flex flex-col gap-2 border bg-red-100">
            <div v-if="!showbutton" class="w-full h-full flex justify-center items-center">
                <div class="text-3xl">Select the student to Review!</div>
              </div>
            <div class="bg-red-100 p-4">
              <div class="flex items-center gap-2" v-if="showbutton">
              <h1  >Name Student: {{ selected.selecteReview }}</h1>
              <div class="h-10 flex items-center">
                  <button type="button" @click="clickOutside()"
                    class="text-red-500 bg-white border border-red-500 p-2 rounded-lg hover:bg-red-200">
                    Cancel</button>
                </div>
              </div>
              <div class="w-full py-4">
                <div class="w-full px-3">

                  <textarea v-if="showbutton" rows="9" maxlength="450" v-model="selected.reviewText"
                    class=" appearance-none block w-full bg-red-200 text-black border border-gray-200 rounded px-4 leading-tight focus:outline-none focus:bg-red-100 focus:border-gray-500"></textarea>
                </div>
                <div class="flex justify-between w-full px-3">

                </div>
              </div>
              <div v-if="showbutton" class="flex flex-row justify-end mr-1">
                <div class="h-10 ">
                  <button type="button" @click="openModal()"
                    class=" text-amber-700 hover:text-white border border-amber-500 hover:bg-yellow-400 focus:ring-4 focus:outline-none focus:ring-amber-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2 bg-white">Add
                    image</button>
                </div>
                <div class="h-10">
                  <button type="button" v-on:click="ReviewStudent(studentSelect.id)"
                    class=" text-green-700 hover:text-white border border-green-700 hover:bg-green-600 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2 bg-white">Save</button>
                </div>

              </div>

            </div>



          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- modal -->
  <div v-if="modal" id="modelConfirm"
    class="fixed z-50 inset-0 bg-gray-900 bg-opacity-60 overflow-y-auto h-full w-full px-4 ">
    <div class="relative my-40 mx-auto shadow-xl rounded-md bg-white w-1/2">

      <div class="flex justify-end p-2">
        <button @click="closeModal()" type="button"
          class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center">
          <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd"
              d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
              clip-rule="evenodd"></path>
          </svg>
        </button>
      </div>

      <div class="p-6 pt-0 text-center">
        <p class="text-4xl font-bold text-gray-900 dark:text-white bg-amber-200 rounded-xl py-3">Image</p>
        <div class="flex flex-col p-2">
          <div v-for="(previewSrc, index) in imagePreviewSrcs" :key="index"
            class="w-full object-cover relative order-first md:order-last md:h-auto flex justify-center items-center border border-dashed border-gray-400 col-span-2 m-2 rounded-lg bg-no-repeat bg-center bg-origin-padding bg-cover">


            <img class="object-scale-down h-1/2 w-3/5 text-gray-400 rounded-lg" :src="previewSrc" alt="">
          </div>
        </div>

        <div class="flex gap-5 pt-5">
          <div class="relative w-1/2">
            <label title="Click to upload" for="profile_image"
              class="cursor-pointer flex items-center gap-4 px-6 py-4 before:border-gray-400/60 hover:before:border-gray-300 group dark:before:bg-darker dark:hover:before:border-gray-500 before:bg-gray-100 dark:before:border-gray-600 before:absolute before:inset-0 before:rounded-3xl before:border before:border-dashed before:transition-transform before:duration-300 hover:before:scale-105 active:duration-75 active:before:scale-95">
              <div class="w-max relative">
                <img class="w-12" src="https://www.svgrepo.com/show/485545/upload-cicle.svg" alt="file upload icon"
                  width="512" height="512">
              </div>
              <div class="relative">
                <span
                  class="block text-base font-semibold relative text-blue-900 dark:text-white group-hover:text-blue-500">
                  Upload a file
                </span>
                <span class="mt-0.5 block text-sm text-gray-500 dark:text-gray-400">Max 2 MB</span>
              </div>
            </label>
            <input @change="handleImageChange()" accept="image/png, image/gif, image/jpeg" ref="profileImageInput"
              id="profile_image" name="profile_image[]" multiple type="file" class="">
          </div>

          <button @click="removeImage()"
            class='inline-flex items-center shadow-md my-5 px-2 py-2 bg-gray-900 text-gray-50 border border-transparent
                    rounded-md font-semibold text-xs uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none 
                    focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150'>
            remove image
          </button>
          <button @click="ReviewStudentImages(studentSelect.id)"
            class="absolute right-4 bottom-8 inline-flex items-center justify-center p-0.5 mb-2 mr-2 overflow-hidden text-sm font-medium text-gray-900 rounded-lg group bg-gradient-to-br from-green-400 to-blue-600 group-hover:from-green-400 group-hover:to-blue-600 hover:text-white dark:text-white focus:ring-4 focus:outline-none focus:ring-green-200 dark:focus:ring-green-800">
            <span
              class="relative px-5 py-2.5 transition-all ease-in duration-75 bg-white dark:bg-gray-900 rounded-md group-hover:bg-opacity-0">
              Save
            </span>
          </button>
        </div>

      </div>

    </div>
  </div>
</template>

<style>
/* เพิ่ม transition property เพื่อทำให้เกิดการเคลื่อนไหว */
/* .slide-right {
      animation: slideRight 1s forwards;
    }
    
    @keyframes slideRight {
      from {
        transform: translateX(100%);
      }
      to {
        transform: translateX(0);
      }
    }  */
</style>


<script setup lang="ts">
definePageMeta({
  layout: "teacher",
  middleware: ['is-authorized', 'is-teacher']
})
const route = useRoute();
import { DelayedRunner } from '@fullcalendar/core/internal';
import dayjs from 'dayjs';


const modal = ref(false);
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

function openModal() {
  modal.value = true;
}

function closeModal() {
  modal.value = false;
  removeImage();
}


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
const showbutton = ref(false);

function review(student) {
  // console.log(student);
  selected.value.selecteReview = student.first_name + ' ' + student.last_name;
  selected.value.reviewText = student.pivot.review_comment;
  studentSelect.value = student;
  showbutton.value = true;
  // playAnimation();
}


const selected = ref({
  selecteReview: 'please select the student',
  reviewText: '',
});

function clickOutside() {
  selected.value.selecteReview = 'please select the student'
  selected.value.reviewText = ''
  showbutton.value = false
}
// function playAnimation() {
//   var animatedElement = document.getElementById('myDiv');


//     animatedElement.classList.remove('hidden');
//     animatedElement.classList.remove('slide-right');

//     setTimeout(function() {
//     // เพิ่มคลาส slide-right เพื่อเริ่มเล่น animation ใหม่
//     animatedElement.classList.add('slide-right');
//     }, 100);

// }







const errorAddStd = ref('');

// add student attend
async function AddStudent(studentId: int) {

  const { data: addResponse, error: addError } = await useApiFetch(`api/teacher/attendStudent/${route.params.id}/${studentId}`, {
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




const errorRemStd = ref('');
// remove student attend
async function RemoveStudent(studentId: int) {

  const { data: removeResponse, error: removeError } = await useApiFetch(`api/teacher/absentStudent/${route.params.id}/${studentId}`, {
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







// image preview
const profileImageInput = ref<HTMLInputElement | null>(null);
const imagePreviews = ref<Array<HTMLImageElement | null>>([]);
const imagePreviewSrcs = ref<Array<string>>([]);
const imagefixes = ref<Array<boolean>>([]);
const profile_image_paths = ref<Array<File | null>>([]);

function handleImageChange() {
  removeImage();
  if (profileImageInput.value && profileImageInput.value.files) {
    const selectedFiles = profileImageInput.value.files;

    for (let i = 0; i < selectedFiles.length; i++) {
      const reader = new FileReader();
      const selectedFile = selectedFiles[i];

      reader.onload = (event: ProgressEvent<FileReader>) => {
        const previewSrc = event.target?.result as string;

        imagePreviewSrcs.value.push(previewSrc);
        imagefixes.value.push(false);
        profile_image_paths.value.push(selectedFile);

        const imagePreviewElement = document.createElement('img');
        imagePreviewElement.src = previewSrc;
        imagePreviews.value.push(imagePreviewElement);
      };

      reader.readAsDataURL(selectedFile);
    }
  } else {
    // Handle the case when no file is selected or the selection is canceled
    imagePreviewSrcs.value = [];
    imagefixes.value = [];
    profile_image_paths.value = [];
    imagePreviews.value = [];
  }
}

function removeImage() {
  imagePreviews.value = [];
  imagePreviewSrcs.value = [];
  imagefixes.value = [];
  profile_image_paths.value = [];
}

async function ReviewStudent(studentId: int) {

  const formData = new FormData();
  await formData.append('reviewText', selected.value.reviewText);

  const { data: reviewResponse, error: reviewError } = await useApiFetch(`api/teacher/addReviewStudent/${route.params.id}/${studentId}`, {
    method: "POST",
    body: formData,
  });

  if (reviewResponse.value) {

    showbutton.value = false
    await fetchStudents();
    alert('Successfully, Add student review');


  } else {

    if (reviewError.value) {
      console.log(reviewError.value);
    }
  }
}
async function ReviewStudentImages(studentId: int) {

  const formData = new FormData();


  if (profileImageInput.value && profileImageInput.value?.files?.length != 0) {

    for (let i = 0; i < profile_image_paths.value.length; i++) {
      const file = profile_image_paths.value[i];
      formData.append('images[]', file);
    }
  }
  else {
    return console.log('stoped');
  }


  const { data: reviewResponse, error: reviewError } = await useApiFetch(`api/teacher/addReviewImagesStudent/${route.params.id}/${studentId}`, {
    method: "POST",
    body: formData,
  });

  if (reviewResponse.value) {
    await fetchStudents();
    closeModal();
    showbutton.value = false
    alert('Successfully, Save image');



  } else {

    if (reviewError.value) {
      console.log(reviewError.value);
    }
  }
}






</script>

