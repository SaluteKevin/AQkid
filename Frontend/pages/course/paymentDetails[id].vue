<script setup lang="ts">
definePageMeta({ layout: "student" })

import { useAuthStore } from "~/stores/useAuthStore";
import { useTimeStore } from "~/stores/useTimeStore";
const route = useRoute();
const modal = ref(false);
const showCancel = ref(false);
const confirm = ref(true);
const message = ref('Time out!!!');

async function refundRequest() {
    await navigateTo(`/student/refund${route.params.id}`);
}

async function closeModal() {
    modal.value = false;
}

async function cancelPayment() {

    timer.clearTime();

    await navigateTo('/course/enrollCourse');

}


const timer = useTimeStore();
const countDown = ref(timer.timer())

function startTimer() {

    const timercount = setInterval(() => {
        if (timer.timer() === 0) {
            modal.value = true;
            confirm.value = false;
            timer.clearTime()
            clearInterval(timercount);
        }
        countDown.value = timer.timer();
    }, 1000);

}
if (timer.timer() > 0) {
    startTimer();
}
else {
    modal.value = true;
    confirm.value = false;
    timer.clearTime()
}

const course = ref({});
const { data: eventCourse, error: eventError } = await useApiFetch("api/student/showCourse/" + route.params.id, {});

if (eventCourse.value) {
    course.value = eventCourse.value
} else {

    if (eventError.value) {

    }

}


const profile_image_path = ref<File | null>(null)
const user = useAuthStore().user;
const uploadError = ref('')

async function handleRegister() {

    const formData = new FormData()

    if (profile_image_path.value) {
        formData.append('image_path', profile_image_path.value)
    }

    const { data: registerResponse, error: registerError } = await useApiFetch(`api/student/enrollCourse/${route.params.id}/${user.value.id}`, {
        method: "POST",
        body: formData,
    });

    if (registerResponse.value) {

        timer.clearTime()

        alert('You have successfully enrolled in this course! Please patiently await confirmation from our staff after submitting the enrollment slip.')

        await navigateTo(`/student`);

    }
    else {
        if (registerError.value) {

            uploadError.value = "";

            uploadError.value = registerError.value?.data.message;

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
    <div class="bg-gradient-to-b from-sky-200 to-azure-200 flex justify-center items-center pt-20 pb-36">
        <div class="bg-white border border-gray-200 shadow w-3/4 py-6  rounded-2xl">
            <div class="h-2/3">
                <div class="bg-orange-500 pb-6 mx-5">

                    <p class="text-center py-4 text-6xl text-white">Payment</p>
                    <div class="flex justify-center items-center">
                        <div class=" flex justify-center items-center bg-white rounded-lg">
                            <div>
                                <img class="h-auto max-w-lg"
                                    src="https://media.discordapp.net/attachments/474941945882476546/1162264364968050738/Screenshot_2023-10-13-12-43-23-97_275eb041e5d68c8a5fb815dd7041b155.jpg?ex=653b4e0a&is=6528d90a&hm=4612de7db51935602c65330a831169eeaaec50cc3360b7648d05d1f00dec3b3a&=&width=461&height=507"
                                    alt="image description">
                            </div>
                        </div>

                    </div>


                    <div class="flex justify-center items-center m-5">
                        <p class="px-12 py-4 text-center text-4xl text-white">Amount: {{ course.price }} baht</p>
                    </div>
                </div>
                <div class="flex flex-col w-full h-full justify-center items-center p-4 my-4">
                    <p class="text-2xl">โปรดอ่านข้อตกลง และ การแก้ปัญหา</p>
                    <p class="text-xl text-red-500">** ลูกค้าจำเป็นที่จะต้องโอนเงินพร้อมแนบสลิปมาภายใน 5 นาที
                        ถ้าหากโอนเงินไม่ทันจะไม่สามารถลงทะเบียนได้</p>

                    <p class="text-xl text-red-500 mt-4">** กรณีที่แนบสลิป และ confirm ไม่ทันแต่ได้ทำการโอนเงินเรียบร้อยแล้ว
                        ให้แก้ไขได้ดังนี้</p>
                    <div class="flex flex-col justify-start">
                        <p class="text-xl">1. เมื่อเวลาหมดจะมีปุ่มไปหน้า refund เด้งให้กดเพื่อขอคืนเงิน</p>
                        <p class="text-xl">2. เมื่อเวลาหมดจากปุ่ม confirm จะกลายเป็นปุ่มขอ refund
                            ซึ่งสามารถกดจากตรงนี้ได้เหมือนกัน</p>
                        <p class="text-xl">3. ลูกค้าสามารถกดไปหน้าขอ refund จากหน้าหลักของลูกค้าได้</p>
                    </div>

                </div>



            </div>

            <div v-if="confirm">
                <div class="h-full overflow-hidden">
                    <div class="flex justify-center items-center p-8">
                        <div
                            class="w-full object-cover relative order-first md:order-last h-1/3 md:h-auto flex justify-center items-center border border-dashed border-gray-400 col-span-2 m-2 rounded-lg bg-no-repeat bg-center bg-origin-padding bg-cover">
                            <span v-if="imagefix" class="text-gray-400 opacity-75">
                                <svg class="w-14 h-14" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="0.7" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5zm10.5-11.25h.008v.008h-.008V8.25zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                                </svg>
                            </span>
                            <h3 v-if="imagefix" class="w-full">Preview Image</h3>

                            <img ref="imagePreview" class="object-scale-down h-1/2 w-3/5 text-gray-400 rounded-lg"
                                :src="imagePreviewSrc" alt="">
                        </div>
                    </div>
                    <div class="flex justify-center gap-5">
                        <input @change="handleImageChange" accept="image/png, image/gif, image/jpeg" ref="profileImageInput"
                            id="profile_image" name="profile_image"
                            class='inline-flex items-center shadow-md my-2 px-2 py-2 bg-gray-900 text-gray-50 border border-transparent
                    rounded-md font-semibold text-xs uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none 
                    focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150' type="file">
                        <button @click="removeImagePreview"
                            class='inline-flex items-center shadow-md my-2 px-2 py-2 bg-gray-900 text-gray-50 border border-transparent
                    rounded-md font-semibold text-xs uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none 
                    focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150'>
                            remove image
                        </button>
                    </div>
                    <div class="flex flex-col h-full w-full mt-8">
                        <div class="text-2xl font-medium text-black w-full flex flex-col items-center gap-2 justify-center">
                            <div>
                                Please confirm in
                                <span class="text-2xl font-medium text-red-700">{{ countDown }}</span>
                                seconds
                            </div>
                            <p class="text-red-500">
                                {{ uploadError }}
                            </p>
                        </div>

                        <div class="flex flex-col p-8 gap-4 mt-8">
                            <button @click="handleRegister()"
                                class="flex-1 px-2 py-2 text-xl bg-green-500 hover:bg-green-700 text-white rounded-lg">
                                Confirm
                            </button>
                            <button v-on:click="showCancel = !showCancel"
                                class="px-2 py-2 text-xl bg-red-500 hover:bg-red-700 text-white rounded-lg">
                                Cancel
                            </button>
                            <div v-if="showCancel" class="flex flex-col text-2xl">Are you Sure you want to Cancel?
                                <div class="flex gap-8 mt-4">
                                    <button v-on:click="cancelPayment" class="p-2 bg-red-200 rounded-lg">Yes, I'm
                                        sure</button>
                                    <button v-on:click="showCancel = false" class="p-2 bg-gray-200 rounded-lg">No, I'm
                                        not</button>
                                </div>
                            </div>

                        </div>


                    </div>
                </div>
            </div>

            <div v-if="!confirm" class="flex flex-col gap-4 p-8">
                <NuxtLink class="p-4 bg-gray-400 rounded-2xl" :to="`/student/refund${route.params.id}`"><Button class="text-center w-full">Go to
                        Refund
                        Page</Button></NuxtLink>
                <Button v-on:click="cancelPayment" class="p-4 bg-red-300 rounded-2xl">Cancel</Button>

            </div>



        </div>

    </div>



    <div v-if="modal">
        <div id="modelConfirm" class="fixed z-50 inset-0 bg-gray-900 bg-opacity-60 overflow-y-auto h-full w-full px-4 ">
            <div class="relative top-40 mx-auto shadow-xl rounded-md bg-white max-w-md">

                <div class="flex justify-end p-2">
                    <button @click="closeModal" type="button"
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
                    <button @click="refundRequest"
                        class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-base inline-flex items-center px-3 py-2.5 text-center mr-2">
                        Go to refund
                    </button>
                    <button @click="closeModal"
                        class="text-gray-900 bg-white hover:bg-gray-100 focus:ring-4 focus:ring-cyan-200 border border-gray-200 font-medium inline-flex items-center rounded-lg text-base px-3 py-2.5 text-center"
                        data-modal-toggle="delete-user-modal">
                        No, cancel
                    </button>
                </div>

            </div>
    </div>

</div></template>