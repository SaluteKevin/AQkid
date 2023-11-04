<template>
    <iframe class="w-full h-screen" id="pdf" />
  </template>
  
  <script setup lang="ts">
  definePageMeta({layout: false})
  import { useNuxtApp } from '#app';
  
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
            Text('Enrollment Reciept', {}, {
              x: context.width / 2,
              y: context.margins.top - 20
            })
          }
        ]
      }
    ]
  })
  
  $pdf.add([
  { raw: 'Hello PDFEasy!', text: {} }, // common text
  
  { stack: [ // stack for paragraph's
    { raw: 'A ', text: {} },
    { raw: 'Simple', text: { bold: true, italic: true } },
    { raw: ' Stack!', text: {} },
  ]},
  { lineBreak: {} },
  { stack: [ // stack for paragraph's
    { raw: 'A ', text: {} },
    { raw: 'Simple', text: { bold: true, italic: true } },
    { raw: ' Stack!', text: {} },
  ]},
  



])
  
  $pdf.run().then(blob => {
    const iframe = document.querySelector('#pdf')
  
    iframe.src = blob
  }).catch((err) => {
    console.error(err)
  })
  </script>