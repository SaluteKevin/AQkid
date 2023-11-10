<template>
    <div class="min-h-screen w-full flex justify-center items-center">
        <div class=" h-full bg-orange-300 border-cyan-950 border-8" style="width: 1000px; padding:20px; text-align:center; ">
            <div class="h-full w-full bg-orange-50 border-cyan-950 border-4" style="padding:20px; text-align:center; ">
                
                <span  style="font-size:50px; font-weight:bold">Certificate of Completion</span>
                <br><br>
                <span style="font-size:25px"><i>This is to certify that</i></span>
                <br><br>
                <span style="font-size:30px"><b>{{ auth.user.value.first_name }} {{ auth.user.value.last_name }}</b></span><br /><br />
                <span style="font-size:25px"><i>has completed the course</i></span> <br /><br />
                <span style="font-size:30px">{{ certificate.title }}</span> <br />
                <span style="font-size:20px">Swimming course with a Graceful and Elegant touch.</span> <br /><br />
                <div class="w-full flex justify-evenly space-x-12">
                    <div>
                        <div>
                        <img src="/images/signOne.png" class="h-24 w-32 object-cover"/>
                            Teach by  
                            {{ certificate.teacher.first_name }}
                            {{ certificate.teacher.last_name }}
                        </div>
                    </div>
                    <div>
                        <div>
                        <img src="/images/AQKids_logo.png" class="h-24 w-24 "/>
                            {{  dayjs(certificate.last_date).format('DD-MMMM-YYYY')}}
                        </div>
                    </div>
                    <div>
                        <div>
                        <img src="/images/signK.png" class="h-24 w-32 object-cover"/>
                            Advisor Kevin Salute
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
</template>

<script setup lang="ts">
definePageMeta({ layout: false,
middleware: ['is-authorized','is-student'] })
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