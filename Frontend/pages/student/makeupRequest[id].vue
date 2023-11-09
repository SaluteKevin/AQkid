<template>
    <div class='app bg-white p-12 transform ease-in-out shadow-2xl border rounded-2xl mt-24 mx-12'>
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
            <div class="relative inline-flex group h-[50px]">
                <div
                    class="absolute transitiona-all duration-1000 opacity-70 -inset-px bg-gradient-to-r from-[#44BCFF] via-[#FF44EC] to-[#FF675E] rounded-xl blur-lg group-hover:opacity-100 group-hover:-inset-1 group-hover:duration-200 animate-tilt">
                </div>
                <a href="#" 
                    class="relative inline-flex items-center justify-center px-8 py-4 text-lg font-bold text-white transition-all duration-200 bg-gray-900 font-pj rounded-xl focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-900"
                    role="button">Request Join class
                </a>
            </div>
            
        </div>
    </div>
</template>

<script setup lang="ts">
definePageMeta({
    layout: "student",
    middleware: ['is-authorized', 'is-student']
})

import { useAuthStore } from "~/stores/useAuthStore";
const user = useAuthStore().user;

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


</script>