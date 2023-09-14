<template>
    <Head>
        <title>{{ meta.title }}</title>
    </Head>
    <main>
        <project-layout :project="project" location="Images">
            <div class="row d-flex justify-content-between align-items-center mb-5">
                <h2 class="fw-bold mb-2 col">IMAGES</h2>
                <div class="col text-sm-end">
                    <button
                        data-bs-target="#storeMaterialModal"
                        data-bs-toggle="modal"
                        class="btn px-sm-4 text-light  text-nowrap mb-2"
                        :style="'background-color: ' + project.color_hash">
                        Add Image <i class="fa fa-plus ms-2"></i>
                    </button>
                </div>
            </div>
            <div class="row d-flex align-items-stretch justify-content-center">
                <div v-for="(material, i) in project.materials"
                     :key="i"
                     class="col-11 col-sm-9 col-md-6 col-lg-4 col-xl-3 mb-4">
                    <image-card :project="project" :material="material" />
                </div>
            </div>
        </project-layout>
    </main>
    <store-material-modal :project="project"/>
    <update-material-modal :project="project"/>
    <open-image-modal/>
</template>

<script>
import AppLayout from "../../Layouts/AppLayout.vue";

export default {
    name: "ShowMaterials",
    layout: AppLayout,
}
</script>

<script setup>
import ProjectLayout from "@/Layouts/ProjectLayout.vue";
import StoreMaterialModal from "@/Modals/Project/ShowMaterials/StoreMaterialModal.vue";
import UpdateMaterialModal from "@/Modals/Project/ShowMaterials/UpdateMaterialModal.vue";
import OpenImageModal from "@/Modals/Project/ShowMaterials/OpenImageModal.vue";
import ImageCard from "@/Components/Project/ShowMaterials/ImageCard.vue";
import { Head } from '@inertiajs/vue3';

defineProps({
    project: {
        type: Object,
        default: null,
    },
    meta: {
        type: Object,
        default: null,
    }
})
</script>

<style scoped></style>
