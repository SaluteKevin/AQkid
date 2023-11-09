<template>
    <div class=" px-[200px] shadow-2xl pb-12 pt-[100px]">
        <div class="text-2xl mb-4">Create Timeslot form</div>

        <VueDatePicker class="text-black mb-4" v-model="date" :is-24="true" enable-seconds hours-increment="1"
            minutes-increment="0" seconds-increment="0" placeholder="Select Date" no-minutes-overlay no-seconds-overlay
            :min-time="{ hours: 10, minutes: 0, seconds: 0 }" :max-time="{ hours: 17, minutes: 0, seconds: 0 }"
            :start-time="{ hours: 10, minutes: 0, seconds: 0 }" :state="datePickerState" :disabled-week-days="[1]">
        </VueDatePicker>






        <div>
            <p class="text-red-500 font-normal">
                {{ showError }}
            </p>
            <button v-on:click="submitNewClass" class="
w-full
bg-primary
rounded
border border-primary
p-3
transition
hover:bg-gray-300
">
                Request New Class
            </button>
        </div>
    </div>
    <div class='app bg-white p-12 transform ease-in-out shadow-2xl border rounded-2xl mt-8 mx-12'>
        <FullCalendar :options='calendarOptions' />
    </div>

    <div class="min-h-[300px] flex justify-center items-center px-[200px]">
        <div v-click-outside="clickOutside" v-if="timeslotShow" ref="scrollCourse"
            class=" p-6 border border-gray-200 rounded-lg w-full flex justify-between items-center">
            <div>
                <h5 class="mb-2 text-2xl font-bold  text-gray-900">{{ timeslotSelected.title }}</h5>

                <p class="mb-3 font-bold text-gray-700 ">Date: {{ timeslotSelected.start }}</p>
                <p class="mb-3 font-bold text-gray-700 ">Type: {{ timeslotSelected.type }}</p>
            </div>
            <div class="text-red-500">{{ showJoinError }}</div>
            <div class="relative inline-flex group h-[50px]">
                <div
                    class="absolute transitiona-all duration-1000 opacity-70 -inset-px bg-gradient-to-r from-[#44BCFF] via-[#FF44EC] to-[#FF675E] rounded-xl blur-lg group-hover:opacity-100 group-hover:-inset-1 group-hover:duration-200 animate-tilt">
                </div>
                <button v-if="!timeslotSelected.author" v-on:click="joinClass"
                    class="relative inline-flex items-center justify-center px-8 py-4 text-lg font-bold text-white transition-all duration-200 bg-gray-900 font-pj rounded-xl focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-900"
                    role="button">Request Join class
                </button>
            </div>

        </div>
    </div>

    <div class="relative flex py-5 items-center w-full px-10 mt-4">
        <div class="flex-grow border-t border-gray-400"></div>
        <span class="flex-shrink mx-4 text-4xl text-gray-400">Class Request Histories</span>
        <div class="flex-grow border-t border-gray-400"></div>
    </div>
    <div class="min-h-[300px] w-full px-[100px] flex flex-col gap-4">
        <Makeup v-for="histo in histoResponse" :makeup="histo"></Makeup>
    </div>
</template>

<script setup lang="ts">
definePageMeta({
    layout: "student",
    middleware: ['is-authorized', 'is-student']
})

import { useAuthStore } from "~/stores/useAuthStore";
const user = useAuthStore().user
const route = useRoute();

import FullCalendar from '@fullcalendar/vue3'
import interactionPlugin from '@fullcalendar/interaction'
import timeGridPlugin from '@fullcalendar/timegrid'
import dayGridPlugin from '@fullcalendar/daygrid'

const calendarOptions = ref({
    plugins: [interactionPlugin, timeGridPlugin, dayGridPlugin],
    initialView: 'timeGridWeek',
    nowIndicator: true,
    editable: false,
    //   dateClick: handleDateClick,
    eventClick: handleEventClick,
    //   eventMouseEnter: handleEventhover,
    //   eventMouseLeave: handleEventLeave,
    contentHeight: 'auto',
    events: ref([]),
    scrollTime: '10:00:00', // Set the scrollTime to 10:00 AM (optional)
    slotMinTime: '10:00:00', // Set the minimum time to 10:00 AM (optional)
    slotMaxTime: '18:00:00', // 
    slotLabelFormat: {
        hour: 'numeric',
        minute: '2-digit',
        omitZeroMinute: false,
    },
    allDaySlot: false,
    initialDate: ref(),
    headerToolbar: {
        left: 'prev,next today',
        center: 'title',
        right: 'dayGridMonth,timeGridWeek,timeGridDay',
    },


})

const eventData = ref([])

calendarOptions.value.events = eventData;

async function handleEventClick(arg) {

    let temp = {
        title: arg.event.title,
        start: arg.event.extendedProps.datestore,
        uid: arg.event.extendedProps.uid,
        type: arg.event.extendedProps.type,
        author: arg.event.extendedProps.author,

    };

    timeslotSelected.value = temp;
    await scrollToCourse();

}

async function scrollToCourse() {

    await setTimeslotToShow();

    if (scrollCourse.value) {
        const element = scrollCourse.value.getBoundingClientRect();

        // Scroll to the element with smooth animation
        window.scrollTo({
            top: element.top + window.scrollY - 100,
            behavior: 'smooth',
        });
    }

};

async function setTimeslotToShow() {
    timeslotShow.value = !timeslotShow.value;
}

function clickOutside() {
    timeslotShow.value = false;
}

const timeslotSelected = ref();
const timeslotShow = ref(false);
const scrollCourse = ref();

// load classes
const { data: classesResponse, error: classesError } = await useApiFetch(`api/student/getMakeUpClasses/${user.value.id}`, {});

if (classesResponse.value) {




    for (const event in classesResponse.value) {

        let temp = {
            title: classesResponse.value[event].title,
            start: classesResponse.value[event].datetime,
            uid: classesResponse.value[event].id,
            datestore: classesResponse.value[event].datetime,
            type: classesResponse.value[event].type,
            author: classesResponse.value[event].author

        }

        if (classesResponse.value[event].author == true) {
            temp["color"] = 'gray';

        }
        else {
            if (classesResponse.value[event].type === "REGULAR") {
                temp["color"] = 'green';
            }

            if (classesResponse.value[event].type === "MAKEUP") {
                temp["color"] = 'purple';
            }


        }

        eventData.value.push(temp);


    }


}

else {
    if (classesError.value) {

    }
}


// enroll class
const showJoinError = ref('')
async function joinClass() {

    const { data: joinResponse, error: joinError } = await useApiFetch(`api/student/makeJoinClass/${user.value.id}/${route.params.id}/${timeslotSelected.value.uid}`, {
        method: "POST"
    });

    if (joinResponse.value) {
        alert("You have already request a joining class")
    }

    else {
        if (joinError.value) {
            showJoinError.value = joinError.value.data.message
        }
    }
}


// load getMakeUpHistories

const { data: histoResponse, error: histoError } = await useApiFetch(`api/student/getMakeUpHistories/${user.value.id}/${route.params.id}`, {})

if (histoResponse.value) {
    console.log(histoResponse.value)
}


// datepicker

import VueDatePicker from '@vuepic/vue-datepicker';
import '@vuepic/vue-datepicker/dist/main.css'
import dayjs from 'dayjs';

const date = ref();
const datePickerState = ref<any>(null);
const showError = ref("");

async function submitNewClass() {

    const { data: newClassResponse, error: newClassError } = await useApiFetch(`api/student/makeMakeUpClass/${user.value.id}/${route.params.id}`, {
        method: "POST",
        body: {
            datetime: dayjs(date.value).format('YYYY-MM-DD HH:mm:ss')
        }
    });

    if (newClassResponse.value) {

        alert('You have requested to create a new class')
        window.location.reload();


    } else {

        if (newClassError.value) {

            datePickerState.value = false

            showError.value = "";

            showError.value = newClassError.value.data.message;

        }

    }

}

</script>