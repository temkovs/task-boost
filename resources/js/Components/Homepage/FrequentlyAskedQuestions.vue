<template>
    <section v-if="questions.length > 0" class="bg-light">
        <div class="container d-flex flex-column align-items-center py-5">
            <div class="fs-3 fw-bold text-center mb-5">Frequently Asked Questions</div>
            <div id="faq" class="col-12 col-xxl-11 accordion accordion-flush mb-lg-3">
                <div
                    v-for="(item, i) in questions"
                    :key="i"
                    class="accordion-item rounded-3 mb-2 border border-0 bg-secondary"
                >
                    <div :id="'heading' + i" class="accordion-header">
                        <button
                            class="accordion-button rounded-3 shadow-none bg-secondary collapsed"
                            type="button"
                            data-bs-toggle="collapse"
                            :data-bs-target="'#collapse' + i"
                            aria-expanded="false"
                            :aria-controls="'collapse' + i"
                        >
                            {{ item.title }}
                        </button>
                    </div>
                    <div
                        :id="'collapse' + i"
                        class="accordion-collapse collapse  bg-secondary"
                        :aria-labelledby="'heading' + i"
                        data-bs-parent="#faq"
                    >
                        <div class="accordion-body pt-0">
                            <div class="col-12 col-lg-10 mb-2">
                                {{ item.description }}
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
    name: "FrequentlyAskedQuestions",
};
</script>
<script setup>
const questions = [
    {
        title: "Can I change the color of my project later on, and what is its purpose?",
        description: `Yes, you can change the color of your project at any time. Simply navigate to your project settings and select a new color. The project color feature was introduced to offer a sense of personalization, making your project more appealing and tailored to your preferences. If you don't choose a color when creating the project, it will default to the app's primary color, which is orange.`,
    },
    {
        title: "How can I delete a node on the mind map?",
        description: `To delete a node, simply right-click on the node of interest. A context menu will appear, offering various options. Select the "delete" option from this menu to remove the node.`,
    },
    {
        title: "How can I add images to my notes?",
        description: `Within the note's text editor, there are options to add image with pasting an image that you have copied.`,
    },
    {
        title: "If I delete a project, will all the data inside it be deleted as well?",
        description:
            "Yes, when you attempt to delete a project, the system will first display a modal asking if you're sure about the deletion. If you confirm by clicking \"yes\", the project along with all its contents will be permanently deleted.",
    },
];
</script>

<style scoped></style>
