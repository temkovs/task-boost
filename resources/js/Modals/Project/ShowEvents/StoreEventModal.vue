<template>
    <base-modal
        id="storeEventModal"
        title="Add Event"
        size="modal-md"
        @onshow="onShow"
        @submit="submit"
        @instance="(_) => (modal = _)"
        :close-button="false"
    >
        <template #default>
            <base-input
                v-model:value="form.title"
                class="mb-3"
                name="title"
                type="text"
                label="Title *"
                :invalid="form.errors.title"
            />
            <base-textarea
                v-model:value="form.description"
                class="mb-3"
                name="description"
                label="Description"
                :invalid="form.errors.description"
            />
            <div class="row">
                <base-input
                    v-model:value="form.start_date"
                    class="mb-3 col-lg-6"
                    label="Start Date *"
                    name="start_date"
                    type="date"
                    :invalid="form.errors.start_date"
                />
                <base-input
                    v-model:value="form.end_date"
                    class="mb-3 col-lg-6"
                    label="End Date *"
                    name="end_date"
                    type="date"
                    :invalid="form.errors.end_date"
                />
            </div>
            <div
                v-if="
                    form.start_date === form.end_date &&
                    form.start_date &&
                    form.end_date
                "
                class="row"
            >
                <base-input
                    v-model:value="form.start_time"
                    class="mb-3 col-6"
                    label="Start Time"
                    name="start_time"
                    type="time"
                    :invalid="form.errors.start_time"
                />
                <base-input
                    v-model:value="form.end_time"
                    class="mb-3 col-6"
                    label="End Time"
                    name="end_time"
                    type="time"
                    :invalid="form.errors.end_time"
                />
            </div>
            <base-textarea
                v-model:value="form.attendees"
                class="mb-3"
                name="attendees"
                label="Attendees"
                :invalid="form.errors.attendees"
            />
            <base-color-select
                v-model:value="form.color"
                class="mb-3 text-center"
                name="color"
                label=""
                placeholder="Color"
                type="color"
                :is-event-color="true"
                :invalid="form.errors.color"
            />
            <base-input
                v-model:value="form.location"
                class="mb-3"
                name="location"
                type="text"
                label="Location"
                :invalid="form.errors.location"
            />
        </template>
        <template #footer>
            <button
                :disabled="form.processing"
                type="submit"
                class="btn btn-primary text-light w-100"
            >
                Add Event
            </button>
        </template>
    </base-modal>
</template>

<script>
export default {
    name: "StoreEventModal",
};
</script>
<script setup>
import { inject, ref } from "vue";
import {useForm, router} from "@inertiajs/vue3";
import BaseModal from "@/Modals/BaseModal.vue";
import BaseInput from "@/Components/BaseComponents/BaseInput.vue";
import BaseTextarea from "@/Components/BaseComponents/BaseTextarea.vue";
import BaseColorSelect from "@/Components/BaseComponents/BaseColorSelect.vue";

const route = inject("route");
const modal = ref(null);

const props = defineProps({
    project: {
        type: Object,
        required: true,
    }
})

const form = useForm({
    title: "",
    description: "",
    start_date: null,
    end_date: null,
    start_time: null,
    end_time: null,
    attendees: "",
    color: "",
    location: "",
});
const onShow = () => {
    router.get(
        route("project.events.index", props.project),
        {},
        {
            preserveState: true,
        }
    );
};
const submit = () => {
    if (form.start_date !== form.end_date) {
        form.start_time = null;
        form.end_time = null;
    }
    form.post(route("project.events.store", props.project), {
        onSuccess: () => {
            modal.value.hide();
            form.reset();
        },
    });
};
</script>

<style scoped></style>
