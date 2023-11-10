<template>
        <div class="flex px-4 py-4 justify-between bg-white
				 shadow-2xl rounded-lg w-full h-full">
            <!-- Card -->

            <!-- Left side -->

            <!-- <img class="h-20 w-20 rounded-full object-cover"
                    :src="`${config.public.imageBaseURL}${refund.user.profile_image_path}`" alt="" /> -->

            <div class="p-2 flex flex-col capitalize text-black place-content-center w-1/5">
                <span>Request Type</span>
                <span class="mt-2 text-gray-600">
                    {{ makeup.title }}
                </span>
            </div>

            <div class="p-2  flex flex-col capitalize text-black place-content-center w-1/5">
                <span>Status</span>
                <span class="mt-2 text-gray-600">
                    <span v-if="makeup.status == 'PENDING'" class="text-xl text-yellow-500">{{ makeup.status
                    }}</span>
                    <span v-if="makeup.status == 'APPROVED'" class="text-xl text-green-500">{{ makeup.status
                    }}</span>
                    <span v-if="makeup.status == 'REJECTED'" class="text-xl text-red-500">{{ makeup.status }}</span>
                </span>

            </div>

            <div class="p-2 flex flex-col text-black place-content-center w-1/5">
                <span>Request time</span>
                <span class="mt-2 text-gray-600">
                    {{ dayjs(makeup.datetime).format('YYYY-MM-DD HH:mm:ss') }}
                </span>

            </div>

            



        </div>
       

    
</template>

<script setup lang="ts">
import dayjs from 'dayjs'
const config = useRuntimeConfig();
const props = defineProps(['makeup'])
const makeup = ref(props.makeup);
const showDetail = ref(false);


</script>

<style>
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}
</style>
