<template>
    <Head>
        <title>{{ meta.title }}</title>
    </Head>
    <main class="bg-secondary">
        <project-layout :project="project" location="Tasks">
            <div class="row d-flex justify-content-between align-items-center mb-5">
                <h2 class="fw-bold mb-2 col">TASKS</h2>
                <div class="col text-sm-end">
                    <button
                        data-bs-target="#storeTaskModal"
                        data-bs-toggle="modal"
                        class="btn px-sm-4 text-light  text-nowrap mb-2"
                        :style="'background-color : ' + (project.color_hash ?? '#fd6528')">
                        Add Task <i class="fa fa-plus ms-2"></i>
                    </button>
                </div>
            </div>
            <div v-if="project.tasks.length"
                 class="row d-flex align-items-stretch justify-content-center text-white">
                <div v-for="(key, i) in Object.keys(taskArrays)"
                     :key="i"
                     class="col-12 col-sm-9 col-lg-4"
                     :class="{ 'mb-4 mb-lg-0' : i !== 2 }"
                >
                    <div class="overflow-auto rounded p-4 custom-scroll custom-max-height"
                         :style="'background-color : ' + (project.color_hash ?? '#fd6528')"
                    >
                        <vue-draggable :project="project"
                                       :tasks="taskArrays[key].tasks"
                                       :title="taskArrays[key].title"
                                       :status="taskArrays[key].status"
                        />
                    </div>
                </div>
            </div>
        </project-layout>
    </main>
    <store-task-modal :project="project"/>
    <update-task-modal :project="project"/>
    <view-task-modal :project="project"/>
</template>

<script>
import AppLayout from "../../Layouts/AppLayout.vue";

export default {
    name: "ShowTasks",
    layout: AppLayout,
}
</script>

<script setup>
import ProjectLayout from "@/Layouts/ProjectLayout.vue";
import StoreTaskModal from "@/Modals/Project/ShowTasks/StoreTaskModal.vue";
import VueDraggable from "@/Components/Project/ShowTasks/VueDraggable.vue";
import {computed, onUpdated, ref, watch} from "vue";
import {DONE, IN_PROGRESS, TO_DO} from "@/TasksConstants.js";
import UpdateTaskModal from "@/Modals/Project/ShowTasks/UpdateTaskModal.vue";
import ViewTaskModal from "@/Modals/Project/ShowTasks/ViewTaskModal.vue";
import { Head } from '@inertiajs/vue3';

const props = defineProps({
    project: {
        type: Object,
        required: true,
    },
    meta: {
        type: Object,
        default: null,
    },
})

const projectTasks = ref(props.project.tasks);

const filterTasksByStatus = (tasks, status) => {
    return tasks.filter(task => task.status === status);
};

const toDoTasks = ref(projectTasks.value.filter(task => task.status === TO_DO));
const inProgressTasks = ref(projectTasks.value.filter(task => task.status === IN_PROGRESS));
const doneTasks = ref(projectTasks.value.filter(task => task.status === DONE));

watch(projectTasks, (newVal) => {
    toDoTasks.value = filterTasksByStatus(newVal, TO_DO);
    inProgressTasks.value = filterTasksByStatus(newVal, IN_PROGRESS);
    doneTasks.value = filterTasksByStatus(newVal, DONE);
});

const taskArrays = computed(() => {
    return {
        toDoTasks: {
            title: 'To Do',
            status: TO_DO,
            tasks: toDoTasks,
        },
        inProgressTasks: {
            title: 'In Progress',
            status: IN_PROGRESS,
            tasks: inProgressTasks,
        },
        doneTasks: {
            title: 'Done',
            status: DONE,
            tasks: doneTasks,
        },
    };
});

onUpdated(() => {
    projectTasks.value = props.project.tasks;
});
</script>

<style scoped>
/* width */
.custom-scroll::-webkit-scrollbar {
    width: 5px;
}

/* Track */
.custom-scroll::-webkit-scrollbar-track {
    background: #d9d9d9;
}

/* Handle */
.custom-scroll::-webkit-scrollbar-thumb {
    background: #bababa;
}

.custom-max-height {
    max-height: 50vh;
}

@media (min-width: 992px) {
    .custom-max-height {
        max-height: 70vh;
    }
}
</style>
