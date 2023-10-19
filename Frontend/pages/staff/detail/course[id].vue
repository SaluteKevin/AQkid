<template>
    <div class="flex flex-col justify-center items-center min-h-screen ">
        <div class="relative flex py-5 items-center w-full px-10 mt-8">
            <div class="flex-grow border-t border-gray-400"></div>
            <span class="flex-shrink mx-4 text-6xl text-gray-400">{{course.title}}</span>
            <div class="flex-grow border-t border-gray-400"></div>
        </div>

        <div
            class="mt-8 relative flex flex-col items-center rounded-[20px] w-[700px] max-w-[95%] mx-auto bg-white shadow-2xl p-3 border broder-gray-400">
            <div class="mt-2 mb-8 w-full ">
                <h4 class="px-2 text-xl font-bold text-navy-700 ">
                    Course Information
                </h4>
                <p class="mt-2 px-2 text-base text-gray-600">
                    {{course.description}}
                </p>
            </div>
            <div class="grid grid-cols-2 gap-4 px-2 w-full ">
                <div
                    class="flex flex-col items-start justify-center rounded-2xl bg-white bg-clip-border px-3 py-4 shadow-lg ">
                    <p class="text-sm text-gray-600">Quota</p>
                    <p class="text-base font-medium text-navy-700 ">
                        {{course.quota}} classes
                    </p>
                </div>

                <div class="flex flex-col justify-center rounded-2xl bg-white bg-clip-border px-3 py-4 shadow-lg">
                    <p class="text-sm text-gray-600">Capacity</p>
                    <p class="text-base font-medium text-navy-700">
                       {{ course.enroll_count }} / {{course.capacity}} people 
                    </p>
                </div>

                <div
                    class="flex flex-col items-start justify-center rounded-2xl bg-white bg-clip-border px-3 py-4 shadow-lg ">
                    <p class="text-sm text-gray-600">Age-restricted</p>
                    <p class="text-base font-medium text-navy-700 ">
                        {{ course.min_age }} to {{ course.max_age }} years old
                    </p>
                </div>

                <div class="flex flex-col justify-center rounded-2xl bg-white bg-clip-border px-3 py-4 shadow-lg ">
                    <p class="text-sm text-gray-600">Class duration</p>
                    <p class="text-base font-medium text-navy-700">
                        {{course.duration}} Minutes
                    </p>
                </div>

                <div
                    class="flex flex-col items-start justify-center rounded-2xl bg-white bg-clip-border px-3 py-4 shadow-lg ">
                    <p class="text-sm text-gray-600">Status</p>
                    <p class="text-base font-medium text-navy-700 ">
                        {{course.status}}
                    </p>
                </div>

                <div class="flex flex-col justify-center rounded-2xl bg-white bg-clip-border px-3 py-4 shadow-lg ">
                    <p class="text-sm text-gray-600">Course price</p>
                    <p class="text-base font-medium text-navy-700 ">
                        {{course.price}}
                    </p>
                </div>
            </div>
        </div>

        <div class="relative flex py-5 items-center w-full px-10 mt-8">
            <div class="flex-grow border-t border-gray-400"></div>
            <span class="flex-shrink mx-4 text-6xl text-gray-400">Course Timeslots</span>
            <div class="flex-grow border-t border-gray-400"></div>
        </div>


        <div class='app bg-white p-12 transform ease-in-out m-12 shadow-2xl border rounded-2xl'>
            <FullCalendar :options='calendarOptions' />
        </div>

    </div>
</template>

<script setup lang="ts">
definePageMeta({ layout: "staff" })
import FullCalendar from '@fullcalendar/vue3'
import interactionPlugin from '@fullcalendar/interaction'
import timeGridPlugin from '@fullcalendar/timegrid'
import dayGridPlugin from '@fullcalendar/daygrid'

const calendarOptions = ref({
    plugins: [interactionPlugin, timeGridPlugin, dayGridPlugin],
    initialView: 'timeGridWeek',
    nowIndicator: true,
    editable: false,
    //   dateClick: handleDateClick,
    eventClick: handleEventClick,
    //   eventMouseEnter: handleEventhover,
    //   eventMouseLeave: handleEventLeave,
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

})

const eventData = ref([])


// { title: 'ink bd', start: '2023-11-03 10:00:00', id: 123, color: 'purple', description: 'description for Repeating Event', eventClassNames: "test" },
//     { title: 'event 1', date: '2023-12-19' },
//     { title: 'event 1', date: '2023-12-19' },
//     { title: 'event 1', date: '2023-12-19' },
//     { title: 'event 2', date: '2023-09-12' }

if (eventData.value) {
    calendarOptions.value.events = eventData;

}

async function handleEventClick(arg) {

    await navigateTo(`/staff/detail/timeslot${arg.event.extendedProps.uid}`);

}


// course info 


const route = useRoute();

const course = ref({})

const { data: courseResponse, error: courseError } = await useApiFetch(`api/staff/courses/${route.params.id}`, {});

if (courseResponse.value) {

    course.value = courseResponse.value;

    let first = 1;

    for(const event in courseResponse.value.timeslots){

        if (first != 0){

            calendarOptions.value.initialDate = courseResponse.value.timeslots[event].datetime

            first = 0;
        }

        let temp = {
            title: courseResponse.value.title,
            start: courseResponse.value.timeslots[event].datetime,
            uid: courseResponse.value.timeslots[event].id,
            color: 'green',
            
        }
        
        eventData.value.push(temp);
    
    }
    
}

else {
    if (courseError.value) {

    }
}





</script>