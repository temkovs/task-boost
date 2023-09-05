<template>
    <div>
        <div class="card shadow-lg h-100">
            <div class="bg-light d-flex h-100">
                <div :style="'background-color : ' + (project.color_hash ?? '#fd6528')" class="col-2"></div>
                <div class="p-3 w-100">
                    <h4 class="text-uppercase truncate-lines-2" style="min-height: 55px">{{
                            project.title
                        }}</h4>
                    <p class="mb-0 truncate-lines-2" style="min-height: 48px">{{ project.description }}</p>
                    <div class="mt-3 d-flex justify-content-evenly align-items-center fs-4"
                         :style="'color : ' + (project.color_hash ?? '#fd6528')">
                        <i class="fa fa-pencil cursor-pointer"
                           :data-bs-project="JSON.stringify(project)"
                           data-bs-target="#updateProjectModal"
                           data-bs-toggle="modal">
                        </i>
                        <i class="fa fa-trash ms-4 cursor-pointer"
                           data-bs-toggle="modal"
                           data-bs-target="#deleteModal"
                           data-bs-title="Project"
                           :data-bs-route="route('projects.destroy', project)">
                        </i>
                        <Link :style="'color : ' + (project.color_hash ?? '#fd6528')"
                              :href="route('project.mind-map.index',project)">
                            <i class="fa fa-eye ms-4"></i>
                        </link>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "ProjectCard",
};
</script>

<script setup>
import {inject} from "vue";

const route = inject("route");

defineProps({
    project: {
        type: Object,
        default: null,
    }
})
</script>

<style scoped>
.truncate-lines-2 {
    display: -webkit-box;
    -webkit-line-clamp: 2; /* Limit the number of lines */
    -webkit-box-orient: vertical;
    overflow: hidden;
    text-overflow: ellipsis;
}
</style>
