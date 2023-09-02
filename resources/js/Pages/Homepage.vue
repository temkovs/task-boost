<template>
    <main>
        <hero-section />
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
</script>

<style scoped>

</style>
