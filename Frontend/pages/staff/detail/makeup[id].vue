<template>
    <div class="container px-5 py-24 mx-auto">
        <div class="w-full justify-center mx-auto flex flex-wrap">
            <div class="lg:w-1/2 w-full lg:pl-10 lg:py-6 mt-6 lg:mt-0">
                <h2 class="text-sm title-font text-gray-500 tracking-widest">Refund Title</h2>
                <h1 class="text-gray-900 text-3xl title-font font-medium mb-1">{{ refund.title }}</h1>

                <p class="leading-relaxed mt-4">
                <div class="card">
                    <h2><span class="text-gray-500">username :</span> {{ refund.user.username }}</h2>
                    <div class="title title--epic"><span class="text-gray-500">Fullname :</span> {{ refund.user.first_name
                    }}
                        {{ refund.user.last_name }}</div>
                    <div class="title title--epic"><span class="text-gray-500">Email :</span>
                        <span v-if="refund.user.email">{{ refund.user.email }}</span>
                        <span v-else>none</span>
                    </div>
                    <div class="title title--epic"><span class="text-gray-500">Phone No. :</span>
                        {{ refund.user.phone_number }}
                    </div>
                    <div class="title title--epic"><span class="text-gray-500">Requested at :</span>
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
                <div v-if="refund.status != 'PENDING'" class="my-4 block text-2xl font-semibold">Review Comment <br>
                    <span class="text-xl text-gray-500">{{ refund.review_comment }}</span>
                </div>

                <div v-if="refund.title == 'JOIN'">asd</div>

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