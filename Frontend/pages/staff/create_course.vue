<template>
  <div class='app p-12 transform ease-in-out m-4 shadow-xl border rounded-2xl'>
    <FullCalendar :options='calendarOptions' />
  </div>

  <div class="px-12 transform ease-in-out m-4 mt-8 shadow-2xl border rounded-xl pb-10 mb-16">
    <div class="relative flex py-5 items-center w-full px-10 mt-4">
      <div class="flex-grow border-t border-gray-400"></div>
      <span class="flex-shrink mx-4 text-4xl text-gray-400">Create Course</span>
      <div class="flex-grow border-t border-gray-400"></div>
    </div>
    <div class="text-2xl font-semibold flex">
      <span class="mr-4">Title</span>
      <input
        class="w-full px-2 py-2 rounded-lg font-medium bg-gray-100 border border-gray-200 placeholder-gray-300 text-sm focus:outline-none focus:border-gray-400 focus:bg-white"
        type="text" name="title" v-model="title" placeholder="Title" />

    </div>
    <p class="text-red-500" v-for="error in createError['title']" :key="error">
      {{ error }}
    </p>
    <div class="text-2xl font-semibold mt-4">
      <span>Description</span>
      <input
        class="mt-2 w-full px-2 py-2 rounded-lg font-medium bg-gray-100 border border-gray-200 placeholder-gray-300 text-sm focus:outline-none focus:border-gray-400 focus:bg-white"
        type="text" name="description" v-model="description" placeholder="description" />
    </div>
    <p class="text-red-500" v-for="error in createError['description']" :key="error">
      {{ error }}
    </p>
    <!-- <div class="flex-grow border-t border-gray-400 mt-6"></div> -->
    <div class="font-semibold px-4 pb-6 pt-2 flex mt-4">
      <div class="w-1/2 mt-4">
        <div class="flex mb-16 space-x-2">
          <div class="w-1/4">
            <span class="text-xl">Course Selection</span>
            <div class="relative group">

              <div v-click-outside="clickOutsideQuo" class="relative">
                <button v-on:click="openQuota = !openQuota" class="bg-orange-300 rounded-md px-4 py-1 mt-2">
                  <span>{{ currentQuota }}</span>
                  <svg fill="currentColor" viewBox="0 0 20 20" :class="{ 'rotate-180': openQuota, 'rotate-0': !openQuota }"
                    class="inline w-4 h-4 mt-1 ml-1 transition-transform duration-200 transform md:-mt-1">
                    <path fill-rule="evenodd"
                      d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                      clip-rule="evenodd"></path>
                  </svg>
                </button>
                <div v-if="openQuota" x-transition:enter="transition ease-out duration-100"
                  x-transition:enter-start="transform opacity-0 scale-95"
                  x-transition:enter-end="transform opacity-100 scale-100"
                  x-transition:leave="transition ease-in duration-75"
                  x-transition:leave-start="transform opacity-100 scale-100"
                  x-transition:leave-end="transform opacity-0 scale-95"
                  class="absolute left-0 w-full mt-2 origin-top-right rounded-md shadow-lg md:w-48">
                  <div v-for="quota in quotaType" :key="quota.name" @click="changeQuota(quota)"
                    v-on:click="openQuota = !openQuota"
                    class="text-black cursor-pointer px-2  bg-white hover:bg-gray-200">
                    <button class="px-2">
                      {{ quota }}
                    </button>
                  </div>
                </div>
              </div>

            </div>
            <p class="text-red-500 font-normal" v-for="error in createError['quota']" :key="error">
              {{ error }}
            </p>
          </div>
          <div class="w-2/4 bg-gray-200 h-full p-2">
            <span>Course type</span>
            <p>Half Course: 5 classes</p>
            <p>Full Course: 10 classes</p>
          </div>

        </div>
        <div class="flex-grow border-t border-gray-400 w-5/6"></div>
        <div class="flex mt-10 space-x-2">

          <div class="w-1/3">
            <span class="text-xl">Age Selection</span>
            <div class="relative group">

              <div v-click-outside="clickOutsideMin" class="relative">
                <button v-on:click="openMinAge = !openMinAge" class="bg-orange-300 rounded-md px-4 py-1 mt-2">
                  <span>{{ Age }}</span>
                  <svg fill="currentColor" viewBox="0 0 20 20"
                    :class="{ 'rotate-180': openMinAge, 'rotate-0': !openMinAge }"
                    class="inline w-4 h-4 mt-1 ml-1 transition-transform duration-200 transform md:-mt-1">
                    <path fill-rule="evenodd"
                      d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                      clip-rule="evenodd"></path>
                  </svg>
                </button>
                <div v-if="openMinAge" x-transition:enter="transition ease-out duration-100"
                  x-transition:enter-start="transform opacity-0 scale-95"
                  x-transition:enter-end="transform opacity-100 scale-100"
                  x-transition:leave="transition ease-in duration-75"
                  x-transition:leave-start="transform opacity-100 scale-100"
                  x-transition:leave-end="transform opacity-0 scale-95"
                  class="absolute left-0 w-full mt-2 origin-top-right rounded-md shadow-lg md:w-48">
                  <div v-for="number in ageType" :key="number.name" @click="changeMinAge(number)"
                    v-on:click="openMinAge = !openMinAge"
                    class="text-black cursor-pointer px-2  bg-white hover:bg-gray-200">
                    <button class="px-2">
                      {{ number }}
                    </button>
                  </div>
                </div>
              </div>

            </div>
            <p class="text-red-500 font-normal" v-for="error in createError['min_age']" :key="error">
              {{ error }}
            </p>
          </div>
          <div class="w-full space-x-4 flex">
            <div class="w-1/3 bg-gray-200 h-full p-2">
              <span>Age type</span>
              <p>B1: 0 - 6 Months</p>
              <p>B2: 6 - 12 Months</p>
              <p>T1: 1 - 2 Years</p>
              <p>T2: 2 - 3 Years</p>
              <p>T3: 3 - 4 Years</p>
              <p>Ps: 5 - 10 Years</p>
            </div>
            <div class="w-3/6 bg-orange-200 h-min p-2">
              <span>Capacity rule</span>
              <p>B and T: hold 4 customers</p>
              <p>Ps: hold 6 customers</p>
            </div>
          </div>
        </div>
      </div>



      <div class="w-1/2 border-l border-gray-400 pl-16 mt-4 space-y-2">
        <div class="flex h-1/4 ">
          <div class="pt-2 w-full">Open Enroll date
            <VueDatePicker class="text-black" v-model="dateOpen" :is-24="true" enable-seconds hours-increment="1"
              minutes-increment="1" seconds-increment="1" placeholder="Select Date" :min-date="new Date()"
              :state="datePickerState" :max-date="maxDate" prevent-min-max-navigation :disabled-week-days="[1]">
            </VueDatePicker>
          </div>
        </div>
        <div class="flex h-1/4">
          <div class="pt-2 w-full">End Enroll date
            <VueDatePicker class="text-black" v-model="dateUntil" :is-24="true" enable-seconds hours-increment="1"
              minutes-increment="1" seconds-increment="1" placeholder="Select Date" :min-date="new Date()"
              :state="datePickerState" :max-date="maxDate" prevent-min-max-navigation :disabled-week-days="[1]">
            </VueDatePicker>
            <p class="text-red-500 font-normal" v-for="error in createError['opens_until']" :key="error">
              {{ error }}
            </p>
          </div>
        </div>
        <div class="flex h-1/4">
          <div class="pt-2 w-full">
            Course Start at
            <VueDatePicker class="text-black z-0" v-model="dateStart" :is-24="true" enable-seconds hours-increment="1"
              minutes-increment="0" seconds-increment="0" placeholder="Select Date" no-minutes-overlay no-seconds-overlay
              :min-time="{ hours: 10, minutes: 0, seconds: 0 }" :max-time="{ hours: 17, minutes: 0, seconds: 0 }"
              :start-time="{ hours: 10, minutes: 0, seconds: 0 }" :state="datePickerState" :  ="[1]" 
              :min-date="new Date()" :max-date="maxDate" prevent-min-max-navigation :disabled-week-days="[1]"
              >
            </VueDatePicker>
            <p class="text-red-500 font-normal" v-for="error in createError['starts_on']" :key="error">
              {{ error }}
            </p>
          </div>
        </div>
        <div>
          <div class="font-semibold relative group h-1/4">
            Select Teacher:
            <button v-click-outside="clickOutsideTeacher" v-on:click="openTeacher = !openTeacher"
              class="bg-orange-300 rounded-md px-4 py-1 mt-2">
              {{ currentTeacher }}
              <svg fill="currentColor" viewBox="0 0 20 20" :class="{ 'rotate-180': openTeacher, 'rotate-0': !openTeacher }"
                class="inline w-4 h-4 mt-1 ml-1 transition-transform duration-200 transform md:-mt-1">
                <path fill-rule="evenodd"
                  d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                  clip-rule="evenodd"></path>
              </svg>
            </button>
            <div v-if="openTeacher" x-transition:enter="transition ease-out duration-100"
              x-transition:enter-start="transform opacity-0 scale-95"
              x-transition:enter-end="transform opacity-100 scale-100" x-transition:leave="transition ease-in duration-75"
              x-transition:leave-start="transform opacity-100 scale-100"
              x-transition:leave-end="transform opacity-0 scale-95"
              class="absolute left-0 w-full mt-2 origin-top-right rounded-md shadow-lg md:w-48">
              <div v-for="teacher in teachers" :key="teacher.name" @click="changeTeacher(teacher.first_name, teacher.id)"
                v-on:click="openTeacher = !openTeacher" class="text-black cursor-pointer px-2  bg-white hover:bg-gray-200">
                <button class="px-2 z-50">
                  {{ teacher.first_name }}
                </button>
              </div>
            </div>
            <p class="text-red-500 font-normal" v-for="error in createError['teacher_id']" :key="error">
              {{ error }}
            </p>
          </div>
          <!-- <div v-if="Age == 'Ps'" class="font-semibold relative group h-1/4">
            Select Teacher assistant:
            <button v-click-outside="clickOutsideTeacher" v-on:click="openTeacher = !openTeacher"
              class="bg-orange-300 rounded-md px-4 py-1 mt-2">
              {{ currentTeacher }}
              <svg fill="currentColor" viewBox="0 0 20 20" :class="{ 'rotate-180': openTeacher, 'rotate-0': !openTeacher }"
                class="inline w-4 h-4 mt-1 ml-1 transition-transform duration-200 transform md:-mt-1">
                <path fill-rule="evenodd"
                  d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                  clip-rule="evenodd"></path>
              </svg>
            </button>
            <div v-if="openTeacher" x-transition:enter="transition ease-out duration-100"
              x-transition:enter-start="transform opacity-0 scale-95"
              x-transition:enter-end="transform opacity-100 scale-100" x-transition:leave="transition ease-in duration-75"
              x-transition:leave-start="transform opacity-100 scale-100"
              x-transition:leave-end="transform opacity-0 scale-95"
              class="absolute left-0 w-full mt-2 origin-top-right rounded-md shadow-lg md:w-48">
              <div v-for="teacher in teachers" :key="teacher.name" @click="changeTeacher(teacher.first_name, teacher.id)"
                v-on:click="openTeacher = !openTeacher" class="text-black cursor-pointer px-2  bg-white hover:bg-gray-200">
                <button class="px-2 z-50">
                  {{ teacher.first_name }}
                </button>
              </div>
            </div>
            <p class="text-red-500 font-normal" v-for="error in createError['teacher_id']" :key="error">
              {{ error }}
            </p>
          </div> -->
        </div>
      </div>

    </div>

    <div class="flex justify-end">
      <p class="text-red-500 font-normal">
        {{ showError }}
      </p>
      <button @click="createCourse()"
        class="bg-orange-500 text-white px-4 py-2  flex rounded-md hover:bg-orange-700 duration-200">
        <span class="text-xl">Create</span>
        <svg width="24px" height="24px" viewBox="0 0 24 16" fill="none" xmlns="http://www.w3.org/2000/svg">
          <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
          <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
          <g id="SVGRepo_iconCarrier">
            <path fill-rule="evenodd" clip-rule="evenodd"
              d="M12.2929 4.29289C12.6834 3.90237 13.3166 3.90237 13.7071 4.29289L20.7071 11.2929C21.0976 11.6834 21.0976 12.3166 20.7071 12.7071L13.7071 19.7071C13.3166 20.0976 12.6834 20.0976 12.2929 19.7071C11.9024 19.3166 11.9024 18.6834 12.2929 18.2929L17.5858 13H4C3.44772 13 3 12.5523 3 12C3 11.4477 3.44772 11 4 11H17.5858L12.2929 5.70711C11.9024 5.31658 11.9024 4.68342 12.2929 4.29289Z"
              fill="#ffffff"></path>
          </g>
        </svg>
      </button>
    </div>
  </div>
</template>

<script setup lang="ts">
definePageMeta({layout: "staff",
middleware: ['is-authorized','is-staff']})
import FullCalendar from '@fullcalendar/vue3'
import interactionPlugin from '@fullcalendar/interaction'
import timeGridPlugin from '@fullcalendar/timegrid'
import dayGridPlugin from '@fullcalendar/daygrid'
import dayjs from 'dayjs';

const open = ref(false);
const openQuota = ref(false);
const openMinAge = ref(false);
const openTeacher = ref(false);
const title = ref('');
const description = ref('');

const currentQuota = ref('Not Assign');
const quotaType = ["Half Course", "Full Course"];
const quotaAmount = ref();
function changeQuota(type: string) {
  currentQuota.value = type;
  if (currentQuota.value == "Full Course") {
    quotaAmount.value = 10;
  }
  if (currentQuota.value == "Half Course") {
    quotaAmount.value = 5;
  }
}
const capacityAmount = ref();

const Age = ref('Not Assign');
const ageType = ['B1', 'B2', 'T1', 'T2', 'T3', 'Ps'];
const minAgeAmount = ref();
const maxAgeAmount = ref();
function changeMinAge(minAge: string) {
  Age.value = minAge;
  capacityAmount.value = 4;
  if(minAge=='B1'){
    minAgeAmount.value = 0;
    maxAgeAmount.value = 6;
  }
  if(minAge=='B2'){
    minAgeAmount.value = 6;
    maxAgeAmount.value = 12;  }
  if(minAge=='T1'){
    minAgeAmount.value = 12;
    maxAgeAmount.value = 24;
  }
  if(minAge=='T2'){
    minAgeAmount.value = 24;
    maxAgeAmount.value = 36;
  }
  if(minAge=='T3'){
    minAgeAmount.value = 36;
    maxAgeAmount.value = 48;
  }
  if(minAge=='Ps'){
    minAgeAmount.value = 48;
    maxAgeAmount.value = 120;
    capacityAmount.value = 6;
  }
}

const currentTeacher = ref("Not Assign");
const currentTeacherNo = ref();
const teachers = ref({});
function changeTeacher(name: string, id: number) {
  currentTeacher.value = name;
  currentTeacherNo.value = id;
}

async function getTeacher() {
  const { data: teacherData, error: teacherError } = await useApiFetch(`api/staff/getTeacherList`, {});
  if (teacherData.value) {

    teachers.value = teacherData.value;
  }
  else {

  }

}

const createError = ref<{ [k: string]: any }>({})
const showError = ref('');
async function createCourse() {
  const { data: courseData, error: courseError } = await useApiFetch(`api/staff/createCourse`, {
    method: "POST",
    body: {
      teacher_id: currentTeacherNo.value,
      title: title.value,
      description: description.value,
      quota: quotaAmount.value,
      capacity: capacityAmount.value,
      min_age: minAgeAmount,
      max_age: maxAgeAmount,
      opens_on: dayjs(dateOpen.value).format('YYYY-MM-DD HH:mm:ss'),
      opens_until: dayjs(dateUntil.value).format('YYYY-MM-DD HH:mm:ss'),
      starts_on: dayjs(dateStart.value).format('YYYY-MM-DD HH:mm:ss'),
    }
  });

  if (courseData.value) {

    alert('You have created New Course');

    await navigateTo(`/staff`);


  } else {

    if (courseError.value) {
      
      showError.value = ""

      showError.value = courseError.value.data.message;
      
      datePickerState.value = false

      const errors = courseError.value.data.errors;

      createError.value = {};

      for (const key in errors) {

        if (errors.hasOwnProperty(key)) {

          const errorMessages = errors[key];

          createError.value[key] = errorMessages;

        }
      }
    }

  }

}

await getTeacher();

const clickOutside = () => {
  open.value = false;
};

const clickOutsideQuo = () => {
  openQuota.value = false;
}
const clickOutsideMin = () => {
  openMinAge.value = false;
}
const clickOutsideTeacher = () => {
  openTeacher.value = false;
}

const calendarOptions = ref({
  plugins: [interactionPlugin, timeGridPlugin, dayGridPlugin],
  initialView: 'timeGridWeek',
  nowIndicator: true,
  editable: false,
  eventClick: handleEventClick,
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


// add timeslot

import VueDatePicker from '@vuepic/vue-datepicker';
import '@vuepic/vue-datepicker/dist/main.css';
import { addMonths, getMonth, getYear, subMonths } from 'date-fns';
const dateOpen = ref();
const dateUntil = ref();
const dateStart = ref();
const datePickerState = ref<any>(null);
const maxDate = computed(() => addMonths(new Date(getYear(new Date()), getMonth(new Date())), 2));

</script>