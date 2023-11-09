<template>

  <div class="bg-gradient-to-t from-indigo-400/40 to-blue-300/30">

    <div class="relative flex pt-5 items-center w-full px-10 mt-20">
      <div class="flex-grow border-t border-gray-400"></div>
              <span class="flex-shrink mx-4 text-6xl text-gray-400">My Current Course</span>
              <div class="flex-grow border-t border-gray-400"></div>
    </div>
    <div class="bg-white p-12 transform ease-in-out m-12 shadow-xl border rounded-2xl">
      <div v-for="course in myCourses" class="space-y-4">
        <div class="flex justify-between px-12 py-2 bg-orange-200 hover:bg-orange-500/60 rounded-lg shadow-lg">
          <div class="text-4xl font-semibold">
            {{ course.title }}
          </div>
          <div class="text-4xl">
            Start : {{ formatDateTime(new Date(course.starts_on)) }}
          </div>
        </div>
      </div>
    </div>
  
  
    <div>
      <div class="relative flex py-5 items-center w-full px-10 mt-8">
          <div class="flex-grow border-t border-gray-400"></div>
          <span class="flex-shrink mx-4 text-6xl text-gray-400">Course Timeslots</span>
          <div class="flex-grow border-t border-gray-400"></div>
      </div>
    
      <div v-click-outside="clickOutside" v-if="timeslotShow" ref="scrollCourse"
          class=" p-6  border border-gray-200 rounded-lg shadow-lg">
    
          <h5 class="mb-2 text-2xl font-bold  text-gray-900">{{ timeslotSelected.title }}</h5>
    
          <p class="mb-3 font-normal text-gray-700 ">Date: {{ timeslotSelected.start }}</p>
          <NuxtLink :to="`/staff/detail/timeslot${timeslotSelected.uid}`"
              class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
              See Timeslot Information
              <svg class="w-3.5 h-3.5 ml-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                  viewBox="0 0 14 10">
                  <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M1 5h12m0 0L9 1m4 4L9 9" />
              </svg>
          </NuxtLink>
      </div>
    
      <div class='app bg-white p-12 transform ease-in-out m-12 shadow-2xl border rounded-2xl'>
          <FullCalendar :options='calendarOptions' />
      </div>
    
      <div class="flex justify-center w-full">
                  <div class="w-full lg:w-1/2 xl:w-5/12 px-4 mb-8">
                      <div class="bg-white relative rounded-lg p-8 sm:p-12 shadow-lg">
    
                          <div class="text-2xl mb-4">Make-up request form</div>
  
                          <div>
                            <div class="font-medium">
                              Selected: "selected time from above"
                            </div>
                          </div>
  
                          <!-- <VueDatePicker class="text-black mb-4" v-model="date" :is-24="true" enable-seconds
                              hours-increment="1" minutes-increment="0" seconds-increment="0" placeholder="Select Date"
                              no-minutes-overlay no-seconds-overlay :min-time="{ hours: 10, minutes: 0, seconds: 0 }"
                              :max-time="{ hours: 17, minutes: 0, seconds: 0 }"
                              :start-time="{ hours: 10, minutes: 0, seconds: 0 }" :state="datePickerState"
                              :disabled-week-days="[1]"></VueDatePicker> -->
    
                          <div>
                              Comment
                            <input 
                                      class="w-full px-4 py-4 rounded-lg border border-gray-200 placeholder-gray-500 text-sm focus:outline-none focus:border-gray-400 focus:bg-white"
                                      type="text" name="username" placeholder="comment" />
                                  <p class="text-red-500" :key="error">
                                      {{ error }}
                                  </p>
                          </div>
  
                          <div>
                              <p class="text-red-500 font-normal">
                                  {{ showError }}
                              </p>
                              <button v-on:click="submitCreateTimeslot" class="w-full mt-6 bg-primary rounded border border-primary p-3 transition hover:bg-gray-300">
                                  Request
                              </button>
                          </div>
    
                      </div>
              </div>
      </div>
  
  
    </div>
  </div>

</template>
  
<script setup lang="ts">
definePageMeta({
  layout: "student",
  middleware: ['is-authorized', 'is-student']
})
import FullCalendar from '@fullcalendar/vue3'
import interactionPlugin from '@fullcalendar/interaction'
import timeGridPlugin from '@fullcalendar/timegrid'
import dayGridPlugin from '@fullcalendar/daygrid'
import { Calendar } from '@fullcalendar/core'
import { useAuthStore } from "~/stores/useAuthStore";
const config = useRuntimeConfig();
const user = useAuthStore().user;

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

// show my current course
const myCourses = ref({})

const { data: myCourseResponse, error: myCourseError } = await useApiFetch(`api/student/getCurrentCourse/${user.value.id}`, {});

if (myCourseResponse.value) {
    myCourses.value = myCourseResponse.value;
}

else {
    if (myCourseError.value) {

    }
}

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

// timeslot select

const timeslotSelected = ref();
const timeslotShow = ref(false);
const scrollCourse = ref();

function clickOutside() {
    timeslotShow.value = false;
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

// course info 


const route = useRoute();

const course = ref({})

const { data: courseResponse, error: courseError } = await useApiFetch(`api/student/getMakeUpClasses/${user.value.id}`, {});

if (courseResponse.value) {

    course.value = courseResponse.value;
    
    let first = 1;

    for (const event in courseResponse.value.timeslots) {

        if (first != 0 && (courseResponse.value.timeslots[event].author == true)) {

            calendarOptions.value.initialDate = courseResponse.value.timeslots[event].datetime

            first = 0;
        }

        let temp = {
            title: courseResponse.value.timeslots[event].title,
            start: courseResponse.value.timeslots[event].datetime,
            uid: courseResponse.value.timeslots[event].id,
            datestore: courseResponse.value.timeslots[event].datetime,
            type: courseResponse.value.timeslots[event].type,

        }

        if (courseResponse.value.timeslots[event].author == false) {
            temp["color"] = 'gray';

        }
        else {
            if (courseResponse.value.timeslots[event].type === "REGULAR") {
                temp["color"] = 'green';
            }

            if (courseResponse.value.timeslots[event].type === "MAKEUP") {
                temp["color"] = 'purple';
            }


        }

        eventData.value.push(temp);


    }


}

else {
    if (courseError.value) {

    }
}

// add timeslot

import VueDatePicker from '@vuepic/vue-datepicker';
import '@vuepic/vue-datepicker/dist/main.css'
import dayjs from 'dayjs';

const date = ref();
const datePickerState = ref<any>(null);
const showError = ref("");

async function submitCreateTimeslot() {

    const { data: createResponse, error: createError } = await useApiFetch(`api/staff/createTimeslot/${route.params.id}`, {
        method: "POST",
        body: {
            datetime: dayjs(date.value).format('YYYY-MM-DD HH:mm:ss')
        }
    });

    if (createResponse.value) {

        window.location.reload();


    } else {

        if (createError.value) {

            datePickerState.value = false

            showError.value = "";

            showError.value = createError.value.data.message;



        }

    }

}

function formatDateTime(date) {
    const year = date.getFullYear();
    const month = String(date.getMonth() + 1).padStart(2, '0'); // Month is 0-based
    const day = String(date.getDate()).padStart(2, '0');
    const hours = String(date.getHours() % 12 || 12).padStart(2, '0'); // Convert to 12-hour format
    const minutes = String(date.getMinutes()).padStart(2, '0');
    const amOrPm = date.getHours() >= 12 ? 'PM' : 'AM';

    const formattedDateTime = `${day}/${month}/${year} ${hours}:${minutes} ${amOrPm}`;
    return formattedDateTime;
}


</script>
  
<style scoped>
.app {
  font-family: Arial, Helvetica Neue, Helvetica, sans-serif;
  font-size: 14px;
}
</style>
