<template>
    <div>
        <h5 class="mb-4 text-uppercase fw-semibold text-white">{{ title }}</h5>
        <draggable v-model="tasksArr"
                   group="tasks"
                   item-key="id"
                   ghost-class="ghost"
                   @change="onChange"
        >
            <template #item="{element, index}"
                      class="list-item"
            >
                <div class="rounded mb-2 bg-white text-dark">
                    <div class="col-12 d-flex">
                        <div class="rounded-start px-1"
                             :class="[
                                        {'low-priority-color' : element.priority === LOW_PRIORITY},
                                        {'mid-priority-color' : element.priority === MID_PRIORITY},
                                        {'high-priority-color' : element.priority === HIGH_PRIORITY},
                             ]"
                        ></div>
                        <div class="col-12 px-4 py-2">
                            <div class="d-flex justify-content-end">
                                <i v-if="!element.due_date && element.status !== DONE"
                                   class="fa fa-clock-o text-dark small"></i>
                                <i v-else-if="element.is_overdue" class="fa fa-clock-o text-danger small"></i>
                                <i v-else-if="element.two_days_left" class="fa fa-clock-o text-warning small"></i>
                                <i v-else-if="element.status !== DONE" class="fa fa-clock-o text-success small"></i>
                            </div>
                            <div class="fw-light mb-3">{{ element.title }}</div>
                            <div class="d-flex justify-content-between align-items-center">
                                <i class="fa fa-edit cursor-pointer small"
                                   :data-bs-task="JSON.stringify(element)"
                                   data-bs-target="#updateTaskModal"
                                   data-bs-toggle="modal"
                                ></i>
                                <i class="fa fa-eye small cursor-pointer"
                                   :data-bs-task="JSON.stringify(element)"
                                   data-bs-target="#viewTaskModal"
                                   data-bs-toggle="modal"
                                ></i>
                                <i data-bs-toggle="modal"
                                   data-bs-target="#deleteModal"
                                   data-bs-title="Task"
                                   :data-bs-route="route('project.tasks.destroy',[project,element])"
                                   class="fa fa-trash cursor-pointer small"
                                ></i>
                            </div>
                        </div>
                    </div>
                </div>
            </template>
        </draggable>
    </div>
</template>

<script>
export default {
    name: "VueDraggable"
}
</script>

<script setup>
import {inject, ref} from "vue";
import Draggable from 'vuedraggable'
import {router} from "@inertiajs/vue3";
import {DONE, LOW_PRIORITY, MID_PRIORITY, HIGH_PRIORITY} from "@/TasksConstants.js";

const route = inject('route');

const props = defineProps({
    project: {
        type: Object,
        required: true,
    },
    tasks: {
        type: Object,
        required: true,
    },
    title: {
        type: String,
        required: true,
    },
    status: {
        type: Number,
        required: true,
    }
})

const tasksArr = ref(props.tasks);

const onChange = (e) => {
    let newIndex = null;
    let destinationStatus = null;
    let taskId = null;
    let oldIndex = null;

    if (e.added) {
        newIndex = e.added.newIndex;
        destinationStatus = props.status;
        taskId = e.added.element.id;
    } else if (e.moved) {
        newIndex = e.moved.newIndex;
        taskId = e.moved.element.id;
    }

    if (e.added || e.moved) {
        const task = ref(props.project.tasks.filter(task => task.id === taskId)[0]);

        router.put(route('project.tasks.move', [props.project, task.value]), {
            'newIndex': newIndex,
            'destinationStatus': destinationStatus,
        }, {
            preserveScroll: true,
        })
    }
}
</script>

<style scoped>
.ghost {
    background: lightgray !important;
    border-radius: 6px;
}

.ghost > div {
    visibility: hidden;
}

.low-priority-color {
    background-color: #AEDFF7;
}

.mid-priority-color {
    background-color: #E67E22;
}

.high-priority-color {
    background-color: #FF0000;
}
</style>
