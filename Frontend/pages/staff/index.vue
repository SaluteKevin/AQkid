<template>
    <div class='app p-12 transform ease-in-out'>
      <FullCalendar :options='calendarOptions' />
    </div>


    <div v-if="showTooltip" class="custom-tooltip" :style="{ top: tooltipTop + 'px', left: tooltipLeft - 50  + 'px' }">
      {{ tooltipContent }}
    </div>
  </template>
  
  <script setup lang="ts">
  definePageMeta({layout: "staff"})
  import FullCalendar from '@fullcalendar/vue3'
  import interactionPlugin from '@fullcalendar/interaction'
  import timeGridPlugin from '@fullcalendar/timegrid'
  import dayGridPlugin from '@fullcalendar/daygrid'
  
  
  


  // const { data : eventData , error : eventError } = await useApiFetch("api/auth/login", {});

                //  ^
                //  | ตัวเดียวกันข้อมูลโหลดมาเลย
                //  v
  // mock up


  const calendarOptions = ref({
          plugins: [interactionPlugin, timeGridPlugin, dayGridPlugin],
          initialView: 'dayGridMonth',
          nowIndicator: true,
          editable: true,
          dateClick: handleDateClick,
          eventClick: handleEventClick,
          eventMouseEnter: handleEventhover,
          eventMouseLeave: handleEventLeave,
        
          

         
          // initialEvents: [
          //   { title: 'nice event', start: new Date(2023,12,15) }
          // ],
          events: ref([]),
          eventColor: '#378006'
  })
    
  
  const eventData = ref([
    { title: 'ink bd', date: '2023-12-19', id:123, color: 'purple',description: 'description for Repeating Event', eventClassNames: "test"},
    { title: 'event 1', date: '2023-12-19' },
    { title: 'event 1', date: '2023-12-19' },
    { title: 'event 1', date: '2023-12-19' },
    { title: 'event 2', date: '2023-09-12' }
    ])

  
  if (eventData.value) {
    calendarOptions.value.events = eventData;

  } 

 

  const showTooltip = ref(false);
  const tooltipContent = ref('');
  const tooltipTop = ref(0);
  const tooltipLeft = ref(0);


    function  handleDateClick (arg) {
      // alert('date click! ' + arg.dateStr);
      eventData.value.push({title: 'test', date: '2023-12-19'})
      // calendarOptions.value.events.push({title: 'test', date: '2023-12-19'})
    }

    function  handleEventClick (arg) {
      alert(arg);
      console.log(arg)
    }

    function handleEventhover (event) {
      showTooltip.value = true;
      tooltipContent.value = event.event.title; // Customize the content as needed
      tooltipTop.value = event.jsEvent.pageY;
      tooltipLeft.value = event.jsEvent.pageX;
      }

    function handleEventLeave () {
    showTooltip.value = false;
  };

 
  </script>




  
  <style scoped>
    .app {
      font-family: Arial, Helvetica Neue, Helvetica, sans-serif;
      font-size: 14px;
    }

    .test {
      font-size: xx-large;
    }

    .custom-tooltip {
      position: absolute;
      background-color: white;
      border: 1px solid #ccc;
      padding: 10px;
      z-index: 999;
    
  }
  </style>