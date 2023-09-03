<template>
    <div>
        <base-modal
            id="storeProjectModal"
            :close-button="false"
            title="Create Project"
            @submit="submit"
            @instance="(_) => (modal = _)"
        >
            <template #default>
                <div>
                    <base-color-select
                        v-model:value="form.color_hash"
                        class="mb-3 text-center"
                        name="color"
                        label=""
                        placeholder="Project Color"
                        type="color"
                        :invalid="form.errors.color_hash"
                    />
                    <base-input
                        v-model:value="form.title"
                        class="mb-3"
                        name="title"
                        label=""
                        placeholder="Project Title *"
                        type="text"
                        :invalid="form.errors.title"
                    />
                    <base-textarea
                        v-model:value="form.description"
                        class="mb-3"
                        name="description"
                        label=""
                        placeholder="Project Description"
                        :invalid="form.errors.description"/>

                </div>

            </template>
            <template #footer>
                <div class="d-flex flex-column w-100">
                    <div>
                        <button
                            type="submit"
                            class="w-100 btn btn-primary text-white px-4 text-white"
                        >
                            Create Project
                        </button>
                    </div>
                </div>
            </template>
        </base-modal>
    </div>
</template>

<script>
export default {
    name: "StoreProjectModal",
};
</script>

<script setup>
import {inject, ref} from "vue";
import BaseModal from "../BaseModal.vue";
import {useForm} from "@inertiajs/vue3";
import BaseInput from "../../Components/BaseComponents/BaseInput.vue";
import BaseTextarea from "@/Components/BaseComponents/BaseTextarea.vue";
import BaseColorSelect from "@/Components/BaseComponents/BaseColorSelect.vue";

const form = useForm({
    title: "",
    color_hash: null,
    description: "",
})

const route = inject("route");
const modal = ref(null);


const submit = () => {
    form.post(route("projects.store"), {
        onSuccess: () => {
            modal.value.hide();
            form.reset();
        },
    });
};
</script>

<style scoped></style>
