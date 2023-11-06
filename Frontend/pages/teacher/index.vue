<template>
  <div class="bg-gradient-to-t from-orange-300 h-screen">
    <div class="container mx-auto grid grid-cols-4 gap-10">
      <div class='app p-12 col-span-3 bg-white shadow-lg rounded-xl mt-16'>
        <FullCalendar :options='calendarOptions' />
      </div>

      <div class="bg-white rounded-lg shadow-xl col-span-1 mt-16 border border-dashed p-4 mb-4">

        <ul class=" bg-white rounded-lg shadow divide-y divide-gray-200 max-w-sm">
          <li class="px-6 py-4" v-for="classes in showAgenda">
            <div class="flex justify-between">
              <span class="font-semibold text-lg">{{ classes.title }}</span>

            </div>
            <p class="text-gray-700">This class start at {{ classes.datetime }}</p>
            <NuxtLink :to="`/teacher/classDetail${classes.id}`">
              Detail
            </NuxtLink>
          </li>

        </ul>
      </div>
    </div>
  </div>
</template>
  
<script setup lang="ts">
definePageMeta({ layout: "teacher",
middleware: ['is-authorized','is-teacher'] })
import FullCalendar from '@fullcalendar/vue3'
import interactionPlugin from '@fullcalendar/interaction'
import timeGridPlugin from '@fullcalendar/timegrid'
import dayGridPlugin from '@fullcalendar/daygrid'
import { Calendar } from '@fullcalendar/core'
import { useAuthStore } from "~/stores/useAuthStore";
const auth = useAuthStore();



const allevents = ref([]);

const events = ref([]);

const showAgenda = ref([]);

const calendarOptions = ref({
  plugins: [interactionPlugin, timeGridPlugin, dayGridPlugin],
  initialView: 'dayGridMonth',
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

calendarOptions.value.events = events;

const { data: eventData, error: loginError } = await useApiFetch(`api/teacher/getEvent/${auth.user.value.id}`, {});


if (eventData.value) {
  // event.value = eventData.value

  allevents.value = eventData.value;



  for (const event in allevents.value) {

    let temp = {
      title: allevents.value[event].title,
      start: allevents.value[event].datetime,
      uid: allevents.value[event].id,
      datestore: allevents.value[event].datetime,
      type: allevents.value[event].type,

    }

    events.value.push(temp);


  }


}



// const eventData = ref([
//   { title: 'eiei' ,date: '2023-10-13'},
//   { title: 'eiei2' ,date: '2023-10-13'},
// ]);


async function handleDateClick(arg) {

  const selectDate = arg.dateStr

  console.log(selectDate)

  showAgenda.value = []

  for (const event in allevents.value) {

    if (allevents.value[event].datetime.split(" ")[0] === selectDate) {
      showAgenda.value.push(allevents.value[event])
    }
  }

}

async function handleEventClick(arg) {
  await navigateTo(`/teacher/classDetail${arg.event.extendedProps.uid}`);

}




</script>
  
<style scoped>
.app {
  font-family: Arial, Helvetica Neue, Helvetica, sans-serif;
  font-size: 14px;
}
</style>
