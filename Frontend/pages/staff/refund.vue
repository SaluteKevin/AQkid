<template>
    <div class="p-16 min-h-screen bg-gradient-to-b to-pink-200 to-60% from-[#bce1ff] from-10%">
    <h2 class="my-4 text-4xl font-semibold text-gray-600">Refund Requests</h2>
			<div class="pb-2 flex items-center justify-between text-gray-600">
				<!-- Header -->

			</div>

    <!-- card -->
        <div class="flex flex-col gap-2 ">
            <div
				v-for="refund in showRequests" :key="refund.id"
				class="flex  px-4 py-4 justify-between bg-white
				 shadow-lg rounded-lg w-full hover:scale-105 duration-150">
				<!-- Card -->

				
					<!-- Left side -->

					<img
						class="h-20 w-20 rounded-full object-cover"
						:src="`${config.public.imageBaseURL}${refund.user.profile_image_path}`"
						alt="" />

					<div
						class="p-2 flex flex-col capitalize text-black place-content-center w-1/5">
						<span>name</span>
						<span class="mt-2 text-gray-600">
							{{ refund.user.first_name }} {{ refund.user.last_name }}
						</span>
					</div>

					<div
						class="p-2  flex flex-col capitalize text-black place-content-center w-1/5">
						<span>Phone Number</span>
						<span class="mt-2 text-gray-600">
							{{ refund.user.phone_number}}
						</span>

					</div>

                    <div
						class="p-2 flex flex-col text-black place-content-center w-1/5">
						<span>Request time</span>
						<span class="mt-2 text-gray-600">
							{{formatDateTime(new Date(refund.created_at))}}
						</span>
						
					</div>
                    
                    <div class="flex place-content-center flex-col">
						<NuxtLink :to="`/staff/detail/refund${refund.id}`">
						<div class="text-white bg-orange-500 hover:bg-orange-700 py-2 px-10 rounded-md mb-1">View detail</div>
                        </NuxtLink>
					</div>



			</div>


        </div>

        <div class="flex flex-col gap-2">


            <Paginate class="mt-8" @change-page="onChangePage" :from="currentpage" :last_page="last_page"/>


        </div>  

			
        </div>

		

</template>	

<script setup lang="ts">

definePageMeta({layout: "staff",
middleware: ['is-authorized','is-staff']})
const config = useRuntimeConfig();
// :src="`${config.public.imageBaseURL}${enroll.user.profile_image_path}`"
// allTeachers

const allRequests = ref({})
const showRequests = ref({})

// await fetchRequests();

async function fetchRequests(page: number) {

    const {data: requestsResponse, error: requestsError } = await useApiFetch("api/staff/allUserRequests?page="+page, {});

    if (requestsResponse.value) {
        
        last_page.value = requestsResponse.value.last_page

        allRequests.value = requestsResponse.value.data;

        showRequests.value = allRequests.value;

    }
    else {
        
        if (requestsError.value) {
            console.log(requestsError.value);
        }

    }
	

}

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

// paginate
import { usePaginateStore } from '~/stores/usePaginateStore'
const paginate = usePaginateStore();

const currentpage = ref(paginate.refund_page)
const last_page = ref<Number>(0)

async function onChangePage(page: any) {

    // console.log(page.value)
    // currentpage.value = page.value

    await paginate.setRefundPage(page.value);

    await fetchRequests(paginate.refund_page);

}


await fetchRequests(paginate.refund_page);




</script>