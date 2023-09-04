<template>
    <div>
        <div class="container-fluid">
            <div class="row flex-nowrap">
                <div class="col-auto col-md-3 col-xl-2 px-sm-2 px-0 "
                     :style="'background-color : ' + project.color_hash">
                    <div
                        class="d-flex flex-column align-items-center align-items-sm-start px-3 pt-4 text-white min-vh-100">
                        <a href="/"
                           class="d-flex align-items-center mb-md-0 me-md-auto text-light text-decoration-none">
                            <span class="fs-5 d-none d-sm-inline text-uppercase mx-auto">{{ project.title }}</span>
                        </a>
                        <hr class="w-100 pz-0 d-none d-sm-block">
                        <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start w-100"
                            id="menu">
                            <li class="nav-item mb-2 w-100" v-for="(item,i) in navItems" :key="i">
                                <Link :href="route(item.link, project)" class="nav-link px-0 text-light item "
                                      :class="location===item.name? 'shadow' : ''"
                                      :style="styleObject(project.color_hash)"
                                >
                                    <i class="fa fs-4 mx-2" :class="item.icon"></i> <span
                                    class="ms-1 d-none d-sm-inline">{{ item.name }}</span>
                                </Link>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col py-3">
                    <slot></slot>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>

import {inject, ref} from "vue";

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
        name: "Home",
        link: "project.home",
        icon: "fa-home"
    },
    {
        name: "MindMap",
        link: "project.mind_map",
        icon: "fa-puzzle-piece"
    },
    {
        name: "Tasks",
        link: "project.tasks",
        icon: "fa-tasks"
    },
    {
        name: "Notes",
        link: "project.notes",
        icon: "fa-sticky-note"
    },
    {
        name: "Materials",
        link: "project.materials",
        icon: "fa-book"
    },
    {
        name: "Events",
        link: "project.events",
        icon: "fa-calendar"
    }
])

const styleObject = (colorHover) => {
    return {
        "--bs-nav-link-color": colorHover,
    };
}
</script>

<style scoped>
.item:hover {
    background-color: #ededed;
    color: var(--bs-nav-link-color) !important; /* Use the computed property */
}
</style>
