<template>
<div class="p-16 min-h-screen bg-gradient-to-b to-pink-200 to-60% from-[#bce1ff] from-10%">
    <h2 class="my-4 text-4xl font-semibold text-gray-600">Make-up class Histories</h2>
			<div class="pb-2 flex items-center justify-between text-gray-600">
				<!-- Header -->

			</div>

    <!-- card -->
        <div class="flex flex-col gap-2 ">
            <div
				v-for="refund in showRequests" :key="refund.id"
				class="flex px-2 py-2 justify-between bg-white
				 shadow-lg rounded-lg w-full hover:scale-105 duration-150">
				<!-- Card -->

				
					<!-- Left side -->

					<img
						class="h-12 w-12 rounded-full object-cover"
						:src="`${config.public.imageBaseURL}${refund.user.profile_image_path}`"
						alt="" />
                    <div
						class="p-3  flex capitalize text-black place-content-center w-1/4">
						<span>Title: </span>
						<span class="ml-1 text-gray-600">
							{{ refund.title}}
						</span>

					</div>

					<div
						class="p-3 flex capitalize text-black place-content-center w-1/4">
						<span class="mr-1">name:</span>
						<span class="text-gray-600">
							{{ refund.user.first_name }} {{ refund.user.last_name }}
						</span>
					</div>

					<div
						class="p-3  flex capitalize text-black place-content-center w-1/4">
						<span>Phone Number: </span>
						<span class="ml-1 text-gray-600">
							{{ refund.user.phone_number}}
						</span>

					</div>

                    <div
						class="p-3 flex text-black place-content-center w-1/4">
						<span>Request time:</span>
						<span class="ml-1 text-gray-600">
							{{formatDateTime(new Date(refund.created_at))}}
						</span>
						
					</div>
                    
                    <div class="flex place-content-center flex-col">
						<NuxtLink :to="`/staff/detail/makeup${refund.id}`">
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
const config = useRuntimeConfig();
definePageMeta({layout: "staff",
middleware: ['is-authorized','is-staff']})


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


const allRequests = ref({})
const showRequests = ref({})

// await fetchRequests();

async function fetchRequests(page: number) {

    const {data: requestsResponse, error: requestsError } = await useApiFetch("api/staff/allMakeUpHistories?page="+page, {});

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

// paginate
import { usePaginateStore } from '~/stores/usePaginateStore'
const paginate = usePaginateStore();

const currentpage = ref(paginate.makeupHistory_page)
const last_page = ref<Number>(0)

async function onChangePage(page: any) {

    // console.log(page.value)
    // currentpage.value = page.value

    await paginate.setMakeUpHistoryPage(page.value);

    await fetchRequests(paginate.makeupHistory_page);

}


await fetchRequests(paginate.makeupHistory_page);

</script>