<template>
    <base-modal
        id="deleteEventModal"
        title="Delete Event"
        @onshow="onShow"
        @submit="submit"
        @instance="(_) => (modal = _)"
        :close-button="false"
    >
        <template #default>
            <h3>Are you sure you want to delete the entity?</h3>
        </template>
        <template #footer>
            <button
                type="submit"
                class="btn btn-primary text-light w-100"
                :disabled="formProcessing"
            >
                <i class="fa fa-trash"></i> Delete Event
            </button>
        </template>
    </base-modal>
</template>

<script>
export default {
    name: "DeleteEventModal",
};
</script>
<script setup>
import { inject, ref } from "vue";
import { router } from "@inertiajs/vue3";
import { Modal } from "bootstrap";
import BaseModal from "@/Modals/BaseModal.vue";

const modal = ref(null);
const route = inject("route");
const event = ref(null);
const formProcessing = ref(false);

const props = defineProps({
    project: {
        type: Object,
        required: true,
    }
})

const onShow = () => {
    event.value = JSON.parse(
        document
            .getElementById("deleteEventModal")
            .getAttribute("data-bs-event")
    );
    router.get(
        route("project.events.index", props.project),
        {},
        {
            preserveState: true,
            preserveScroll: true,
        }
    );
};

const submit = () => {
    formProcessing.value = true;
    router.delete(route("project.events.destroy", [props.project, event.value]), {
        onSuccess: () => {
            const modal = Modal.getInstance(
                document.getElementById("deleteEventModal")
            );
            modal.hide();
        },
        onFinish: () => {
            formProcessing.value = false;
        },
    });
};
</script>

<style scoped></style>
