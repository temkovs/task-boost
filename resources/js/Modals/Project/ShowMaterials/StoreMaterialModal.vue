<template>
    <div>
        <base-modal
            id="storeMaterialModal"
            :close-button="false"
            title="Add Image"
            @submit="submit"
            @instance="(_) => (modal = _)"
        >
            <template #default>
                <div v-if="isImage && imageUrl" class="w-100 d-flex justify-content-center mb-5 mt-2">
                    <img
                        :src="imageUrl"
                        alt="Image Preview"
                        class="object-fit-contain shadow custom-max-width"
                    >
                </div>
                <div class="col-12">
                    <custom-file-picker
                        id="materialsUpload"
                        class="mb-3"
                        label=""
                        @change="(file) => (form.file = file) + previewFile(file)"
                        :error="form.errors.file"
                    />
                </div>
                <base-input
                    v-model:value="form.file_name"
                    class="position-relative"
                    name="file_name"
                    placeholder="File Name"
                    label=""
                    type="text"
                    :invalid="form.errors.file_name"
                />
            </template>
            <template #footer>
                <div class="d-flex flex-column w-100">
                    <div>
                        <button
                            type="submit"
                            class="w-100 btn btn-primary text-white px-4 text-white"
                            :disabled="form.processing"
                        >
                            Add Image
                        </button>
                    </div>
                </div>
            </template>
        </base-modal>
    </div>
</template>

<script>
export default {
    name: "StoreMaterialModal"
}
</script>

<script setup>
import {inject, ref} from "vue";
import BaseModal from "../../BaseModal.vue";
import {useForm} from "@inertiajs/vue3";
import BaseInput from "@/Components/BaseComponents/BaseInput.vue";
import CustomFilePicker from "@/Components/BaseComponents/CustomFilePicker.vue";

const route = inject("route");
const modal = ref(null);


const props = defineProps({
    project: {
        type: Object,
        default: null,
    },
})

const form = useForm({
    file: null,
    file_name: "",
})

const submit = () => {
    form.post(route("project.materials.store", props.project), {
        onSuccess: () => {
            modal.value.hide();
            form.reset();
            imageUrl.value = '';

            const fileInput = document.getElementById('materialsUpload');
            if (fileInput) {
                fileInput.value = '';
            }
        },
    });
};

const imageUrl = ref('');
const isImage = ref(false);

const previewFile = (file) => {
    const currentFile = file;
    if (currentFile) {
        if (currentFile.type.startsWith('image/')) {
            isImage.value = true;

            const reader = new FileReader();
            reader.onload = (e) => {
                imageUrl.value = e.target.result;
            };
            reader.readAsDataURL(currentFile);
        } else {
            isImage.value = false;
            imageUrl.value = '';
        }
    }
};
</script>

<style scoped>
.custom-max-width {
    max-width: 65%;
}

@media (min-width: 768px) {
    .custom-max-width {
        max-width: 55%;
    }
}
</style>
