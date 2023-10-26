<template>
    <!-- <div class="pagination flex gap-5">
        <button @click="goToPage(currentPage - 1)" :disabled="currentPage === 1">Previous</button>
        <span>{{ currentPage }}</span>
        <button @click="goToPage(currentPage + 1)" :disabled="currentPage === totalPages">Next</button>
      </div> -->
<ul class="flex">
    <li>
        <button v-on:click="goToPage(currentPage - 1)" :disabled="currentPage === 1"
        class="h-8 px-5 text-gray-600 font-bold transition-colors duration-150 bg-white  border-gray-400 rounded-l-sm focus:shadow-outline hover:bg-indigo-100 shadow-lg">
            <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 16">
                <path fill-rule="evenodd"
                    d="M11.354 1.646a.5.5 0 0 1 0 .708L5.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0z" />
            </svg>
        </button>
    </li>
    
    <li>
        <div class="grid place-content-center h-8 px-5 text-indigo-600 font-bold transition-colors duration-150 bg-white  border-l-0 border-gray-400 focus:shadow-outline shadow-lg">Page {{ currentPage }} of {{ totalPages }}</div>
    </li>
    
    <li>
        <button  v-on:click="goToPage(currentPage + 1)" :disabled="currentPage === totalPages"
        class="h-8 px-5 text-gray-600 font-bold transition-colors duration-150 bg-white rounded-r-sm border-l-0 focus:shadow-outline hover:bg-indigo-100 shadow-lg">
            <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 16">
                <path fill-rule="evenodd"
                    d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z" />
            </svg>
        </button>
    </li>
</ul>

</template>
    
<script setup lang="ts">
    
const props = defineProps(['from','last_page'])
const emits = defineEmits(['changePage'])
    
const currentPage = ref(props.from); // The current page
const totalPages = ref(props.last_page); // The total number of pages
    
const goToPage = (page: number) => {

    if (page >= 1 && page <= totalPages.value) {
        
        currentPage.value = page;
        
        emits('changePage',currentPage);
    }
      
}
</script>