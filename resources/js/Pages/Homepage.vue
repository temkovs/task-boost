<template>
    <main>
        <hero-section />
        <contact-us />
        <frequently-asked-questions />
    </main>
</template>

<script>
import AppLayout from "../Layouts/AppLayout.vue";
export default {
    name: "Homepage",
    layout: AppLayout,
}
</script>

<script setup>
import ContactUs from "@/Components/Homepage/ContactUs.vue";
import HeroSection from "@/Components/Homepage/HeroSection.vue";
import FrequentlyAskedQuestions from "@/Components/Homepage/FrequentlyAskedQuestions.vue";
</script>

<style scoped>

</style>
