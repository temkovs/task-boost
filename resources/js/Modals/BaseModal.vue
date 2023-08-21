<template>
    <div
        :id="id"
        ref="modalRef"
        class="modal fade"
        tabindex="-1"
        aria-hidden="true"
    >
        <div
            class="modal-dialog modal-dialog-centered"
            :class="[size, modalDimension]"
        >
            <div class="modal-content border-0">
                <div class="modal-header bg-white">
                    <h5
                        v-if="title"
                        class="modal-title text-dark fw-bold ps-3 pt-3"
                    >
                        {{ title }}
                    </h5>
                    <button
                        type="button"
                        class="btn-close mt-1 me-3"
                        :class="{ 'btn-close-white': darkTheme }"
                        data-bs-dismiss="modal"
                        aria-label="Close"
                    ></button>
                </div>
                <form
                    class="pb-4 px-3 rounded-bottom"
                    :class="darkTheme ? 'text-white bg-custom' : 'bg-EFEFEF'"
                    @submit.prevent="emit('submit')"
                >
                    <div class="modal-body mt-3 pb-0">
                        <slot></slot>
                    </div>
                    <div class="modal-footer border-0 pb-0">
                        <button
                            v-if="closeButton"
                            type="button"
                            class="btn btn-secondary"
                            data-bs-dismiss="modal"
                        >
                            Затвори
                        </button>
                        <slot name="footer"></slot>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "BaseModal",
};
</script>
<script setup>
import { Modal } from "bootstrap";
import { onBeforeUnmount, onMounted, ref } from "vue";

defineProps({
    id: {
        type: String,
        required: true,
    },
    title: {
        type: String,
        required: true,
    },
    size: {
        type: String,
        default: null,
    },
    closeButton: {
        type: Boolean,
        default: true,
    },
    darkTheme: {
        type: Boolean,
        default: false,
    },
    modalDimension: {
        type: String,
        default: "",
    },
});

const modal = ref(null);
const modalRef = ref(null);

onMounted(() => {
    modal.value = Modal.getOrCreateInstance(modalRef.value);
    modalRef.value.addEventListener("show.bs.modal", (event) => {
        emit("onshow", event);
    });
    emit("instance", modal.value);
});

onBeforeUnmount(() => {
    modal.value.hide();
});

const emit = defineEmits(["submit", "onshow", "instance"]);
</script>

<style scoped>
.modal-dialog {
    overflow-y: initial !important;
}

.bg-custom {
    background: #221f1f;
}
</style>
