<template>
    <base-modal
        id="viewTaskModal"
        title="View Task"
        :close-button="false"
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
                    :read-only="true"
                />
                <base-textarea
                    v-model:value="form.description"
                    class="mb-3"
                    name="description"
                    label="Description"
                    :invalid="form.errors.description"
                    :read-only="true"
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
                                :checked="form.priority === priority.number"
                                :disabled="form.priority !== priority.number"
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
                    :read-only="true"
                    :invalid="form.errors.due_date"
                />
            </div>
        </template>
        <template #footer>
            <button
                class="btn btn-primary text-light w-100"
                @click="modal.hide()"
            >
                Close
            </button>
        </template>
    </base-modal>
</template>

<script>
export default {
    name: "ViewTaskModal"
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
</script>

<style scoped>

</style>
