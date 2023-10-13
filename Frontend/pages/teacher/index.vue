<template>
    <div class="container mx-auto grid grid-cols-4 gap-10">
        <div class='app p-12 col-span-3'>
            <FullCalendar :options='calendarOptions' />
        </div>

        <div class="col-span-1">
        <ul class="bg-white rounded-lg shadow divide-y divide-gray-200 max-w-sm">
            <li class="px-6 py-4">
                <div class="flex justify-between">
                    <span class="font-semibold text-lg">List Item 1</span>
                    <span class="text-gray-500 text-xs">1 day ago</span>
                </div>
                <p class="text-gray-700">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam in dui mauris.</p>
            </li>
            <li class="px-6 py-4">
                <div class="flex justify-between">
                    <span class="font-semibold text-lg">List Item 2</span>
                    <span class="text-gray-500 text-xs">2 days ago</span>
                </div>
                <p class="text-gray-700">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam in dui mauris.</p>
            </li>
            <li class="px-6 py-4">
                <div class="flex justify-between">
                    <span class="font-semibold text-lg">List Item 3</span>
                    <span class="text-gray-500 text-xs">3 days ago</span>
                </div>
                <p class="text-gray-700">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam in dui mauris.</p>
            </li>
        </ul>
    </div>
    </div>


  </template>
  
  <script setup lang="ts">
  definePageMeta({layout: "staff"})
  import FullCalendar from '@fullcalendar/vue3'
  import interactionPlugin from '@fullcalendar/interaction'
  import timeGridPlugin from '@fullcalendar/timegrid'
  import dayGridPlugin from '@fullcalendar/daygrid'
import { Calendar } from '@fullcalendar/core'

  const events = ref([{}]);

   const {data: eventData, error: loginError } = await useApiFetch("api/teacher/getEvent", {});



    if(eventData.value) {
      // event.value = eventData.value

      const eventArray: any[] = []

      for(const event in eventData.value){

        let eventLoop = {}
        eventLoop["title"] = eventData.value[event].title
        eventLoop["date"] = eventData.value[event].start_datetime
        eventArray.push(eventLoop)
        
        
      }
      events.value = eventArray
      console.log(eventArray)
    }

  const calendarOptions = ref({
          plugins: [interactionPlugin, timeGridPlugin, dayGridPlugin],
          initialView: 'dayGridMonth',
          nowIndicator: true,
          editable: true,
          dateClick: handleDateClick,
          eventClick: handleEventClick,
        //   initialEvents: [
        //     { title: 'nice event', start: new Date(2023,12,15) }
        //   ],
          events: events.value
  
        })
    
    // const eventData = ref([
    //   { title: 'eiei' ,date: '2023-10-13'},
    //   { title: 'eiei2' ,date: '2023-10-13'},
    // ]);


    async function  handleDateClick (arg) {
      alert('date click! ');
    }

    function  handleEventClick (arg) {
      alert(arg);
      console.log(arg)
    }
    
  </script>
  
  <style scoped>
    .app {
      font-family: Arial, Helvetica Neue, Helvetica, sans-serif;
      font-size: 14px;
    }
  </style>