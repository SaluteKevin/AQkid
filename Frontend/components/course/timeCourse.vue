<template>
        <button @click="onClick()" v-if="status" type="button" class="p-2 mx-2 w-full text-white bg-gradient-to-r from-green-400 via-green-500 to-green-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-green-300 dark:focus:ring-green-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-3">{{ time }}</button>
        <button v-if="!status" type="button" class="p-2 mx-2 w-full h-12 text-white bg-gradient-to-r bg-gray-500  font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-3">   </button>
        
</template>

<script setup lang="ts">

const props = defineProps(['day','time','status','id'])
const emits = defineEmits(['select'])
const status = ref(props.status)
const time = ref(props.time)

const onClick = () => {
    emits('select', props.day, props.time , props.id)
}



</script>