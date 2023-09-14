<template>
    <Head>
        <title>{{ meta.title }}</title>
    </Head>
    <main class="bg-secondary">
        <project-layout :project="project" location="Notes">
            <div class="row d-flex justify-content-between align-items-center">
                <h2 class="fw-bold mb-2 col">NOTES</h2>
                <div class="col text-sm-end">
                    <button
                        data-bs-target="#storeNoteModal"
                        data-bs-toggle="modal"
                        class="btn px-sm-4 text-light  text-nowrap mb-2"
                        :style="'background-color : ' + (project.color_hash ?? '#fd6528')">
                        Add Note <i class="fa fa-plus ms-2"></i>
                    </button>
                </div>
            </div>
            <div class="mt-2 mt-lg row g-3">
                <div v-for="(note,i) in project.notes" :key="i" class="col-12 col-xl-6  align-content-stretch">
                    <note-card :project="project" :note="note" />
                </div>
            </div>
        </project-layout>
    </main>
    <store-note-modal :project="project"/>
    <update-note-modal :project="project"/>
</template>

<script>
import AppLayout from "../../Layouts/AppLayout.vue";

export default {
    name: "ShowNotes",
    layout: AppLayout,
}
</script>

<script setup>
import ProjectLayout from "@/Layouts/ProjectLayout.vue";
import StoreNoteModal from "@/Modals/Project/ShowNotes/StoreNoteModal.vue";
import UpdateNoteModal from "@/Modals/Project/ShowNotes/UpdateNoteModal.vue";
import { Head } from '@inertiajs/vue3';
import NoteCard from "@/Components/Project/ShowNotes/NoteCard.vue";

defineProps({
    project: {
        type: Object,
        default: null,
    },
    meta: {
        type: Object,
        default: null,
    }
})
</script>

<style scoped>
</style>
