<template>
    <div class="p-16 min-h-screen bg-gradient-to-b to-pink-200 to-60% from-[#bce1ff] from-10%">
        <h2 class="my-4 text-4xl font-semibold text-gray-600">My Enrollmens</h2>
        <div class="pb-2 flex items-center justify-between text-gray-600">
            <!-- Header -->

        </div>

        <!-- card -->
        <div v-for="enroll in allEnrollments" class="flex flex-col gap-2 ">
            <Enrollment :enroll="enroll" class="mt-2 duration-200"></Enrollment>
        </div>




    </div>
</template>

<script setup lang="ts">
definePageMeta({ layout: "student",
middleware: ['is-authorized','is-student'] })

import { useAuthStore } from "~/stores/useAuthStore";

const auth = useAuthStore();
const user = auth.user.value;

const allEnrollments = ref();

const { data: enrollmentResponse, error: enrollmentError } = await useApiFetch(`api/student/myEnrollments/${user.id}`, {});

if (enrollmentResponse.value) {

    allEnrollments.value = sortByFieldDesc(enrollmentResponse.value, 'created_at');

}

else {
  if (enrollmentError.value) {


  }

}

function sortByFieldDesc(obj: Record<string, any>, field: string): any[] {
  const dataArray = Object.values(obj);
  
  return dataArray.sort((a, b) => {
    if (a[field] > b[field]) return -1;
    if (a[field] < b[field]) return 1;
    return 0;
  });
}

</script>