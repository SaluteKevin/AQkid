<template>
    <div class="mt-12">
test {{ $route.params.id }}
    </div>
</template>

<script setup lang="ts">
definePageMeta({ layout: "staff" })

const route = useRoute();

const timeslot = ref({})


</script>