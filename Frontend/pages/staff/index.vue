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

  <div class="w-full flex ml-12">
    <NuxtLink class="px-3 py-2 bg-white font-medium text-gray-800 rounded-lg shadow-md border border-gray-300 hover:bg-gray-200" :to="`/staff/create_course`">Create Course</NuxtLink>
  </div>


  <div class="h-fit w-full px-10 mt-10 mb-16">
    <div class="h-full w-full p-16 flex flex-wrap gap-8  border border-dashed shadow-2xl">

      <div class="flex items-center justify-center h-full" v-for="course in courseResponse" :key="course.id">
        <div class="bg-white shadow-2xl p-6 rounded-2xl border-2 border-gray-50">
          <div class="flex flex-col">
            <div>
              <h2 class="font-bold text-gray-600 text-center">{{ course.title }}</h2>
            </div>
            <p class="text-xs text-gray-500 text-center">{{ course.duration / 60 }} Hour</p>
            <div class="w-full place-items-end text-right border-t-2 border-gray-100 mt-2">
              <NuxtLink class="text-indigo-600 text-xs font-medium" :to="`/staff/detail/course${course.id}`">View Course
              </NuxtLink>

            </div>
          </div>
        </div>

      </div>

    </div>

  </div>

  <!-- <div v-if="showTooltip" class="custom-tooltip" :style="{ top: tooltipTop + 'px', left: tooltipLeft + 'px', width: tooltipWidth }">
    {{ tooltipContent }}
  </div> -->
</template>
  
<script setup lang="ts">
definePageMeta({layout: "staff",
middleware: ['is-authorized','is-staff']})
import FullCalendar from '@fullcalendar/vue3'
import interactionPlugin from '@fullcalendar/interaction'
import timeGridPlugin from '@fullcalendar/timegrid'
import dayGridPlugin from '@fullcalendar/daygrid'
import dayjs from 'dayjs';

const calendarOptions = ref({
  plugins: [interactionPlugin, timeGridPlugin, dayGridPlugin],
  initialView: 'timeGridWeek',
  nowIndicator: true,
  editable: false,
  eventClick: handleEventClick,
  // eventMouseEnter: handleEventhover,
  // eventMouseLeave: handleEventLeave,
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

const allTimeslots = ref({})


// { title: 'ink bd', start: '2023-11-03 10:00:00', id: 123, color: 'purple', description: 'description for Repeating Event', eventClassNames: "test" },
//   { title: 'event 1', date: '2023-12-19' },
//   { title: 'event 1', date: '2023-12-19' },
//   { title: 'event 1', date: '2023-12-19' },
//   { title: 'event 2', date: '2023-09-12' }



calendarOptions.value.events = eventData;

const { data: timeslotResponse, error: timeslotError } = await useApiFetch(`api/staff/allTimeslots`, {});

if (timeslotResponse.value) {

  allTimeslots.value = timeslotResponse.value;

  for (const event in allTimeslots.value) {

    let temp = {
      title: allTimeslots.value[event].title,
      start: allTimeslots.value[event].datetime,
      uid: allTimeslots.value[event].id,
      datestore: allTimeslots.value[event].datetime,
      type: allTimeslots.value[event].type,

    }

    if (dayjs(allTimeslots.value[event].datetime).day() == 0) {
      temp["color"] = 'red';
    }

    if (dayjs(allTimeslots.value[event].datetime).day() == 1) {
      temp["color"] = 'yellow';
    }

    if (dayjs(allTimeslots.value[event].datetime).day() == 2) {
      temp["color"] = 'pink';
    }

    if (dayjs(allTimeslots.value[event].datetime).day() == 3) {
      temp["color"] = 'green';
    }

    if (dayjs(allTimeslots.value[event].datetime).day() == 4) {
      temp["color"] = 'orange';
    }

    if (dayjs(allTimeslots.value[event].datetime).day() == 5) {
      temp["color"] = 'blue';
    }

    if (dayjs(allTimeslots.value[event].datetime).day() == 6) {
      temp["color"] = 'purple';
    }

    eventData.value.push(temp);


  }


}



// tooltip
// const showTooltip = ref(false);
// const tooltipContent = ref('');
// const tooltipTop = ref(0);
// const tooltipLeft = ref(0);
// const tooltipWidth = ref<any>(0);


async function handleEventClick(arg) {
  await navigateTo(`/staff/detail/timeslot${arg.event.extendedProps.uid}`);
}

// function handleEventhover(event) {
//   showTooltip.value = true;
//   tooltipContent.value = event.event.title; // Customize the content as needed

//   // Calculate content width (assuming tooltipContent.value is a string)
//   const contentWidth = tooltipContent.value.length * 12

//   // Set a maximum width based on the viewport size
//   const viewportWidth = window.innerWidth;
//   const maxWidthPercentage = 0.8; // You can adjust this as needed (e.g., 0.8 for 80% of the viewport width)
//   const maxWidth = viewportWidth * maxWidthPercentage;

//   // Set the tooltip's width dynamically based on content width and maximum width
//   tooltipWidth.value = contentWidth > maxWidth ? `${maxWidth}px` : 'auto';

//   tooltipTop.value = event.jsEvent.pageY;
//   tooltipLeft.value = event.jsEvent.pageX;
// }

// function handleEventLeave() {
//   showTooltip.value = false;
// };

// all Courses
const { data: courseResponse, error: courseError } = await useApiFetch("api/staff/allCourses", {});

if (courseResponse.value) {
  
}


// Create Course
const showCreateCourse = ref(false)

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