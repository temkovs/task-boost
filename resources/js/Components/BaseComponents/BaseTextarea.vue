<template>
    <div>
        <label v-if="label" :for="name">{{ label }}</label>
        <textarea
            :id="name"
            v-model="_value"
            :placeholder="placeholder"
            :class="{ 'is-invalid': invalid }"
            class="form-control rounded-3 custom-min-height p-3"
            @keyup="emit('keyup')"
            @keydown.enter="emit('onEnter')"
        ></textarea>
        <div class="invalid-feedback">
            {{ invalid }}
        </div>
    </div>
</template>

<script>
export default {
    name: "BaseTextarea",
};
</script>

<script setup>
import { computed } from "vue";

const props = defineProps({
    name: {
        type: String,
        required: true,
    },
    value: {
        type: String,
        default: "",
    },
    label: {
        type: String,
        default: "",
    },
    placeholder: {
        type: String,
        default: "",
    },
    invalid: {
        type: String,
        default: "",
    },
});

const emit = defineEmits(["update:value", "keyup", "onEnter"]);
const _value = computed({
    get() {
        return props.value;
    },
    set(val) {
        emit("update:value", val);
    },
});
</script>

<style scoped>
textarea::placeholder {
    color: #8b8b8b;
    font-size: 12px;
}

.custom-min-height {
    min-height: 150px;
}
</style>
