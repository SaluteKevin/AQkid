<template>
    <div class="min-h-screen w-full flex justify-center items-center">
        <div class=" h-full" style="width: 1000px; padding:20px; text-align:center; border: 10px solid #787878">
            <div class="h-full w-full" style="padding:20px; text-align:center; border: 5px solid #787878">
                <span style="font-size:50px; font-weight:bold">Certificate of Completion</span>
                <br><br>
                <span style="font-size:25px"><i>This is to certify that</i></span>
                <br><br>
                <span style="font-size:30px"><b>{{ auth.user.value.first_name }} {{ auth.user.value.last_name }}</b></span><br /><br />
                <span style="font-size:25px"><i>has completed the course</i></span> <br /><br />
                <span style="font-size:30px">{{ certificate.title }}</span> <br /><br />
                <span style="font-size:20px">swimming course with a Graceful and Elegant touch.</span> <br /><br /><br /><br />
                <span style="font-size:25px"><i>dated</i></span><br>
                {{  dayjs(certificate.updated_at).format('YYYY-MM-DD HH:mm:ss')}}
                
            </div>
        </div>
    </div>
</template>

<script setup lang="ts">
definePageMeta({ layout: false })
const route = useRoute();
import { useAuthStore } from "~/stores/useAuthStore";
const auth = useAuthStore();
import dayjs from 'dayjs';

const certificate = ref({});
const { data: certificateResponse, error: certificateError } = await useApiFetch(`api/student/certificate/${route.params.id}`, {});

if (certificateResponse.value) {
    certificate.value = certificateResponse.value
} else {
    if (certificateError.value) {   
    
    }

}

</script>