<template>
    <div class="position-absolute custom-absolute-position">
        <i
            class="fa text-secondary cursor-pointer"
            :class="[
                { 'fa-eye': hasTypeText },
                { 'fa-eye-slash': !hasTypeText },
            ]"
            @click="
                hasTypeText = !hasTypeText;
                emit('toggle-password', hasTypeText ? 'text' : 'password');
            "
        >
        </i>
    </div>
</template>

<script>
export default {
    name: "TogglePasswordIcon",
};
</script>

<script setup>
import { ref } from "vue";

const emit = defineEmits(["toggle-password"]);
const hasTypeText = ref(false);
</script>

<style scoped>
.custom-absolute-position {
    top: 0.6rem;
    right: 2rem;
}
</style>
