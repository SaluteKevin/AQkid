<template>
    <div class='app p-12 transform ease-in-out'>
        <FullCalendar v-click-outside="clickOutside" :options='calendarOptions' />
    </div>

    <div v-if="showCard" class="flex justify-center">
        <article
            class="w-96 relative flex flex-col justify-end overflow-hidden rounded-2xl px-8 pb-8 pt-40 max-w-sm mx-auto ">
            <img src="https://www.ecohome.net/media/articles/images/f2/9c/f29c921116e7b42501639bda77885d5051a5c8f1/thumbs/dOp8pM6ckCwo_1200x500_EE_R0wWf.jpg"
                alt="University of Southern California" class="absolute inset-0 h-full w-full object-cover">
            <div class="absolute inset-0 bg-gradient-to-t from-gray-900 via-gray-900/40"></div>
            <h3 id="day" class="z-10 text-3xl font-bold text-white">{{ day }}</h3>
            <h3 id="time" class="z-10 text-3xl font-bold text-white">{{ time }}</h3>
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

const day = ref('please select the time')
const time = ref<any>('')
const idCourse = ref(0)



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
      eventClick: handleEventClick,
    //   eventMouseEnter: handleEventhover,
    //   eventMouseLeave: handleEventLeave,

    events: ref([]),
    eventColor: '#378006'
})


const eventData = ref([
    { title: 'ink bd', start: '2023-11-03 10:00:00', uid: 123, color: 'purple', description: 'description for Repeating Event', eventClassNames: "test" },
    
])


import {useAuthStore} from "~/stores/useAuthStore";
    
const user = useAuthStore().user;

const {data: eventCourse, error: loginError } = await useApiFetch("api/student/getAllCourses", {});

if(eventCourse.value){
    console.log(eventCourse.value);
    
    for(const event in eventCourse.value){
        let ageRange = `${eventCourse.value[event].max_age}-${eventCourse.value[event].min_age}`;
        let temp = {
            title: eventCourse.value[event].title,
            start: eventCourse.value[event].start_datetime,
            uid: eventCourse.value[event].id,
            color: 'purple',
            description: ageRange,
            
        }
        console.log(temp);
        
        eventData.value.push(temp)
    
    }
    
}




if (eventData.value) {
    calendarOptions.value.events = eventData;

}

const showCard = ref(false);

function  handleEventClick (arg) {

    const daysOfWeek = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];
    day.value = daysOfWeek[new Date(arg.event.start).getDay()]
    time.value = formatTime(new Date(arg.event.start))
    idCourse.value = arg.event.extendedProps.uid
    showCard.value = true;

}

function formatTime(date) {
  const hours = date.getHours();
  const minutes = date.getMinutes();
  const seconds = date.getSeconds();
  const ampm = hours >= 12 ? 'PM' : 'AM';

  // Convert 24-hour format to 12-hour format
  const formattedHours = hours % 12 || 12;

  // Add leading zeros to minutes and seconds if needed
  const formattedMinutes = minutes < 10 ? `0${minutes}` : minutes;
  const formattedSeconds = seconds < 10 ? `0${seconds}` : seconds;

  // Combine the formatted time components
  const formattedTime = `${formattedHours}:${formattedMinutes}:${formattedSeconds} ${ampm}`;

  return formattedTime;
}

const clickOutside = () => {
  showCard.value = false;
};



</script>