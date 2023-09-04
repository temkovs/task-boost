<template>
    <main class="min-h bg-secondary">
        <projects-section :projects="projects" />
        <store-project-modal />
        <update-project-modal />
    </main>
</template>

<script>
import AppLayout from "../../Layouts/AppLayout.vue";
export default {
    name: "Index",
    layout: AppLayout,
}
</script>

<script setup>
import StoreProjectModal from "@/Modals/Project/StoreProjectModal.vue";
import ProjectsSection from "@/Components/Projects/ProjectsSection.vue";
import UpdateProjectModal from "@/Modals/Project/UpdateProjectModal.vue";

defineProps({
    projects: {
        type: Array,
        default: [],
    }
})
</script>

<style scoped>
.min-h {
    margin: 0;
    padding: 0;
    min-height: 74.6vh;
}
</style>
