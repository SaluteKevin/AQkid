<template>
    <main class="overflow-hidden">
        
        <LandingMainSection @scroll="JoinUs" class=" bg-gradient-to-b from-white from-55%  via-sky-300 via-75% to-indigo-400"/>
        

        <div ref="scrollTo"></div>
        <LandingFeatures  class="pt-12 bg-gradient-to-b from-indigo-400 via-blue-400 via-60% to-sky-600" />
        
        <LandingReviews class="bg-gradient-to-b from-sky-600 via-blue-600 to-blue-950"/>
        
        <LandingCallToAction />
    </main>
</template>


<script setup lang="ts">

const scrollTo = ref()

const JoinUs  = async() => {

    if (scrollTo.value) {

        const element = scrollTo.value.getBoundingClientRect();
  
        // Scroll to the element with smooth animation
        window.scrollTo({
            top: element.top + window.scrollY,
            behavior: 'smooth',
        });
    }

};

</script>