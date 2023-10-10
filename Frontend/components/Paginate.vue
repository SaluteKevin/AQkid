<template>
    <div class="pagination flex gap-5">
        <button @click="goToPage(currentPage - 1)" :disabled="currentPage === 1">Previous</button>
        <span>{{ currentPage }}</span>
        <button @click="goToPage(currentPage + 1)" :disabled="currentPage === totalPages">Next</button>
      </div>
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