<script setup>
const props = defineProps({
    wire: {},
    mingleData: {},
})

const {wire, mingleData} = props

const url = mingleData.url
const folders = mingleData.folders
const files = mingleData.files
const back_path = mingleData.back_path
const back_name = mingleData.back_name
const current_path = mingleData.current_path
const view = mingleData.view

// wire.reload()
//     .then(data => {
//         console.log(data) // 4
//     })

</script>

<template>
    <div>
        <div v-html="view" ></div>
    </div>
</template>
