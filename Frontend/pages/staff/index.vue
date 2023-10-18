<template>
  <div class="relative flex py-5 items-center w-full px-10 mt-4">
    <div class="flex-grow border-t border-gray-400"></div>
    <span class="flex-shrink mx-4 text-4xl text-gray-400">Classes Calendar</span>
    <div class="flex-grow border-t border-gray-400"></div>
  </div>

  <div class='app p-12 transform ease-in-out m-4 shadow-2xl border rounded-2xl'>
    <FullCalendar :options='calendarOptions' />
  </div>

  <div class="relative flex py-5 items-center w-full px-10">
    <div class="flex-grow border-t border-gray-400"></div>
    <span class="flex-shrink mx-4 text-gray-400">Course Section</span>
    <div class="flex-grow border-t border-gray-400"></div>
  </div>
  <div class="h-screen w-full px-10">
    <div class="h-full w-full p-16 flex flex-wrap justify-center gap-8 overflow-y-auto border border-dashed shadow-2xl">
      <div v-for="course in courseResponse" :key="course.id"
      class="flex flex-col py-8 px-4 h-64 w-56 space-y-6 rounded-2xl bg-gray-100 transition duration-300 hover:rotate-6 hover:bg-gray-300  shadow-lg">

        <header class="text-center text-small font-extrabold text-gray-600">2021.09.01</header>

        <div >
          <p class="text-center text-xl font-extrabold text-gray-900">{{course.title}}</p>
          <p class="text-center text-xl font-extrabold text-[#FE5401]">{{course.duration / 60}} Hour</p>
        </div>

        <footer class=" flex justify-center">
          <button
            class="flex items-baseline gap-2 rounded-lg bg-[#FE5401] px-4 py-2.5 text-xl font-bold text-white hover:bg-[#FF7308]">
            <span>Start</span>
            <i class="fas fa-hand-peace text-xl"></i>
          </button>
        </footer>


      </div>

  </div>


  


  </div>

  <div class="relative flex py-5 items-center w-full px-10">
    <div class="flex-grow border-t border-gray-400"></div>
    <span class="flex-shrink mx-4 text-gray-400">Course Section</span>
    <div class="flex-grow border-t border-gray-400"></div>
  </div>


  <!-- <div v-if="showTooltip" class="custom-tooltip" :style="{ top: tooltipTop + 'px', left: tooltipLeft - 50 + 'px' }">
    {{ tooltipContent }}
  </div> -->
</template>
  
<script setup lang="ts">
definePageMeta({ layout: "staff" })
import FullCalendar from '@fullcalendar/vue3'
import interactionPlugin from '@fullcalendar/interaction'
import timeGridPlugin from '@fullcalendar/timegrid'
import dayGridPlugin from '@fullcalendar/daygrid'

const calendarOptions = ref({
  plugins: [interactionPlugin, timeGridPlugin, dayGridPlugin],
  initialView: 'timeGridWeek',
  nowIndicator: true,
  editable: true,
  dateClick: handleDateClick,
  eventClick: handleEventClick,
  eventMouseEnter: handleEventhover,
  eventMouseLeave: handleEventLeave,
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

})


const eventData = ref([
  { title: 'ink bd', start: '2023-11-03 10:00:00', id: 123, color: 'purple', description: 'description for Repeating Event', eventClassNames: "test" },
  { title: 'event 1', date: '2023-12-19' },
  { title: 'event 1', date: '2023-12-19' },
  { title: 'event 1', date: '2023-12-19' },
  { title: 'event 2', date: '2023-09-12' }
])


if (eventData.value) {
  calendarOptions.value.events = eventData;

}


// tooltip
const showTooltip = ref(false);
const tooltipContent = ref('');
const tooltipTop = ref(0);
const tooltipLeft = ref(0);


function handleDateClick(arg) {
  // alert('date click! ' + arg.dateStr);
  eventData.value.push({ title: 'test', date: '2023-12-19' })
  // calendarOptions.value.events.push({title: 'test', date: '2023-12-19'})
}

function handleEventClick(arg) {
  alert(arg);
  console.log(arg)
}

function handleEventhover(event) {
  showTooltip.value = true;
  tooltipContent.value = event.event.title; // Customize the content as needed
  tooltipTop.value = event.jsEvent.pageY;
  tooltipLeft.value = event.jsEvent.pageX;
}

function handleEventLeave() {
  showTooltip.value = false;
};

// all Courses
const { data: courseResponse, error: courseError } = await useApiFetch("api/staff/allCourses", {});

if (courseResponse.value) {
  console.log(courseResponse.value)
}

</script>




  
<style scoped>
.app {
  font-family: Arial, Helvetica Neue, Helvetica, sans-serif;
  font-size: 14px;
}

.test {
  font-size: xx-large;
}

.custom-tooltip {
  position: absolute;
  background-color: white;
  border: 1px solid #ccc;
  padding: 10px;
  z-index: 999;

}
</style>