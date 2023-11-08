<template>
  <div class="container mx-auto w-full mt-28">
    <FullCalendar :options='calendarOptions' />
  </div>

  <div v-if="showComment" ref="scrollTo" v-click-outside="clickOutside" class="w-full flex justify-center">
    <div class="w-1/3  bg-amber-300 rounded-2xl ml-8 mt-8">
      <div class="outline-gray-300 outline outline-2 p-4 m-5 rounded-md">
        <p class="text-3xl font-bold text-white">Detail of {{ event }}</p>
        <div class="bg-gray-50 p-2 mt-8">
        <p class="text-2xl ">Comment from teacher: </p>
        <p class="text-xl">{{ comment }}</p>
      </div>
      </div>
    </div>
  </div>
  <div v-if="showComment" class=" flex flex-wrap justify-center gap-1 border border-dashed min-h-[300px] m-8">
    <a :href="`${config.public.imageBaseURL}${image.path}`" v-for="image in images" :key="image.id"
      class="hover:scale-125 transition duration-500 cursor-pointer ">
      <img class="w-[300px] h-[300px] object-cover" :src="`${config.public.imageBaseURL}${image.path}`">
    </a>

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
const auth = useAuthStore();



const allevents = ref([]);

const events = ref([]);

const showAgenda = ref([]);

const calendarOptions = ref({
  plugins: [interactionPlugin, timeGridPlugin, dayGridPlugin],
  initialView: 'dayGridMonth',
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

calendarOptions.value.events = events;

const { data: eventData, error: loginError } = await useApiFetch(`api/student/reviewStudent/${auth.user.value.id}`, {});
console.log(eventData.value);


if (eventData.value) {
  // event.value = eventData.value

  allevents.value = eventData.value;



  for (const event in allevents.value) {

    let temp = {
      title: allevents.value[event].title,
      start: allevents.value[event].time,
      uid: allevents.value[event].id,
      datestore: allevents.value[event].time,
      images: allevents.value[event].images,
      comment: allevents.value[event].review_comment,
    }

    events.value.push(temp);


  }


}



// const eventData = ref([
//   { title: 'eiei' ,date: '2023-10-13'},
//   { title: 'eiei2' ,date: '2023-10-13'},
// ]);
const event = ref();
const images = ref();
const comment = ref();
const showComment = ref(false);

async function handleEventClick(arg) {
  event.value = arg.event.title;
  images.value = arg.event.extendedProps.images;
  comment.value = arg.event.extendedProps.comment;
  await showCommentTrue();
  await scrollComment();

}
async function showCommentTrue() {
  showComment.value = true;
}

function clickOutside() {
  showComment.value = false;
}

const scrollTo = ref()

async function scrollComment() {

    if (scrollTo.value) {

        const element = scrollTo.value.getBoundingClientRect();
  
        // Scroll to the element with smooth animation
        window.scrollTo({
            top: element.top + window.scrollY,
            behavior: 'smooth',
        });
    }

};

</script>
  
<style scoped>
.app {
  font-family: Arial, Helvetica Neue, Helvetica, sans-serif;
  font-size: 14px;
}
</style>
