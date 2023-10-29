<template>
    <div v-click-outside="clickOutside">
        <div class="flex px-4 py-4 justify-between bg-white
				 shadow-2xl rounded-t-lg w-full h-full">
            <!-- Card -->

            <!-- Left side -->

            <!-- <img class="h-20 w-20 rounded-full object-cover"
                    :src="`${config.public.imageBaseURL}${refund.user.profile_image_path}`" alt="" /> -->

            <div class="p-2 flex flex-col capitalize text-black place-content-center w-1/5">
                <span>Refund Title</span>
                <span class="mt-2 text-gray-600">
                    {{ refundrequest.title }}
                </span>
            </div>

            <div class="p-2  flex flex-col capitalize text-black place-content-center w-1/5">
                <span>Status</span>
                <span class="mt-2 text-gray-600">
                    <span v-if="refundrequest.status == 'PENDING'" class="text-xl text-yellow-500">{{ refundrequest.status }}</span>
                    <span v-if="refundrequest.status == 'APPROVED'" class="text-xl text-green-500">{{ refundrequest.status }}</span>
                    <span v-if="refundrequest.status == 'REJECTED'" class="text-xl text-red-500">{{ refundrequest.status }}</span>
                </span>

            </div>

            <div class="p-2 flex flex-col text-black place-content-center w-1/5">
                <span>Request time</span>
                <span class="mt-2 text-gray-600">
                    {{ dayjs(refundrequest.created_at).format('YYYY-MM-DD HH:mm:ss') }}
                </span>

            </div>

            <div class="flex place-content-center items-center flex-col">
                <div>More Detail</div>
                <svg v-on:click="showDetail = !showDetail" width="50" fill="#000000" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                    <g id="SVGRepo_iconCarrier">
                        <path
                            d="M2,4A1,1,0,0,1,3,3H21a1,1,0,0,1,0,2H3A1,1,0,0,1,2,4Zm1,9H21a1,1,0,0,0,0-2H3a1,1,0,0,0,0,2Zm18,6H12a1,1,0,0,0,0,2h9a1,1,0,0,0,0-2Z">
                        </path>
                    </g>
                </svg>
            </div>



        </div>
        <div v-if="showDetail" class="flex gap-8 bg-gray-200 p-8">
            <div class=" rounded-b-lg p-4">Proof of payment:</div>
            <a :href="`${config.public.imageBaseURL}${refundrequest.description}`" target="_blank">
                <img class="object-contain rounded-r-md" width="200" height="200"
                    :src="`${config.public.imageBaseURL}${refundrequest.description}`">
            </a>

            <div class=" rounded-b-lg p-4">Review comments: {{ refundrequest.review_comment }}</div>
        </div>

    </div>
</template>

<script setup lang="ts">
import dayjs from 'dayjs'
const config = useRuntimeConfig();
const props = defineProps(['refund'])
const refundrequest = ref(props.refund);
const showDetail = ref(false);

const clickOutside = () => {
    showDetail.value = false;
};

</script>

<style>
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}
</style>
