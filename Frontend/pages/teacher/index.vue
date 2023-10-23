<template>
    <div class="container mx-auto grid grid-cols-4 gap-10">
        <div class='app p-12 col-span-3'>
            <FullCalendar :options='calendarOptions' />
        </div>

        <div class="col-span-1">
        <ul class="bg-white rounded-lg shadow divide-y divide-gray-200 max-w-sm">
            <li class="px-6 py-4" v-for="classes in showAgenda">
                <div class="flex justify-between">
                    <span class="font-semibold text-lg">{{classes.title}}</span>
                    
                </div>
                <p class="text-gray-700">This class start at {{classes.start_datetime}}</p>
                <button type="button">info</button>
            </li>
            
        </ul>
    </div>
    </div>


  </template>
  
  <script setup lang="ts">
  import FullCalendar from '@fullcalendar/vue3'
  import interactionPlugin from '@fullcalendar/interaction'
  import timeGridPlugin from '@fullcalendar/timegrid'
  import dayGridPlugin from '@fullcalendar/daygrid'
  import { Calendar } from '@fullcalendar/core'

  const events = ref([{}]);

  const showAgenda = ref([]);

   const {data: eventData, error: loginError } = await useApiFetch("api/teacher/getEvent", {});

   

    if(eventData.value) {
      // event.value = eventData.value

      const eventArray: any[] = []

      for(const event in eventData.value){

        let eventLoop = {}
        eventLoop["title"] = eventData.value[event].title
        eventLoop["date"] = eventData.value[event].starts_on
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
      alert('date click! '+ arg.dateStr);

      const selectDate = arg.dateStr

      showAgenda.value = []
     
      console.log(selectDate)
      for(const event in eventData.value){

        if (eventData.value[event].starts_on.split(" ")[0] === selectDate) {
          showAgenda.value.push(eventData.value[event])
        }
        

        

      }
     
      
      
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
