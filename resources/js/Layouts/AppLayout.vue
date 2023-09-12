<template>
    <div class="bg-secondary">
        <custom-navbar />
        <slot></slot>
        <register-modal />
        <sign-in-modal />
        <custom-footer />
        <delete-modal/>
    </div>
</template>

<script setup>
import CustomFooter from "@/Components/Layouts/CustomFooter.vue";
import CustomNavbar from "@/Components/Layouts/CustomNavbar.vue";
import RegisterModal from "@/Modals/RegisterModal.vue";
import SignInModal from "@/Modals/SignInModal.vue";
import DeleteModal from "@/Modals/DeleteModal.vue";
</script>
