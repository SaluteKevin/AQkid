<template>
    <div class="p-16 min-h-screen bg-gradient-to-b to-purple-100 to-60% from-[#bce1ff] from-10%">
        <div class="flex justify-between items-center">
            <h2 class="my-4 text-4xl font-semibold text-gray-600">Teacher List</h2>
            <label
                class="relative bg-white min-w-sm max-w-2xl flex flex-col md:flex-row items-center justify-center border  px-2 rounded-2xl gap-2 shadow-2xl focus-within:border-gray-300"
                for="search-bar">
                <input id="search-bar" placeholder="teacher name" v-on:change="handleSearchTeacher"
                    class="px-6 py-2 w-full rounded-md flex-1 outline-none bg-white">
                <button
                    class="w-full md:w-auto px-4 py-1 bg-black border-black text-white fill-white active:scale-95 duration-100 border will-change-transform overflow-hidden relative rounded-xl transition-all disabled:opacity-70">
                    
                    <div class="relative">

                        <!-- Loading animation change opacity to display -->
                        <div
                            class="flex items-center justify-center h-3 w-3 absolute inset-1/2 -translate-x-1/2 -translate-y-1/2 transition-all">
                            <svg class="opacity-0 animate-spin w-full h-full" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                    stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor"
                                    d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                </path>
                            </svg>
                        </div>

                        <div class="flex items-center transition-all opacity-1 valid: "><span
                                class="text-sm font-semibold whitespace-nowrap  mx-auto">
                                Search
                            </span>
                        </div>

                    </div>
                    
                </button>
            </label>    
            <button v-on:click="regisUp"
            class="px-3 py-2 bg-white font-medium text-gray-800 rounded-lg shadow-md border border-gray-300 hover:bg-gray-200">
                Register teacher

            </button>
        </div>
                <div class="pb-2 flex items-center justify-between text-gray-600">
                    <!-- Header -->
                    <div>
                        <span>
                            <span class="text-green-400">
                                431
                            </span>
                            teachers
                        </span>
                        <span>
                            <span class="text-green-400">
                                22
                            </span>
                            courses
                        </span>
                    </div>

                </div>

        <!-- card -->
        
            <div class="flex flex-col gap-2" >

                <div v-for="teacher in showTeachers" :key="teacher.username"
                    class="mt-2 flex  px-4 py-4 justify-between bg-white
                    shadow-2xl rounded-lg cursor-pointer w-full">
                    <!-- Card -->

                    
                        <!-- Left side -->

                        <img
                            class="h-12 w-12 rounded-full object-cover"
                            src="https://inews.gtimg.com/newsapp_match/0/8693739867/0"
                            alt="" />

                        <div
                            class="ml-4 flex flex-col capitalize text-black">
                            <span>name</span>
                            <span class="mt-2 text-gray-600">
                                {{teacher.first_name}} {{ teacher.middle_name }} {{teacher.last_name }}
                            </span>
                        </div>

                        <div
                            class="ml-12  flex flex-col capitalize text-black">
                            <span>Phone Number</span>
                            <span class="mt-2 text-gray-600">
                                {{teacher.phone_number}}
                            </span>

                        </div>

                        <div
                            class="mr-16 flex flex-col text-black">
                            <span>Email</span>
                            <span class="mt-2 text-gray-600">
                                {{teacher.email}}
                            </span>
                            
                        </div>

                        <div
                            class="ml-12 flex flex-col capitalize text-black">
                            <span>Courses</span>
                            <span class="text-red-400" v-if="teacher.course_count == 0">
                                No courses
                            </span>
                            <span class="text-green-600" v-if="teacher.course_count != 0">
                                {{ teacher.course_count }}
                            </span>
                        </div>


                        <div
                            class="mr-16 flex flex-col capitalize text-gray-600">
                            <span>Profile info</span>
                            
                            <nuxt-link :to="`/staff/detail/teacher${teacher.id}`">
                                <span class="text-gray-600">see more...</span>
                            </nuxt-link>
                        </div>



                </div>

                
            </div>

            <Paginate class="mt-8" :from="1" :last_page="10"/>
			
    </div>

    

    <div v-if="Registration" class="min-h-screen bg-gradient-to-t to-purple-100 to-60% from-[#bce1ff] from-10% flex flex-col items-center justify-center">

        <div class="relative flex py-5 items-center w-full px-10">
            <div class="flex-grow border-t border-gray-400"></div>
            <span class="flex-shrink mx-4 text-gray-400">Teacher Registration</span>
            <div class="flex-grow border-t border-gray-400"></div>
        </div>

        <h2 ref="scrollRegis" class="my-4 text-4xl font-semibold text-gray-600">Registration Form</h2>        
        <div class=" w-full p-12">
                <form @submit.prevent="handleRegister" class="bg-white p-16 rounded-2xl shadow-2xl">
                
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
                            
                        <label for="phone_number" class="flex mt-4">Phone Number<span class="text-red-500 mt-1 ml-2">  ***</span></label>
                        <input v-model="RegistrationForm.phone_number"
                        type="tel" id="phone_number" name="phone_number" placeholder="081-111-1111" 
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

            

                        
                        <div class="flex gap-4">
                            <button
                                    type="submit"
                                    class="bg-black mt-8
                                        shadow-inner 
                                        hover:shadow-xl duration-300 hover:bg-white hover:text-indigo-600 w-full text-center py-3 rounded text-white my-1"
                                >Create Account</button>

                                <button v-on:click="regisDown"
                        class="bg-red-500 mt-8
                                        shadow-inner 
                                        hover:shadow-xl duration-300 hover:bg-white hover:text-indigo-600 w-full text-center py-3 rounded text-white my-1"
                        >
                        Cancel
                        </button>
                        </div>

                        <p class="text-red-500" v-for="error in RegistrationError['message']" :key="error">
                                    {{ error }}
                        </p>

                        
                </form>

                

        </div>

        
            
    </div>

    

		

</template>


<script setup lang="ts">
definePageMeta({layout: "staff"})

const Registration = ref(false)
const scrollRegis = ref()

async function setRegis() {
    Registration.value = !Registration.value;
}

const regisUp  = async() => {

    await setRegis();

    if (scrollRegis.value) {
        const element = scrollRegis.value.getBoundingClientRect();
  
        // Scroll to the element with smooth animation
        window.scrollTo({
            top: element.top + window.scrollY,
            behavior: 'smooth',
        });
    }

};

const regisDown  = async() => {

    await setRegis();

    // Scroll to the element with smooth animation
    window.scrollTo({
        top: 0,
        behavior: 'smooth',
    });

};


// allTeachers

const allTeachers = ref({})
const showTeachers = ref({})

await fetchTeachers();

async function fetchTeachers() {

    const {data: teacherResponse, error: teacherError } = await useApiFetch("api/staff/allTeachers", {});

    if (teacherResponse.value) {
        
        allTeachers.value = teacherResponse.value;

        showTeachers.value = allTeachers.value;

    }
    else {
        
        if (teacherError.value) {
            console.log(teacherError.value);
        }

    }


}

// register Teacher

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

    const {data: registerResponse, error: registerError } = await useApiFetch("api/staff/register", {
            method: "POST",
            body: formData,
    });

    if (registerResponse.value) {

        await fetchTeachers();

        await regisDown();

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

// Search Teacher

function handleSearchTeacher( event ) {
      
    showTeachers.value = {};

    for (const teacher in allTeachers.value) {
        
        if (allTeachers.value[teacher].first_name.toLowerCase().includes(event.target.value.toLowerCase())) {
            
            showTeachers.value[teacher] = allTeachers.value[teacher];

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