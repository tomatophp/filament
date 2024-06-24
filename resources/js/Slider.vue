<script setup>
// import Swiper core and required modules
import {Navigation, Pagination, Zoom, Thumbs, FreeMode} from 'swiper/modules';
import {onMounted, ref} from 'vue';

import { Swiper, SwiperSlide } from 'swiper/vue';

// Import Swiper styles
import 'swiper/css';
import 'swiper/css/free-mode';
import 'swiper/css/navigation';
import 'swiper/css/pagination';
import 'swiper/css/scrollbar';
import 'swiper/css/zoom';
import 'swiper/css/thumbs';


onMounted(()=>{
    const swiper = document.querySelector('.swiper-main').swiper;
    let swiperSlide = document.querySelectorAll('.swiper-main .swiper-slide')
    for(let index = 0; index< swiperSlide.length; index++) {
        swiperSlide[index].addEventListener('mouseover', function (e) {
            swiper.zoom.in();
        });

        swiperSlide[index].addEventListener('mouseout', function (e) {
            swiper.zoom.out();
        });
    }
});

const thumbsSwiper = ref(null);

const setThumbsSwiper = (swiper) => {
    thumbsSwiper.value = swiper;
};

const modules = ref([Navigation, Zoom, Thumbs, Pagination, FreeMode]);

const props = defineProps({
    wire: {},
    mingleData: {},
});


</script>
<template>
    <div class="w-full h-full" :class="{'flex justify-between gap-4': mingleData.position !== 'horizontal'}">
        <swiper
            v-if="mingleData.images.length && mingleData.position !== 'horizontal'"
            watch-slides-progress
            class="mySwiper"
            ref="swiperSlideRef"
            @swiper="setThumbsSwiper"
            :spaceBetween="10"
            :slidesPerView="4"
            :direction="mingleData.position"
            :freeMode="true"
            :modules="modules"
            style="height: 300px; width: 350px;"
        >
            <swiper-slide v-for="image in mingleData.images" class="border rounded-lg overflow-hidden">
                <img :src="image" />
            </swiper-slide>
        </swiper>
        <swiper
            class="swiper-main"
            :navigation="mingleData.navigation"
            :pagination="true"
            :modules="modules"
            slidesPerView="auto"
            :spaceBetween="14"
            :zoom="{
                maxRatio: 3,
            }"
            :thumbs="{ swiper: thumbsSwiper }"
        >
            <swiper-slide v-for="image in mingleData.images" class="border rounded-lg overflow-hidden">
                <img :src="image" />
            </swiper-slide>
        </swiper>
        <swiper
            v-if="mingleData.images.length && mingleData.position === 'horizontal'"
            watch-slides-progress
            class="mySwiper"
            ref="swiperSlideRef"
            @swiper="setThumbsSwiper"
            :spaceBetween="10"
            :slidesPerView="4"
            :direction="mingleData.position"
            :freeMode="true"
            :modules="modules"
            style="height: 80px; width: 350px;"
        >
            <swiper-slide v-for="image in mingleData.images" class="border rounded-lg overflow-hidden">
                <img :src="image" />
            </swiper-slide>
        </swiper>
    </div>
</template>
<style scoped>
.mySwiper {
    box-sizing: border-box;
}

.mySwiper .swiper-slide {
    opacity: 0.4;
}

.mySwiper .swiper-slide-thumb-active {
    opacity: 1;
}
</style>
