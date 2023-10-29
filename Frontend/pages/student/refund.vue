<template>
    <div class="p-16 min-h-screen bg-gradient-to-b to-pink-200 to-60% from-[#bce1ff] from-10%">
        <h2 class="my-4 text-4xl font-semibold text-gray-600">My Refund Requests</h2>
        <div class="pb-2 flex items-center justify-between text-gray-600">
            <!-- Header -->

        </div>

        <!-- card -->
        <div v-for="refund in allRefunds" class="flex flex-col gap-2 ">
            <Refund :refund="refund" class="mt-2"></Refund>
        </div>




    </div>
</template>

<script setup lang="ts">
definePageMeta({ layout: "student" })

import { useAuthStore } from "~/stores/useAuthStore";

const auth = useAuthStore();
const user = auth.user.value;

const allRefunds = ref();

const { data: refundsResponse, error: refundsError } = await useApiFetch(`api/student/myRefunds/${user.id}`, {});

if (refundsResponse.value) {

    allRefunds.value = sortByFieldDesc(refundsResponse.value, 'created_at');

    console.log(allRefunds.value)

}

else {
  if (refundsError.value) {


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