<template>
    <main class="bg-orange-500">
        <HomeCompMainHome />
    </main>
</template>

<script setup lang="ts">
import {useAuthStore} from "~/stores/useAuthStore";
    
const auth = useAuthStore();

console.log(auth.user.value);

</script>