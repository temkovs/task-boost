<template>
    <div>
        <base-modal
            id="storeNoteModal"
            :close-button="false"
            title="Add Note"
            @submit="submit"
            @instance="(_) => (modal = _)"
        >
            <template #default>
                <QuillEditor
                    style="min-height: 200px"
                    ref="myQuillEditor"
                    theme="snow"
                    toolbar="minimal"
                    :read-only="false"
                    @update:content="handleContentUpdate"
                />
            </template>
            <template #footer>
                <div class="d-flex flex-column w-100">
                    <div>
                        <button
                            type="submit"
                            class="w-100 btn btn-primary text-white px-4 text-white"
                        >
                            Add Note
                        </button>
                    </div>
                </div>
            </template>
        </base-modal>
    </div>
</template>

<script>
export default {
    name: "StoreNoteModal",
};
</script>

<script setup>
import {inject, ref} from "vue";
import BaseModal from "../../BaseModal.vue";
import {useForm} from "@inertiajs/vue3";
import { QuillEditor } from '@vueup/vue-quill'
import { Quill } from "@vueup/vue-quill";
import '@vueup/vue-quill/dist/vue-quill.snow.css';
const route = inject("route");
const modal = ref(null);


const props = defineProps({
    project: {
        type: Object,
        default: null,
    },
})

const form = useForm({
    note: "",
})



const handleContentUpdate = (delta) => {
    form.note = delta;
};

const getHTMLFromDelta = () => {
    if (!form.note) return "";
    const tempQuill = new Quill(document.createElement('div'));
    tempQuill.setContents(form.note);
    return tempQuill.root.innerHTML;
};

const submit = () => {
    form.note = getHTMLFromDelta()
    form.post(route("project.notes.store", props.project), {
        onSuccess: () => {
            modal.value.hide();
            form.reset();
        },
    });
};
</script>

<style scoped></style>
