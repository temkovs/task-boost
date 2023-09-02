<template>
    <main>
        <hero-section />
        <contact-us />
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
import HeroSection from "@/Components/Homepage/HeroSection.vue";
import ContactUs from "@/Components/Homepage/ContactUs.vue";
</script>

<style scoped>

</style>
