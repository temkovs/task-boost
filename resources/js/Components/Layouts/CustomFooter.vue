<template>
    <footer id="footer" class="border-top bg-black">
        <div class="container py-4 py-md-4 text-light">
            <div class="row d-flex justify-content-between align-items-center">
                <div class="col-12 col-md-6 col-lg-8 col-xxl-9 text-center text-md-start">
                    <Link :href="route('homepage')">
                        <img
                            src="/images/layouts/navbar/task-boost-white-logo.svg"
                            height="52"
                            alt="MasterClass logo"
                        />
                    </Link>
                </div>
                <div class="col-12 col-md-6 col-lg-4 col-xxl-3 text-center text-md-start">
                        <div class="mt-2 mt-md-0">
                           <pre class="mb-0 fw-lighter">C O N N E C T  Y O U R  I D E A S</pre>
                        </div>
                </div>
            </div>
        </div>
    </footer>
</template>

<script>
export default {
    name: "CustomFooter",
};
</script>
<script setup>
import { inject } from "vue";

const route = inject("route");
</script>

<style scoped></style>
