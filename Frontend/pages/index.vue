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
import nuxtStorage from 'nuxt-storage';

await useApiFetch("/sanctum/csrf-cookie");

nuxtStorage.localStorage.setData('ApiToken', '2|LPPFR7p2GqijHsx2D9qbqoWk17bRx86SO3t57dnb4c48883f');


</script>