<template>
    <div>
        <div class="container-fluid overflow-hidden">
            <div class="row flex-nowrap">
                <div class="col-auto col-md-3 col-xl-2 px-sm-2 px-0 "
                     :style="'background-color : ' + (project.color_hash ?? '#fd6528')">
                    <div
                        class="d-flex flex-column align-items-center align-items-sm-start px-3 pt-4 text-white min-vh-90">
                        <span
                            class="d-flex align-items-center mb-md-0 me-md-auto text-light text-decoration-none">
                            <span class="fs-5 d-none d-sm-inline text-uppercase mx-auto">
                               {{ project.title }}
                            </span>
                        </span>
                        <hr class="w-100 pz-0 d-none d-sm-block">
                        <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start w-100"
                            id="menu">
                            <li class="nav-item mb-2 w-100" v-for="(item,i) in navItems" :key="i">
                                <Link :href="route(item.link, project)" class="nav-link px-0 text-light item"
                                      :class="location===item.name? 'clicked' : ''"
                                      :style="styleObject(project.color_hash)"
                                >
                                    <i class="fa fs-4 mx-2" :class="item.icon"></i> <span
                                    class="ms-1 d-none d-sm-inline">{{ item.name }}</span>
                                </Link>
                            </li>
                            <hr class="w-100">
                            <li class="nav-item mb-2 w-100">
                                <span :data-bs-project="JSON.stringify(project)"
                                      data-bs-target="#updateProjectModal"
                                      data-bs-toggle="modal"
                                      class="nav-link px-0 text-light item cursor-pointer"
                                      :style="styleObject(project.color_hash)"
                                >
                                    <i class="fa fa-pencil fs-4 mx-2"></i> <span
                                    class="ms-1 d-none d-sm-inline">Edit Project</span>
                                </span>
                            </li>
                            <li class="nav-item mb-2 w-100">
                                <span data-bs-toggle="modal"
                                      data-bs-target="#deleteModal"
                                      data-bs-title="Project"
                                      :data-bs-route="route('projects.destroy', project)"
                                      class="nav-link px-0 text-light item cursor-pointer"
                                      :style="styleObject(project.color_hash)"
                                >
                                    <i class="fa fa-trash fs-4 mx-2"></i> <span
                                    class="ms-1 d-none d-sm-inline">Delete Project</span>
                                </span>
                            </li>
                            <li class="nav-item mb-2 w-100">
                                <Link :href="route('projects.index')"
                                      class="nav-link px-0 text-light item cursor-pointer"
                                      :style="styleObject(project.color_hash)"
                                >
                                    <i class="fa fa-arrow-left fs-4 mx-2"></i> <span
                                    class="ms-1 d-none d-sm-inline">Projects</span>
                                </Link>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col p-4 px-sm-4 px-md-5 max-width-1600px mx-auto">
                    <slot></slot>
                </div>
            </div>
        </div>
    </div>
    <update-project-modal/>
</template>

<script setup>

import {inject, ref} from "vue";
import UpdateProjectModal from "@/Modals/Project/UpdateProjectModal.vue";

const route = inject("route");

const props = defineProps({
    project: {
        type: Object,
        default: null
    },
    location: {
        type: String,
        default: "Home",
    }
})

const componentColorHash = ref(props.project.color_hash)

const navItems = ref([
    {
        name: "MindMap",
        link: "project.mind-map.index",
        icon: "fa-puzzle-piece"
    },
    {
        name: "Tasks",
        link: "project.tasks.index",
        icon: "fa-tasks"
    },
    {
        name: "Notes",
        link: "project.notes.index",
        icon: "fa-sticky-note"
    },
    {
        name: "Images",
        link: "project.materials.index",
        icon: "fa-file-image-o"
    },
    {
        name: "Events",
        link: "project.events.index",
        icon: "fa-calendar"
    },
])

const styleObject = (colorHover) => {
    return {
        "--bs-nav-link-color": colorHover,
    };
}
</script>

<style scoped>
.clicked {
    background-color: #ededed;
    color: var(--bs-nav-link-color) !important; /* Use the computed property */
}

.item:hover {
    background-color: #ededed;
    color: var(--bs-nav-link-color) !important; /* Use the computed property */
}

.min-vh-90 {
    min-height: 90vh !important;
}
</style>
