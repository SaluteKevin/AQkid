<template>
    <div class="p-16 min-h-screen bg-gradient-to-b to-emerald-200 to-60% from-[#bce1ff] from-10%">
    <h2 class="my-4 text-4xl font-semibold text-gray-600">Enrollment History</h2>
			<div class="pb-2 flex items-center justify-between text-gray-600">
				<!-- Header -->

			</div>

    <!-- card -->
        <div class="flex flex-col gap-2 ">
            <div
				v-for="enroll in showEnrollsHistory" :key="enroll.number"
				class="flex  px-2 py-2 justify-between bg-white
				 shadow-lg w-full">
				<!-- Card -->

				
					<!-- Left side -->

					<img
						class="h-12 w-12 rounded-full object-cover"
						src="/images/AQKids_logo.png"
						alt="" />

					<div
						class="ml-4 mt-3 flex capitalize text-black w-1/4">
						<span class="mr-2">name:</span>
						<span class="text-gray-600">
							{{ enroll.user.first_name }} {{ enroll.user.last_name }}
						</span>
					</div>

					<div
						class="ml-12 mt-3 flex capitalize text-black w-1/4">
						<span class="mr-2">Phone Number:</span>
						<span class="text-gray-600">
							{{ enroll.user.phone_number}}
						</span>

					</div>

                    <div
						class="mr-16 mt-3 flex text-black w-1/4">
						<span class="mr-2">Request time:</span>
						<span class=" text-gray-600">
							{{formatDateTime(new Date(enroll.created_at))}}
						</span>
						
					</div>
                    
                    <div class="mr-16 flex place-content-center flex-col">
						<NuxtLink :to="`/staff/detail/request${enroll.id}`">
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

definePageMeta({layout: "staff"})

// allTeachers

const allEnrollHistory = ref({})
const showEnrollsHistory = ref({})

// await fetchEnrolls();

async function fetchEnrolls(page: number) {

    const {data: enrollHistoryResponse, error: enrollHistoryError } = await useApiFetch("api/staff/historyEnrollment?page="+page, {});

    if (enrollHistoryResponse.value) {
        
        last_page.value = enrollHistoryResponse.value.last_page

        allEnrollHistory.value = enrollHistoryResponse.value.data;

        showEnrollsHistory.value = allEnrollHistory.value;

    }
    else {
        
        if (enrollHistoryError.value) {
            console.log(enrollHistoryError.value);
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

const currentpage = ref(paginate.enrollHistory_page)
const last_page = ref<Number>(0)

async function onChangePage(page: any) {

    // console.log(page.value)
    // currentpage.value = page.value

    await paginate.setEnrollHistoryPage(page.value);

    await fetchEnrolls(paginate.enrollHistory_page);

}


await fetchEnrolls(paginate.enrollHistory_page);


</script>