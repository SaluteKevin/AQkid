<template>
    <div class="flex bg-white w-full items-center justify-between rounded-2xl shadow-lg p-4">
        <img class="w-24 h-24 rounded-full" :src="`${config.public.imageBaseURL}${props.image_path}`" alt="">
        <div>{{ props.name }}</div>
        <div>
            <label class="relative inline-flex items-center cursor-pointer">
                <input type="checkbox"  class="sr-only peer" :checked="checkToggle" v-on:click="updateAttend()">
                <div
                    class="w-14 h-7 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300  rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:left-[4px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-6 after:w-6 after:transition-all  peer-checked:bg-blue-600">
                </div>
                <span class="ml-3 text-sm font-medium text-gray-900 ">{{ checkWord }}</span>
            </label>
        </div>
    </div>
</template>

<script setup lang="ts">
const config = useRuntimeConfig();
const route = useRoute();
const props = defineProps(['image_path', 'name', 'checked', 'id'])
const emits = defineEmits(['change'])
const checkToggle = ref(props.checked == "TRUE")
const checkWord = ref()

function checkToggleForWord() {
    if (checkToggle.value) {
        checkWord.value = 'Attend'
    } else {
        checkWord.value = 'Absent'
    }
}

checkToggleForWord();



const errorAddStd = ref('');
const errorRemStd = ref('');

async function updateAttend() {

    if (checkToggle.value) {
        await RemoveStudent();
    } else {
        await AddStudent();
    }

}

// add student attend
async function AddStudent() {

    const { data: addResponse, error: addError } = await useApiFetch(`api/teacher/attendStudent/${route.params.id}/${props.id}`, {
        method: "POST"
    });

    if (addResponse.value) {

        emits('change');

    } else {

        if (addError.value) {
            errorAddStd.value = "";

            errorAddStd.value = addError.value.data.message;
        }
    }


}





// remove student attend
async function RemoveStudent() {

    const { data: removeResponse, error: removeError } = await useApiFetch(`api/teacher/absentStudent/${route.params.id}/${props.id}`, {
        method: "POST"
    });

    if (removeResponse.value) {

        emits('change');

    } else {

        if (removeError.value) {
            errorRemStd.value = "";

            errorRemStd.value = removeError.value.data.message;
        }
    }
}

</script>