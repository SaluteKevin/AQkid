<template>
    <div class="flex justify-center bg-white w-full flex flex-col gap-5 px-3 md:px-16 lg:px-28 md:flex-row text-[#161931]">

        <main class="flex justify-center w-full min-h-screen py-1 md:w-2/3 lg:w-3/4">
            <div class="p-2 md:p-4">
                <div class="w-full px-6 pb-8 mt-8 sm:max-w-xl sm:rounded-lg">
                    <h2 class="text-2xl font-bold sm:text-xl">Profile setting</h2>

                    <div class="grid max-w-2xl mx-auto mt-8">
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




                        <div class="items-center mt-8 sm:mt-14 text-[#202142]">

                            <div class="mb-2 sm:mb-6">
                                <label for="password"
                                    class="block mb-2 text-sm font-medium text-indigo-900 ">Password</label>
                                <input v-model="EditForm.password" type="text" id="password"
                                    class="bg-indigo-50 border border-indigo-300 text-indigo-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5 "
                                    placeholder="Your Password" required>
                            </div>

                            <div
                                class="flex flex-col items-center w-full mb-2 space-x-0 space-y-2 sm:flex-row sm:space-x-4 sm:space-y-0 sm:mb-6">
                                <div class="w-full">
                                    <label for="first_name" class="block mb-2 text-sm font-medium text-indigo-900 ">
                                        First name</label>
                                    <input v-model="EditForm.firstname" type="text" id="first_name"
                                        class="bg-indigo-50 border border-indigo-300 text-indigo-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5 "
                                        placeholder="Your first name" required>
                                </div>
                                <div class="w-full">
                                    <label for="first_name" class="block mb-2 text-sm font-medium text-indigo-900 ">
                                        Middle name</label>
                                    <input v-model="EditForm.middlename" type="text" id="first_name"
                                        class="bg-indigo-50 border border-indigo-300 text-indigo-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5 "
                                        placeholder="Your middle name" required>
                                </div>

                                <div class="w-full">
                                    <label for="last_name" class="block mb-2 text-sm font-medium text-indigo-900 ">
                                        Last name</label>
                                    <input v-model="EditForm.lastname" type="text" id="last_name"
                                        class="bg-indigo-50 border border-indigo-300 text-indigo-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5 "
                                        placeholder="Your last name" required>
                                </div>

                            </div>

                            <div class="mb-2 sm:mb-6">
                                <label for="email" class="block mb-2 text-sm font-medium text-indigo-900 ">Your
                                    email</label>
                                <input v-model="EditForm.email" type="email" id="email"
                                    class="bg-indigo-50 border border-indigo-300 text-indigo-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5 "
                                    placeholder="your.email@mail.com" required>
                            </div>

                            <div class="mb-2 sm:mb-6">
                                <label for="profession" class="block mb-2 text-sm font-medium text-indigo-900 ">Phone
                                    number</label>
                                <input v-model="EditForm.phone_number" type="text" id="profession"
                                    class="bg-indigo-50 border border-indigo-300 text-indigo-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5 "
                                    placeholder="Your phonenumber" required>
                            </div>


                            <div class="flex justify-end gap-2">
                                <button v-on:click="handleEditProfile"
                                    class="text-white bg-indigo-700  hover:bg-indigo-800 focus:ring-4 focus:outline-none focus:ring-indigo-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-indigo-600 dark:hover:bg-indigo-700 dark:focus:ring-indigo-800">Save</button>
                                <button type="submit"
                                    class="text-white bg-[#202142] hover:bg-indigo-800 focus:ring-4 focus:outline-none font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center ">Cancle</button>
                            </div>


                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</template>
    
    
<script setup lang="ts">
import { useAuthStore } from "~/stores/useAuthStore";
const auth = useAuthStore();

console.log(auth.user.value)

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
    email: "",
    firstname: "",
    middlename: "",
    lastname: "",
    birthdate: "",
    phone_number: "",
    //
});

async function handleEditProfile() {

    const { data: updateResponse, error: updateError } = await useApiFetch("api/student/editprofile/" + auth.user.value.id, {
        method: "POST",
        body: EditForm.value,
    });

    if (updateResponse.value) {

        console.log(updateResponse.value)
        // await navigateTo(`/student/profile`);

    }

    else {

        if (updateError.value) {


            const errors = updateError.value.data.errors;

            updateError.value = {};

            for (const key in errors) {

                if (errors.hasOwnProperty(key)) {

                    const errorMessages = errors[key];

                    updateError.value[key] = errorMessages;

                }
            }


        }

    }
}

</script>
    