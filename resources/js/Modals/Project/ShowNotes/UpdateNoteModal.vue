<template>
    <div>
        <base-modal
            id="updateNoteModal"
            :close-button="false"
            title="Edit Note"
            @submit="submit"
            @onshow="onShow"
            @instance="(_) => (modal = _)"
        >
            <template #default>
                <div>
                    <QuillEditor
                        ref="myQuillEditor"
                        theme="snow"
                        toolbar="minimal"
                        :read-only="false"
                        @update:content="handleContentUpdate"
                    />
                </div>
            </template>
            <template #footer>
                <div class="d-flex flex-column w-100">
                    <div>
                        <button
                            type="submit"
                            class="w-100 btn btn-primary text-white px-4 text-white"
                        >
                            Edit Note
                        </button>
                    </div>
                </div>
            </template>
        </base-modal>
    </div>
</template>

<script>
export default {
    name: "UpdateNoteModal",
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
const myQuillEditor = ref(null);
const note = ref(null);

const onShow = (event) => {
    note.value = JSON.parse(event.relatedTarget.getAttribute("data-bs-note"));
    const delta = htmlToDelta(note.value.note);
    myQuillEditor.value.setContents(delta);
};

const handleContentUpdate = (delta) => {
    form.note = delta;
};

const getHTMLFromDelta = () => {
    if (!form.note) return "";
    const tempQuill = new Quill(document.createElement('div'));
    tempQuill.setContents(form.note);
    return tempQuill.root.innerHTML;
};

function htmlToDelta(htmlString) {
    const container = document.createElement('div');
    container.innerHTML = htmlString;
    document.body.appendChild(container);
    const quill = new Quill(container, { readOnly: true });
    const delta = quill.getContents();
    document.body.removeChild(container);

    return delta;
}

const submit = () => {
    form.note = getHTMLFromDelta()
    console.log(getHTMLFromDelta())
    form.put(route("project.notes.update", [props.project, note.value]), {
        onSuccess: () => {
            modal.value.hide();
            form.reset();
        },
    });
};
</script>

<style scoped></style>
