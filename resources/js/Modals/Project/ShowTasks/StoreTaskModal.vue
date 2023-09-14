<template>
    <base-modal
        id="storeTaskModal"
        title="Add Task"
        :close-button="false"
        @submit="submit"
        @instance="(_) => (modal = _)"
    >
        <template #default>
            <div>
                <base-input
                    v-model:value="form.title"
                    class="mb-3"
                    name="title"
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
                    <div class="mb-3 col-6">
                        <label class="form-label">Priority</label>
                        <div
                            v-for="(priority, i) in priorities"
                            :key="i"
                            class="form-check"
                        >
                            <input
                                :id="priority.name"
                                :class="{ 'is-invalid': form.errors.priority }"
                                class="form-check-input"
                                type="radio"
                                name="priority"
                                :value="priority.number"
                                v-model="form.priority"
                            />
                            <label class="form-check-label" :for="priority.name">
                                {{ priority.name }}
                            </label>
                            <div class="invalid-feedback">
                                {{ form.errors.priority }}
                            </div>
                        </div>
                    </div>
                    <div class="mb-3 col-6">
                        <label class="form-label">Status</label>
                        <div
                            v-for="(status, i) in statuses"
                            :key="i"
                            class="form-check"
                        >
                            <input
                                :id="status.name"
                                :class="{ 'is-invalid': form.errors.status }"
                                class="form-check-input"
                                type="radio"
                                name="status"
                                :value="status.number"
                                v-model="form.status"
                            />
                            <label class="form-check-label" :for="status.name">
                                {{ status.name }}
                            </label>
                            <div class="invalid-feedback">
                                {{ form.errors.status }}
                            </div>
                        </div>
                    </div>
                </div>
                <base-input
                    v-model:value="form.due_date"
                    class="mb-3"
                    name="due_date"
                    label="Due Date"
                    type="date"
                    :invalid="form.errors.due_date"
                />
            </div>
        </template>
        <template #footer>
            <button
                :disabled="form.processing"
                type="submit"
                class="btn btn-primary text-light w-100"
            >
                Add Task
            </button>
        </template>
    </base-modal>
</template>

<script>
export default {
    name: "StoreTaskModal",
};
</script>
<script setup>
import {useForm} from "@inertiajs/vue3";
import {inject, ref} from "vue";
import {DONE, HIGH_PRIORITY, IN_PROGRESS, LOW_PRIORITY, MID_PRIORITY, TO_DO} from "@/TasksConstants.js";
import BaseInput from "@/Components/BaseComponents/BaseInput.vue";
import BaseTextarea from "@/Components/BaseComponents/BaseTextarea.vue";
import BaseModal from "@/Modals/BaseModal.vue";


const route = inject("route");
const modal = ref(null);

const props = defineProps({
    project: {
        type: Object,
        required: true,
    },
});

const priorities = [
    {
        number: HIGH_PRIORITY,
        name: "High Priority",
    },
    {
        number: MID_PRIORITY,
        name: "Mid Priority",
    },
    {
        number: LOW_PRIORITY,
        name: "Low Priority",
    },
];

const statuses = [
    {
        number: TO_DO,
        name: "TO DO",
    },
    {
        number: IN_PROGRESS,
        name: "IN PROGRESS",
    },
    {
        number: DONE,
        name: "DONE",
    },
]

const form = useForm({
    title: "",
    description: "",
    due_date: "",
    priority: LOW_PRIORITY,
    status: TO_DO,
});

const submit = () => {
    form.post(route("project.tasks.store", props.project), {
        onSuccess: () => {
            modal.value.hide();
            form.reset();
        },
    });
};
</script>

<style scoped></style>
