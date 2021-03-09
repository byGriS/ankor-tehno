<template>
  <div>
    <splide class="header-slider" :options="sliderOptions">
      <splide-slide>
        <a href="#"><img src="/images/slide1.png" /></a>
      </splide-slide>
      <splide-slide>
        <a href="#"><img src="/images/slide2.jpeg" /></a>
      </splide-slide>
    </splide>
  </div>
</template>


<script>
import { Splide, SplideSlide } from "@splidejs/vue-splide";
import '@splidejs/splide/dist/css/themes/splide-default.min.css';

export default {
  components: { Splide, SplideSlide },
  data() {
    return {
      sliderOptions: {
        rewind: true,
        autoplay: true,
        pagination: false,
        //cover: true,
        interval: 1000,
      },
    };
  },
};
</script>

<style scoped>
.header-slider img{
  width: 100%;
}
</style>