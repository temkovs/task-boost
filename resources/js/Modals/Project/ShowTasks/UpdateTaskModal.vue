<template>
    <base-modal
        id="updateTaskModal"
        title="Edit Task"
        :close-button="false"
        @submit="submit"
        @onshow="onShow"
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
                Edit Task
            </button>
        </template>
    </base-modal>
</template>

<script>
export default {
    name: "UpdateTaskModal",
}
</script>

<script setup>
import { inject, ref } from "vue";
import { useForm } from "@inertiajs/vue3";
import {HIGH_PRIORITY, LOW_PRIORITY, MID_PRIORITY} from "@/TasksConstants.js";
import BaseInput from "@/Components/BaseComponents/BaseInput.vue";
import BaseTextarea from "@/Components/BaseComponents/BaseTextarea.vue";
import BaseModal from "@/Modals/BaseModal.vue";

const props = defineProps({
    project: {
        type: Object,
        required: true,
    },
});

const route = inject("route");
const task = ref(null);
const modal = ref(null);

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

let form = useForm({
    title: "",
    description: "",
    due_date: "",
    priority: "",
    status: "",
});

const onShow = (event) => {
    task.value = JSON.parse(
        event.relatedTarget.getAttribute("data-bs-task")
    );

    form.title = task.value.title;
    form.description = task.value.description;
    form.priority = task.value.priority;
    form.status = task.value.status;
    form.due_date = task.value.due_date;
};

const submit = () => {
    form.put(route("project.tasks.update", [props.project, task.value]), {
        onSuccess: () => {
            modal.value.hide();
        },
    });
};
</script>

<style scoped>

</style>
