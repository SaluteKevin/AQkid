<template>
    <div class="container px-5 py-24 mx-auto">
        <div class="w-full justify-center mx-auto flex flex-wrap">
            <div class="lg:w-1/2 w-full lg:pl-10 lg:py-6 mt-6 lg:mt-0">
                <h2 class="text-sm title-font text-gray-500 tracking-widest">Class Request Type</h2>
                <h1 class="text-gray-900 text-3xl title-font font-medium mb-1">{{ refund.title }}</h1>
                <div class="min-h-[150px] flex items-center gap-8">
                    <svg width="100px" height="100px" viewBox="0 0 1024 1024" class="icon" version="1.1"
                        xmlns="http://www.w3.org/2000/svg" fill="#000000">
                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                        <g id="SVGRepo_iconCarrier">
                            <path
                                d="M597.678 480.76L390.797 333.998c-22.209-15.766-53-10.532-68.762 11.687l-2.04 2.871c-15.753 22.214-10.526 53 11.691 68.762l206.876 146.771c22.218 15.757 53 10.527 68.766-11.687l2.035-2.876c15.768-22.218 10.529-53.005-11.685-68.766z"
                                fill="#F39A2B"></path>
                            <path
                                d="M585.066 423.392l-2.871-2.034c-22.218-15.763-53.004-10.527-68.766 11.687L279.007 763.472c-15.762 22.214-10.527 53.005 11.69 68.763l2.871 2.04c22.218 15.762 53.004 10.53 68.762-11.688l234.423-330.428c15.767-22.22 10.531-53.001-11.687-68.767z"
                                fill="#E5594F"></path>
                            <path
                                d="M891.662 525.126c-0.363 50.106-8.104 91.767-27.502 142.522-13.232 34.625-44.231 82.177-70.529 111.108-62.993 69.31-152.478 113.292-240.772 121.615-100.773 9.501-189.621-17.478-271.287-78.551 7.65 5.723-7.536-6.408-7.061-6.009-4.562-3.821-8.967-7.82-13.369-11.824-8.803-8.003-17.105-16.535-25.225-25.224-18.148-19.432-26.188-30.526-41.439-54.866-27.11-43.264-40.704-80.283-51.007-132.536-4.015-20.354-5.395-39.803-5.586-66.233-0.531-73.33-114.29-73.381-113.758 0 1.607 222.487 154.098 420.146 370.093 475.715 216.482 55.697 449.039-49.258 553.91-245.54 37.754-70.664 56.715-150.224 57.293-230.179 0.526-73.379-113.231-73.328-113.761 0.002z"
                                fill="#4A5699"></path>
                            <path
                                d="M137.884 501.467c0.362-50.104 8.103-91.762 27.502-142.52 13.233-34.621 44.233-82.173 70.53-111.108 62.993-69.309 152.472-113.29 240.768-121.615 100.773-9.5 189.626 17.479 271.292 78.554-7.652-5.721 7.532 6.408 7.057 6.01 4.563 3.819 8.968 7.821 13.371 11.823 8.803 8 17.108 16.535 25.228 25.225 18.147 19.43 26.187 30.526 41.438 54.866 27.111 43.264 40.709 80.28 51.009 132.533 4.014 20.352 5.396 39.804 5.586 66.232 0.529 73.33 114.287 73.384 113.76 0-1.608-222.489-154.107-420.144-370.099-475.715-216.482-55.7-449.036 49.26-553.905 245.541-37.753 70.664-56.715 150.219-57.292 230.174-0.534 73.384 113.225 73.33 113.755 0z"
                                fill="#C45FA0"></path>
                        </g>
                    </svg>
                    <div>
                        <p>Selected datetime</p>
                        <div class="text-4xl font-bold">{{ refund.datetime }}</div>
                    </div>
                </div>
                <p class="leading-relaxed mt-4">
                <h2 class="text-sm title-font text-gray-500 tracking-widest">User Profile</h2>
                <div class="card">
                    <h2><span class="text-gray-500">username: </span> {{ refund.user.username }}</h2>
                    <div class="title title--epic"><span class="text-gray-500">Fullname: </span> {{ refund.user.first_name
                    }}
                        {{ refund.user.last_name }}</div>
                    <div class="title title--epic"><span class="text-gray-500">Email: </span>
                        <span v-if="refund.user.email">{{ refund.user.email }}</span>
                        <span v-else>none</span>
                    </div>
                    <div class="title title--epic"><span class="text-gray-500">Phone No: </span>
                        {{ refund.user.phone_number }}
                    </div>
                    <div class="title title--epic"><span class="text-gray-500">Requested at: </span>
                        {{ formatDateTime(new
                            Date(refund.created_at)) }}
                    </div>


                </div>
                <div>
                </div>
                </p>
                <label class="my-4 block text-xl font-semibold">Request Status<br>
                    <span v-if="refund.status == 'PENDING'" class="text-xl text-yellow-500">{{ refund.status }}</span>
                    <span v-if="refund.status == 'APPROVED'" class="text-xl text-green-500">{{ refund.status }}</span>
                    <span v-if="refund.status == 'REJECTED'" class="text-xl text-red-500">{{ refund.status }}</span>
                </label>
                <div v-if="refund.status != 'PENDING'" class="my-4 block text-2xl font-semibold">Review Comment: <br>
                    <span class="text-xl text-gray-500">{{ refund.review_comment }}</span>
                </div>

                <div v-if="refund.status == 'PENDING'" class="mt-8">
                    <button v-on:click="showAccept"
                        class="mb-1.5 block w-full text-center text-white bg-green-600 hover:bg-green-700 px-2 py-1.5 rounded-md">
                        Accept
                    </button>

                    <div v-if="showAcceptInput" class="flex gap-8 mb-8">
                        <input class="bg-gray-200 py-1.5 px-4 border-1 border w-4/5" type="text"
                            placeholder="Comment (Optional)" v-model="acceptComment">
                        <button v-on:click="acceptRefund"
                            class="w-1/5 h-16 bg-orange-500 text-white rounded-md hover:bg-orange-700 mr-4">Submit</button>
                    </div>

                    <p class="text-red-500">
                        {{ formError.accept }}
                    </p>


                    <button v-on:click="showReject"
                        class="mb-1.5 flex flex-wrap justify-center w-full border border-gray-300 hover:border-gray-500 px-2 py-1.5 rounded-md">
                        Reject
                    </button>

                    <div v-if="showRejectInput" class="flex gap-8 mb-4">
                        <input class="bg-gray-200 py-1.5 px-4 border-1 border w-4/5" type="text"
                            placeholder="** Please provide a reason for rejecting this enrollment." v-model="rejectComment">
                        <button v-on:click="rejectRefund"
                            class="w-1/5 h-16 bg-orange-500 text-white rounded-md hover:bg-orange-700 mr-4">Submit</button>
                    </div>

                    <p class="text-red-500">
                        {{ formError.reject }}
                    </p>

                </div>
            </div>
        </div>
    </div>
</template>

<script setup lang="ts">

definePageMeta({
    layout: "staff",
    middleware: ['is-authorized', 'is-staff']
})
const config = useRuntimeConfig();

const route = useRoute();

const refund = ref({})

async function fetchRefund() {
    const { data: refundResponse, error: refundError } = await useApiFetch(`api/staff/getMakeUp/${route.params.id}`, {});

    if (refundResponse.value) {

        refund.value = refundResponse.value;
        console.log(refund.value.datetime)
    }

    else {
        if (refundError.value) {

        }
    }
}

await fetchRefund();

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


const formError = ref({
    accept: "",
    reject: ""
})

// accept

const showAcceptInput = ref(false);
const acceptComment = ref(null);

async function showAccept() {
    showAcceptInput.value = !showAcceptInput.value;
    showRejectInput.value = false;
}

async function acceptRefund() {

    if (refund.value.title == "JOIN") {

        const { data: refundResponse, error: refundError } = await useApiFetch("api/staff/acceptJoin/" + refund.value.id, {
            method: "POST",
            body: {
                comment: acceptComment.value
            }
        });

        if (refundResponse.value) {
            await fetchRefund();
        }

        else {

            formError.value.accept = refundError.value?.data.message;

        }


    }


    if (refund.value.title == "MAKE") {
        const { data: refundResponse, error: refundError } = await useApiFetch("api/staff/acceptMakeUp/" + refund.value.id, {
            method: "POST",
            body: {
                comment: acceptComment.value
            }
        });

        if (refundResponse.value) {
            await fetchRefund();
        }

        else {

            formError.value.accept = refundError.value?.data.message;

        }
    }



}


// reject

const showRejectInput = ref(false);
const rejectComment = ref(null);

async function showReject() {
    showRejectInput.value = !showRejectInput.value;
    showAcceptInput.value = false;
}


async function rejectRefund() {

    const { data: refundResponse, error: refundError } = await useApiFetch("api/staff/rejectMakeUp/" + refund.value.id, {
        method: "POST",
        body: {
            comment: rejectComment.value
        }
    });

    if (refundResponse.value) {

        await fetchRefund();

    }

    else {

        if (refundError.value) {
            formError.value.reject = refundError.value?.data.message;
        }

    }
}

</script>