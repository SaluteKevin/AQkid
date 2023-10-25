<template>


  <div class='app p-12 transform ease-in-out m-4 shadow-xl border rounded-2xl'>
    <FullCalendar :options='calendarOptions' />
  </div>

  <div class="px-12 transform ease-in-out m-4 mt-8 shadow-2xl border rounded-xl pb-10">
    <div class="relative flex py-5 items-center w-full px-10 mt-4">
    <div class="flex-grow border-t border-gray-400"></div>
    <span class="flex-shrink mx-4 text-4xl text-gray-400">Create Course</span>
    <div class="flex-grow border-t border-gray-400"></div>
  </div>
    <div class="text-2xl font-semibold flex">
        <span class="mr-4">Title</span> 
        <input 
                                class="w-full px-8 py-2 rounded-lg font-medium bg-gray-100 border border-gray-200 placeholder-gray-300 text-sm focus:outline-none focus:border-gray-400 focus:bg-white"
                                type="text" name="title" placeholder="" />
    </div>
    <div class="text-2xl font-semibold mt-4">
        <span>Description</span> 
        <input 
                                class="mt-2 w-full px-8 py-2 rounded-lg font-medium bg-gray-100 border border-gray-200 placeholder-gray-300 text-sm focus:outline-none focus:border-gray-400 focus:bg-white"
                                type="text" name="description" placeholder="" />
    </div>
    <div class="flex font-semibold mt-2"> 
        <div class="mr-24">
            <span class="text-xl">Quota</span>
            <div class="relative group">
        
                <div v-click-outside="clickOutside" class="relative">
                        <button v-on:click="open = !open" class="bg-orange-300 rounded-md px-4 py-1 mt-2">
                        <span>Amount: 1</span>
                        <svg fill="currentColor" viewBox="0 0 20 20" :class="{'rotate-180': open, 'rotate-0': !open}" class="inline w-4 h-4 mt-1 ml-1 transition-transform duration-200 transform md:-mt-1"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                        </button>
                        <div v-if="open" x-transition:enter="transition ease-out duration-100" x-transition:enter-start="transform opacity-0 scale-95" x-transition:enter-end="transform opacity-100 scale-100" x-transition:leave="transition ease-in duration-75" x-transition:leave-start="transform opacity-100 scale-100" x-transition:leave-end="transform opacity-0 scale-95" class="absolute left-0 w-full mt-2 origin-top-right rounded-md shadow-lg md:w-48">
                        <div v-on:click="open = !open" class="cursor-pointer px-2 py-2 bg-white hover:bg-gray-200">
                            <button class="px-1 py-2">
                                1
                            </button>
                        </div>
                        <div v-on:click="open = !open" class="cursor-pointer px-2 py-2 bg-white hover:bg-gray-200">
                            <button class="px-1 py-2">
                                2
                            </button>
                        </div>
                        <div v-on:click="open = !open" class="cursor-pointer px-2 py-2 bg-white hover:bg-gray-200">
                            <button class="px-1 py-2">
                                3
                            </button>
                        </div>
                        <div v-on:click="open = !open" class="cursor-pointer px-2 py-2 bg-white hover:bg-gray-200">
                            <button class="px-1 py-2">
                                4
                            </button>
                        </div>
                        <div v-on:click="open = !open" class="cursor-pointer px-2 py-2 bg-white hover:bg-gray-200">
                            <button class="px-1 py-2">
                                5
                            </button>
                        </div>
                        </div>
                </div>  

            </div>
        </div>


        <div class="mr-24">
            <span class="text-xl">Capacity</span>
            
        </div>
        <div>
            <span class="text-xl">Age</span>
            <div class="bg-orange-300 rounded-md px-4 py-1 mt-2">dropdown</div>
        </div>
    </div>
    
    
    <div class="flex font-semibold mt-6 bg-orange-100 px-4 pb-6 pt-2">
        <div class="mr-24">
            Start on
            <div class="bg-gray-300 rounded-md px-4 py-1 mt-2">dropdown</div>
        </div>
        <div class="mr-24">
            Until
            <div class="bg-gray-300 rounded-md px-4 py-1 mt-2">dropdown</div>
        </div>
    </div>
    <div>
        <div class="mt-4 font-semibold">Select Teacher
            <div class="bg-orange-300 rounded-md">dropdown</div>
        </div>

        <div class="mt-4 font-semibold">
        Select Timeslot
        <div class="bg-orange-300 rounded-md">select time</div>
        </div>
    </div>
    
    
    <div class="bg-orange-500 text-white px-2 py-4 mt-8"><span>Create</span></div>
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

const clickOutside = () => {
  open.value = false;
};

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