<template>
    <div class="min-h-screen w-full flex justify-center items-center">
        <div class=" h-full" style="width: 1000px; padding:20px; text-align:center; border: 10px solid #787878">
            <div class="h-full w-full" style="padding:20px; text-align:center; border: 5px solid #787878">
                <span style="font-size:50px; font-weight:bold">Certificate of Completion</span>
                <br><br>
                <span style="font-size:25px"><i>This is to certify that</i></span>
                <br><br>
                <span style="font-size:30px"><b>$student.getFullName()</b></span><br /><br />
                <span style="font-size:25px"><i>has completed the course</i></span> <br /><br />
                <span style="font-size:30px">$course.getName()</span> <br /><br />
                <span style="font-size:20px">with score of <b>$grade.getPoints()%</b></span> <br /><br /><br /><br />
                <span style="font-size:25px"><i>dated</i></span><br>
                #set ($dt = $DateFormatter.getFormattedDate($grade.getAwardDate(), "MMMM dd, yyyy"))
                <span style="font-size:30px">$dt</span>
            </div>
        </div>
    </div>
</template>

<script setup lang="ts">
definePageMeta({ layout: false })
</script>