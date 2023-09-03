<template>
    <nav
        class="py-3 position-sticky sticky-top navbar navbar-dark navbar-expand-lg bg-dark"
    >
        <div class="position-relative container d-flex justify-content-between">
            <div>
                <button
                    v-if="user"
                    class="navbar-toggler me-2 border-0"
                    type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent"
                    aria-expanded="false"
                    aria-label="Toggle navigation"
                >
                    <span class="navbar-toggler-icon small"></span>
                </button>
                <Link class="navbar-brand" :href="route('homepage')">
                    <img
                        src="/images/layouts/navbar/task-boost-white-logo.svg"
                        height="47"
                        alt="Task Boost Logo"
                    />
                </Link>
            </div>
            <button
                v-if="!user"
                class="navbar-toggler"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent"
                aria-expanded="false"
                aria-label="Toggle navigation"
            >
                <span class="navbar-toggler-icon" style="color: white !important;"></span>
            </button>
            <div
                id="navbarSupportedContent"
                class="collapse navbar-collapse w-100"
            >
                <div
                    class="navbar-nav text-center ms-lg-auto d-flex justify-content-end mt-3 mt-lg-0"
                    :class="[{ 'w-100': user }]"
                >
                    <div
                        v-for="(navLink, i) in navLinks"
                        :key="navLink.name"
                        :class="{
                            'mb-3 mb-lg-0': i !== navLinks.length - 1,
                        }"
                        class="nav-item me-lg-5"
                    >
                        <a
                            :href="
                                route(navLink.href) +
                                (navLink.section ? navLink.section : '')
                            "
                            class="text-decoration-none text-white"
                        >
                            {{ navLink.name }}
                        </a>
                    </div>
                </div>
                <ul
                    v-if="!user"
                    class="navbar-nav d-flex align-items-center gap-4 gap-lg-0 py-3 py-lg-0"
                >
                    <li class="nav-item">
                        <button
                            data-bs-target="#signInModal"
                            data-bs-toggle="modal"
                            class="btn border-0 bg-transparent px-0 text-white"
                        >
                            Log In
                        </button>
                    </li>
                    <li class="nav-item ms-lg-5">
                        <button
                            data-bs-target="#registerModal"
                            data-bs-toggle="modal"
                            class="btn btn-primary text-white px-4 text-white"
                        >
                            Register
                        </button>
                    </li>
                </ul>
            </div>
            <div
                v-if="user"
                class="d-flex justify-content-end align-items-center custom-absolute-position dropdown me-2 me-md-0 mt-2 mt-lg-0"
            >
                <a
                    id="dropdownUser2"
                    href="#"
                    class="d-flex align-items-center link-dark text-decoration-none dropdown-toggle"
                    data-bs-display="static"
                    data-bs-toggle="dropdown"
                    aria-expanded="false"
                >
                    <div
                        class="rounded-circle me-2 bg-white d-flex align-items-center justify-content-center"
                        style="width: 2rem; height: 2rem"
                    >
                        <i class="fa fa-user text-dark"></i>
                    </div>
                    <strong class="d-none d-lg-block text-white pe-1">
                        {{ user.name }}
                    </strong>
                </a>
                <ul
                    class="dropdown-menu dropdown-menu-end text-small shadow"
                    aria-labelledby="dropdownUser2"
                >
                    <li>
                        <Link
                            as="button"
                            type="button"
                            class="dropdown-item"
                            :href="route('projects.index')"
                        >
                            <i class="fa fa-book me-2"></i>Projects
                        </Link>

                        <Link
                            method="post"
                            as="button"
                            type="button"
                            class="dropdown-item"
                            :href="route('logout')"
                        >
                            <i class="fa fa-sign-out me-2"></i>Log Out
                        </Link>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</template>

<script>
export default {
    name: "CustomNavbar"
}
</script>

<script setup>
import {inject} from "vue";
import { useBase } from "@/Mixins/useBase.js";

const {user} = useBase();
const route = inject("route");


const navLinks = [
    {
        name: "Home",
        href: "homepage",
    },
    {
        name: "Contact",
        href: "homepage",
        section: "#contact"
    },
];
</script>

<style scoped>
.navbar-toggler:focus {
    box-shadow: none !important;
}

@media (max-width: 991.98px) {
    .custom-absolute-position {
        position: absolute;
        right: 0;
        top: 0;
    }
}
</style>
