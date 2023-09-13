<template>
    <main class="space-y-40 py-20 backdrop-blur-2xl bg-[radial-gradient(ellipse_at_top,_var(--tw-gradient-stops))] from-sky-200 to-sky-400">
        <MainSection />
        <Features />
        <Stats />
        <Testimonials />
        <CallToAction />
        <Blog />
    </main>
</template>


<script setup lang="ts">
await useApiFetch("/sanctum/csrf-cookie");

</script>