<template>
    <div>
        <base-modal
            id="updateMaterialModal"
            :close-button="false"
            title="Edit Image"
            @submit="submit"
            @onshow="onShow"
            @instance="(_) => (modal = _)"
        >
            <template #default>
                <div>
                    <base-input
                        v-model:value="form.file_name"
                        class="position-relative"
                        name="file_name"
                        placeholder="File Name"
                        label=""
                        type="text"
                        :invalid="form.errors.file_name"
                    />
                </div>
            </template>
            <template #footer>
                <div class="d-flex flex-column w-100">
                    <div>
                        <button
                            type="submit"
                            class="w-100 btn btn-primary text-white px-4 text-white"
                            :disabled="form.processing"
                        >
                            Edit Image
                        </button>
                    </div>
                </div>
            </template>
        </base-modal>
    </div>
</template>

<script>
export default {
    name: "UpdateMaterialModal",
};
</script>

<script setup>
import {inject, ref} from "vue";
import BaseModal from "../../BaseModal.vue";
import {useForm} from "@inertiajs/vue3";
import BaseInput from "@/Components/BaseComponents/BaseInput.vue";
const route = inject("route");
const modal = ref(null);

const props = defineProps({
    project: {
        type: Object,
        default: null,
    },
})
const form = useForm({
    path: "",
    file_name: "",
})

const material = ref(null);

const onShow = (event) => {
    material.value = JSON.parse(event.relatedTarget.getAttribute("data-bs-material"));
    form.path = material.value.path;
    form.file_name = material.value.file_name;
};

const submit = () => {
    form.put(route("project.materials.update", [props.project, material.value]), {
        onSuccess: () => {
            modal.value.hide();
            form.reset();
        },
    });
};
</script>

<style scoped></style>
