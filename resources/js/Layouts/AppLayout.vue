<template>
    <custom-navbar />
    <slot></slot>
    <register-modal />
    <sign-in-modal />
</template>

<script setup>

import CustomNavbar from "@/Components/Layouts/CustomNavbar.vue";
import RegisterModal from "@/Modals/RegisterModal.vue";
import SignInModal from "@/Modals/SignInModal.vue";
</script>
