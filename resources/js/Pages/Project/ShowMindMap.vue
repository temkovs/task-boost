<template>
    <main class="bg-secondary">
        <project-layout :project="project" location="MindMap">
            {{ project }}
        </project-layout>
    </main>
</template>

<script>
import AppLayout from "../../Layouts/AppLayout.vue";

export default {
    name: "ShowMindMap",
    layout: AppLayout,
}
</script>

<script setup>

import ProjectLayout from "@/Layouts/ProjectLayout.vue";

defineProps({
    project: {
        type: Object,
        default: null,
    },
})
</script>

<style scoped></style>
