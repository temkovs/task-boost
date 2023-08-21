import { usePage } from "@inertiajs/vue3";
import { computed } from "vue";

export function useBase() {
    const user = computed(() => usePage().props.user);

    return {
        user,
    };
}
