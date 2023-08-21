<template>
    <div>
        <base-modal
            id="registerModal"
            :close-button="false"
            title="Регистрирај се"
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
                        placeholder="Име и презиме *"
                        type="text"
                        :invalid="form.errors.name"
                    />
                    <base-input
                        v-model:value="form.email"
                        name="email"
                        label=""
                        placeholder="Е-пошта *"
                        class="mb-3"
                        type="email"
                        :invalid="form.errors.email"
                    />
                    <base-input
                        v-model:value="form.phone"
                        class="mb-3"
                        name="phone"
                        label=""
                        placeholder="Телефонски број"
                        type="tel"
                        :invalid="form.errors.phone"
                    />
                </div>

                <base-input
                    v-model:value="form.password"
                    class-label="text-dark"
                    class="mb-3 position-relative"
                    name="password"
                    placeholder="Лозинка *"
                    label=""
                    type="password"
                    :invalid="form.errors.password"
                />
                <div class="form-check mb-2">
                    <label
                        class="form-check-label text-dark"
                        for="agree-with-terms"
                    >
                        Ги прифаќам сите
                        <a
                            :href="route('homepage')"
                            target="_blank"
                        >
                            услови за користење
                        </a>
                    </label>
                    <input
                        id="agree-with-terms"
                        v-model="agree_with_terms"
                        class="form-check-input"
                        type="checkbox"
                    />
                </div>
                <div class="form-check">
                    <input
                        id="agree-with-videos"
                        v-model="wont_share_videos"
                        class="form-check-input"
                        type="checkbox"
                    />
                    <label
                        class="form-check-label text-dark"
                        for="agree-with-videos"
                    >
                        Се согласувам дека нема да го споделувам видео
                        материјалот со никого
                    </label>
                </div>
            </template>
            <template #footer>
                <div class="d-flex flex-column w-100">
                    <div>
                        <button
                            type="submit"
                            class="w-100 rounded-3 btn btn-primary text-white px-4 px-sm-5 py-2 fw-light mb-4"
                            :disabled="
                                form.processing ||
                                !agree_with_terms ||
                                !wont_share_videos
                            "
                        >
                            Регистрирај се
                        </button>
                    </div>

                    <div
                        class="w-100 border-top border-1 border-DCDCDC mb-4"
                    ></div>
                    <div class="col-12 text-center small">
                        <span class="text-dark">Веќе си член?</span>
                        <button
                            data-bs-toggle="modal"
                            data-bs-target="#signInModal"
                            :data-bs-redirect="form.redirect"
                            class="text-primary bg-transparent border-0 fw-semibold"
                            @click="(e) => e.preventDefault()"
                        >
                            Најави се
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

const agree_with_terms = ref(false);
const wont_share_videos = ref(false);

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
