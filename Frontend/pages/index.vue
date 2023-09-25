<template>
    <main class="bg-orange-500">
        <LandingMainSection />
        <LandingFeatures />
        <LandingReviews/>
        <LandingCallToAction />
    </main>
</template>


<script setup lang="ts">
import {useAuthStore} from "~/stores/useAuthStore";
import nuxtStorage from 'nuxt-storage';
import Cookies from 'js-cookie';

const auth = useAuthStore();
await auth.testCSRF();









</script>