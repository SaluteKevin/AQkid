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
  <div class="flex gap-8">
    <div class=" flex ml-12">
      <NuxtLink
        class="px-3 py-2 bg-white font-medium text-gray-800 rounded-lg shadow-md border border-gray-300 hover:bg-gray-200"
        :to="`/staff/create_course`">Create Course</NuxtLink>
    </div>

    <div class="relative text-left flex gap-3 items-center">
      <div>Filter : </div>
      <div>
        <button v-on:click="filter = !filter" type="button"
          class="inline-flex w-full justify-center gap-x-1.5 rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50"
          id="menu-button" aria-expanded="true" aria-haspopup="true">
          {{ filterSelect }}
          <svg class="-mr-1 h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
            <path fill-rule="evenodd"
              d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z"
              clip-rule="evenodd" />
          </svg>
        </button>
      </div>


      <div v-if="filter" v-click-outside="clickOutside"
        class="absolute  z-10 mt-2 w-56 origin-top-right rounded-md bg-white shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none"
        role="menu" aria-orientation="vertical" aria-labelledby="menu-button" tabindex="-1">
        <div class="py-1" role="none">
          <!-- Active: "bg-gray-100 text-gray-900", Not Active: "text-gray-700" -->
          <div v-on:click="selectFilter('All')" class="text-gray-700 block px-4 py-2 text-sm hover:bg-gray-300"
            role="menuitem" tabindex="-1" id="menu-item-0">All</div>
          <div v-on:click="selectFilter('Pending')" class="text-gray-700 block px-4 py-2 text-sm hover:bg-gray-300"
            role="menuitem" tabindex="-1" id="menu-item-1">Pending </div>
          <div v-on:click="selectFilter('Open')" class="text-gray-700 block px-4 py-2 text-sm hover:bg-gray-300"
            role="menuitem" tabindex="-1" id="menu-item-2">Open </div>
          <div v-on:click="selectFilter('Full')" class="text-gray-700 block px-4 py-2 text-sm hover:bg-gray-300"
            role="menuitem" tabindex="-1" id="menu-item-2">Full </div>
          <div v-on:click="selectFilter('Active')" class="text-gray-700 block px-4 py-2 text-sm hover:bg-gray-300"
            role="menuitem" tabindex="-1" id="menu-item-2">Active </div>
          <div v-on:click="selectFilter('Ended')" class="text-gray-700 block px-4 py-2 text-sm hover:bg-gray-300"
            role="menuitem" tabindex="-1" id="menu-item-2">ENDED </div>
        </div>
      </div>
    </div>

    <label
      class="relative bg-white min-w-sm max-w-2xl flex flex-col md:flex-row items-center justify-center border  px-2 rounded-2xl shadow-2xl focus-within:border-gray-300 w-1/2"
      for="search-bar">
      <input id="search-bar" placeholder="Course name" v-on:change="handleSearchCourse"
        class="px-6 py-2 w-full rounded-md flex-1 outline-none bg-white">
      <button
        class="w-full md:w-auto px-4 py-1 bg-black border-black text-white fill-white active:scale-95 duration-100 border will-change-transform overflow-hidden relative rounded-xl transition-all disabled:opacity-70">

        <div class="relative">

          <!-- Loading animation change opacity to display -->
          <div
            class="flex items-center justify-center h-3 w-3 absolute inset-1/2 -translate-x-1/2 -translate-y-1/2 transition-all">
            <svg class="opacity-0 animate-spin w-full h-full" xmlns="http://www.w3.org/2000/svg" fill="none"
              viewBox="0 0 24 24">
              <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4">
              </circle>
              <path class="opacity-75" fill="currentColor"
                d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
              </path>
            </svg>
          </div>

          <div class="flex items-center transition-all opacity-1 valid: "><span
              class="text-sm font-semibold whitespace-nowrap  mx-auto">
              Search
            </span>
          </div>

        </div>

      </button>
    </label>
  </div>



  <div class="h-fit w-full px-10 mt-10 mb-16">
    <div class="h-full w-full p-16 grid grid-cols-4 gap-6  border border-dashed shadow-2xl">

      <div class="flex items-center justify-center h-full" v-for="course in showCourse" :key="course.id">
        <div
          class="bg-white shadow-lg p-6 rounded-2xl w-full text-gray-500 border-2 border-gray-50 hover:bg-gray-200 hover:text-orange-500 hover:scale-105 duration-200">
          <div class="flex flex-col">
            <div>
              <h2 class="font-bold text-center">{{ course.title }}</h2>
            </div>
            <p v-if="course.status == 'OPEN'" class="text-xs text-center text-green-500">{{ course.status }}</p>
            <p v-if="course.status == 'PENDING'" class="text-xs text-center text-amber-500">{{ course.status }}</p>
            <p v-if="course.status == 'ENDED'" class="text-xs text-center text-gray-500">{{ course.status }}</p>
            <p v-if="course.status == 'ACTIVE'" class="text-xs text-center text-blue-500">{{ course.status }}</p>
            <p v-if="course.status == 'CANCELLED'" class="text-xs text-center text-red-500">{{ course.status }}</p>
            <p v-if="course.status == 'FULL'" class="text-xs text-center text-purple-500">{{ course.status }}</p>
            <div class="w-full place-items-end text-right border-t-2 border-gray-100 mt-2">
              <NuxtLink class="text-indigo-600 ho text-xs font-medium" :to="`/staff/detail/course${course.id}`">View
                Course
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
definePageMeta({
  layout: "staff",
  middleware: ['is-authorized', 'is-staff']
})
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
const allCourses = ref({})
const showCourse = ref({})
const { data: courseResponse, error: courseError } = await useApiFetch("api/staff/allCourses", {});

if (courseResponse.value) {
  allCourses.value = courseResponse.value
  showCourse.value = allCourses.value
}


// Create Course
const showCreateCourse = ref(false)


// filter
const filter = ref(false)
const filterSelect = ref("All")
const filterEnum = ref('')

const clickOutside = () => {
  filter.value = false;
};


const selectFilter = async (select: string) => {

  if (filterSelect.value === select) {

    filter.value = false;


  }
  else {

    filterSelect.value = select;
    filter.value = false;

    if (select == 'All') {
      filterEnum.value = ''
      showCourse.value = allCourses.value;
      return;
    }

    if (select == 'Open') {
      filterEnum.value = "OPEN"
    }

    if (select == 'Full') {
      filterEnum.value = "FULL"
    }

    if (select == 'Active') {
      filterEnum.value = "ACTIVE"
    }

    if (select == 'Ended') {
      filterEnum.value = "ENDED"
    }

    if (select == 'Pending') {
      filterEnum.value = "PENDING"
    }


    showCourse.value = [];

    for (const course in allCourses.value) {
      if (allCourses.value[course].status == filterEnum.value) {
        showCourse.value.push(allCourses.value[course]);
      }
    }



  }



}

// search
function handleSearchCourse(event) {
  if (event.target.value === '') {
    window.location.reload();
  } else {

    showCourse.value = [];
    for (const course in allCourses.value) {

    

      if (allCourses.value[course].title.toLowerCase().search(event.target.value.toLowerCase()) === 0) {
        showCourse.value.push(allCourses.value[course]);
      }
    }


  }
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