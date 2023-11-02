<template>
    <div class="flex items-center mb-4 cursor-pointer hover:bg-gray-100 p-2 rounded-md" v-on:click="clickChat">
        <div class="w-12 h-12 bg-gray-300 rounded-full mr-3">
            <img :src="`${config.public.imageBaseURL}${contract.profile_image_path}`" alt="User Avatar"
                class="w-12 h-12 rounded-full">
        </div>
        <div v-if="props.has_read == 'TRUE'" class="flex-1 overflow-hidden">
            <h2 class="text-lg font-semibold">{{ contract.first_name }} {{ contract.last_name }}</h2>
            <p class="text-gray-600 truncate">{{ props.last_message }}</p>
        </div>
        <div v-if="props.has_read == 'FALSE'" class="flex-1 overflow-hidden">
            <h2 class="text-lg font-semibold">{{ contract.first_name }} {{ contract.last_name }}</h2>
            <p class="text-black text-xl font-bold truncate">{{ props.last_message }}</p>
        </div>
    </div>
</template>

<script setup lang="ts">

const config = useRuntimeConfig();
const props = defineProps(['contract','last_message','has_read'])
const contract = ref(props.contract);
const emits = defineEmits(['seeChat'])



function clickChat() {
    
    emits('seeChat', contract.value.id, contract.value.first_name);

}


</script>