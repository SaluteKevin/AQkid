<template>
    <div class="flex flex-col justify-center items-center min-h-screen ">
        <div class="relative flex py-5 items-center w-full px-10 mt-8">
            <div class="flex-grow border-t border-gray-400"></div>
            <span class="flex-shrink mx-4 text-6xl text-gray-400">{{ course.title }}</span>
            <div class="flex-grow border-t border-gray-400"></div>
        </div>

        <div
            class="mt-8 relative flex flex-col items-center rounded-[20px] w-[700px] max-w-[95%] mx-auto bg-white shadow-2xl p-3 border broder-gray-400">
            <div class="mt-2 mb-8 w-full ">
                <h4 class="px-2 text-xl font-bold text-navy-700 ">
                    Course Information
                </h4>
                <p class="mt-2 px-2 text-base text-gray-600">
                    {{ course.description }}
                </p>
            </div>
            <div class="grid grid-cols-2 gap-4 px-2 w-full ">
                <div
                    class="flex flex-col items-start justify-center rounded-2xl bg-white bg-clip-border px-3 py-4 shadow-lg ">
                    <p class="text-sm text-gray-600">Quota</p>
                    <p class="text-base font-medium text-navy-700 ">
                        {{ course.quota }} classes
                    </p>
                </div>

                <div class="flex flex-col justify-center rounded-2xl bg-white bg-clip-border px-3 py-4 shadow-lg">
                    <p class="text-sm text-gray-600">Capacity</p>
                    <p class="text-base font-medium text-navy-700">
                        {{ course.enroll_count }} / {{ course.capacity }} people
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
                        {{ course.duration }} Minutes
                    </p>
                </div>

                <div
                    class="flex flex-col items-start justify-center rounded-2xl bg-white bg-clip-border px-3 py-4 shadow-lg ">
                    <p class="text-sm text-gray-600">Status</p>
                    <p class="text-base font-medium text-navy-700 ">
                        {{ course.status }}
                    </p>
                </div>

                <div class="flex flex-col justify-center rounded-2xl bg-white bg-clip-border px-3 py-4 shadow-lg ">
                    <p class="text-sm text-gray-600">Course price</p>
                    <p class="text-base font-medium text-navy-700 ">
                        {{ course.price }}
                    </p>
                </div>
            </div>
        </div>

        <div class="relative flex py-5 items-center w-full px-10 mt-8">
            <div class="flex-grow border-t border-gray-400"></div>
            <span class="flex-shrink mx-4 text-6xl text-gray-400">Course Timeslots</span>
            <div class="flex-grow border-t border-gray-400"></div>
        </div>

        <div v-click-outside="clickOutside" v-if="timeslotShow" ref="scrollCourse"
            class=" p-6  border border-gray-200 rounded-lg shadow-lg">

            <h5 class="mb-2 text-2xl font-bold  text-gray-900">{{ timeslotSelected.title }}</h5>

            <p class="mb-3 font-normal text-gray-700 ">Date: {{ timeslotSelected.start }}</p>
            <NuxtLink :to="`/staff/detail/timeslot${timeslotSelected.uid}`"
                class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                See Timeslot Information
                <svg class="w-3.5 h-3.5 ml-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 14 10">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M1 5h12m0 0L9 1m4 4L9 9" />
                </svg>
            </NuxtLink>
        </div>

        <div class='app bg-white p-12 transform ease-in-out m-12 shadow-2xl border rounded-2xl'>
            <FullCalendar :options='calendarOptions' />
        </div>

        <div>
            <div class="container">
                <div class="flex flex-wrap lg:justify-between -mx-4">
                    <div class="w-full lg:w-1/2 xl:w-6/12 px-4">
                        <div class="max-w-[570px] mb-12 lg:mb-0">
                            
                            <h2 class="
                  text-dark
                  mb-6
                  uppercase
                  font-bold
                  text-[32px]
                  sm:text-[40px]
                  lg:text-[36px]
                  xl:text-[40px]
                  ">
                                Create Timeslot
                            </h2>
                            <p class="text-base text-body-color leading-relaxed mb-9">
                                <span>> Select How you gonna create new timeslot <br>Append / Specify</span><br>
                                <span> <span class="text-red-400">**</span> Append will automatically add a new timeslot after the last class.</span><br>
                                <span> <span class="text-red-400">**</span> You can choose a specific date, but it must have the same time and day.</span>
                            </p>

                        </div>
                    </div>
                    <div class="w-full lg:w-1/2 xl:w-5/12 px-4">
                        <div class="bg-white relative rounded-lg p-8 sm:p-12 shadow-lg">
                            <form>
                                <div class="text-2xl mb-4">Create Timeslot form</div>
                                <div class="mb-6">
                                    <input v-model="isAppend" v-on:change="handleAppend" type="checkbox" id="choice1" name="choice1">
                                    <label for="choice1"> Append</label><br>
                                    <input v-model="isSpecify" v-on:change="handleSpecify" type="checkbox" id="choice2" name="vehicle2">
                                    <label for="choice2"> Specify</label><br>
                                </div>
                                <div v-if="showSpecifyDate" class="mb-6">
                                    <input 
                                type="date" 
                        class=" w-full
                        rounded
                        py-3
                        px-[14px]
                        text-body-color text-base
                        border border-[f0f0f0]
                        outline-none
                        focus-visible:shadow-none
                        focus:border-primary
                        " >
                                   
                                </div>
                                
                                <div>
                                    <button v-if="showSubmitTimeslot" type="submit" class="
                        w-full
                        
                        bg-primary
                        rounded
                        border border-primary
                        p-3
                        transition
                        hover:bg-opacity-90
                        ">
                                        Create Timeslot
                                    </button>
                                </div>
                            </form>
                            <div>
                                <span class="absolute -top-10 -right-9 z-[-1]">
                                    <svg width="100" height="100" viewBox="0 0 100 100" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M0 100C0 44.7715 0 0 0 0C55.2285 0 100 44.7715 100 100C100 100 100 100 0 100Z"
                                            fill="#3056D3" />
                                    </svg>
                                </span>
                                <span class="absolute -right-10 top-[90px] z-[-1]">
                                    <svg width="34" height="134" viewBox="0 0 34 134" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <circle cx="31.9993" cy="132" r="1.66667" transform="rotate(180 31.9993 132)"
                                            fill="#13C296" />
                                        <circle cx="31.9993" cy="117.333" r="1.66667"
                                            transform="rotate(180 31.9993 117.333)" fill="#13C296" />
                                        <circle cx="31.9993" cy="102.667" r="1.66667"
                                            transform="rotate(180 31.9993 102.667)" fill="#13C296" />
                                        <circle cx="31.9993" cy="88" r="1.66667" transform="rotate(180 31.9993 88)"
                                            fill="#13C296" />
                                        <circle cx="31.9993" cy="73.3333" r="1.66667"
                                            transform="rotate(180 31.9993 73.3333)" fill="#13C296" />
                                        <circle cx="31.9993" cy="45" r="1.66667" transform="rotate(180 31.9993 45)"
                                            fill="#13C296" />
                                        <circle cx="31.9993" cy="16" r="1.66667" transform="rotate(180 31.9993 16)"
                                            fill="#13C296" />
                                        <circle cx="31.9993" cy="59" r="1.66667" transform="rotate(180 31.9993 59)"
                                            fill="#13C296" />
                                        <circle cx="31.9993" cy="30.6666" r="1.66667"
                                            transform="rotate(180 31.9993 30.6666)" fill="#13C296" />
                                        <circle cx="31.9993" cy="1.66665" r="1.66667"
                                            transform="rotate(180 31.9993 1.66665)" fill="#13C296" />
                                        <circle cx="17.3333" cy="132" r="1.66667" transform="rotate(180 17.3333 132)"
                                            fill="#13C296" />
                                        <circle cx="17.3333" cy="117.333" r="1.66667"
                                            transform="rotate(180 17.3333 117.333)" fill="#13C296" />
                                        <circle cx="17.3333" cy="102.667" r="1.66667"
                                            transform="rotate(180 17.3333 102.667)" fill="#13C296" />
                                        <circle cx="17.3333" cy="88" r="1.66667" transform="rotate(180 17.3333 88)"
                                            fill="#13C296" />
                                        <circle cx="17.3333" cy="73.3333" r="1.66667"
                                            transform="rotate(180 17.3333 73.3333)" fill="#13C296" />
                                        <circle cx="17.3333" cy="45" r="1.66667" transform="rotate(180 17.3333 45)"
                                            fill="#13C296" />
                                        <circle cx="17.3333" cy="16" r="1.66667" transform="rotate(180 17.3333 16)"
                                            fill="#13C296" />
                                        <circle cx="17.3333" cy="59" r="1.66667" transform="rotate(180 17.3333 59)"
                                            fill="#13C296" />
                                        <circle cx="17.3333" cy="30.6666" r="1.66667"
                                            transform="rotate(180 17.3333 30.6666)" fill="#13C296" />
                                        <circle cx="17.3333" cy="1.66665" r="1.66667"
                                            transform="rotate(180 17.3333 1.66665)" fill="#13C296" />
                                        <circle cx="2.66536" cy="132" r="1.66667" transform="rotate(180 2.66536 132)"
                                            fill="#13C296" />
                                        <circle cx="2.66536" cy="117.333" r="1.66667"
                                            transform="rotate(180 2.66536 117.333)" fill="#13C296" />
                                        <circle cx="2.66536" cy="102.667" r="1.66667"
                                            transform="rotate(180 2.66536 102.667)" fill="#13C296" />
                                        <circle cx="2.66536" cy="88" r="1.66667" transform="rotate(180 2.66536 88)"
                                            fill="#13C296" />
                                        <circle cx="2.66536" cy="73.3333" r="1.66667"
                                            transform="rotate(180 2.66536 73.3333)" fill="#13C296" />
                                        <circle cx="2.66536" cy="45" r="1.66667" transform="rotate(180 2.66536 45)"
                                            fill="#13C296" />
                                        <circle cx="2.66536" cy="16" r="1.66667" transform="rotate(180 2.66536 16)"
                                            fill="#13C296" />
                                        <circle cx="2.66536" cy="59" r="1.66667" transform="rotate(180 2.66536 59)"
                                            fill="#13C296" />
                                        <circle cx="2.66536" cy="30.6666" r="1.66667"
                                            transform="rotate(180 2.66536 30.6666)" fill="#13C296" />
                                        <circle cx="2.66536" cy="1.66665" r="1.66667"
                                            transform="rotate(180 2.66536 1.66665)" fill="#13C296" />
                                    </svg>
                                </span>
                                <span class="absolute -left-7 -bottom-7 z-[-1]">
                                    <svg width="107" height="134" viewBox="0 0 107 134" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <circle cx="104.999" cy="132" r="1.66667" transform="rotate(180 104.999 132)"
                                            fill="#13C296" />
                                        <circle cx="104.999" cy="117.333" r="1.66667"
                                            transform="rotate(180 104.999 117.333)" fill="#13C296" />
                                        <circle cx="104.999" cy="102.667" r="1.66667"
                                            transform="rotate(180 104.999 102.667)" fill="#13C296" />
                                        <circle cx="104.999" cy="88" r="1.66667" transform="rotate(180 104.999 88)"
                                            fill="#13C296" />
                                        <circle cx="104.999" cy="73.3333" r="1.66667"
                                            transform="rotate(180 104.999 73.3333)" fill="#13C296" />
                                        <circle cx="104.999" cy="45" r="1.66667" transform="rotate(180 104.999 45)"
                                            fill="#13C296" />
                                        <circle cx="104.999" cy="16" r="1.66667" transform="rotate(180 104.999 16)"
                                            fill="#13C296" />
                                        <circle cx="104.999" cy="59" r="1.66667" transform="rotate(180 104.999 59)"
                                            fill="#13C296" />
                                        <circle cx="104.999" cy="30.6666" r="1.66667"
                                            transform="rotate(180 104.999 30.6666)" fill="#13C296" />
                                        <circle cx="104.999" cy="1.66665" r="1.66667"
                                            transform="rotate(180 104.999 1.66665)" fill="#13C296" />
                                        <circle cx="90.3333" cy="132" r="1.66667" transform="rotate(180 90.3333 132)"
                                            fill="#13C296" />
                                        <circle cx="90.3333" cy="117.333" r="1.66667"
                                            transform="rotate(180 90.3333 117.333)" fill="#13C296" />
                                        <circle cx="90.3333" cy="102.667" r="1.66667"
                                            transform="rotate(180 90.3333 102.667)" fill="#13C296" />
                                        <circle cx="90.3333" cy="88" r="1.66667" transform="rotate(180 90.3333 88)"
                                            fill="#13C296" />
                                        <circle cx="90.3333" cy="73.3333" r="1.66667"
                                            transform="rotate(180 90.3333 73.3333)" fill="#13C296" />
                                        <circle cx="90.3333" cy="45" r="1.66667" transform="rotate(180 90.3333 45)"
                                            fill="#13C296" />
                                        <circle cx="90.3333" cy="16" r="1.66667" transform="rotate(180 90.3333 16)"
                                            fill="#13C296" />
                                        <circle cx="90.3333" cy="59" r="1.66667" transform="rotate(180 90.3333 59)"
                                            fill="#13C296" />
                                        <circle cx="90.3333" cy="30.6666" r="1.66667"
                                            transform="rotate(180 90.3333 30.6666)" fill="#13C296" />
                                        <circle cx="90.3333" cy="1.66665" r="1.66667"
                                            transform="rotate(180 90.3333 1.66665)" fill="#13C296" />
                                        <circle cx="75.6654" cy="132" r="1.66667" transform="rotate(180 75.6654 132)"
                                            fill="#13C296" />
                                        <circle cx="31.9993" cy="132" r="1.66667" transform="rotate(180 31.9993 132)"
                                            fill="#13C296" />
                                        <circle cx="75.6654" cy="117.333" r="1.66667"
                                            transform="rotate(180 75.6654 117.333)" fill="#13C296" />
                                        <circle cx="31.9993" cy="117.333" r="1.66667"
                                            transform="rotate(180 31.9993 117.333)" fill="#13C296" />
                                        <circle cx="75.6654" cy="102.667" r="1.66667"
                                            transform="rotate(180 75.6654 102.667)" fill="#13C296" />
                                        <circle cx="31.9993" cy="102.667" r="1.66667"
                                            transform="rotate(180 31.9993 102.667)" fill="#13C296" />
                                        <circle cx="75.6654" cy="88" r="1.66667" transform="rotate(180 75.6654 88)"
                                            fill="#13C296" />
                                        <circle cx="31.9993" cy="88" r="1.66667" transform="rotate(180 31.9993 88)"
                                            fill="#13C296" />
                                        <circle cx="75.6654" cy="73.3333" r="1.66667"
                                            transform="rotate(180 75.6654 73.3333)" fill="#13C296" />
                                        <circle cx="31.9993" cy="73.3333" r="1.66667"
                                            transform="rotate(180 31.9993 73.3333)" fill="#13C296" />
                                        <circle cx="75.6654" cy="45" r="1.66667" transform="rotate(180 75.6654 45)"
                                            fill="#13C296" />
                                        <circle cx="31.9993" cy="45" r="1.66667" transform="rotate(180 31.9993 45)"
                                            fill="#13C296" />
                                        <circle cx="75.6654" cy="16" r="1.66667" transform="rotate(180 75.6654 16)"
                                            fill="#13C296" />
                                        <circle cx="31.9993" cy="16" r="1.66667" transform="rotate(180 31.9993 16)"
                                            fill="#13C296" />
                                        <circle cx="75.6654" cy="59" r="1.66667" transform="rotate(180 75.6654 59)"
                                            fill="#13C296" />
                                        <circle cx="31.9993" cy="59" r="1.66667" transform="rotate(180 31.9993 59)"
                                            fill="#13C296" />
                                        <circle cx="75.6654" cy="30.6666" r="1.66667"
                                            transform="rotate(180 75.6654 30.6666)" fill="#13C296" />
                                        <circle cx="31.9993" cy="30.6666" r="1.66667"
                                            transform="rotate(180 31.9993 30.6666)" fill="#13C296" />
                                        <circle cx="75.6654" cy="1.66665" r="1.66667"
                                            transform="rotate(180 75.6654 1.66665)" fill="#13C296" />
                                        <circle cx="31.9993" cy="1.66665" r="1.66667"
                                            transform="rotate(180 31.9993 1.66665)" fill="#13C296" />
                                        <circle cx="60.9993" cy="132" r="1.66667" transform="rotate(180 60.9993 132)"
                                            fill="#13C296" />
                                        <circle cx="17.3333" cy="132" r="1.66667" transform="rotate(180 17.3333 132)"
                                            fill="#13C296" />
                                        <circle cx="60.9993" cy="117.333" r="1.66667"
                                            transform="rotate(180 60.9993 117.333)" fill="#13C296" />
                                        <circle cx="17.3333" cy="117.333" r="1.66667"
                                            transform="rotate(180 17.3333 117.333)" fill="#13C296" />
                                        <circle cx="60.9993" cy="102.667" r="1.66667"
                                            transform="rotate(180 60.9993 102.667)" fill="#13C296" />
                                        <circle cx="17.3333" cy="102.667" r="1.66667"
                                            transform="rotate(180 17.3333 102.667)" fill="#13C296" />
                                        <circle cx="60.9993" cy="88" r="1.66667" transform="rotate(180 60.9993 88)"
                                            fill="#13C296" />
                                        <circle cx="17.3333" cy="88" r="1.66667" transform="rotate(180 17.3333 88)"
                                            fill="#13C296" />
                                        <circle cx="60.9993" cy="73.3333" r="1.66667"
                                            transform="rotate(180 60.9993 73.3333)" fill="#13C296" />
                                        <circle cx="17.3333" cy="73.3333" r="1.66667"
                                            transform="rotate(180 17.3333 73.3333)" fill="#13C296" />
                                        <circle cx="60.9993" cy="45" r="1.66667" transform="rotate(180 60.9993 45)"
                                            fill="#13C296" />
                                        <circle cx="17.3333" cy="45" r="1.66667" transform="rotate(180 17.3333 45)"
                                            fill="#13C296" />
                                        <circle cx="60.9993" cy="16" r="1.66667" transform="rotate(180 60.9993 16)"
                                            fill="#13C296" />
                                        <circle cx="17.3333" cy="16" r="1.66667" transform="rotate(180 17.3333 16)"
                                            fill="#13C296" />
                                        <circle cx="60.9993" cy="59" r="1.66667" transform="rotate(180 60.9993 59)"
                                            fill="#13C296" />
                                        <circle cx="17.3333" cy="59" r="1.66667" transform="rotate(180 17.3333 59)"
                                            fill="#13C296" />
                                        <circle cx="60.9993" cy="30.6666" r="1.66667"
                                            transform="rotate(180 60.9993 30.6666)" fill="#13C296" />
                                        <circle cx="17.3333" cy="30.6666" r="1.66667"
                                            transform="rotate(180 17.3333 30.6666)" fill="#13C296" />
                                        <circle cx="60.9993" cy="1.66665" r="1.66667"
                                            transform="rotate(180 60.9993 1.66665)" fill="#13C296" />
                                        <circle cx="17.3333" cy="1.66665" r="1.66667"
                                            transform="rotate(180 17.3333 1.66665)" fill="#13C296" />
                                        <circle cx="46.3333" cy="132" r="1.66667" transform="rotate(180 46.3333 132)"
                                            fill="#13C296" />
                                        <circle cx="2.66536" cy="132" r="1.66667" transform="rotate(180 2.66536 132)"
                                            fill="#13C296" />
                                        <circle cx="46.3333" cy="117.333" r="1.66667"
                                            transform="rotate(180 46.3333 117.333)" fill="#13C296" />
                                        <circle cx="2.66536" cy="117.333" r="1.66667"
                                            transform="rotate(180 2.66536 117.333)" fill="#13C296" />
                                        <circle cx="46.3333" cy="102.667" r="1.66667"
                                            transform="rotate(180 46.3333 102.667)" fill="#13C296" />
                                        <circle cx="2.66536" cy="102.667" r="1.66667"
                                            transform="rotate(180 2.66536 102.667)" fill="#13C296" />
                                        <circle cx="46.3333" cy="88" r="1.66667" transform="rotate(180 46.3333 88)"
                                            fill="#13C296" />
                                        <circle cx="2.66536" cy="88" r="1.66667" transform="rotate(180 2.66536 88)"
                                            fill="#13C296" />
                                        <circle cx="46.3333" cy="73.3333" r="1.66667"
                                            transform="rotate(180 46.3333 73.3333)" fill="#13C296" />
                                        <circle cx="2.66536" cy="73.3333" r="1.66667"
                                            transform="rotate(180 2.66536 73.3333)" fill="#13C296" />
                                        <circle cx="46.3333" cy="45" r="1.66667" transform="rotate(180 46.3333 45)"
                                            fill="#13C296" />
                                        <circle cx="2.66536" cy="45" r="1.66667" transform="rotate(180 2.66536 45)"
                                            fill="#13C296" />
                                        <circle cx="46.3333" cy="16" r="1.66667" transform="rotate(180 46.3333 16)"
                                            fill="#13C296" />
                                        <circle cx="2.66536" cy="16" r="1.66667" transform="rotate(180 2.66536 16)"
                                            fill="#13C296" />
                                        <circle cx="46.3333" cy="59" r="1.66667" transform="rotate(180 46.3333 59)"
                                            fill="#13C296" />
                                        <circle cx="2.66536" cy="59" r="1.66667" transform="rotate(180 2.66536 59)"
                                            fill="#13C296" />
                                        <circle cx="46.3333" cy="30.6666" r="1.66667"
                                            transform="rotate(180 46.3333 30.6666)" fill="#13C296" />
                                        <circle cx="2.66536" cy="30.6666" r="1.66667"
                                            transform="rotate(180 2.66536 30.6666)" fill="#13C296" />
                                        <circle cx="46.3333" cy="1.66665" r="1.66667"
                                            transform="rotate(180 46.3333 1.66665)" fill="#13C296" />
                                        <circle cx="2.66536" cy="1.66665" r="1.66667"
                                            transform="rotate(180 2.66536 1.66665)" fill="#13C296" />
                                    </svg>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

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
    headerToolbar: {
        left: 'prev,next today',
        center: 'title',
        right: 'dayGridMonth,timeGridWeek,timeGridDay',
    },

})

const eventData = ref([])


// { title: 'ink bd', start: '2023-11-03 10:00:00', id: 123, color: 'purple', description: 'description for Repeating Event', eventClassNames: "test" },
//     { title: 'event 1', date: '2023-12-19' },
//     { title: 'event 1', date: '2023-12-19' },
//     { title: 'event 1', date: '2023-12-19' },
//     { title: 'event 2', date: '2023-09-12' }


calendarOptions.value.events = eventData;



async function handleEventClick(arg) {

    let temp = {
        title: arg.event.title,
        start: arg.event.extendedProps.datestore,
        uid: arg.event.extendedProps.uid,
        type: arg.event.extendedProps.type,

    };

    timeslotSelected.value = temp;
    await scrollToCourse();


}

// timeslot select

const timeslotSelected = ref();
const timeslotShow = ref(false);
const scrollCourse = ref();

function clickOutside() {
    timeslotShow.value = false;
}

async function scrollToCourse() {

    await setTimeslotToShow();

    if (scrollCourse.value) {
        const element = scrollCourse.value.getBoundingClientRect();

        // Scroll to the element with smooth animation
        window.scrollTo({
            top: element.top + window.scrollY - 100,
            behavior: 'smooth',
        });
    }

};

async function setTimeslotToShow() {
    timeslotShow.value = !timeslotShow.value;
}



// course info 


const route = useRoute();

const course = ref({})

const { data: courseResponse, error: courseError } = await useApiFetch(`api/staff/courses/${route.params.id}`, {});

if (courseResponse.value) {

    course.value = courseResponse.value;

    let first = 1;

    for (const event in courseResponse.value.timeslots) {

        if (first != 0) {

            calendarOptions.value.initialDate = courseResponse.value.timeslots[event].datetime

            first = 0;
        }

        let temp = {
            title: courseResponse.value.timeslots[event].title,
            start: courseResponse.value.timeslots[event].datetime,
            uid: courseResponse.value.timeslots[event].id,
            datestore: courseResponse.value.timeslots[event].datetime,
            type: courseResponse.value.timeslots[event].type,

        }

        if (courseResponse.value.timeslots[event].author == false) {
            temp["color"] = 'gray';

        }
        else {
            if (courseResponse.value.timeslots[event].type === "REGULAR") {
                temp["color"] = 'green';
            }

            if (courseResponse.value.timeslots[event].type === "MAKEUP") {
                temp["color"] = 'purple';
            }


        }

        eventData.value.push(temp);


    }


}

else {
    if (courseError.value) {

    }
}

// add timeslot

const showSpecifyDate = ref(false);
const showSubmitTimeslot = ref(false);
const selectedSpecify = ref('Append');

const isAppend = ref(false);
const isSpecify = ref(false);

function handleAppend() {

    // ถ้าเปลี่ยนเป็น true
    if (isAppend.value == true) {
    
        isSpecify.value = false;

        selectedSpecify.value = "Append";

        showSpecifyDate.value = false;

        showSubmitTimeslot.value = true;

    } else {

        showSubmitTimeslot.value = false;

    }

}

function handleSpecify() {

    // ถ้าเปลี่ยนเป็น true
    if (isSpecify.value == true) {
    
        isAppend.value = false;

        selectedSpecify.value = "Specify";

        showSpecifyDate.value = true;

    } else {

        showSpecifyDate.value = false;

        showSubmitTimeslot.value = false;

    }


}




</script>