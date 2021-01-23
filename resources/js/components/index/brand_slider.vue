<template>
  <div class="container-my">
    <splide class="header-slider" :options="sliderOptions">
      <splide-slide>
        <a href="#">
          <div
            class="logo-firm"
            style="background-image: url('/images/brand_logo_makita.png')"
          ></div
        ></a>
      </splide-slide>
      <splide-slide>
        <a href="#">
          <div
            class="logo-firm"
            style="background-image: url('/images/brand_logo_dewalt.png')"
          ></div
        ></a>
      </splide-slide>
      <splide-slide>
        <a href="#">
          <div
            class="logo-firm"
            style="background-image: url('/images/brand_logo_HITACHI.png')"
          ></div
        ></a>
      </splide-slide>
      <splide-slide>
        <a href="#">
          <div
            class="logo-firm"
            style="background-image: url('/images/brand_logo_HUSQVARNA.png')"
          ></div
        ></a>
      </splide-slide>
      <splide-slide>
        <a href="#">
          <div
            class="logo-firm"
            style="background-image: url('/images/brand_logo_bosch.png')"
          ></div
        ></a>
      </splide-slide>
      <splide-slide>
        <a href="#">
          <div
            class="logo-firm"
            style="background-image: url('/images/brand_logo_Karcher.png')"
          ></div
        ></a>
      </splide-slide>
      <splide-slide>
        <a href="#">
          <div
            class="logo-firm"
            style="background-image: url('/images/brand_logo_stihl.png')"
          ></div
        ></a>
      </splide-slide>
      <splide-slide>
        <a href="#">
          <div
            class="logo-firm"
            style="background-image: url('/images/brand_logo_зубр.png')"
          ></div
        ></a>
      </splide-slide>
      <splide-slide>
        <a href="#">
          <div
            class="logo-firm"
            style="background-image: url('/images/brand_logo_интерскол.png')"
          ></div
        ></a>
      </splide-slide>
    </splide>
  </div>
</template>

<script>
import { Splide, SplideSlide } from "@splidejs/vue-splide";
//import '@splidejs/splide/dist/css/themes/splide-default.min.css';

export default {
  components: { Splide, SplideSlide },
  data() {
    return {
      sliderOptions: {
        rewind: true,
        autoplay: true,
        pagination: false,
        cover: true,
        interval: 2000,
        fixedHeight: 100,
        perPage: 5,
        perMove: 1,
        gap: 5,
        padding: 15,
        arrows: false,
      },
    };
  },
};
</script>

<style scoped>
.splide__slide{
  padding: 0 10px;
}
</style>