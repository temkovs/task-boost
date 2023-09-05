<template>
    <main class="bg-secondary">
        <project-layout :project="project" location="MindMap">
            <div class="h-100">
                <mindmap
                    v-model="form.mind_map"
                    @update:model-value="onChange"
                    locale="en"
                    :branch="4"
                    :x-gap="84"
                    :y-gap="18"
                    :zoom="true"
                    :fit-btn="true"
                    :center-btn="true"
                    :download-btn="true"
                    :drag="true"
                    :edit="true"
                    :add-node-btn="true"
                    :sharp-corner="false"
                    :ctm="true"
                    :timetravel="true"
                    :vertical="true"
                />
            </div>
        </project-layout>
    </main>
</template>

<script>
import AppLayout from "../../Layouts/AppLayout.vue";
import mindmap from "vue3-mindmap";
import "vue3-mindmap/dist/style.css";

export default {
    name: "ShowMindMap",
    layout: AppLayout,
    components: {mindmap},
}
</script>

<script setup>
import ProjectLayout from "@/Layouts/ProjectLayout.vue";
const route = inject("route");
import {inject, ref} from "vue";
import {useForm} from "@inertiajs/vue3";

const props = defineProps({
    project: {
        type: Object,
        default: null,
    },
})

const form = useForm({
    mind_map: props.project.mind_map ? JSON.parse(props.project.mind_map.mind_map): [{
        "name": props.project.title,
        "children": [
            {
                "name": "First Child Note",
                "children": []
            },
            {
                "name": "Second Child Note",
                "children": []
            },
            {
                "name": "Third Child Note",
                "children": [],
                "left": true
            }
        ],
    }],
})
const onChange = (data) => {
    form.mind_map = JSON.stringify(data);
    form.post(route("project.mind-map.store", props.project));
};
</script>

<style>

.Mindmap_button-list_fgvb6 button i.Mindmap_fit_fgvb6 {
    background-image: url(/images/icons/24px/fit-to-page-outline.png)
}

.Mindmap_button-list_fgvb6 button i.Mindmap_gps_fgvb6 {
    background-image: url(/images/icons/24px/crosshairs-gps.png)
}

.Mindmap_button-list_fgvb6 button i.Mindmap_fit_fgvb6 {
    background-image: url(/images/icons/24px/fit-to-page-outline.png)
}

.Mindmap_button-list_fgvb6 button i.Mindmap_download_fgvb6 {
    background-image: url(/images/icons/24px/download.png)
}

.Mindmap_button-list_fgvb6 button i.Mindmap_prev_fgvb6 {
    background-image: url(/images/icons/24px/prev.png)
}

.Mindmap_button-list_fgvb6 button i.Mindmap_next_fgvb6 {
    background-image: url(/images/icons/24px/next.png)
}
</style>
