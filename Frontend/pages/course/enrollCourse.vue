<template>

    <div class="py-5 bg-cyan-900">
        <p class="text-center text-6xl text-gray-900 dark:text-black">Enroll Course</p>
    </div>

    <div class="h-screen bg-orange-500 pt-5">
        <div class="grid grid-rows-8 grid-cols-10 gap-1 px-80">
            <div class="content-center justify-center max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                <h5 class="text-center mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                    time
                </h5>
            </div>
            <div class="content-center justify-center max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                <h5 class="text-center mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                    9.00
                </h5>
            </div>
            <div class="content-center justify-center max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                <h5 class="text-center mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                    10.00
                </h5>
            </div>
            <div class="content-center justify-center max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                <h5 class="text-center mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                    11.00
                </h5>
            </div>
            <div class="content-center justify-center max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                <h5 class="text-center mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                    12.00
                </h5>
            </div>
            <div class="content-center justify-center max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                <h5 class="text-center mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                    13.00
                </h5>
            </div>
            <div class="content-center justify-center max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                <h5 class="text-center mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                    14.00
                </h5>
            </div>
            <div class="content-center justify-center max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                <h5 class="text-center mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                    15.00
                </h5>
            </div>
            <div class="content-center justify-center max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                <h5 class="text-center mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                    16.00
                </h5>
            </div>
            <div class="content-center justify-center max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                <h5 class="text-center mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                    17.00
                </h5>
            </div>
        </div>
        
        
        <div class="grid grid-rows-7 grid-cols-10 py-4 gap-1 px-80 ">
            
            
            
            
            
            
            <div class="content-center justify-center max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                <h5 class="text-center mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                    Monday
                </h5>
            </div>
            <div class="col-span-9 w-full bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                <h5 class="text-center text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                    Close
                </h5>
            </div>
            

            
            
            
            <div class="content-center justify-center max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                <h5 class="text-center mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                    Tuesday
                </h5>
            </div>
            <div class="col-span-9"></div>
            
            
            
            
            
            
            <div class="content-center justify-center max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                <h5 class="text-center mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                    Wednesday
                </h5>
            </div>
            <div class="col-span-9"></div>
            
            
            
            
            
            
            <div class="content-center justify-center max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                <h5 class="text-center mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                    Thursday
                </h5>
            </div>
            <div class="col-span-4"></div>

            <button type="button" @click="select('Thursday','10.00')" class="w-full text-white bg-gradient-to-r from-green-400 via-green-500 to-green-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-green-300 dark:focus:ring-green-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">Select</button>
            <button type="button" @click="select('Thursday','11.00')" class="w-full text-white bg-gradient-to-r from-green-400 via-green-500 to-green-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-green-300 dark:focus:ring-green-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">Select</button>
            <div class="col-span-3"></div>
            
            
            
            
            
            <div class="content-center justify-center max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                <h5 class="text-center mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                    Friday
                </h5>
            </div>
            <div class="col-span-7"></div>
            
            <button type="button" @click="select('Friday','17.00')" class="w-full text-white bg-gradient-to-r from-green-400 via-green-500 to-green-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-green-300 dark:focus:ring-green-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">Select</button>
            <div></div>
            
            
            
            
            
            <div class="content-center justify-center max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                <h5 class="text-center mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                    Saturday
                </h5>
            </div>
            <div class="col-span-9"></div>
            



            <div class="items-center justify-items-center max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                <h5 class="text-center mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                    Sunday
                </h5>
            </div>
            <div id="addtest" class=""></div>
        </div>
        <div class="flex justify-center">
            <article class="w-96 relative flex flex-col justify-end overflow-hidden rounded-2xl px-8 pb-8 pt-40 max-w-sm mx-auto ">
                <img src="https://www.ecohome.net/media/articles/images/f2/9c/f29c921116e7b42501639bda77885d5051a5c8f1/thumbs/dOp8pM6ckCwo_1200x500_EE_R0wWf.jpg" alt="University of Southern California" class="absolute inset-0 h-full w-full object-cover">
                <div class="absolute inset-0 bg-gradient-to-t from-gray-900 via-gray-900/40"></div>
                <h3 id="day" class="z-10 text-3xl font-bold text-white">please select the time</h3>
                <h3 id="time" class="z-10 text-3xl font-bold text-white"></h3>
                <div class="z-10 gap-y-1 right-0 overflow-hidden text-sm leading-6 text-gray-300 p-2">
                    <a href="/course/confirmCourse" class="rounded-r-lg group relative px-8 py-1 overflow-hidden bg-white text-xl shadow my-6">
                            <div class="absolute inset-0 w-3 bg-lime-600 transition-all duration-[250ms] ease-out group-hover:w-full rounded-r-lg"></div>
                            <span class="relative text-black group-hover:text-white ">Confirm</span>
                        </a>
                </div>
            </article>
            </div>
        </div>
        
        
        
        
        
    </template>

<script setup lang="ts">

function select(day,time) {
    document.getElementById("day").innerHTML = day;
    document.getElementById("time").innerHTML = time;
}
function addtest(){
    document.getElementById('addtest').innerHTML = `<button type="button" @click="select('Saturday','17.00')" class="w-full text-white bg-gradient-to-r from-green-400 via-green-500 to-green-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-green-300 dark:focus:ring-green-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">Select</button>`;
}



</script>