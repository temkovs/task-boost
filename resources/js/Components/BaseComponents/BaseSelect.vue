<template>
    <div>
        <label
            v-if="label"
            :for="name"
            class="form-label"
            :class="labelTextStyle"
        >{{ label }}</label
        >
        <div class="input-group">
            <div v-if="icon" class="input-group-prepend">
                <span class="input-group-text"><i :class="icon"></i></span>
            </div>
            <select
                v-model="_value"
                :class="[
                    { 'is-invalid': invalid },
                    pillSelect ? 'rounded-5' : 'rounded rounded-2',
                    customBorderStyle,
                    { 'text-secondary': _value === '' },
                ]"
                :disabled="disabled"
                class="form-select"
                @change="emit('change')"
            >
                <slot></slot>
            </select>
            <div class="invalid-feedback">{{ invalid }}</div>
        </div>
    </div>
</template>

<script>
export default {
    name: "BaseSelect",
};
</script>

<script setup>
import { computed } from "vue";

const props = defineProps({
    name: {
        type: [String, Number],
        default: "",
    },
    icon: {
        type: String,
        required: false,
        default: "",
    },
    value: {
        type: [String, Number, Array],
        default: "",
    },
    label: {
        type: String,
        default: "",
    },
    disabled: {
        type: Boolean,
        default: false,
    },
    invalid: {
        type: String,
        default: "",
    },
    pillSelect: {
        type: Boolean,
        default: false,
    },
    customBorderStyle: {
        type: String,
        default: "",
        required: false,
    },
    labelTextStyle: {
        type: String,
        required: false,
        default: "",
    },
});

const emit = defineEmits(["update:value", "change"]);
const _value = computed({
    get() {
        return props.value;
    },
    set(val) {
        emit("update:value", val);
    },
});
</script>

<style scoped></style>
