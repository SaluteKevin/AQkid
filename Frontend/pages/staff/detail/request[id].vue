<template>
    <div class="relative flex place-content-center justify-center p-10 bg-gray-200">

        <div class="flex shadow-xl h-full w-4/5 ">
        <!-- Login form -->
        <div class="flex flex-wrap justify-center rounded-l-md bg-white h-full w-full py-12">
        <div class="w-4/5">
            <div class="grid grid-flow-col grid-cols-2 w-full my-6">
                <div>
                        <!-- Heading -->
                <h1 class="text-4xl font-semibold">Student_Username</h1>
                <div class="text-gray-500 text-3xl mb-3">Student_name</div>

                <!-- Form -->
                <div class="mb-3">
                    <label class="mb-2 block text-xl font-semibold">Email<br>
                        <span class="text-xl text-gray-500">Student_email</span>
                    </label>
                    
                </div>

                

                <div class="mb-3">
                    <label class="mb-2 block text-xl font-semibold">Phone number<br>
                        <span class="text-xl text-gray-500">student_phone_number</span>
                    </label>
                </div>

                <div class="mb-3">
                    <label class="mb-2 block text-xl font-semibold">Request at<br>
                        <span class="text-xl text-gray-500">{{formatDateTime(new Date(enroll.created_at))}}</span>
                    </label>
                </div>
                </div>
                <div class="h-auto w-full justify-center grid">
                    <img src="/images/AQKids_logo.png" class="object-contain h-72 w-72 place-self-end">
                </div>
            </div>
            

            

            <div class="mb-3">
                <button class="mb-1.5 block w-full text-center text-white bg-green-600 hover:bg-green-700 px-2 py-1.5 rounded-md">
                    Accept
                </button>
                <button class="flex flex-wrap justify-center w-full border border-gray-300 hover:border-gray-500 px-2 py-1.5 rounded-md">
                    Reject
                </button>
            </div>

        </div>
        <div class="flex flex-wrap shadow-xl">
            <img class="w-full h-full object-contain rounded-r-md" src="https://media.discordapp.net/attachments/711217095681245235/1163756633248256020/screenshot_20231017_153305.png?ex=6540bbd2&is=652e46d2&hm=ed685f35d47d877d7d50a69b0352335448310412b882c321fe23a09c0316768b&=&width=324&height=560">
        </div>
    </div>

        

  </div>



        <div class="absolute left-10 top-10">
            <NuxtLink to="/staff/request">
            <button class="bg-orange-500 px-8 py-1 text-xl text-white border-2 border-white hover:bg-orange-700 duration-150 rounded-lg">
                back
            </button>
            </NuxtLink>
        </div>
    </div>
</template>

<script setup lang="ts">

definePageMeta({layout: "staff"})

const route = useRoute();

const enroll = ref({})

const { data: enrollResponse, error: enrollError } = await useApiFetch(`api/staff/enrolls/${route.params.id}`, {});

if (enrollResponse.value) {
    enroll.value = enrollResponse.value;

    console.log(enroll.value)
}

else {
    if (enrollError.value) {
        
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
</script>