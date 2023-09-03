<template>
    <section
        class="max-width-1600px mx-auto position-relative overflow-hidden bg-secondary"
    >
        <div class="w-100 d-lg-none">
            <div class="ratio ratio-21x9">
                <img
                    src="/images/homepage/girl-study.jpg"
                    alt="Hero Image"
                    style="object-fit: cover;"
                />
            </div>
        </div>
        <div class="container py-5 text-dark" style="z-index: 1000;">
            <div
                class="row d-flex justify-content-between align-items-center py-xl-2 py-xxl-5 my-lg-4"
            >
                <div
                    class="order-1 order-lg-0 col-12 col-sm-12 col-md-11 col-lg-7"
                >
                    <div class="display-4 fw-semibold">
                        <span class="text-primary">Create</span>
                        your first<br class="d-none d-lg-flex"/>
                        project and boost<br class="d-none d-lg-flex"/>
                        your <span class="text-primary"> productivity</span>
                    </div>
                    <div class="my-4">
                        Visualize and connect ideas while achieving superior
                        <br class="d-none d-lg-flex"/>
                        self-organization through intuitive task management,
                        <br class="d-none d-lg-flex"/>
                        interactive mind maps, dynamic calendars,
                        <br class="d-none d-lg-flex"/>
                        and seamless note-taking.
                    </div>
                    <Link
                        v-if="user"
                        :href="route('projects.index')"
                        class="btn btn-primary text-white rounded-3 px-3 py-2 fs-5"
                    >
                        Create Project
                    </Link>
                    <button
                        v-else
                        data-bs-target="#signInModal"
                        data-bs-toggle="modal"
                        class="btn btn-primary text-white rounded-3 px-3 py-2 fs-5"
                    >
                        Create Project
                    </button>
                </div>
                <div
                    class="order-0 order-lg-1 position-lg-absolute custom-right-position col-12 col-lg-7 d-flex justify-content-center justify-content-lg-end mb-4 mb-lg-0 d-none d-lg-flex"
                >
                    <div class="col-12 col-md-10 col-lg-11">
                        <div class="ratio ratio-4x6">
                            <img
                                src="/images/homepage/girl-study.jpg"
                                alt="Hero Image"
                                class="object-fit-contain"
                            />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
export default {
    name: "HeroSection",
};
</script>

<script setup>
import {inject} from "vue";
import {useBase} from "@/Mixins/useBase.js";

const {user} = useBase();
const route = inject("route");
</script>

<style scoped>
@media (min-width: 992px) {
    .position-lg-absolute {
        position: absolute;
    }

    .custom-right-position {
        right: -3%;
    }
}
</style>
