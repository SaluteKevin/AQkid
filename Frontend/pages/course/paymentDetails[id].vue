<script setup lang="ts">
definePageMeta({layout: "student"})

import { defineStore } from 'pinia'
import {useAuthStore} from "~/stores/useAuthStore";
import {useTimeStore} from "~/stores/useTimeStore";

const modal = ref(false);
const message = ref('time out');

function closeModal(){
    navigateTo(`/student`);
}

const route = useRoute();
await useTimeStore().updateTime();
const counter = await useTimeStore().time;
const nowTime = new Date();
const countDown = ref(300);
if(counter && nowTime){
    const timeDifferenceInMilliseconds = counter - nowTime;
    console.log(`time ${{ counter }} nowTime ${{ nowTime }}` );
    const timeDifferenceInSeconds = Math.floor(timeDifferenceInMilliseconds / 1000);
    if (0<=timeDifferenceInSeconds && timeDifferenceInSeconds<= 300 ){
        countDown.value = Math.floor(timeDifferenceInSeconds % 301);
    }
    else {
        countDown.value = 0;
    }
    console.log(countDown.value);
    
}

var time = ref({
    minute: 5,
    second: 0
})
async function startTimer() {
  const timer = setInterval(() => {
    if (--countDown.value <= 0) {
      // ทำงานเมื่อครบ 5 นาที
        modal.value = true;
        clearInterval(timer);
    }
    else {
        time.value.minute = countDown.value/60 | 0;
        time.value.second = countDown.value%60;
    }

  }, 1000);

}
if (countDown.value > 0){
    startTimer();
}
else {
    modal.value = true;
}

const course = reactive({});
const {data: eventCourse, error: loginError } = await useApiFetch("api/student/showCourse/"+route.params.id, {});
if(eventCourse.value){
    course.value = eventCourse.value[0]
}

const profile_image_path =  ref<File | null>(null)
const user = useAuthStore().user;
console.log(user.value.id);


async function handleRegister() {
    const formData = new FormData()
    if (profile_image_path.value) {
        formData.append('image_path', profile_image_path.value)
        
        
        const {data: registerResponse, error: registerError } = await useApiFetch("api/student/enrollCourse/"+route.params.id+'/'+user.value.id, {
            method: "POST",
            body: formData,
        });
        if (registerResponse.value) {
            console.log(registerResponse.value.message);
            navigateTo(`/student`);

            //route go home page user
            // await navigateTo(`/student`);
        }
        else {
            if (registerError.value) {
              console.log(registerError.value?.data.message);
              message.value = registerError.value?.data.message;
              modal.value = true;
            }
        }
        
    }

}






// image preview
const profileImageInput = ref<HTMLInputElement | null>(null);
const imagePreview = ref<HTMLImageElement | null>(null);
const imagePreviewSrc = ref<string>(''); // Store the image source
const imagefix = ref(true);

const handleImageChange = () => {
  if (profileImageInput.value && profileImageInput.value.files && profileImageInput.value.files[0]) {
    const selectedFile = profileImageInput.value.files[0];
    const reader = new FileReader();

    reader.onload = (event: ProgressEvent<FileReader>) => {
      if (imagePreview.value) {
        imagePreview.value.src = event.target?.result as string;
        imagePreviewSrc.value = event.target?.result as string; // Set the image source
        imagefix.value = false;
        profile_image_path.value = selectedFile;
      }
    };

    reader.readAsDataURL(selectedFile);
  } else {
    // Handle the case when no file is selected or the selection is canceled
    if (imagePreview.value) {
      imagePreview.value.src = '';
      imagePreviewSrc.value = ''; // Clear the image source
      imagefix.value = true;
      profile_image_path.value = null;
    }
  }
};

const removeImagePreview = () => {
  if (imagePreview.value) {
    imagePreview.value.src = '';
    imagePreviewSrc.value = ''; // Clear the image source
    imagefix.value = true;
    profile_image_path.value = null;
  }

  if (profileImageInput.value) {
    profileImageInput.value.value = ''; // Clear the input value
  }
};


</script>

<template>
    <div id="dialogoverlay"></div>
    <div id="dialogbox" class="slit-in-vertical">
        <div>
            <div id="dialogboxhead"></div>
            <div id="dialogboxbody"></div>
            <div id="dialogboxfoot"></div>
        </div>
    </div>
    
    <div class="bg-gradient-to-b flex justify-center items-center pt-20 pb-36">
        <div class="bg-black-300 border border-gray-200 shadow w-3/4 p-12 rounded-2xl">
            <div class="p-5 bg-gradient-to-r animate-pulse from-cyan-300 via-cyan-800 to-cyan-300 rounded-2xl mx-5">
                <p class="p-4 text-center text-6xl text-gray-900 dark:text-black rounded-2xl">Payment</p>
            </div>
            <div class="flex justify-center items-center">
                <div class="w-1/2 flex justify-center items-center bg-white rounded-lg">
                    <div>
                        <img class="h-auto max-w-lg" src="https://media.discordapp.net/attachments/474941945882476546/1162264364968050738/Screenshot_2023-10-13-12-43-23-97_275eb041e5d68c8a5fb815dd7041b155.jpg?ex=653b4e0a&is=6528d90a&hm=4612de7db51935602c65330a831169eeaaec50cc3360b7648d05d1f00dec3b3a&=&width=461&height=507" alt="image description">
                    </div>
                </div>
            </div>
            <div class="flex justify-center items-center m-5">
                <p v-if="course.value" class="w-1/2 px-12 py-4 text-center text-4xl text-gray-900 dark:text-black bg-cyan-300 rounded-2xl w-1/2">Amount:    {{course.value.price}}  baht</p>
            </div>

            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
            <div class="flex justify-center items-center">
                <div class="flex gap-5">
                            <input @change="handleImageChange" accept="image/png, image/gif, image/jpeg" ref="profileImageInput" id="profile_image" name="profile_image" class='inline-flex items-center shadow-md my-2 px-2 py-2 bg-gray-900 text-gray-50 border border-transparent
                                rounded-md font-semibold text-xs uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none 
                            focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150' type="file">
                            <button @click="removeImagePreview"
                            class = 'inline-flex items-center shadow-md my-2 px-2 py-2 bg-gray-900 text-gray-50 border border-transparent
                                rounded-md font-semibold text-xs uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none 
                            focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150'>
                            remove image
                            </button>


                </div>
            </div>
            <div  class="flex justify-center items-center m-5">
                <div 
                    class="w-80 object-cover relative order-first md:order-last h-28 md:h-auto flex justify-center items-center border border-dashed border-gray-400 col-span-2 m-2 rounded-lg bg-no-repeat bg-center bg-origin-padding bg-cover">
                        <span v-if="imagefix" class="text-gray-400 opacity-75">
                            <svg class="w-14 h-14"  xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="0.7" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5zm10.5-11.25h.008v.008h-.008V8.25zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                            </svg>
                        </span>
                        <h3 v-if="imagefix" class="w-full">Preview Image</h3>
                        
                        <img ref="imagePreview" class="object-cover w-80 text-gray-400" :src="imagePreviewSrc" alt="">
                </div>
            </div>
            <div class="flex justify-center items-center m-5">
                <div class="w-1/2 px-12 py-4 relative">
                        <div class="absolute right-0">
                            <button @click="handleRegister()" class="relative inline-flex items-center justify-center p-0.5 mb-2 mr-2 overflow-hidden text-sm font-medium text-white rounded-lg group bg-gradient-to-br from-teal-300 to-teal-300 group-hover:from-blue-300 group-hover:to-blue-300 dark:text-black dark:hover:text-white focus:ring-4 focus:outline-none focus:ring-blue-400 dark:focus:ring-blue-500">
                                <span class="relative px-5 py-2.5 transition-all ease-in duration-75 text-white dark:bg-gray-900 rounded-md group-hover:bg-opacity-0">
                                    Confirm
                                </span>
                            </button>
                        </div>
                </div>
            </div>
            <p class="text-2xl font-medium text-gray-900 text-red-700">Please confirm in 5 minutes</p>
            <p class="text-2xl font-medium text-gray-900 text-red-700">{{ time.minute }}:{{ time.second }}</p>


        </div>
    </div>

    <div v-if="modal">
        <div id="modelConfirm" class="fixed z-50 inset-0 bg-gray-900 bg-opacity-60 overflow-y-auto h-full w-full px-4 ">
            <div class="relative top-40 mx-auto shadow-xl rounded-md bg-white max-w-md">
            
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
                    <svg class="w-20 h-20 text-red-600 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <h3 class="text-xl font-normal text-gray-500 mt-5 mb-6">{{ message }}</h3>
                    <a href="#"  onclick=""
                        class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-base inline-flex items-center px-3 py-2.5 text-center mr-2">
                        Go to refund
                    </a>
                    <a href="#" @click="closeModal()"
                        class="text-gray-900 bg-white hover:bg-gray-100 focus:ring-4 focus:ring-cyan-200 border border-gray-200 font-medium inline-flex items-center rounded-lg text-base px-3 py-2.5 text-center"
                        data-modal-toggle="delete-user-modal">
                        No, cancel
                    </a>
                </div>
            
            </div>
        </div>

    </div>


</template>