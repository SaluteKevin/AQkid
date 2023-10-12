<template>
    <div class='app p-12 transform ease-in-out'>
      <FullCalendar :options='calendarOptions' />
    </div>
  </template>
  
  <script setup lang="ts">
  definePageMeta({layout: "staff"})
  import FullCalendar from '@fullcalendar/vue3'
  import interactionPlugin from '@fullcalendar/interaction'
  import timeGridPlugin from '@fullcalendar/timegrid'
  import dayGridPlugin from '@fullcalendar/daygrid'
  
  const event = ref({});


  // const { data : eventData , error : eventError } = await useApiFetch("api/auth/login", {});

                //  ^
                //  | ตัวเดียวกันข้อมูลโหลดมาเลย
                //  v
  // mock up
          const eventData = ref([
    { title: 'ink bd', date: '2023-12-19', key: 123},
    { title: 'event 1', date: '2023-12-19' },
    { title: 'event 1', date: '2023-12-19' },
    { title: 'event 1', date: '2023-12-19' },
    { title: 'event 2', date: '2023-09-12' }
    ])

  
  if (eventData.value) {
     event.value = eventData.value 

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
          events: event.value
        })

    function  handleDateClick (arg) {
      alert('date click! ' + arg.dateStr);
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