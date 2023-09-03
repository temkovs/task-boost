<template>
    <section class="bg-light">
        <div
            class="container py-5 text-dark d-flex flex-column align-items-center"
        >
            <div class="fs-3 fw-bold text-center mb-2">Our Success Formula</div>
            <div class="col-12 col-lg-10 col-xl-8 text-center mb-5 fs-5">
                Discover the elements that set us apart and propel you towards <br class="d-none d-md-block">
                productivity greatness.
            </div>
            <div class="row d-flex justify-content-center align-items-start">
                <div
                    v-for="(step, i) in steps"
                    :key="step.title"
                    class="col-12 col-md-4 d-flex justify-content-center mb-5 mb-md-3"
                    :class="{ 'mb-3 mb-lg-0': i !== steps.length - 1 }"
                >
                    <div class="col-12 col-xxl-11">
                        <div class="d-flex flex-column">
                            <div class="ratio ratio-1x1 w-25 mx-auto">
                                <img
                                    :src="
                    '/images/homepage/' + step.image
                "
                                    :alt="step.alt"
                                    class="object-fit-contain"
                                />
                            </div>
                            <div class="text-center mt-3">
                                <div class="fs-4 mb-3 text-primary fw-bold">{{ step.title }}</div>
                                <div>
                                    {{ step.paragraph }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
export default {
    name: "OurSuccessFormula",
};
</script>

<script setup>

const steps = [
    {
        title: `Connect Your Ideas`,
        paragraph: `Effortlessly link concepts, inspiring fresh perspectives and boosting innovative thinking in your daily tasks.`,
        image: "connection.png",
        alt: "Step 1 image",
    },
    {
        title: `Be Organized`,
        paragraph: `Sync tasks, calendars, notes, and mind maps for an integrated and streamlined approach to managing your workload.`,
        image: "work.png",
        alt: "Step 2 image",
    },
    {
        title: `Achieve Mastery`,
        paragraph: `Seamlessly manage tasks with user-friendly tools, empowering your journey to masterful productivity and success.`,
        image: "leader.png",
        alt: "Step 3 image",
    },
];
</script>

<style scoped></style>
