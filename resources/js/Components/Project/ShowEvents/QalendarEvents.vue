<template>
    <Qalendar
        :events="eventsArr"
        :selected-date="selectedDate ? new Date(selectedDate) : new Date()"
        :config="config"
        @edit-event="handleEdit"
        @delete-event="handleDelete"
        @event-was-dragged="handleDrag"
        @event-was-resized="handleResize"
        @updated-period="handleUpdatedPeriod"
        @updated-mode="handleUpdatedMode"
        class="custom-width"
        :class="{ 'custom-height' : !modeValue || modeValue === 'month' }"
    >
        <template #customCurrentTime>
            <div
                :style="{
                        height: '0.5px',
                        backgroundColor: '#02161C',
                        position: 'relative',
                    }"
            >
                <div
                    :style="{
                            position: 'absolute',
                            left: '-7px',
                            top: '-5px',
                            height: '10px',
                            width: '10px',
                            backgroundColor: '#02161C',
                            borderRadius: '50%',
                        }"
                ></div>
            </div>
        </template>
    </Qalendar>
</template>

<script>
export default {
    name: "QalendarEvents"
}
</script>

<script setup>
import {Qalendar} from "qalendar";
import "qalendar/dist/style.css";
import {router, useForm} from "@inertiajs/vue3";
import {onBeforeMount, ref, watch} from "vue";
import {eventsColors} from "@/Colors.js";
import {Modal} from "bootstrap";

const props = defineProps({
    project: {
        type: Object,
        default: null,
    },
    events: {
        type: Object,
        default: null,
    },
    selectedDate: {
        type: String,
        default: null,
    },
    mode: {
        type: String,
        default: "week",
    },
})

const config = {
    defaultMode: props.mode,
};

const modeValue = ref(props.mode);

const form = useForm({
    title: "",
    description: "",
    start_date: null,
    end_date: null,
    start_time: null,
    end_time: null,
    attendees: "",
    color: "",
    location: "",
});

let eventsArr = ref([]);

const getCalendarEventsArr = () => {
    if (!props.events) return;
    eventsArr.value = props.events.map(
        ({
             id,
             title,
             start_date,
             start_time,
             end_date,
             end_time,
             description,
             attendees,
             color,
             location,
         }) => {
            const eventTime =
                start_time && end_time
                    ? {
                        start: `${start_date} ${start_time}`,
                        end: `${end_date} ${end_time}`,
                    }
                    : {start: start_date, end: end_date};
            return {
                id: id.toString(),
                title,
                time: eventTime,
                description,
                with: attendees,
                color: color? eventsColors.find(item => item.hash_code === color).label : eventsColors[0].label,
                location,
                isEditable: true,
            };
        }
    );
};

onBeforeMount(() => {
    getCalendarEventsArr();
});

watch(
    () => props.events,
    () => {
        getCalendarEventsArr();
    },
    {deep: true}
);

const handleEdit = (e) => {
    const selectedEvent = props.events.find(
        ({id}) => id.toString() === e.toString()
    );
    if (!selectedEvent) return;
    const updateEventModal = new Modal(
        document.getElementById("updateEventModal")
    );
    document
        .getElementById("updateEventModal")
        .setAttribute("data-bs-event", JSON.stringify(selectedEvent));
    updateEventModal.show();
};

const handleDelete = (e) => {
    const selectedEvent = props.events.find(
        ({id}) => id.toString() === e.toString()
    );
    if (!selectedEvent) return;
    const deleteEventModal = new Modal(
        document.getElementById("deleteEventModal")
    );
    document
        .getElementById("deleteEventModal")
        .setAttribute("data-bs-event", JSON.stringify(selectedEvent));
    deleteEventModal.show();
};

const handleEvent = (e, form) => {
    const {start, end} = e.time;
    const [start_date, start_time] = start.split(" ");
    const [end_date, end_time] = end.split(" ");
    const selectedEvent = props.events.find(
        ({id}) => id.toString() === e.id.toString()
    );
    const {title, description, attendees, color, location} = selectedEvent;

    form.start_date = start_date;
    form.start_time = start_time;
    form.end_date = end_date;
    form.end_time = end_time;
    form.title = title;
    form.description = description;
    form.attendees = attendees;
    form.color = color;
    form.location = location;

    return selectedEvent.id;
};

const handleDrag = (e) => {
    const selectedEventId = handleEvent(e, form);
    form.put(route("project.events.update", [props.project, selectedEventId]),
        {preserveScroll: true, preserveState: true});
};

const handleResize = (e) => {
    const selectedEventId = handleEvent(e, form);
    form.put(route("project.events.update", [props.project, selectedEventId]),
        {preserveScroll: true, preserveState: true});
};

let mode = null;
const months = {
    Jan: "01",
    Feb: "02",
    Mar: "03",
    Apr: "04",
    May: "05",
    Jun: "06",
    Jul: "07",
    Aug: "08",
    Sep: "09",
    Oct: "10",
    Nov: "11",
    Dec: "12",
};

const handleUpdatedPeriod = (e) => {
    const start = formatDate(e.start);
    const end = formatDate(e.end);
    const difference =
        (new Date(end).getTime() - new Date(start).getTime()) /
        (1000 * 3600 * 24);
    mode = "";
    if (difference === 0) {
        mode = "day";
    }
    if (difference === 6) {
        mode = "week";
    }
    if (difference >= 30) {
        mode = "month";
    }
    router.get(route("project.events.index", [props.project, {mode, start, end}]), {}, {
        preserveScroll: true,
        preserveState: true,
    });
};
const handleUpdatedMode = (e) => {
    const {period} = e;
    const start = formatDate(period.start);
    const end = formatDate(period.end);
    const {mode} = e;
    router.get(route("project.events.index", [props.project, {mode, start, end}]), {}, {
        preserveScroll: true,
        preserveState: true,
    });
};
const formatDate = (date) => {
    const dateArr = date.toString().split(" ");
    return `${dateArr[3]}-${months[dateArr[1]]}-${dateArr[2]}`;
};
</script>

<style scoped>
@media (min-width: 992px) {
    .custom-height {
        height: 67vh;
    }
}

@media (max-width: 420px) {
    .custom-width {
        width: 70vw;
    }
}
</style>
