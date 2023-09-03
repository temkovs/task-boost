<template>
    <base-modal
        :close-button="false"
        id="deleteModal"
        :title="'Delete ' + title"
        @submit="submit"
        @onshow="onShow"
        @instance="(_) => (modal = _)"
    >
        <template #default>
            <h3>Are you sure you want to delete the entity?</h3>
        </template>
        <template #footer>
            <button
                type="submit"
                class="btn btn-primary text-light w-100"
                :disabled="formProcessing"
            >
                <i class="fa fa-trash"></i> Delete {{title}}
            </button>
        </template>
    </base-modal>
</template>

<script>
export default {
    name: "DeleteModal",
};
</script>
<script setup>
import { ref } from "vue";
import BaseModal from "./BaseModal.vue";
import { router } from "@inertiajs/vue3";

const modal = ref(null);
const title = ref("Null");
const route = ref(null);
const formProcessing = ref(false);

const onShow = (event) => {
    title.value = event.relatedTarget.getAttribute("data-bs-title");
    route.value = event.relatedTarget.getAttribute("data-bs-route");
};

const submit = () => {
    formProcessing.value = true;
    router.delete(route.value, {
        preserveScroll: true,
        preserveState: true,
        onSuccess: () => {
            modal.value.hide();
        },
        onFinish: () => {
            formProcessing.value = false;
        },
    });
};
</script>
<style scoped></style>
