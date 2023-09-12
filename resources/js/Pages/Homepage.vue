<template>
    <main>
        <hero-section />
        <our-success-formula />
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
import OurSuccessFormula from "@/Components/Homepage/OurSuccessFormula.vue";
import FrequentlyAskedQuestions from "@/Components/Homepage/FrequentlyAskedQuestions.vue";
import {onMounted} from "vue";
import { Modal } from "bootstrap";

const props = defineProps({
    showAuthModal: {
        type: Object,
        default: null,
    }
})

onMounted(() => {
    const { showLogin, showRegister } = props.showAuthModal;
    if (showLogin || showRegister) {
        const modalId = showLogin ? "signInModal" : "registerModal";
        const modal = Modal.getOrCreateInstance(
            document.getElementById(modalId)
        );
        modal.show();
    }
});
</script>

<style scoped>

</style>
