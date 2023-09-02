<template>
    <div>
        <base-modal
            id="signInModal"
            :close-button="false"
            title="Sign In"
            @submit="submit"
            @instance="(_) => (modal = _)"
        >
            <template #default>
                <form>
                    <base-input
                        v-model:value="form.email"
                        class="mb-3"
                        name="email"
                        label=""
                        placeholder="E-mail"
                        type="email"
                        :invalid="form.errors.email"
                    />
                    <base-input
                        v-model:value="form.password"
                        class="position-relative mb-3"
                        name="password"
                        placeholder="Password"
                        label=""
                        type="password"
                        :invalid="form.errors.password"
                    />
                </form>
            </template>
            <template #footer>
                <div
                    class="d-flex w-100 justify-content-between align-items-center mb-4"
                >
                    <button
                        type="submit"
                        class="btn btn-primary text-white w-100 py-2 fw-light"
                        :disabled="form.processing"
                    >
                        Sign In
                    </button>
                </div>
                <div class="w-100 border-top border-1 border-DCDCDC mb-4"></div>
                <div class="col-12 text-center small">
                    <span class="text-dark">If you don't have an account</span>
                    <button
                        data-bs-toggle="modal"
                        data-bs-target="#registerModal"
                        class="text-primary bg-transparent border-0 fw-semibold"
                        @click="(e) => e.preventDefault()"
                    >
                        Register
                    </button>
                </div>
            </template>
        </base-modal>
    </div>
</template>

<script>
export default {
    name: "SignInModal",
};
</script>
<script setup>
import BaseModal from "./BaseModal.vue";
import {inject, ref} from "vue";
import {useForm} from "@inertiajs/vue3";
import BaseInput from "../Components/BaseComponents/BaseInput.vue";

const route = inject("route");
const modal = ref(null);

const form = useForm({
    email: "",
    password: "",
});

const submit = () => {
    form.post(route("login"), {
        onSuccess: () => {
            modal.value.hide();
            form.reset();
        },
        preserveState: true,
    });
};
</script>

<style scoped></style>
