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
                        :style="'background-color: ' + project.color_hash ">
                        Add Note <i class="fa fa-plus ms-2"></i>
                    </button>
                </div>
            </div>
            <div class="mt-2 mt-lg row g-3">
                <div v-for="(note,i) in project.notes" :key="i" class="col-12 col-xl-6  align-content-stretch">
                    <div class="card px-2 p-5 p-sm-5 h-100 position-relative overflow-hidden">
                        <div class="d-flex align-items-center position-absolute top-0 end-0 p-2 text-light ">
                            <i class="fa fa-pencil cursor-pointer p-2 rounded"
                               :style="'background-color: ' + project.color_hash "
                               :data-bs-note="JSON.stringify(note)"
                               data-bs-target="#updateNoteModal"
                               data-bs-toggle="modal">
                            </i>
                            <i class="fa fa-trash ms-2 cursor-pointer p-2 text-light rounded"
                               :style="'background-color: ' + project.color_hash "
                               data-bs-toggle="modal"
                               data-bs-target="#deleteModal"
                               data-bs-title="Note"
                               :data-bs-route="route('project.notes.destroy',[project,note])">
                            </i>
                        </div>
                        <div v-html="DOMPurify.sanitize(note.note)"></div>
                    </div>
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
import {inject} from "vue";
import DOMPurify from "dompurify";
import { Head } from '@inertiajs/vue3';

const route = inject("route");
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
