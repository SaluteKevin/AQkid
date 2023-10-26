<template>
    <div class="relative flex place-content-center justify-center p-10 bg-gray-200">

        <div class="flex shadow-xl h-full w-4/5 ">
            <!-- Login form -->
            <div class="flex flex-wrap justify-center rounded-l-md bg-white h-full w-full py-12">
                <div class="w-4/5">
                    <div class="grid grid-flow-col grid-cols-2 w-full my-6">
                        <div>
                            <!-- Heading -->
                            <h1 class="text-4xl font-semibold">{{ enroll.user.username }}</h1>
                            <div class="text-gray-500 text-3xl mb-3">{{ enroll.user.first_name }} {{ enroll.user.last_name
                            }}</div>

                            <!-- Form -->
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
                        </div>
                        <div class="h-auto w-full justify-center grid">
                            <img src="/images/AQKids_logo.png" class="object-contain h-72 w-72 place-self-end">
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
                <a :href="`${config.public.apiBaseURL}storage/users/21/profile_image.jpg`" target="_blank">
                <div class="flex flex-wrap shadow-xl">
                    <img class="w-full h-full object-contain rounded-r-md"
                        src="https://media.discordapp.net/attachments/711217095681245235/1163756633248256020/screenshot_20231017_153305.png?ex=6540bbd2&is=652e46d2&hm=ed685f35d47d877d7d50a69b0352335448310412b882c321fe23a09c0316768b&=&width=324&height=560">
                </div>
                </a>
            </div>



        </div>



        <div class="absolute left-10 top-10">
            <NuxtLink to="/staff/request">
                <button
                    class="bg-orange-500 px-8 py-1 text-xl text-white border-2 border-white hover:bg-orange-700 duration-150 rounded-lg">
                    back
                </button>
            </NuxtLink>
        </div>
    </div>
</template>

<script setup lang="ts">
const config = useRuntimeConfig();
definePageMeta({ layout: "staff" })

const route = useRoute();

const enroll = ref({})

async function fetchEnroll() {
    const { data: enrollResponse, error: enrollError } = await useApiFetch(`api/staff/enrolls/${route.params.id}`, {});

    if (enrollResponse.value) {
        enroll.value = enrollResponse.value;

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