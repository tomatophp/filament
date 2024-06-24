<script setup>
import {ref} from "vue";

const props = defineProps({
    wire: {},
    mingleData: {},
})

const count = ref(1)

const doubleCurrentCount = () => {
    props.wire.doubleIt(count.value).then((data) => {
        count.value = data
    })
}

const {wire, mingleData} = props

const message = mingleData.message

</script>

<template>
    <button @click.prevent="doubleCurrentCount">
        {{ count }}
    </button>
</template>
