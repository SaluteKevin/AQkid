<template>

    <div class="container mx-auto w-full">
        <FullCalendar :options='calendarOptions' />
    </div>
    <div class="flex mx-44 my-5 p-1">
        <div class="w-2/3">
            <div class="grid grid-cols-2 ">
                <div v-for="image in images" :key="image.id" class="items-center justify-center flex  m-8 hover:scale-125 transition duration-500 cursor-pointer object-cover">
                    <img :src="`${config.public.imageBaseURL}${image.path}`" >
                </div>
                


            </div>
        </div>
        <div v-if="comment" class="w-1/3 bg-amber-300 rounded-2xl m-1">
            <div class="outline-gray-300 outline outline-2 p-4 m-5 rounded-md">
                <p class="text-3xl font-bold text-gray-900 dark:text-white">Detail:</p>
                <div class="text-xl"><i class="fa-solid fa-circle" style="color: rgb(48, 117, 190)"></i>{{comment}}</div>
            </div>
        </div>

    </div>
</template>
  
  <script setup lang="ts">
  definePageMeta({ layout: "teacher" })
  import FullCalendar from '@fullcalendar/vue3'
  import interactionPlugin from '@fullcalendar/interaction'
  import timeGridPlugin from '@fullcalendar/timegrid'
  import dayGridPlugin from '@fullcalendar/daygrid'
  import { Calendar } from '@fullcalendar/core'
  import {useAuthStore} from "~/stores/useAuthStore";
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

const {data: eventData, error: loginError } = await useApiFetch(`api/student/reviewStudent/${auth.user.value.id}`, {});
console.log(eventData.value);

   
if(eventData.value) {
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
    const images = ref();
    const comment = ref();


    async function  handleEventClick (arg) {
        images.value = arg.event.extendedProps.images;
        comment.value = arg.event.extendedProps.comment;
        
     
    }
    
    


  </script>
  
  <style scoped>
    .app {
      font-family: Arial, Helvetica Neue, Helvetica, sans-serif;
      font-size: 14px;
    }
  </style>
