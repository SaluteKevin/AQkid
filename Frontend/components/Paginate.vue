<template>
    <!-- <div class="pagination flex gap-5">
        <button @click="goToPage(currentPage - 1)" :disabled="currentPage === 1">Previous</button>
        <span>{{ currentPage }}</span>
        <button @click="goToPage(currentPage + 1)" :disabled="currentPage === totalPages">Next</button>
      </div> -->

      <nav class="inline-flex items-center p-1 rounded bg-white space-x-2">
        <button class="p-1 rounded border text-black bg-white hover:text-white hover:bg-blue-600 hover:border-blue-600" @click="goToPage(currentPage - 1)" :disabled="currentPage === 1">
            <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 16">
                <path fill-rule="evenodd"
                    d="M11.354 1.646a.5.5 0 0 1 0 .708L5.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0z" />
            </svg>
        </button>
        <p class="text-gray-500">Page {{ currentPage }} of {{ totalPages }}</p>
        <button class="p-1 rounded border text-black bg-white hover:text-white hover:bg-blue-600 hover:border-blue-600" @click="goToPage(currentPage + 1)" :disabled="currentPage === totalPages">
            <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 16">
                <path fill-rule="evenodd"
                    d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z" />
            </svg>
        </button>
    </nav>
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