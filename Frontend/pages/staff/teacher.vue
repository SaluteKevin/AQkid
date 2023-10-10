<template>
    <div class="p-16 min-h-screen bg-gradient-to-l to-purple-50 to-60% from-[#bce1ff] from-10%">
    <h2 class="my-4 text-4xl font-semibold text-fray-600">Teacher List</h2>
			<div class="pb-2 flex items-center justify-between text-gray-600">
				<!-- Header -->
				<div>
					<span>
						<span class="text-green-400">
							431
						</span>
						teachers
					</span>
					<span>
						<span class="text-green-400">
							22
						</span>
						courses
					</span>
				</div>

			</div>

    <!-- card -->
        <div class="flex flex-col gap-2">
            <div
				class="mt-2 flex  px-4 py-4 justify-between bg-white
				 shadow-2xl rounded-lg cursor-pointer w-full">
				<!-- Card -->

				
					<!-- Left side -->

					<img
						class="h-12 w-12 rounded-full object-cover"
						src="https://inews.gtimg.com/newsapp_match/0/8693739867/0"
						alt="" />

					<div
						class="ml-4 flex flex-col capitalize text-black">
						<span>name</span>
						<span class="mt-2 text-gray-600">
							carmen beltran
						</span>
					</div>

					<div
						class="ml-12  flex flex-col capitalize text-black">
						<span>Phone Number</span>
						<span class="mt-2 text-gray-600">
							097-232-2233
						</span>

					</div>

                    <div
						class="mr-16 flex flex-col text-black">
						<span>Email</span>
						<span class="mt-2 text-gray-600">
							ingfosbreak@outlook.com
						</span>
						
					</div>

					<div
						class="ml-12 flex flex-col capitalize text-black">
						<span>Courses</span>
						<span class="text-red-400">
							No courses
						</span>
					</div>


                    <div
						class="mr-16 flex flex-col capitalize text-gray-600">
						<span>Profile info</span>
						<NuxtLink to="">
						<span class="text-gray-600">see more...</span>
                        </NuxtLink>
					</div>



			</div>

            <div
				class="mt-2 flex px-4 py-4 justify-between bg-white
				 shadow-2xl rounded-lg cursor-pointer w-full">
				<!-- Card -->

				
					<!-- Left side -->

					<img
						class="h-12 w-12 rounded-full object-cover"
						src="https://inews.gtimg.com/newsapp_match/0/8693739867/0"
						alt="" />

					<div
						class="ml-4 flex flex-col capitalize text-black">
						<span>name</span>
						<span class="mt-2 text-gray-600">
							carmen beltran
						</span>
					</div>

					<div
						class="ml-12  flex flex-col capitalize text-black">
						<span>Phone Number</span>
						<span class="mt-2 text-gray-600">
							097-232-2233
						</span>

					</div>

                    <div
						class="mr-16 flex flex-col text-black">
						<span>Email</span>
						<span class="mt-2 text-gray-600">
							ingfosbreak@outlook.com
						</span>
						
					</div>

					<div
						class="ml-12 flex flex-col capitalize text-black">
						<span>Courses</span>
						<span class="text-red-400">
							No courses
						</span>
					</div>


                    <div
						class="mr-16 flex flex-col capitalize text-gray-600">
						<span>Profile info</span>
						<NuxtLink to="">
						<span class="text-gray-600">see more...</span>
                        </NuxtLink>
					</div>



			</div>

        </div>

            

			
        </div>

		

</template>

<script setup lang="ts">

definePageMeta({layout: "staff"})
</script>