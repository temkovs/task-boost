<template>
    <div class="card px-2 p-5 p-sm-5 h-100 position-relative overflow-hidden">
        <div class="d-flex align-items-center position-absolute top-0 end-0 p-2 text-light ">
            <i class="fa fa-pencil cursor-pointer p-2 rounded"
               :style="'background-color : ' + (project.color_hash ?? '#fd6528')"
               :data-bs-note="JSON.stringify(note)"
               data-bs-target="#updateNoteModal"
               data-bs-toggle="modal">
            </i>
            <i class="fa fa-trash ms-2 cursor-pointer p-2 text-light rounded"
               :style="'background-color : ' + (project.color_hash ?? '#fd6528')"
               data-bs-toggle="modal"
               data-bs-target="#deleteModal"
               data-bs-title="Note"
               :data-bs-route="route('project.notes.destroy',[project,note])">
            </i>
        </div>
        <div v-html="DOMPurify.sanitize(note.note)"></div>
    </div>
</template>

<script>
export default {
    name: "NoteCard"
}
</script>

<script setup>
import DOMPurify from "dompurify";
import {inject} from "vue";

const route = inject("route");

defineProps({
    project: {
        type: Object,
        default: null,
    },
    note: {
        type: Object,
        required: true,
    }
})
</script>

<style scoped>

</style>
