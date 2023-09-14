<template>
    <Head>
        <title>{{ meta.title }}</title>
    </Head>
    <main class="bg-secondary">
        <project-layout :project="project" location="Events">
            <div class="row d-flex justify-content-between align-items-center mb-5">
                <h2 class="fw-bold mb-2 col">EVENTS</h2>
                <div class="col text-sm-end">
                    <button
                        data-bs-target="#storeEventModal"
                        data-bs-toggle="modal"
                        class="btn px-sm-4 text-light  text-nowrap mb-2"
                        :style="'background-color : ' + (project.color_hash ?? '#fd6528')">
                        Add Event <i class="fa fa-plus ms-2"></i>
                    </button>
                </div>
            </div>
            <div>
                <qalendar-events
                    :project="project"
                    :events="events"
                    :selected-date="selectedDate"
                    :mode="mode"
                />
            </div>
        </project-layout>
    </main>
    <store-event-modal :project="project"/>
    <update-event-modal :project="project"/>
    <delete-event-modal :project="project"/>
</template>

<script>
import AppLayout from "../../Layouts/AppLayout.vue";

export default {
    name: "ShowEvents",
    layout: AppLayout,
}
</script>

<script setup>
import ProjectLayout from "@/Layouts/ProjectLayout.vue";
import StoreEventModal from "@/Modals/Project/ShowEvents/StoreEventModal.vue";
import UpdateEventModal from "@/Modals/Project/ShowEvents/UpdateEventModal.vue";
import DeleteEventModal from "@/Modals/Project/ShowEvents/DeleteEventModal.vue";
import { Head } from '@inertiajs/vue3';
import QalendarEvents from "@/Components/Project/ShowEvents/QalendarEvents.vue";

const props = defineProps({
    project: {
        type: Object,
        default: null,
    },
    events: {
        type: Object,
        default: null,
    },
    selectedDate: {
        type: String,
        default: null,
    },
    mode: {
        type: String,
        default: "week",
    },
    meta: {
        type: Object,
        default: null,
    },
})
</script>

<style scoped>

</style>
