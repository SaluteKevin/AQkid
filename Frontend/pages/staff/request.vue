<template>
    <div class="p-16 min-h-screen bg-gradient-to-b to-purple-100 to-60% from-[#bce1ff] from-10%">
    <h2 class="my-4 text-4xl font-semibold text-gray-600">Requests</h2>
			<div class="pb-2 flex items-center justify-between text-gray-600">
				<!-- Header -->
				<div>
					<span>
						<span>
                            <span class="text-green-400">
                                {{ enrollCount }}
                            </span>
                            Request(s)
                        </span>
					</span>
				</div>

			</div>

    <!-- card -->
        <div class="flex flex-col gap-2 ">
            <div
				v-for="enroll in showEnrolls" :key="enroll.number"
				class="mt-2 flex  px-4 py-4 justify-between bg-white
				 shadow-2xl rounded-lg w-full">
				<!-- Card -->

				
					<!-- Left side -->

					<img
						class="h-20 w-20 rounded-full object-cover"
						src="https://inews.gtimg.com/newsapp_match/0/8693739867/0"
						alt="" />

					<div
						class="ml-4 flex flex-col capitalize text-black place-content-center">
						<span>name</span>
						<span class="mt-2 text-gray-600">
							{{ enroll.student_id }}
						</span>
					</div>

					<div
						class="ml-12  flex flex-col capitalize text-black place-content-center">
						<span>Phone Number</span>
						<span class="mt-2 text-gray-600">
							097-232-2233
						</span>

					</div>

                    <div
						class="mr-16 flex flex-col text-black place-content-center">
						<span>Request time</span>
						<span class="mt-2 text-gray-600">
							{{ enroll.created_at }}
						</span>
						
					</div>
                    
                    <div class="mr-16 flex place-content-center flex-col">
						<NuxtLink to="/staff/detail/request_id/">
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

const allEnroll = ref({})
const showEnrolls = ref({})
const enrollCount = ref<Number>(0)

// await fetchEnrolls();

async function fetchEnrolls(page: number) {

    const {data: enrollResponse, error: enrollError } = await useApiFetch("api/staff/allEnrollments?page="+page, {});

    if (enrollResponse.value) {
        
        last_page.value = enrollResponse.value.last_page

        allEnroll.value = enrollResponse.value.data;

        showEnrolls.value = allEnroll.value;

		enrollCount.value = showEnrolls.value.length;
    }
    else {
        
        if (enrollError.value) {
            console.log(enrollError.value);
        }

    }


}

// paginate
import { usePaginateStore } from '~/stores/usePaginateStore'
const paginate = usePaginateStore();

const currentpage = ref(paginate.enroll_page)
const last_page = ref<Number>(0)

async function onChangePage(page: any) {

    // console.log(page.value)
    // currentpage.value = page.value

    await paginate.setEnrollPage(page.value);

    await fetchEnrolls(paginate.enroll_page);

}


await fetchEnrolls(paginate.enroll_page);


</script>