<script setup lang="ts">
definePageMeta({layout: "student"})

import { defineStore } from 'pinia'
import {useAuthStore} from "~/stores/useAuthStore";
import {useTimeStore} from "~/stores/useTimeStore";


function CustomAlert(){
  this.alert = function(message,title){
    document.body.innerHTML = document.body.innerHTML + '<div id="dialogoverlay"></div><div id="dialogbox" class="slit-in-vertical"><div><div id="dialogboxhead"></div><div id="dialogboxbody"></div><div id="dialogboxfoot"></div></div></div>';
    
    let dialogoverlay = document.getElementById('dialogoverlay');
    let dialogbox = document.getElementById('dialogbox');
    
    let winH = window.innerHeight;
    dialogoverlay.style.height = winH+"px";

    dialogbox.style.top = "100px";

    dialogoverlay.style.display = "block";
    dialogbox.style.display = "block";
    
    document.getElementById('dialogboxhead').style.display = 'block';

    if(typeof title === 'undefined') {
      document.getElementById('dialogboxhead').style.display = 'none';
    } else {
      document.getElementById('dialogboxhead').innerHTML = '<i class="fa fa-exclamation-circle" aria-hidden="true"></i> '+ title;
    }
    
    document.getElementById('dialogboxbody').innerHTML = message;
    document.getElementById('dialogboxfoot').innerHTML = '<button class="pure-material-button-contained active" onclick="customAlert.ok()">OK</button>';
  }
  
  this.ok = function(){
    document.getElementById('dialogbox').style.display = "none";
    document.getElementById('dialogoverlay').style.display = "none";
  }
}

let customAlert = new CustomAlert();


const route = useRoute();
const counter = useTimeStore();
var time = ref({
    minute: useTimeStore().time/60,
    second: useTimeStore().time%60
})
async function startTimer() {
  const timer = setInterval(() => {
    counter.timeDown();
    if (useTimeStore().time === 0) {
      // ทำงานเมื่อครบ 5 นาที
        navigateTo(`/`);
        customAlert.alert('Over Time');
        clearInterval(timer);
    }
    else{
        time.value.minute = useTimeStore().time/60 | 0;
        time.value.second = useTimeStore().time%60;
        // console.log(counter.value);
    }
  }, 1000);

}
if (useTimeStore().time > 0){
    startTimer();
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
        console.log(formData.get('image_path'));
        
        const {data: registerResponse, error: registerError } = await useApiFetch("api/student/enrollCourse/"+route.params.id+'/'+user.value.id, {
            method: "POST",
            body: formData,
        });
        if (registerResponse.value) {
            console.log(registerResponse.value.message);
            
            //route go home page user
            // await navigateTo(`/student`);
        }
        if (registerError.value){
            console.log(registerError.value);
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


    <div class="absolute max-w-md border rounded-lg">
  <div class="flex flex-col p-5 rounded-lg shadow bg-white">
	<div class="flex">
	  <div>
		<svg class="w-6 h-6 fill-current text-blue-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M11 7h2v2h-2zm0 4h2v6h-2zm1-9C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8z"/></svg>
	  </div>

	  <div class="ml-3">
		<h2 class="font-semibold text-gray-800">Alert Component</h2>
		<p class="mt-2 text-sm text-gray-600 leading-relaxed">Etiam finibus velit vel lacus cursus porttitor ac rhoncus leo. Ut gravida justo est, sit amet vulputate felis vestibulum eleifend. Vivamus faucibus augue a scelerisque rutrum. Donec faucibus nibh ex, in condimentum quam viverra in.</p>
	  </div>
	</div>

	<div class="flex justify-end items-center mt-3">
	  <button class="px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-800 text-sm font-medium rounded-md">
		Cancel
	  </button>

	  <button class="px-4 py-2 ml-2 bg-blue-500 hover:bg-blue-600 text-white text-sm font-medium rounded-md">
		Continue
	  </button>
	</div>
  </div>
</div>


</template>