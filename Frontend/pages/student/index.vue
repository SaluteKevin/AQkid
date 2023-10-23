<template>
    <div class="flex justify-center place-content-center p-24 text-6xl text-black font-semibold">
      Welcome
    </div>
    <div class='app p-12'>
      <FullCalendar :options='calendarOptions' />
    </div>
    


    <div class="flex justify-center place-content-center text-6xl text-black font-semibold">my class</div>

    <div class="flex flex-wrap justify-center px-5">
      <a v-for="classes in classResponse" :key="classes.id"
      class="relative bg-gray-900 block p-6 border border-gray-100 rounded-lg max-w-sm mx-auto mt-24" href="#">
  
        <span class="absolute inset-x-0 bottom-0 h-2 bg-gradient-to-r from-green-300 via-blue-500 to-purple-600"></span>

        <div class="my-4">
            <h2 class="text-white text-2xl font-bold pb-2">Card Title</h2>
            <p class="text-gray-300 py-1">Card description or content goes here.</p>
        </div>

        <div class="flex justify-end">
            <button class="px-2 py-1 text-white border border-gray-200 font-semibold rounded hover:bg-gray-800">Click Me</button>
        </div>
      </a>

    </div>
</template>

<script setup lang="ts">

  // calendar
  import FullCalendar from '@fullcalendar/vue3'
  import interactionPlugin from '@fullcalendar/interaction'
  import timeGridPlugin from '@fullcalendar/timegrid'
  import dayGridPlugin from '@fullcalendar/daygrid'


  const calendarOptions = ref({
          plugins: [interactionPlugin, timeGridPlugin, dayGridPlugin],
          initialView: 'dayGridMonth',
          nowIndicator: true,
          editable: true,
          
        
          

         
          // initialEvents: [
          //   { title: 'nice event', start: new Date(2023,12,15) }
          // ],
          events: ref([]),
          eventColor: '#378006'
  })
    
  //ไว้ใส่วัน
  const eventData = ref([

    ])

  
  if (eventData.value) {
    calendarOptions.value.events = eventData;

  } 

  // my classes

  const {data: classResponse, error: classError } = await useApiFetch("api/student/getClasses", {});
  definePageMeta({ layout: "student" })
  console.log(classResponse)





  </script>
  

  <style scoped>
    .app {
      font-family: Arial, Helvetica Neue, Helvetica, sans-serif;
      font-size: 14px;
    }
  </style>



  