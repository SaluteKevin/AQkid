<template>
    <div class='app p-12'>
      <FullCalendar :options='calendarOptions' />
    </div>
  </template>
  
  <script setup lang="ts">
  definePageMeta({layout: "staff"})
  import FullCalendar from '@fullcalendar/vue3'
  import interactionPlugin from '@fullcalendar/interaction'
  import timeGridPlugin from '@fullcalendar/timegrid'
  

  const calendarOptions = ref({
          plugins: [interactionPlugin, timeGridPlugin],
          initialView: 'timeGridWeek',
          nowIndicator: true,
          editable: true,
          initialEvents: [
            { title: 'nice event', start: new Date() }
          ]
        })

 
  </script>
  
  <style scoped>
    .app {
      font-family: Arial, Helvetica Neue, Helvetica, sans-serif;
      font-size: 14px;
    }
  </style>