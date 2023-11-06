<template>
    <div class="bg-gray-200">
        <div class="container px-5 py-24 mx-auto bg-white">
            <div class="lg:w-4/5 mx-auto flex flex-wrap">
                <a :href="`${config.public.imageBaseURL}${enroll.proof_of_payment_path}`" target="_blank"
                    class="lg:w-1/2 w-full object-cover object-center rounded border border-gray-200">
                    <img alt="ecommerce" :src="`${config.public.imageBaseURL}${enroll.proof_of_payment_path}`">
                </a>
    
                <div class="lg:w-1/2 w-full lg:pl-10 lg:py-6 mt-6 lg:mt-0 text-2xl">
    
                    <p class="leading-relaxed mt-4">
                    <div class="card">
                        <div class="h-full w-full justify-center grid mb-10">
                                <img :src="`${config.public.imageBaseURL}${enroll.user.profile_image_path}`" class="object-cover h-72 w-72  rounded-full">
                            </div>
                        <h2><span class="text-gray-500">username :</span> {{ enroll.user.username }}</h2>
                        <div class="title title--epic"><span class="text-gray-500">Fullname :</span> {{ enroll.user.first_name }}
                            {{ enroll.user.last_name }}</div>
                        <div class="title title--epic"><span class="text-gray-500">Email :</span>
                            <span v-if="enroll.user.email">{{ enroll.user.email }}</span>
                            <span v-else>none</span>
                        </div>
                        <div class="title title--epic"><span class="text-gray-500">Phone No. :</span>
                            {{ enroll.user.phone_number }}
                        </div>
                        <div class="title title--epic"><span class="text-gray-500">Requested at :</span>
                            {{ formatDateTime(new
                                Date(enroll.created_at)) }}
                        </div>
    
    
                    </div>
                    <div>
                    </div>
                    </p>
                    <label class="my-4 block text-xl font-semibold">Request Status<br>
                                        <span v-if="enroll.status == 'PENDING'" class="text-xl text-yellow-500">{{enroll.status}}</span>
                                        <span v-if="enroll.status == 'APPROVED'" class="text-xl text-green-500">{{enroll.status}}</span>
                                        <span v-if="enroll.status == 'REJECTED'" class="text-xl text-red-500">{{enroll.status}}</span>
                    </label>
                    <div v-if="enroll.status != 'PENDING'" class="my-4 block text-2xl font-semibold">Review Comment <br>
                        <span class="text-xl text-gray-500">{{enroll.review_comment}}</span>
                    </div>
                    
                    <div v-if="enroll.status == 'PENDING'" class="mt-8">
                        <button v-on:click="showAccept"
                            class="mb-1.5 block w-full text-center text-white bg-green-600 hover:bg-green-700 px-2 py-1.5 rounded-md">
                            Accept
                        </button>
    
                        <div v-if="showAcceptInput" class="flex gap-8 mb-8">
                            <input class="bg-gray-200 py-1.5 px-4 border-1 border w-4/5" type="text"
                                placeholder="Comment (Optional)" v-model="acceptComment">
                            <button v-on:click="acceptenroll"
                                class="w-1/5 h-16 bg-orange-500 text-white rounded-md hover:bg-orange-700 mr-4">Submit</button>
                        </div>
    
                        <p class="text-red-500" >
                                        {{ formError.accept }}
                        </p>
    
    
                        <button v-on:click="showReject"
                            class="mb-1.5 flex flex-wrap justify-center w-full border border-gray-300 hover:border-gray-500 px-2 py-1.5 rounded-md">
                            Reject
                        </button>
    
                        <div v-if="showRejectInput" class="flex gap-8 mb-4">
                            <input class="bg-gray-200 py-1.5 px-4 border-1 border w-4/5" type="text"
                                placeholder="** Please provide a reason for rejecting this enrollment." v-model="rejectComment">
                            <button v-on:click="rejectenroll"
                                class="w-1/5 h-16 bg-orange-500 text-white rounded-md hover:bg-orange-700 mr-4">Submit</button>
                        </div>
    
                        <p class="text-red-500" >
                                        {{ formError.reject }}
                            </p>
    
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- <div class="relative flex  justify-center p-10 bg-gray-200">
        <a :href="`${config.public.imageBaseURL}${enroll.proof_of_payment_path}`" target="_blank">
                <div 
                class="lg:w-1/2 w-full object-cover object-center rounded border border-gray-200">
                    <img 
                    class="w-full h-full object-contain rounded-r-md"
                    :src="`${config.public.imageBaseURL}${enroll.proof_of_payment_path}`">
                </div>
                </a>
        <div class="flex shadow-xl h-full">
            
            <div class="flex flex-wrap justify-center rounded-l-md bg-white h-full w-full py-12">
                <div class="w-4/5">
                    <div class="grid grid-flow-col grid-cols-2 w-full my-6">
                        <div>
                            
                            <h1 class="text-4xl font-semibold">{{ enroll.user.username }}</h1>
                            <div class="text-gray-500 text-3xl mb-3">{{ enroll.user.first_name }} {{ enroll.user.last_name
                            }}</div>


                            <div class="mb-3">
                                <label class="mb-2 block text-xl font-semibold">Email<br>
                                    <span v-if="enroll.user.email" class="text-xl text-gray-500">{{ enroll.user.email
                                    }}</span>
                                    <span v-else class="text-xl text-gray-500">none</span>
                                </label>

                            </div>



                            <div class="mb-3">
                                <label class="mb-2 block text-xl font-semibold">Phone number<br>
                                    <span class="text-xl text-gray-500">{{ enroll.user.phone_number }}</span>
                                </label>
                            </div>

                            <div class="mb-3">
                                <label class="mb-2 block text-xl font-semibold">Request at<br>
                                    <span class="text-xl text-gray-500">{{ formatDateTime(new
                                        Date(enroll.created_at)) }}</span>
                                </label>
                            </div>

                            <div class="mb-3">
                                <label class="mb-2 block text-xl font-semibold">Request Status<br>
                                    <span v-if="enroll.status == 'PENDING'" class="text-xl text-yellow-500">{{enroll.status}}</span>
                                    <span v-if="enroll.status == 'SUCCESS'" class="text-xl text-green-500">{{enroll.status}}</span>
                                    <span v-if="enroll.status == 'FAILED'" class="text-xl text-red-500">{{enroll.status}}</span>
                                </label>
                            </div>

                            <div v-if="enroll.status != 'PENDING'" class="my-4 block text-2xl font-semibold">Review Comment <br>
                                <span class="text-xl text-gray-500">{{enroll.review_comment}}</span>
                            </div>
                        </div>
                        <div class="h-auto w-full justify-center grid">
                            <img :src="`${config.public.imageBaseURL}${enroll.user.profile_image_path}`" class="object-contain h-72 w-72 place-self-end">
                        </div>
                    </div>




                    <div class="mb-3" v-if="enroll.status == 'PENDING'">
                        <button v-on:click="showAccept"
                            class="mb-1.5 block w-full text-center text-white bg-green-600 hover:bg-green-700 px-2 py-1.5 rounded-md">
                            Accept
                        </button>

                        <div v-if="showAcceptInput" class="flex gap-8 mb-8">
                            <input class="bg-gray-200 py-1.5 px-4 border-1 border w-4/5" type="text" placeholder="Comment (Optional)"  v-model="acceptComment">
                            <button v-on:click="AcceptEnroll" class="w-1/5 h-16 bg-orange-500 text-white rounded-md hover:bg-orange-700 mr-4">Submit</button>
                        </div>

                        <p class="text-red-500" >
                                    {{ formError.accept }}
                        </p>


                        <button v-on:click="showReject"
                            class="mb-1.5 flex flex-wrap justify-center w-full border border-gray-300 hover:border-gray-500 px-2 py-1.5 rounded-md">
                            Reject
                        </button>

                        <div v-if="showRejectInput" class="flex gap-8 mb-4">
                            <input class="bg-gray-200 py-1.5 px-4 border-1 border w-4/5" type="text" placeholder="** Please provide a reason for rejecting this enrollment." v-model="rejectComment">
                            <button v-on:click="RejectEnroll" class="w-1/5 h-16 bg-orange-500 text-white rounded-md hover:bg-orange-700 mr-4">Submit</button>
                        </div>

                        <p class="text-red-500" >
                                    {{ formError.reject }}
                        </p>
                    </div>

                </div>

            </div>



        </div>

    </div> -->
</template>

<script setup lang="ts">
const config = useRuntimeConfig();
definePageMeta({layout: "staff",
middleware: ['is-authorized','is-staff']})

const route = useRoute();

const enroll = ref({})

async function fetchEnroll() {
    const { data: enrollResponse, error: enrollError } = await useApiFetch(`api/staff/enrolls/${route.params.id}`, {});

    if (enrollResponse.value) {
        enroll.value = enrollResponse.value;
        console.log(enroll.value)

    }

    else {
        if (enrollError.value) {

        }
    }

}

await fetchEnroll();

function formatDateTime(date) {
    const year = date.getFullYear();
    const month = String(date.getMonth() + 1).padStart(2, '0'); // Month is 0-based
    const day = String(date.getDate()).padStart(2, '0');
    const hours = String(date.getHours() % 12 || 12).padStart(2, '0'); // Convert to 12-hour format
    const minutes = String(date.getMinutes()).padStart(2, '0');
    const amOrPm = date.getHours() >= 12 ? 'PM' : 'AM';

    const formattedDateTime = `${day}/${month}/${year} ${hours}:${minutes} ${amOrPm}`;
    return formattedDateTime;
}


//
const formError = ref({
    accept: "",
    reject: ""
})


const showAcceptInput = ref(false);
const acceptComment = ref(null);

async function showAccept() {
    showAcceptInput.value = !showAcceptInput.value;
    showRejectInput.value = false;
}

async function AcceptEnroll() {
    const { data: enrollResponse, error: enrollError } = await useApiFetch("api/staff/acceptEnroll/" + enroll.value.id, {
        method: "POST",
        body: {
            comment : acceptComment.value
        }
    });

    if (enrollResponse.value) {
        await fetchEnroll();
    }

    else {

        formError.value.accept = enrollError.value?.data.message;

    }


}

const showRejectInput = ref(false);
const rejectComment = ref(null);


async function showReject() {
    showRejectInput.value = !showRejectInput.value;
    showAcceptInput.value = false;
}

async function RejectEnroll() {

    const{ data: enrollResponse, error: enrollError} = await useApiFetch("api/staff/rejectEnroll/"+enroll.value.id,{
        method: "POST",
        body: {
            comment : rejectComment.value
        }
    });

    if(enrollResponse.value){
        await fetchEnroll();
    }

    else {
        
        formError.value.reject = enrollError.value?.data.message;

    }
}

</script>