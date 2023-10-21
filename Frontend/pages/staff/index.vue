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
    <button v-on:click="showCreateCourse = !showCreateCourse"
      class="px-3 py-2 bg-white font-medium text-gray-800 rounded-lg shadow-md border border-gray-300 hover:bg-gray-200">
      Create Course
    </button>
  </div>

  <div v-if="showCreateCourse">

  </div>

  <div class="min-h-screen w-full px-10 ">
    <div class="h-full w-full p-16 flex flex-wrap gap-8  border border-dashed shadow-2xl">

      <div class="flex items-center justify-center h-full" v-for="course in courseResponse" :key="course.id">
        <div class="bg-white shadow-2xl p-6 rounded-2xl border-2 border-gray-50">
          <div class="flex flex-col">
            <div>
              <h2 class="font-bold text-gray-600 text-center">{{ course.title }}</h2>
            </div>
            <div class="my-6">
              <div class="flex flex-row space-x-4 items-center">
                <div id="icon">
                  <span>
                    <svg class="w-20 h-20 fill-stroke text-yellow-400" fill="none" stroke="currentColor"
                      viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z">
                      </path>
                    </svg>
                  </span>
                </div>
                <div id="temp">
                  <h4 class="text-4xl">12&deg;C</h4>
                  <p class="text-xs text-gray-500">{{ course.duration / 60 }} Hour</p>
                </div>
              </div>
            </div>
            <div class="w-full place-items-end text-right border-t-2 border-gray-100 mt-2">
              <a href="#" class="text-indigo-600 text-xs font-medium">View more</a>
            </div>
          </div>
        </div>

      </div>
      <div class="flex items-center justify-center h-full" v-for="course in courseResponse" :key="course.id">
        <div class="bg-white shadow-2xl p-6 rounded-2xl border-2 border-gray-50">
          <div class="flex flex-col">
            <div>
              <h2 class="font-bold text-gray-600 text-center">{{ course.title }}</h2>
            </div>
            <div class="my-6">
              <div class="flex flex-row space-x-4 items-center">
                <div id="icon">
                  <span>
                    <svg class="w-20 h-20 fill-stroke text-yellow-400" fill="none" stroke="currentColor"
                      viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z">
                      </path>
                    </svg>
                  </span>
                </div>
                <div id="temp">
                  <h4 class="text-4xl">12&deg;C</h4>
                  <p class="text-xs text-gray-500">{{ course.duration / 60 }} Hour</p>
                </div>
              </div>
            </div>
            <div class="w-full place-items-end text-right border-t-2 border-gray-100 mt-2">
              <a href="#" class="text-indigo-600 text-xs font-medium">View more</a>
            </div>
          </div>
        </div>

      </div>
      <div class="flex items-center justify-center h-full" v-for="course in courseResponse" :key="course.id">
        <div class="bg-white shadow-2xl p-6 rounded-2xl border-2 border-gray-50">
          <div class="flex flex-col">
            <div>
              <h2 class="font-bold text-gray-600 text-center">{{ course.title }}</h2>
            </div>
            <div class="my-6">
              <div class="flex flex-row space-x-4 items-center">
                <div id="icon">
                  <span>
                    <svg class="w-20 h-20 fill-stroke text-yellow-400" fill="none" stroke="currentColor"
                      viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z">
                      </path>
                    </svg>
                  </span>
                </div>
                <div id="temp">
                  <h4 class="text-4xl">12&deg;C</h4>
                  <p class="text-xs text-gray-500">{{ course.duration / 60 }} Hour</p>
                </div>
              </div>
            </div>
            <div class="w-full place-items-end text-right border-t-2 border-gray-100 mt-2">
              <a href="#" class="text-indigo-600 text-xs font-medium">View more</a>
            </div>
          </div>
        </div>

      </div>

    </div>





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



calendarOptions.value.events = eventData;



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