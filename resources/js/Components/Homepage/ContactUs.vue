<template>
    <section id="contact" class="bg-secondary custom-scroll-margin-top">
        <div
            class="container d-flex justify-content-center align-items-center py-5 text-dark"
        >
            <div
                class="col-12 col-xxl-12 row mx-auto px-0 d-flex align-items-center"
            >
                <div
                    class="order-1 order-lg-0 col-12 col-md-12 col-lg-7 col-xl-6 px-0 d-flex flex-column"
                >
                    <div
                        class="fs-3 mb-3 fw-bold"
                    > Do you need additional guidance?
                    </div>
                    <div class="mb-3 mb-sm-5">
                        Our team is here to provide the support you're looking for. <br class="d-none d-lg-flex">
                        Whether you have questions, need advice, or seek assistance. <br class="d-none d-lg-flex">
                        Your success is our priority!
                    </div>
                    <div class="d-flex justify-content-start align-items-start row">
                        <div
                            v-for="(contact, i) in contacts"
                            :key="i"
                            class=" col col-lg-5"
                        >
                            <div class="small opacity-75 mb-2 mb-sm-3 mt-4 mt-sm-0">{{ contact.title }}</div>
                            <div class="d-flex align-items-center">
                                <i
                                    class="me-2 fa text-primary fa-2x"
                                    :class="contact.icon"
                                />
                                <a
                                    v-if="contact.phone"
                                    class="text-dark text-decoration-none"
                                    :href="'tel:' + contact.phone"
                                >{{ contact.phone }}</a
                                >
                                <a
                                    v-if="contact.email"
                                    class="text-dark text-decoration-none"
                                    :href="'mailto:' + contact.email"
                                >{{ contact.email }}</a
                                >
                            </div>
                        </div>
                    </div>
                </div>
                <div
                    class="order-0 order-lg-1 col-12 col-lg-5 col-xl-6 px-0 d-flex justify-content-center justify-content-lg-end mb-5 mb-lg-0"
                >
                    <div class="col-11 col-sm-9 col-md-6 col-lg-12">
                        <div class="ratio ratio-2048x1336">
                            <img
                                src="/images/homepage/contact-illustration.jpeg"
                                alt="Office Work"
                                class="object-fit-contain object-position-right"
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
    name: "ContactUs",
};
</script>

<script setup>

const contacts = [
    {
        title: "Call Us",
        icon: "fa-phone",
        alt: "Phone icon",
        phone: "+38970222222",
    },
    {
        title: "Send a Message",
        icon: "fa-envelope",
        alt: "Envelope icon",
        email: "task_boost@gmail.com",
    },
];
</script>

<style scoped>
@media (min-width: 992px) {
    .object-position-right {
        object-position: right !important;
    }
}

@media (max-width: 575.98px) {
    .custom-font-size-sm-screen {
        font-size: 14px !important;
    }

    .custom-dimensions-sm-screen {
        width: 19px !important;
        height: 15px !important;
    }
}

.custom-scroll-margin-top {
    scroll-margin-top: 7.2rem;
}
</style>
