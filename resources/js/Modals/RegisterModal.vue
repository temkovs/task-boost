<template>
    <div>
        <base-modal
            id="registerModal"
            :close-button="false"
            title="Register"
            @submit="submit"
            @instance="(_) => (modal = _)"
        >
            <template #default>
                <div>
                    <base-input
                        v-model:value="form.name"
                        class="mb-3"
                        name="name"
                        label=""
                        placeholder="Name & Surname *"
                        type="text"
                        :invalid="form.errors.name"
                    />
                    <base-input
                        v-model:value="form.email"
                        name="email"
                        label=""
                        placeholder="E-mail *"
                        class="mb-3"
                        type="email"
                        :invalid="form.errors.email"
                    />
                    <base-input
                        v-model:value="form.phone"
                        class="mb-3"
                        name="phone"
                        label=""
                        placeholder="Phone Number"
                        type="tel"
                        :invalid="form.errors.phone"
                    />
                </div>

                <base-input
                    v-model:value="form.password"
                    class-label="text-dark"
                    class="mb-3 position-relative"
                    name="password"
                    placeholder="Password *"
                    label=""
                    type="password"
                    :invalid="form.errors.password"
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
                            Register
                        </button>
                    </div>

                    <div class="w-100 border-top border-1 border-DCDCDC my-4"></div>
                    <div class="col-12 text-center small">
                        <span class="text-dark">Do you have an account?</span>
                        <button
                            data-bs-toggle="modal"
                            data-bs-target="#signInModal"
                            :data-bs-redirect="form.redirect"
                            class="text-primary bg-transparent border-0 fw-semibold"
                            @click="(e) => e.preventDefault()"
                        >
                            Sign In
                        </button>
                    </div>
                </div>
            </template>
        </base-modal>
    </div>
</template>

<script>
export default {
    name: "RegisterModal",
};
</script>

<script setup>
import BaseModal from "./BaseModal.vue";
import BaseInput from "../Components/BaseComponents/BaseInput.vue";
import { useForm } from "@inertiajs/vue3";
import { inject, ref } from "vue";

const form = useForm({
    name: "",
    email: "",
    phone: "",
    date_of_birth: "",
    gender: "",
    password: "",
});

const route = inject("route");
const modal = ref(null);


const submit = () => {
    form.post(route("register"), {
        onSuccess: () => {
            modal.value.hide();
            form.reset();
        },
    });
};
</script>

<style scoped></style>
