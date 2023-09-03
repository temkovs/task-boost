<template>
    <section class="bg-secondary">
        <div
            class="container py-5 text-center"
        >
            <div class="fs-3 fw-bold">Your Projects ({{ projects.length }})</div>

            <div v-if="projects.length===0" class="col-12 col-lg-7 col-xl-6 mx-auto my-5 my-sm-0">
                <div class="ratio ratio-6123x4082">
                    <img src="/images/projects/no-file-found.png" alt="no-file-found"/>
                </div>
            </div>

            <div v-else class="my-5 row g-4 d-flex text-start">
                <div v-for="(project,i) in projects" :key="i" class="col-12 col-md-6 col-xl-4 align-content-stretch">
                    <project-card  :project="project"/>
                </div>
            </div>

            <div data-bs-target="#storeProjectModal"
                 data-bs-toggle="modal" class="btn btn-primary px-3 text-light mt-3">
                {{projects.length>0 ? 'Add New Project' : 'Create Your First Project'}}
                <i class="fa fa-plus ms-2"></i>
            </div>
        </div>
    </section>
</template>

<script>
export default {
    name: "ProjectsSection",
};
</script>

<script setup>
import ProjectCard from "@/Components/Projects/ProjectSection/ProjectCard.vue";

defineProps({
    projects: {
        type: Array,
        default: [],
    }
})
</script>

<style scoped>
</style>
