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
                                type="text" name="title" placeholder="Title" />
    </div>
    <div class="text-2xl font-semibold mt-4">
        <span>Description</span> 
        <input 
                                class="mt-2 w-full px-2 py-2 rounded-lg font-medium bg-gray-100 border border-gray-200 placeholder-gray-300 text-sm focus:outline-none focus:border-gray-400 focus:bg-white"
                                type="text" name="description" placeholder="description" />
    </div>
    <div class="grid grid-flow-col font-semibold mt-2"> 
        <div class="mr-24">
            <span class="text-xl">Quota</span>
            <div class="relative group">
        
                <div v-click-outside="clickOutsideQuo" class="relative">
                        <button v-on:click="openQuota = !openQuota" class="bg-orange-300 rounded-md px-4 py-1 mt-2">
                        <span>Amount: {{ currentQuota }}</span>
                        <svg fill="currentColor" viewBox="0 0 20 20" :class="{'rotate-180': openQuota, 'rotate-0': !openQuota}" class="inline w-4 h-4 mt-1 ml-1 transition-transform duration-200 transform md:-mt-1"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                        </button>
                        <div v-if="openQuota" x-transition:enter="transition ease-out duration-100" x-transition:enter-start="transform opacity-0 scale-95" x-transition:enter-end="transform opacity-100 scale-100" x-transition:leave="transition ease-in duration-75" x-transition:leave-start="transform opacity-100 scale-100" x-transition:leave-end="transform opacity-0 scale-95" class="absolute left-0 w-full mt-2 origin-top-right rounded-md shadow-lg md:w-48">
                        <div v-for="number in quotaNumber" :key="number.namer" @click="changeQuota" v-on:click="openQuota = !openQuota" class="text-black cursor-pointer px-2  bg-white hover:bg-gray-200">
                            <button class="px-2">
                                {{number}}
                            </button>
                        </div>
                        </div>
                </div>  

            </div>
        </div>


        <div class="mr-24">
            <span class="text-xl">Capacity</span>
            <div class="relative group">
        
        <div v-click-outside="clickOutsideCap" class="relative">
                <button v-on:click="openCapacity = !openCapacity" class="bg-orange-300 rounded-md px-4 py-1 mt-2">
                <span>Amount: {{ currentCapacity }}</span>
                <svg fill="currentColor" viewBox="0 0 20 20" :class="{'rotate-180': openCapacity, 'rotate-0': !openCapacity}" class="inline w-4 h-4 mt-1 ml-1 transition-transform duration-200 transform md:-mt-1"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                </button>
                <div v-if="openCapacity" x-transition:enter="transition ease-out duration-100" x-transition:enter-start="transform opacity-0 scale-95" x-transition:enter-end="transform opacity-100 scale-100" x-transition:leave="transition ease-in duration-75" x-transition:leave-start="transform opacity-100 scale-100" x-transition:leave-end="transform opacity-0 scale-95" class="absolute left-0 w-full mt-2 origin-top-right rounded-md shadow-lg md:w-48">
                <div v-for="number in capacityNumber" :key="number.namer" @click="changeCapacity" v-on:click="openCapacity = !openCapacity" class="text-black cursor-pointer px-2  bg-white hover:bg-gray-200">
                    <button class="px-2">
                        {{number}}
                    </button>
                </div>
                </div>
        </div>  

            </div>
        </div>
        <div>
            <span class="text-xl">Min Age</span>
            <div class="relative group">
        
                <div v-click-outside="clickOutsideMin" class="relative">
                        <button v-on:click="openMinAge = !openMinAge" class="bg-orange-300 rounded-md px-4 py-1 mt-2">
                        <span>Amount: {{ currentMinAge }}</span>
                        <svg fill="currentColor" viewBox="0 0 20 20" :class="{'rotate-180': openMinAge, 'rotate-0': !openMinAge}" class="inline w-4 h-4 mt-1 ml-1 transition-transform duration-200 transform md:-mt-1"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                        </button>
                        <div v-if="openMinAge" x-transition:enter="transition ease-out duration-100" x-transition:enter-start="transform opacity-0 scale-95" x-transition:enter-end="transform opacity-100 scale-100" x-transition:leave="transition ease-in duration-75" x-transition:leave-start="transform opacity-100 scale-100" x-transition:leave-end="transform opacity-0 scale-95" class="absolute left-0 w-full mt-2 origin-top-right rounded-md shadow-lg md:w-48">
                        <div v-for="number in minAgeNumber" :key="number.namer" @click="changeMinAge" v-on:click="openMinAge = !openMinAge" class="text-black cursor-pointer px-2  bg-white hover:bg-gray-200">
                            <button class="px-2">
                                {{number}}
                            </button>
                        </div>
                        </div>
                </div>  

            </div>
        </div>
        <div>
            <span class="text-xl">Max Age</span>
            <div class="relative group">
        
                <div v-click-outside="clickOutsideMax" class="relative">
                        <button v-on:click="openMaxAge = !openMaxAge" class="bg-orange-300 rounded-md px-4 py-1 mt-2">
                        <span>Amount: {{ currentMaxAge }}</span>
                        <svg fill="currentColor" viewBox="0 0 20 20" :class="{'rotate-180': openMaxAge, 'rotate-0': !openMaxAge}" class="inline w-4 h-4 mt-1 ml-1 transition-transform duration-200 transform md:-mt-1"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                        </button>
                        <div v-if="openMaxAge" x-transition:enter="transition ease-out duration-100" x-transition:enter-start="transform opacity-0 scale-95" x-transition:enter-end="transform opacity-100 scale-100" x-transition:leave="transition ease-in duration-75" x-transition:leave-start="transform opacity-100 scale-100" x-transition:leave-end="transform opacity-0 scale-95" class="absolute left-0 w-full mt-2 origin-top-right rounded-md shadow-lg md:w-48">
                        <div v-for="number in maxAgeNumber" :key="number.namer" @click="changeMaxAge" v-on:click="openMaxAge = !openMaxAge" class="text-black cursor-pointer px-2  bg-white hover:bg-gray-200">
                            <button class="px-2">
                                {{number}}
                            </button>
                        </div>
                        </div>
                </div>  

            </div>
        </div>
    </div>
    
    <div class="flex-grow border-t border-gray-400 mt-6"></div>
    <div class="font-semibold px-4 pb-6 pt-2 flex">
        <div class="w-1/2">
          <div class="grid grid-flow-col">
            <div class="pt-2">Start on:
            <button class="bg-gray-300 rounded-md px-4 py-1 mt-2 ml-5">
              <svg fill="currentColor" viewBox="0 0 20 20" :class="{'rotate-180': openMinAge, 'rotate-0': !openMinAge}" class="inline w-4 h-4 mt-1 ml-1 transition-transform duration-200 transform md:-mt-1"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
            </button>
            </div>
          </div>
          <div class="grid grid-flow-col">
              <div class="pt-2">Until:
              <button class="bg-gray-300 rounded-md px-4 py-1 mt-2 ml-10">
                <svg fill="currentColor" viewBox="0 0 20 20" :class="{'rotate-180': openMinAge, 'rotate-0': !openMinAge}" class="inline w-4 h-4 mt-1 ml-1 transition-transform duration-200 transform md:-mt-1"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
              </button>
              </div>
          </div>
        </div>
        <div class="w-1/2">
          <div class="font-semibold">
            Select Teacher: 
            <button class="bg-gray-300 rounded-md px-4 py-1 mt-2 ml-10">
              <svg fill="currentColor" viewBox="0 0 20 20" :class="{'rotate-180': openMinAge, 'rotate-0': !openMinAge}" class="inline w-4 h-4 mt-1 ml-1 transition-transform duration-200 transform md:-mt-1"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
            </button>
          </div>

          <div class="mt-4 font-semibold">
          Select Timeslot:
              <button class="bg-gray-300 rounded-md px-4 py-1 mt-2 ml-8">
                <svg fill="currentColor" viewBox="0 0 20 20" :class="{'rotate-180': openMinAge, 'rotate-0': !openMinAge}" class="inline w-4 h-4 mt-1 ml-1 transition-transform duration-200 transform md:-mt-1"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
              </button>
          </div>
        </div>
        
    </div>
    
    
    <button class="bg-orange-500 text-white px-4 py-2 mt-8 flex rounded-xl hover:bg-orange-700 duration-200">
        <span class="text-xl">Create</span>
        <svg width="24px" height="24px" viewBox="0 0 24 16" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path fill-rule="evenodd" clip-rule="evenodd" d="M12.2929 4.29289C12.6834 3.90237 13.3166 3.90237 13.7071 4.29289L20.7071 11.2929C21.0976 11.6834 21.0976 12.3166 20.7071 12.7071L13.7071 19.7071C13.3166 20.0976 12.6834 20.0976 12.2929 19.7071C11.9024 19.3166 11.9024 18.6834 12.2929 18.2929L17.5858 13H4C3.44772 13 3 12.5523 3 12C3 11.4477 3.44772 11 4 11H17.5858L12.2929 5.70711C11.9024 5.31658 11.9024 4.68342 12.2929 4.29289Z" fill="#ffffff"></path> </g></svg>
    </button>
  </div>

</template>

<script setup lang="ts">
definePageMeta({layout:"staff"})
import FullCalendar from '@fullcalendar/vue3'
import interactionPlugin from '@fullcalendar/interaction'
import timeGridPlugin from '@fullcalendar/timegrid'
import dayGridPlugin from '@fullcalendar/daygrid'
import dayjs from 'dayjs';

const open = ref(false);
const openQuota = ref(false);
const openCapacity = ref(false);
const openMinAge = ref(false);
const openMaxAge = ref(false);

var currentQuota = 1;
const quotaNumber = [5,10];
const changeQuota = () =>{
    currentQuota = 0;
}

var currentCapacity = 4;
const capacityNumber = [4,6];
const changeCapacity = () =>{
    currentCapacity = 0;
}

var currentMinAge = 0;
const minAgeNumber = [0,6,12,24,36,48,60];
const changeMinAge = () =>{
    currentMinAge = 1;
}

var currentMaxAge = 0;
const maxAgeNumber = [6,12,24,36,48,60,120];
const changeMaxAge = () =>{
    currentMaxAge = 1;
}



const clickOutside = () => {
  open.value = false;
};

const clickOutsideQuo = () =>{
    openQuota.value = false;
}
const clickOutsideCap = () =>{
    openCapacity.value = false;
}
const clickOutsideMin = () =>{
    openMinAge.value = false;
}
const clickOutsideMax = () =>{
    openMaxAge.value = false;
}

const calendarOptions = ref({
  plugins: [interactionPlugin, timeGridPlugin, dayGridPlugin],
  initialView: 'timeGridWeek',
  nowIndicator: true,
  editable: false,
  dateClick: handleDateClick,
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

    console.log(dayjs(allTimeslots.value[event].datetime).day())

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


function handleDateClick(arg) {
  // alert('date click! ' + arg.dateStr);
  eventData.value.push({ title: 'test', date: '2023-12-19' })
  // calendarOptions.value.events.push({title: 'test', date: '2023-12-19'})
}

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

</script>