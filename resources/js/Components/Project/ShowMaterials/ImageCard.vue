<template>
    <div class="h-100 shadow rounded bg-white d-flex flex-column justify-content-between">
        <div class="text-dark text-center fs-5 fw-semibold p-3"
        >
            {{ material.file_name }}
        </div>
        <div class="d-flex flex-column align-items-end">
            <div class="ratio ratio-1x1">
                <img :src="material.full_source"
                     alt="Image"
                     class="object-fit-cover"
                />
            </div>
            <div class="col-12 d-flex justify-content-center">
                <div class="col-12 col-xl-11 d-flex justify-content-between p-4 text-dark">
                    <i class="fa fa-edit fs-5 cursor-pointer"
                       :data-bs-material="JSON.stringify(material)"
                       data-bs-target="#updateMaterialModal"
                       data-bs-toggle="modal"
                    ></i>
                    <i data-bs-toggle="modal"
                       data-bs-target="#openImageModal"
                       :data-bs-image="JSON.stringify(material)"
                       class="fa fa-eye fs-5 cursor-pointer"
                    ></i>
                    <i data-bs-toggle="modal"
                       data-bs-target="#deleteModal"
                       data-bs-title="Image"
                       :data-bs-route="route('project.materials.destroy',[project,material])"
                       class="fa fa-trash fs-5 cursor-pointer"
                    ></i>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "ImageCard"
}
</script>

<script setup>
import {inject} from "vue";

const route = inject('route');

defineProps({
    project: {
        type: Object,
        default: null,
    },
    material: {
        type: Object,
        required: true,
    }
})
</script>

<style scoped>
i:hover {
    opacity: 75%;
}
</style>
