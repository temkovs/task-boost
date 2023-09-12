<template>
    <div
        id="openImageModal"
        ref="modalRef"
        class="modal fade"
        tabindex="-1"
        aria-hidden="true"
        @click.self="emit('hidden-modal')"
    >
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content bg-transparent border-0">
                <img
                    :src="image.full_source"
                    alt="Project Image"
                    class="object-fit-contain mh-90"
                />
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "OpenImageModal",
};
</script>
<script setup>
import { Modal } from "bootstrap";
import { onMounted, ref } from "vue";

const modal = ref(null);
const modalRef = ref(null);

const emit = defineEmits(["hidden-modal"]);

const image = ref({
    src: "",
    alt: "",
});

onMounted(() => {
    modal.value = Modal.getOrCreateInstance(modalRef.value);
    modalRef.value.addEventListener("show.bs.modal", (event) => {
        image.value = JSON.parse(
            event.relatedTarget.getAttribute("data-bs-image")
        );
    });
});
</script>

<style scoped>
.mh-90 {
    max-height: 90vh;
}
</style>
