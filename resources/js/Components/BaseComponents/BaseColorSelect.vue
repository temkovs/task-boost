<template>
    <div>
        <p class="fs-12-px mb-1">
            {{ isEventColor ? "Choose your event's color" : "Choose your project's color" }}
        </p>
        <select v-model="_value" :style="_value? 'background-color : ' + _value:''"
                class="w-100 rounded-3 py-2 ps-3">
            <option :value="null" class="pt-1"></option>
            <option v-for="(color, key) in (isEventColor ? eventsColors : projectColors)"
                    :key="key" :value="color.hash_code"
                    :style="{ backgroundColor: color.hash_code }"
            >
            </option>
        </select>
    </div>
</template>

<script>
export default {
    name: "BaseColorSelect",
};
</script>
<script setup>
import {computed, ref} from "vue";
import {projectColors, eventsColors} from '/resources/js/Colors.js';

const props = defineProps({
    name: {
        type: String,
        required: true,
    },
    value: {
        type: [String, Number],
        default: "",
    },
    invalid: {
        type: String,
        default: "",
    },
    label: {
        type: String,
        required: true,
    },
    disabled: {
        type: Boolean,
        default: false,
    },
    inline: {
        type: Boolean,
        default: false,
    },
    classLabel: {
        type: String,
        default: null,
    },
    isEventColor: {
        type: Boolean,
        default: false,
    }
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

const typeValue = ref(props.type);
</script>

<style scoped>
.fs-12-px {
    font-size: 12px;
}
</style>
