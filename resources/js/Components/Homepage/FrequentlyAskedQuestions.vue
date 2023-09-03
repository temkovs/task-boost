<template>
    <section v-if="questions.length > 0" class="bg-light">
        <div class="container d-flex flex-column align-items-center py-5">
            <div class="fs-3 fw-bold text-center mb-5">Frequently Asked Questions</div>
            <div id="faq" class="col-12 col-xxl-11 accordion accordion-flush mb-5">
                <div
                    v-for="(item, i) in questions"
                    :key="i"
                    class="accordion-item rounded-3 mb-2 border border-0 bg-secondary"
                >
                    <div :id="'heading' + i" class="accordion-header">
                        <button
                            class="accordion-button rounded-3 shadow-none bg-secondary collapsed border border-0"
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
                        class="accordion-collapse collapse pt-4 bg-secondary"
                        :aria-labelledby="'heading' + i"
                        data-bs-parent="#faq"
                    >
                        <!-- eslint-disable vue/no-v-html -->
                        <div class="accordion-body pt-0">
                            <div class="col-12 col-lg-10 mb-2">
                                {{ item.description }}
                            </div>
                        </div>
                        <!--eslint-enable-->
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
        title: "Дали курсевите се достапни офлајн?",
        description: `Тоа зависи од самиот курс. Некои од курсевите имаат можност за преземање на материјалите,
         додека другите побаруваат интернет конекција за нивен пристап.`,
    },
    {
        title: "Дали постојат попусти за курсевите?",
        description: `Ние нудиме различни попусти и промоции на курсевите во тек на годината.
         Претплатете се или запратете нѐ на некоја од понудените социјални мрежи за секогаш да бидете во тек.`,
    },
    {
        title: "Како можам да го контактирам инструкторот на даден курс?",
        description: `Секој инструктор може да се контактира преку понудените информации за контакт на
         основната страна на курсот.`,
    },
    {
        title: "Дали видеата од курсот се достапни и по прегледувањето на истите?",
        description:
            "Да, видеата и целиот материјал содржан во курсот ви остануваат достапни неограничено.",
    },
];
</script>

<style scoped></style>
