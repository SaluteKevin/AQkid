<script setup lang="ts">

var counter = ref( 300 );
var time = ref({
    minute: 5,
    second: 0
})
function startTimer() {
  const timer = setInterval(() => {
    if (--counter.value === 0) {
      // ทำงานเมื่อครบ 5 นาที
        console.log('Over Time');
        clearInterval(timer);
    }
    else{
        time.value.minute = counter.value/60 | 0;
        time.value.second = counter.value%60;
        console.log(counter.value);
    }
  }, 1000);

}

startTimer();


</script>

<template>
    <div class="bg-gradient-to-b flex justify-center items-center bg-orange-400 pt-36 pb-36">
        <div class="bg-cyan-900 w-3/4 p-12 rounded-2xl">
            <div class="p-5 bg-cyan-900">
                <p class="p-4 text-center text-6xl text-gray-900 dark:text-white bg-orange-500 rounded-2xl">Payment</p>
            </div>
            <div class="flex justify-center items-center">
                <div class="w-1/2 flex justify-center items-center bg-white rounded-lg">
                    <div>
                        <img class="h-auto max-w-lg" src="https://media.discordapp.net/attachments/474941945882476546/1162264364968050738/Screenshot_2023-10-13-12-43-23-97_275eb041e5d68c8a5fb815dd7041b155.jpg?ex=653b4e0a&is=6528d90a&hm=4612de7db51935602c65330a831169eeaaec50cc3360b7648d05d1f00dec3b3a&=&width=461&height=507" alt="image description">
                    </div>
                </div>
            </div>
            <div class="flex justify-center items-center m-5">
                <p class="w-1/2 px-12 py-4 text-center text-4xl text-gray-900 dark:text-white bg-orange-500 rounded-2xl w-1/2">Amount:    30000  baht</p>
            </div>

            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
            <div class="flex justify-center items-center">
                <div class="w-1/2 px-2 rounded-xl">
                    <label class="block mb-2 text-2xl font-medium text-gray-900 dark:text-white" for="file_input">Upload slip</label>
                    <input class="block w-full text-2xl text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" 
                    id="file_input" type="file" @change="onFileChange" @input="data.image = $event.target.files[0]">
                </div>
            </div>
            <div class="flex justify-center items-center m-5">
                <div class="w-1/2 px-12 py-4 relative">
                        <div class="absolute right-0">
                            <button class="relative inline-flex items-center justify-center p-0.5 mb-2 mr-2 overflow-hidden text-sm font-medium text-gray-900 rounded-lg group bg-gradient-to-br from-teal-300 to-orange-300 group-hover:from-orange-300 group-hover:to-orange-300 dark:text-white dark:hover:text-gray-900 focus:ring-4 focus:outline-none focus:ring-orange-200 dark:focus:ring-orange-800">
                                <span class="relative px-5 py-2.5 transition-all ease-in duration-75 bg-white dark:bg-gray-900 rounded-md group-hover:bg-opacity-0">
                                    Confirm
                                </span>
                            </button>
                        </div>
                </div>
            </div>
            <p class="text-2xl font-medium text-gray-900 text-red-700">Please confirm in 5 minutes</p>
            <p class="text-2xl font-medium text-gray-900 text-red-700">{{ time.minute }}:{{ time.second }}</p>







        </div>
    </div>
</template>