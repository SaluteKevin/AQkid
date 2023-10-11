<template>
    <div class="h-screen justify-end place-item-center flex">
        <img class="w-1/2 object-cover" src="https://media.discordapp.net/attachments/1077532767052628008/1160566075277201458/325391955_957174475648899_6145813447620796700_n.png?ex=65352062&is=6522ab62&hm=c251cd1182ab5d70773a01685bfde627a07f42d831fbc6c99d38f987a85f95f8&=&width=1440&height=1068">
        <div class="overflow-y-auto bg-native w-full rounded-l-xl p-16 shadow-2xl">
            <form @submit.prevent="handleRegister()">
            <h1 class="text-4xl decoration-indigo-500 text-center mt-4 text-gray-800 font-semibold">Sign up</h1>
                <div class="relative flex py-5 items-center w-full px-10">
                        <div class="flex-grow border-t border-gray-400"></div>
                        <span class="flex-shrink mx-4 text-gray-400">Account Section</span>
                        <div class="flex-grow border-t border-gray-400"></div>
                    </div>
                    <label for="username" class="flex">Username <span class="text-red-500 mt-1 ml-2">  ***</span></label>
                    <input v-model="RegistrationForm.username"
                        type="text"
                        class="block border border-grey-light w-full p-3 rounded  "
                        name="username"
                        placeholder="Username" id="username"/>
                    <p class="text-red-500" v-for="error in RegistrationError['username']" :key="error">
                                {{ error }}
                    </p>

                    <label for="email" class="flex mt-4">Email</label>
                    <input v-model="RegistrationForm.email"
                        type="email"
                        class="block border border-grey-light w-full p-3 rounded"
                        name="email"
                        placeholder="Email (Optional)" 
                        id="email"/>
                        <p class="text-red-500" v-for="error in RegistrationError['email']" :key="error">
                                {{ error }}
                        </p>

                    <label for="password" class="flex mt-4">Password <span class="text-red-500 mt-1 ml-2">  ***</span></label>
                    <input v-model="RegistrationForm.password"
                        type="text"
                        class="block border border-grey-light w-full p-3 rounded"
                        name="password"
                        placeholder="Password" 
                        id="password"/>
                    
                    <p class="text-red-500" v-for="error in RegistrationError['password']" :key="error">
                                {{ error }}
                    </p>
                    
                    <label for="password_confirmation" class="flex mt-4">Confirm Password <span class="text-red-500 mt-1 ml-2">  ***</span></label>
                    <input v-model="RegistrationForm.password_confirmation"
                        type="text"
                        class="block border border-grey-light w-full p-3 rounded"
                        name="password_confirmation"
                        placeholder="Confirm Password" 
                        id="password_confirmation"/>

                    <div class="relative flex py-5 items-center w-full px-10">
                        <div class="flex-grow border-t border-gray-400"></div>
                        <span class="flex-shrink mx-4 text-gray-400">Info Section</span>
                        <div class="flex-grow border-t border-gray-400"></div>
                    </div>
                    
                    <label for="firstname" class="flex mt-4">Firstname<span class="text-red-500 mt-1 ml-2">  ***</span></label>
                    <input v-model="RegistrationForm.firstname"
                        type="text"
                        class="block border border-grey-light w-full p-3 rounded"
                        name="firstname"
                        placeholder="Firstname" 
                        id="firstname"/>

                    <p class="text-red-500" v-for="error in RegistrationError['firstname']" :key="error">
                                {{ error }}
                    </p>

                    <label for="middlename" class="flex mt-4">Middlename</label>
                    <input v-model="RegistrationForm.middlename"
                        type="text"
                        class="block border border-grey-light w-full p-3 rounded"
                        name="middlename"
                        placeholder="Middlename" 
                        id="middlename"/>

                    <p class="text-red-500" v-for="error in RegistrationError['middlename']" :key="error">
                                {{ error }}
                    </p>

                    <label for="lastname" class="flex mt-4">Lastname<span class="text-red-500 mt-1 ml-2">  ***</span></label>
                    <input v-model="RegistrationForm.lastname"
                        type="text"
                        class="block border border-grey-light w-full p-3 rounded"
                        name="lastname"
                        placeholder="Lastname" 
                        id="lastname"/>
                    
                    <p class="text-red-500" v-for="error in RegistrationError['lastname']" :key="error">
                                {{ error }}
                    </p>

                    <label for="birthdate" class="flex mt-4">Birthdate<span class="text-red-500 mt-1 ml-2">  ***</span></label>
                    <input v-model="RegistrationForm.birthdate"
                    type="date" id="birthdate" name="birthdate"
                    class="block border border-grey-light w-full p-3 rounded">
                    <p class="text-red-500" v-for="error in RegistrationError['birthdate']" :key="error">
                                {{ error }}
                    </p>
                        
                    <label for="phone_number" class="flex mt-4">Birthdate<span class="text-red-500 mt-1 ml-2">  ***</span></label>
                    <input v-model="RegistrationForm.phone_number"
                    type="tel" id="phone_number" name="phone_number" placeholder="091-111-1111" 
                    class="block border border-grey-light w-full p-3 rounded">

                    <p class="text-red-500" v-for="error in RegistrationError['phone_number']" :key="error">
                                {{ error }}
                    </p>

                    <!-- image -->

                    <label for="profile_image" class="flex mt-4">Profile Image</label>

                    <div class="flex w-full gap-5">
                        <input @change="handleImageChange" ref="profileImageInput" id="profile_image" name="profile_image" class='inline-flex items-center shadow-md my-2 px-2 py-2 bg-gray-900 text-gray-50 border border-transparent
                            rounded-md font-semibold text-xs uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none 
                        focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150' type="file">
                        <button @click="removeImagePreview"
                        class = 'inline-flex items-center shadow-md my-2 px-2 py-2 bg-gray-900 text-gray-50 border border-transparent
                            rounded-md font-semibold text-xs uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none 
                        focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150'>
                        remove image
                        </button>


                    </div>
                    

                    

                        <div 
                            class="relative order-first md:order-last h-28 md:h-auto flex justify-center items-center border border-dashed border-gray-400 col-span-2 m-2 rounded-lg bg-no-repeat bg-center bg-origin-padding bg-cover">
                                <span v-if="imagefix" class="text-gray-400 opacity-75">
                                    <svg class="w-14 h-14"  xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="0.7" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5zm10.5-11.25h.008v.008h-.008V8.25zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                                </svg>
                                </span>
                                
                                <img ref="imagePreview" :src="imagePreviewSrc" alt="">
                        </div>

          

                    

                    <button
                        type="submit"
                        class="bg-black mt-8
                               shadow-inner 
                               hover:shadow-xl duration-300 hover:bg-white hover:text-indigo-600 w-full text-center py-3 rounded text-white my-1"
                    >Create Account</button>

                    <p class="text-red-500" v-for="error in RegistrationError['message']" :key="error">
                                {{ error }}
                    </p>

                    <div class="text-grey-dark">
                    Already Sign Up? 
                    <NuxtLink class="no-underline border-b border-blue text-indigo-600" to="/auths/login">
                        Log in
                    </NuxtLink>

                </div>
            </form>
        </div>
        
    </div>
</template>


<script setup lang="ts">
definePageMeta({layout: false})

import {useAuthStore} from "~/stores/useAuthStore";
    
const auth = useAuthStore();

await auth.setCSRFCookie();

const RegistrationForm = ref({
    username: "",
    email: "",
    password: "",
    password_confirmation: "",
    firstname: "",
    middlename: "",
    lastname: "",
    birthdate:"",
    phone_number:"",
    
});

const RegistrationError = ref<{ [k: string]: any }>({})

const profile_image_path =  ref<File | null>(null)


async function handleRegister() {

    const formData = new FormData()

    if (profile_image_path.value) {
        formData.append('profile_image_path', profile_image_path.value)
    }

    for (const item in RegistrationForm.value) {
        formData.append(item, RegistrationForm.value[item]);
    }

    const {data: registerResponse, error: registerError } = await useApiFetch("api/auth/register", {
            method: "POST",
            body: formData,
    });

    if (registerResponse.value) {

        await navigateTo(`/auths/login`);

    } 

    else {

        if (registerError.value) {

            
            const errors = registerError.value.data.errors;

            RegistrationError.value = {};

            for (const key in errors) {

                if (errors.hasOwnProperty(key)) {

                const errorMessages = errors[key];
                
                RegistrationError.value[key] = errorMessages;

                }
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