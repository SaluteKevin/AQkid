<template>
    <div class="bg-gradient-to-t from-blue-200 from-30% to-80% to-sky-100 pb-20">
        <div class="text-4xl pt-12 ml-12 font-bold text-gray-700 ">
            Enroll Course
        </div>
        <div class='app p-6 transform ease-in-out '>
            <FullCalendar :options='calendarOptions' class="bg-white p-6 rounded-xl" />
        </div>
        <div  ref="scrollEvent" v-if="showCard" class="flex w-full justify-center">
            <div class="bg-white max-w-2xl shadow overflow-hidden sm:rounded-lg">
                <div class="px-4 py-5 sm:px-6">
                    <h3 class="text-lg leading-6 font-medium text-gray-900">
                        Course Info
                    </h3>
                    <p class="mt-1 max-w-2xl text-sm text-gray-500">
                        Details and informations about course.
                    </p>
                </div>
                <div class="border-t border-gray-200">
                    <dl>
                        <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dt class="text-sm font-medium text-gray-500">
                                Day
                            </dt>
                            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                {{ day }}
                            </dd>
                        </div>
                        <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dt class="text-sm font-medium text-gray-500">
                                Time
                            </dt>
                            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                {{ time }}
                            </dd>
                        </div>
                        <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dt class="text-sm font-medium text-gray-500">
                                Already in
                            </dt>
                            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                <div v-if="author">Yes</div>
                                <div v-if="!author">No</div>
                            </dd>
                        </div>
                        <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dt class="text-sm font-medium text-gray-500">
                                Capacity
                            </dt>
                            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                {{ enroll_count }} / {{ capacity }} people
                            </dd>
                        </div>
                        <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dt class="text-sm font-medium text-gray-500">
                                Age-restricted
                            </dt>
                            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                
                                <div>min_age : 
                                    <span v-if="min_age < 12">{{min_age}} 
                                        <span v-if="min_age == 1">month</span> 
                                        <span v-if="min_age > 1">months</span>
                                    </span>
                                    <span v-if="min_age >= 12">{{min_age / 12}} 
                                        <span v-if="min_age / 12 == 1">year</span> 
                                        <span v-if="min_age / 12 > 1">years</span>
                                    </span>
                                </div>
                                <div>max_age : 
                                    <span v-if="max_age < 12">{{max_age}} 
                                        <span v-if="max_age == 1">month</span> 
                                        <span v-if="max_age > 1">months</span>
                                    </span>
                                    <span v-if="max_age >= 12">{{max_age / 12}} 
                                        <span v-if="max_age / 12 == 1">year</span> 
                                        <span v-if="max_age / 12 > 1">years</span>
                                    </span>
                                    
                                </div>
                            </dd>
                        </div>
    
                        <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            
                            
                            <NuxtLink v-if="!author && myAge >= min_age && myAge <= max_age" :to="`/course/confirmCourse${idCourse}`"
                                class="rounded-lg group relative px-8 py-1 overflow-hidden bg-green-300 hover:bg-green-400 focus:bg-green-500 text-xl shadow my-6">
                                View
                            </NuxtLink>
                            
                            <span v-else>Not available</span>
    
                        </div>
                    </dl>
                </div>
            </div>
        </div>
    </div>


</template>

<script setup lang="ts">

definePageMeta({ layout: "student" })


import FullCalendar from '@fullcalendar/vue3'
import interactionPlugin from '@fullcalendar/interaction'
import timeGridPlugin from '@fullcalendar/timegrid'
import dayGridPlugin from '@fullcalendar/daygrid'
import dayjs from 'dayjs';

const calendarOptions = ref({
    plugins: [interactionPlugin, timeGridPlugin, dayGridPlugin],
    initialView: 'dayGridMonth',
    nowIndicator: true,
    editable: false,
    //   dateClick: handleDateClick,
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



const eventData = ref([])


import { useAuthStore } from "~/stores/useAuthStore";
const user = useAuthStore().user;

const myAge = ref(dayjs().diff(dayjs(user.value.birthdate), 'month'));


// all courses
const { data: eventCourse, error: eventError } = await useApiFetch(`api/student/allEnrollCourse/${user.value.id}`, {});

if (eventCourse.value) {


    for (const event in eventCourse.value) {

        let temp = {
            title: eventCourse.value[event].title,
            start: eventCourse.value[event].starts_on,
            uid: eventCourse.value[event].id,
            datestore: eventCourse.value[event].starts_on,
            author: eventCourse.value[event].author,
            max_age: eventCourse.value[event].max_age,
            min_age: eventCourse.value[event].min_age,
            enroll_count: eventCourse.value[event].studentsIn,
            capacity: eventCourse.value[event].capacity,

        }

        if (dayjs(eventCourse.value[event].starts_on).day() == 0) {
            temp["color"] = 'red';
        }

        if (dayjs(eventCourse.value[event].starts_on).day() == 1) {
            temp["color"] = 'yellow';
        }

        if (dayjs(eventCourse.value[event].starts_on).day() == 2) {
            temp["color"] = 'pink';
        }

        if (dayjs(eventCourse.value[event].starts_on).day() == 3) {
            temp["color"] = 'green';
        }

        if (dayjs(eventCourse.value[event].starts_on).day() == 4) {
            temp["color"] = 'orange';
        }

        if (dayjs(eventCourse.value[event].starts_on).day() == 5) {
            temp["color"] = 'blue';
        }

        if (dayjs(eventCourse.value[event].starts_on).day() == 6) {
            temp["color"] = 'purple';
        }

        if (eventCourse.value[event].author) {
            temp["color"] = 'gray';
        }

        eventData.value.push(temp);


    }


} else {

    if (eventError.value) {

    }

}


calendarOptions.value.events = eventData;



const showCard = ref(false);
const day = ref('please select the time')
const time = ref<any>('')
const author = ref(false)
const idCourse = ref(0)
const max_age = ref(0)
const min_age = ref(0)
const enroll_count = ref(0)
const capacity = ref(0)



async function handleEventClick(arg) {

    const daysOfWeek = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];
    day.value = daysOfWeek[new Date(arg.event.start).getDay()]
    time.value = formatTime(new Date(arg.event.start))
    idCourse.value = arg.event.extendedProps.uid
    author.value = arg.event.extendedProps.author;
    max_age.value = arg.event.extendedProps.max_age;
    min_age.value = arg.event.extendedProps.min_age;
    enroll_count.value = arg.event.extendedProps.enroll_count;
    capacity.value = arg.event.extendedProps.capacity;
    
    await showCardtrue();

    await toEvent();

}

function formatTime(date) {
    const hours = date.getHours();
    const minutes = date.getMinutes();
    const seconds = date.getSeconds();
    const ampm = hours >= 12 ? 'PM' : 'AM';

    // Convert 24-hour format to 12-hour format
    const formattedHours = hours % 12 || 12;

    // Add leading zeros to minutes and seconds if needed
    const formattedMinutes = minutes < 10 ? `0${minutes}` : minutes;
    const formattedSeconds = seconds < 10 ? `0${seconds}` : seconds;

    // Combine the formatted time components
    const formattedTime = `${formattedHours}:${formattedMinutes}:${formattedSeconds} ${ampm}`;

    return formattedTime;
}

const clickOutside = () => {
    showCard.value = false;
};

const showCardtrue = async() => {
    showCard.value = true;
}

const scrollEvent = ref()


const toEvent  = async() => {

  if (scrollEvent.value) {

      const element = scrollEvent.value.getBoundingClientRect();

      // Scroll to the element with smooth animation
      window.scrollTo({
          top: element.top + window.scrollY,
          behavior: 'smooth',
      });
  }

};



</script>