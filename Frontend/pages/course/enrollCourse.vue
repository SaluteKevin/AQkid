<template>
    <div class='app p-12 transform ease-in-out'>
        <FullCalendar :options='calendarOptions' />
    </div>

    <div class="flex justify-center">
        <article
            class="w-96 relative flex flex-col justify-end overflow-hidden rounded-2xl px-8 pb-8 pt-40 max-w-sm mx-auto ">
            <img src="https://www.ecohome.net/media/articles/images/f2/9c/f29c921116e7b42501639bda77885d5051a5c8f1/thumbs/dOp8pM6ckCwo_1200x500_EE_R0wWf.jpg"
                alt="University of Southern California" class="absolute inset-0 h-full w-full object-cover">
            <div class="absolute inset-0 bg-gradient-to-t from-gray-900 via-gray-900/40"></div>
            <h3 id="day" class="z-10 text-3xl font-bold text-white">{{ dayy }}</h3>
            <h3 id="time" class="z-10 text-3xl font-bold text-white">{{ timee }}</h3>
            <div class="z-10 gap-y-1 right-0 overflow-hidden text-sm leading-6 text-gray-300 p-2">
                <NuxtLink :to="`/course/confirmCourse${idCourse}`"
                    class="rounded-r-lg group relative px-8 py-1 overflow-hidden bg-white text-xl shadow my-6">
                    <div
                        class="absolute inset-0 w-3 bg-lime-600 transition-all duration-[250ms] ease-out group-hover:w-full rounded-r-lg">
                    </div>
                    <span class="relative text-black group-hover:text-white ">Confirm</span>
                </NuxtLink>
            </div>
        </article>
    </div>
</template>

<script setup lang="ts">

const dayy = ref('please select the time')
const timee = ref('')
const idCourse = ref(0)
const days = ['Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday']
const times = ['9.00', '10.00', '11.00', '12.00', '13.00', '14.00', '15.00', '16.00', '17.00']


import FullCalendar from '@fullcalendar/vue3'
import interactionPlugin from '@fullcalendar/interaction'
import timeGridPlugin from '@fullcalendar/timegrid'
import dayGridPlugin from '@fullcalendar/daygrid'


const calendarOptions = ref({
    plugins: [interactionPlugin, timeGridPlugin, dayGridPlugin],
    initialView: 'timeGridWeek',
    nowIndicator: false,
    editable: true,
    dayHeaderFormat: { weekday: 'long' },
    scrollTime: '10:00:00', // Set the scrollTime to 10:00 AM (optional)
    slotMinTime: '10:00:00', // Set the minimum time to 10:00 AM (optional)
    slotMaxTime: '18:00:00', // 
    slotLabelFormat: {
        hour: 'numeric',
        minute: '2-digit',
        omitZeroMinute: false,
    },
    contentHeight: 'auto',
    allDaySlot: false,

    //   dateClick: handleDateClick,
    //   eventClick: handleEventClick,
    //   eventMouseEnter: handleEventhover,
    //   eventMouseLeave: handleEventLeave,

    events: ref([]),
    eventColor: '#378006'
})


const eventData = ref([
    { title: 'ink bd', date: '2023-12-19', start: '2023-12-19T10:00:00', end: '2023-12-19T10:59:00', id: 123, color: 'purple', description: 'description for Repeating Event', eventClassNames: "test" },
    { title: 'event 1', date: '2023-12-19' },
    { title: 'event 1', date: '2023-12-19' },
    { title: 'event 1', date: '2023-12-19' },
    { title: 'event 2', date: '2023-09-12' }
])


if (eventData.value) {
    calendarOptions.value.events = eventData;

}




</script>