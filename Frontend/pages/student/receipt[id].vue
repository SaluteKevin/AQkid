<template>
    <iframe class="w-full h-screen" id="pdf" />
</template>
  
<script setup lang="ts">
definePageMeta({ layout: false,
middleware: ['is-authorized','is-student'] })
const route = useRoute();
import { useNuxtApp } from '#app';
import dayjs from 'dayjs';


const { data: receiptResponse, error: receiptError } = await useApiFetch(`api/student/getReceipt/${route.params.id}`, {});

if (receiptResponse.value) {
    
} else {
    if (receiptError.value) {   
    
    }

}


const { $pdf } = useNuxtApp()

$pdf.new({
    plugins: [
        {
            page: [
                // simple counter footer
                ({ Text }, context, current, total) => {
                    // render in every page
                    Text('AQKids', { fontSize: 20 }, {
                        x: context.width / 2,
                        y: context.height - context.margins.bottom
                    })
                },
                // simple header
                ({ Text }, context, current, total) => {
                    // render in every page
                    Text('Enrollment Receipt', { bold: true, fontSize: 20 }, {
                        x: context.width / 2,
                        y: context.margins.top - 20
                    })
                }
            ]
        }
    ]

}

)

$pdf.add([
    { lineBreak: {} },
    { lineBreak: {} },
    { raw: 'Receipt of ' + receiptResponse.value.user.first_name + " " + receiptResponse.value.user.last_name, text: { } }, // common text
    { lineBreak: {} },
    { table: { // table. Check pdfkit-table package for more explanations
    body: {
      title: "Receipt Details",
      headers: [ "Course Title", "Description","Pay at","Amount"],
      rows: [
        [ receiptResponse.value.course.title, receiptResponse.value.receipt.description,  
        dayjs(receiptResponse.value.receipt.payment_timestamp).format('YYYY-MM-DD HH:mm:ss'), receiptResponse.value.receipt.amount + ' Baht'],
      ],
    },
    options: {}
    }},
    { lineBreak: {} },
    { lineBreak: {} },
    { lineBreak: {} },
    { lineBreak: {} },
    { raw: 'Payment Status: ' + receiptResponse.value.status, text: {bold: true} },
    { raw: 'Total: ' + receiptResponse.value.receipt.total + " Baht", text: {bold: true} },
    


])


$pdf.run().then(blob => {
    const iframe = document.querySelector('#pdf')
    iframe.src = blob
}).catch((err) => {
    console.error(err)
})
</script>