<template>
    <div class="flex justify-center bg-gradient-to-t from-cyan-200 from-20% via-white to-purple-200 to-90% flex-col gap-5 px-3 md:px-16 lg:px-28 md:flex-row text-[#161931]">

        <main class="flex justify-center w-full min-h-screen py-1 md:w-2/3 lg:w-3/4">
            <div class="p-2 md:p-4 bg-white">
                <div class="w-full px-6 pb-8 mt-8 sm:max-w-xl sm:rounded-lg">
                    <h2 class="text-2xl font-bold sm:text-xl">Profile setting</h2>
                    <div class="relative flex pt-5 items-center w-full px-10">
                        <div class="flex-grow border-t border-gray-400"></div>
                        <span class="flex-shrink mx-4 text-gray-400">Image Section</span>
                        <div class="flex-grow border-t border-gray-400"></div>
                    </div>

                    <div class="grid max-w-2xl mx-auto">
                        <div class="flex flex-col items-center space-y-5 sm:flex-row sm:space-y-0">

                            <div class="flex flex-col space-y-5 sm:ml-8">
                                <div
                                    class="relative order-first md:order-last h-28 md:h-auto flex justify-center items-center border border-dashed border-gray-400 col-span-2 m-2 rounded-lg bg-no-repeat bg-center bg-origin-padding bg-cover">
                                    <span v-if="imagefix" class="text-gray-400 opacity-75">
                                        <svg class="w-14 h-14" xmlns="http://www.w3.org/2000/svg" fill="none"
                                            viewBox="0 0 24 24" stroke-width="0.7" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5zm10.5-11.25h.008v.008h-.008V8.25zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                                        </svg>
                                    </span>

                                    <img ref="imagePreview" :src="imagePreviewSrc" alt="">
                                </div>
                                
                                <div class="flex w-full gap-5">
                                    <input @change="handleImageChange" ref="profileImageInput" id="profile_image"
                                        name="profile_image"
                                        class='inline-flex items-center shadow-md my-2 px-2 py-2 bg-gray-900 text-gray-50 border border-transparent
                                    rounded-md font-semibold text-xs uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none 
                                focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150'
                                        type="file">
                                    <button @click="removeImagePreview"
                                        class='inline-flex items-center shadow-md my-2 px-2 py-2 bg-gray-900 text-gray-50 border border-transparent
                                    rounded-md font-semibold text-xs uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none 
                                focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150'>
                                        remove image
                                    </button>
                                </div>

                            </div>



                        </div>
                        <p class="text-green-500">{{ imageSuccess }}</p>
                        <p class="text-red-500 font-normal">
                            {{ errorImage }}
                            </p>    
                        <div class="flex justify-end gap-2">
                            <button v-if="!showImageEdit" v-on:click="showImageEdit = !showImageEdit" class="text-white bg-[#202142] hover:bg-indigo-800 focus:ring-4 focus:outline-none font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">Edit</button>
                            <button v-if="showImageEdit" v-on:click="handleChangeImage"
                                class="text-white bg-indigo-700  hover:bg-indigo-800 focus:ring-4 focus:outline-none focus:ring-indigo-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-indigo-600 dark:hover:bg-indigo-700 dark:focus:ring-indigo-800">Save</button>
                            <button v-if="showImageEdit" v-on:click="cancel" 
                                class="text-white bg-[#202142] hover:bg-indigo-800 focus:ring-4 focus:outline-none font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center ">Cancel</button>
                                
                        </div>
                        <p class="text-red-500" v-for="error in imageError['profile_image_path']" :key="error">
                                    {{ error }}
                                    </p>
                                    

                        <div class="relative flex py-5 items-center w-full px-10">
                            <div class="flex-grow border-t border-gray-400"></div>
                            <span class="flex-shrink mx-4 text-gray-400">Information Section</span>
                            <div class="flex-grow border-t border-gray-400"></div>
                        </div>


                        <div class="items-center mt-8 sm:mt-14 text-[#202142]">



                            <div
                                class="flex flex-col items-center w-full mb-2 space-x-0 space-y-2 sm:flex-row sm:space-x-4 sm:space-y-0 sm:mb-6">
                                <div class="w-full">
                                    <label for="first_name" class="block mb-2 text-sm font-medium text-indigo-900 ">
                                        First name</label>
                                    <input v-model="EditForm.firstname" type="text" id="first_name"
                                        class="bg-indigo-50 border border-indigo-300 text-indigo-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5 "
                                        required>
                                    <p class="text-red-500" v-for="error in RegistrationError['firstname']" :key="error">
                                    {{ error }}
                                    </p>
                                </div>
                                <div class="w-full">
                                    <label for="middle_name" class="block mb-2 text-sm font-medium text-indigo-900 ">
                                        Middle name</label>
                                    <input v-model="EditForm.middlename" type="text" id="middle_name"
                                        class="bg-indigo-50 border border-indigo-300 text-indigo-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5 "
                                        required>
                                        <p class="text-red-500" v-for="error in RegistrationError['middlename']" :key="error">
                                        {{ error }}
                                        </p>
                                </div>

                                <div class="w-full">
                                    <label for="last_name" class="block mb-2 text-sm font-medium text-indigo-900 ">
                                        Last name</label>
                                    <input v-model="EditForm.lastname" type="text" id="last_name"
                                        class="bg-indigo-50 border border-indigo-300 text-indigo-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5 "
                                        required>
                                    <p class="text-red-500" v-for="error in RegistrationError['lastname']" :key="error">
                                    {{ error }}
                                    </p>
                                </div>

                            </div>

                            <div class="mb-2 sm:mb-6">
                                <label for="email" class="block mb-2 text-sm font-medium text-indigo-900 ">Your
                                    birthdate</label>
                                <input v-model="EditForm.birthdate" id="birthdate" type="date"
                                    class="bg-indigo-50 border border-indigo-300 text-indigo-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5 "
                                    required>
                                    <p class="text-red-500" v-for="error in RegistrationError['birthdate']" :key="error">
                                    {{ error }}
                                    </p>
                            </div>

                            <div class="mb-2 sm:mb-6">
                                <label for="email" class="block mb-2 text-sm font-medium text-indigo-900 ">Your
                                    email</label>
                                <input v-model="EditForm.email" type="email" id="email"
                                    class="bg-indigo-50 border border-indigo-300 text-indigo-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5 "
                                    required>
                                    <p class="text-red-500" v-for="error in RegistrationError['email']" :key="error">
                                    {{ error }}
                                    </p>
                            </div>

                            <div class="mb-2 sm:mb-6">
                                <label for="profession" class="block mb-2 text-sm font-medium text-indigo-900 ">Phone
                                    number</label>
                                <input v-model="EditForm.phone_number" type="text" id="profession"
                                    class="bg-indigo-50 border border-indigo-300 text-indigo-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5 "
                                    required>
                                    <p class="text-red-500" v-for="error in RegistrationError['phone_number']" :key="error">
                                    {{ error }}
                                    </p>
                            </div>
                            <p class="text-green-500">{{ profileSuccess }}</p>
                            <p class="text-red-500 font-normal">
                            {{ errorProfile }}
                            </p>
                            <div class="flex justify-end gap-2">
                                <button v-if="!showProfileEdit" v-on:click="showProfileEdit = !showProfileEdit" class="text-white bg-[#202142] hover:bg-indigo-800 focus:ring-4 focus:outline-none font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">Edit</button>
                                <button v-if="showProfileEdit" v-on:click="handleEditProfile"
                                    class="text-white bg-indigo-700  hover:bg-indigo-800 focus:ring-4 focus:outline-none focus:ring-indigo-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-indigo-600 dark:hover:bg-indigo-700 dark:focus:ring-indigo-800">Save</button>
                                <button  v-if="showProfileEdit" v-on:click="cancel" 
                                    class="text-white bg-[#202142] hover:bg-indigo-800 focus:ring-4 focus:outline-none font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center ">Cancel</button>
                            </div>


                        </div>
                        <div class="relative flex py-5 items-center w-full px-10">
                            <div class="flex-grow border-t border-gray-400"></div>
                            <span class="flex-shrink mx-4 text-gray-400">Password Section</span>
                            <div class="flex-grow border-t border-gray-400"></div>
                        </div>

                        <div class="mb-2 sm:mb-6">
                            <label for="password" class="block mb-2 text-sm font-medium text-indigo-900 ">Password</label>
                            <input v-model="passwordForm.password" type="text" id="password"
                                class="bg-indigo-50 border border-indigo-300 text-indigo-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5 "
                                required placeholder="Enter New Password">
                                <p class="text-red-500" v-for="error in passwordError['password']" :key="error">
                                    {{ error }}
                                    </p>
                            <label for="password" class="block my-2 text-sm font-medium text-indigo-900 ">Confirm
                                Password</label>
                            <input v-model="passwordForm.password_confirmation" type="text" id="confirm_password"
                                class="bg-indigo-50 border border-indigo-300 text-indigo-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5 "
                                required placeholder="Confirm New Password">
                                <p class="text-red-500" v-for="error in passwordError['password_confirmation']" :key="error">
                                    {{ error }}
                                </p>
                        </div>

                        <p class="text-green-500">{{ passwordSuccess }}</p>
                        <p class="text-red-500 font-normal">
                            {{ errorPassword }}
                            </p>
                        <div class="flex justify-end gap-2">
                            <button v-if="!showPasswordEdit" v-on:click="showPasswordEdit = !showPasswordEdit" class="text-white bg-[#202142] hover:bg-indigo-800 focus:ring-4 focus:outline-none font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">Edit</button>
                            <button v-if="showPasswordEdit" v-on:click="handleChangePassword"
                                class="text-white bg-indigo-700  hover:bg-indigo-800 focus:ring-4 focus:outline-none focus:ring-indigo-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-indigo-600 dark:hover:bg-indigo-700 dark:focus:ring-indigo-800">Save</button>
                            <button v-if="showPasswordEdit" v-on:click="cancel" 
                                class="text-white bg-[#202142] hover:bg-indigo-800 focus:ring-4 focus:outline-none font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center ">Cancel</button>
                        </div>

                    </div>
                </div>
            </div>
        </main>
    </div>
</template>
    
    
<script setup lang="ts">
definePageMeta({ layout: "student" })
import { useAuthStore } from "~/stores/useAuthStore";
const auth = useAuthStore();


const RegistrationError = ref<{ [k: string]: any }>({})
const profileSuccess = ref("");

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

const EditForm = ref({
    email: auth.user.value.email,
    firstname: auth.user.value.first_name,
    middlename: auth.user.value.middlename,
    lastname: auth.user.value.last_name,
    birthdate: auth.user.value.birthdate,
    phone_number: auth.user.value.phone_number,
    //
});

async function handleEditProfile() {

    const { data: updateResponse, error: updateError } = await useApiFetch("api/auth/editprofile/" + auth.user.value.id, {
        method: "POST",
        body: EditForm.value,
    });

    if (updateResponse.value) {

        // console.log(updateResponse.value)
        await fetchAuthUser();

        RegistrationError.value = {};

        errorProfile.value = "";

        profileSuccess.value = "Successfully, Update Profile";
        // await navigateTo(`/student/profile`);

    }

    else {

        if (updateError.value) {

            profileSuccess.value = "";

            errorProfile.value = "";

            errorProfile.value = updateError.value.data.message;

            const errors = updateError.value.data.errors;

            RegistrationError.value = {};

            profileSuccess.value = "";

            for (const key in errors) {

                if (errors.hasOwnProperty(key)) {

                    const errorMessages = errors[key];

                    RegistrationError.value[key] = errorMessages;

                }
            }
        }

    }
}



const passwordForm = ref({
    password: auth.user.value.password,
    password_confirmation: "",
});

const passwordSuccess = ref("");

const passwordError = ref<{ [k: string]: any }>({})

async function handleChangePassword() {

    const { data: updateResponse, error: updateError } = await useApiFetch("api/auth/editpassword/" + auth.user.value.id, {
        method: "POST",
        body: passwordForm.value,
    });
    if (updateResponse.value) {

        await fetchAuthUser();

        passwordError.value = {};

        errorPassword.value = "";

        passwordSuccess.value = "Successfully, Update Password";
    }
    else {

        if (updateError.value) {

            passwordSuccess.value = "";

            errorPassword.value = "";

            errorPassword.value = updateError.value.data.message;

            const errors = updateError.value.data.errors;

            passwordError.value = {};

            passwordSuccess.value = "";

            for (const key in errors) {

                if (errors.hasOwnProperty(key)) {

                    const errorMessages = errors[key];

                    passwordError.value[key] = errorMessages;

                }
            }
        }

    }

}


const profile_image_path = ref<File | null>(null);
const imageError = ref<{ [k: string]: any }>({})
const imageSuccess = ref("");

async function handleChangeImage() {

    const formData = new FormData()

    if (profile_image_path.value) {
        formData.append('profile_image_path', profile_image_path.value)
    }

    const { data: updateResponse, error: updateError } = await useApiFetch("api/auth/editimage/" + auth.user.value.id, {
        method: "POST",
        body: formData,
    });

    if (updateResponse.value) {

        await fetchAuthUser();

        imageError.value = {};

        errorImage.value = "";

        imageSuccess.value = "Successfully, Change Profile Image";

    }
    else {

        if (updateError.value) {

            imageSuccess.value = "";

            errorImage.value = "";

            errorImage.value = updateError.value.data.message;

            const errors = updateError.value.data.errors;

            imageError.value = {};

            imageSuccess.value = "";

            for (const key in errors) {

                if (errors.hasOwnProperty(key)) {

                    const errorMessages = errors[key];

                    imageError.value[key] = errorMessages;

                }
            }
        }

    }

}

function cancel() {
    window.location.reload();

}

async function fetchAuthUser() {
    await auth.fetchAuthUser();

}

// all edits
const showImageEdit = ref(false)
const showProfileEdit = ref(false)
const showPasswordEdit = ref(false)

const errorImage = ref("")
const errorProfile = ref("")
const errorPassword = ref("")

</script>
    