<template>
  <div>
    <h1>{{ product["title"] }}</h1>
    <div class="row align-items-start">
      <div class="col-3"></div>
      <div class="col-6 d-flex justify-content-center">
        <div class="d-flex count-wrap">
          <button class="btn-count btn-minus" @click="addCount(-1)">-</button>
          <div>
            <input
              class="input-count"
              v-model="count"
              @keypress="isNumber($event)"
            />
          </div>
          <button class="btn-count btn-plus" @click="addCount(1)">+</button>
        </div>
        <div
          class="button button-red d-flex align-items-center justify-content-between"
        >
          <div class="icon-basket"></div>
          <div @click="toBasket()">В КОРЗИНУ</div>
        </div>
      </div>
      <div class="d-none d-md-block col-3 manufacturer">
        <!-- <h1>{{ product["manufacturer"] }}</h1> -->
      </div>
    </div>
    <div class="d-flex justify-content-center">
      <div class="button button-orange" data-toggle="modal" data-target="#oneClickModal" @click="oneClick()">КУПИТЬ В 1 КЛИК</div>
    </div>
    <div>
      <splide class="product-slider my-3" :options="sliderOptions">
        <splide-slide v-for="image in product['images']" :key="image.id">
          <img :src="image['src']" />
        </splide-slide>
      </splide>
    </div>
    <h3>Технические характеристики</h3>
    <div v-for="prop in product['properties']" :key="prop.id" class="property d-flex justify-content-between">
      <div>{{prop['title']}}</div>
      <div>{{prop['pivot']['value']}}</div>
    </div>
    <div class="delivery">
       <span class="icon delivery_icon"><a href="/delivery">ИНФОРМАЦИЯ О ДОСТАВКЕ</a></span>
    </div>
  </div>
</template>

<script>
import { Splide, SplideSlide } from "@splidejs/vue-splide";
import "@splidejs/splide/dist/css/themes/splide-default.min.css";

export default {
  components: { Splide, SplideSlide },
  props: ["product"],
  data() {
    return {
      count: 1,
      sliderOptions: {
        rewind: true,
        autoplay: false,
        pagination: true,
        arrows: false,
      },
    };
  },
  methods: {
    addCount(add) {
      this.count = parseInt(this.count) + parseInt(add);
      if (this.count < 1) this.count = 1;
    },
    isNumber: function (evt) {
      evt = evt ? evt : window.event;
      var charCode = evt.which ? evt.which : evt.keyCode;
      if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        evt.preventDefault();
      } else {
        return true;
      }
    },    
    oneClick(){
      let input_product_id = document.getElementById('product_id');
      input_product_id.value = this.product.id;
      let input_product_count = document.getElementById('product_count');
      input_product_count.value = this.count;      
    },
    toBasket() {
      window.axios
        .post("/toBasket", {
          token: this.$store.state.token,
          id: this.product.id,
          count: this.count,
        })
        .then((response) => {
          this.$store.state.basket.items = response.data;
        });
    },
  },
  beforeMount(){
    if (this.product.images.length > 1){
      this.sliderOptions.arrows = true;
    }else{
      this.sliderOptions.arrows = false;
    }
  }
};
</script>

<style scoped>
h1 {
  text-transform: uppercase;
}
.button {
  color: #fff;
  font-size: 9pt;
  padding: 5px 10px;
  margin: 10px 0;
  cursor: pointer;
  transition: 0.3s;
  min-width: 120px;
  width: 120px;
}
.button-orange {
  background: #ff7e00;
}
.button-orange:hover {
  background: #dd6f00;
}
.button-red {
  background: #ce2500;
}
.button-red:hover {
  background: #ae2000;
}
.count-wrap {
  margin-right: 15px;
}
.icon-basket {
  background-image: url("/images/basket_icon.png");
  background-size: cover;
  background-position: center, center;
  width: 18px;
  height: 16px;
}
.input-count {
  width: 100px;
  margin: 10px 0;
  text-align: center;
}
.btn-count {
  margin: 10px 0;
  border: 0px;
  border-top: 1px solid black;
  border-bottom: 1px solid black;
  outline: 0 !important;
  min-width: 30px;
  background: #fff;
}
.btn-minus {
  border-left: 1px solid black;
}
.btn-plus {
  border-right: 1px solid black;
}
.manufacturer h1 {
  margin: 0;
  padding: 0;
  text-align: right;
}
.product-slider{
  height: calc(200px + 15vw);
  background: #fff;
  display: flex;
  justify-content: center;
}
.splide__slide{
  display: flex;
  align-items: center;
  justify-content: center;
}
.splide__slide img{
  max-height: 100%;
}
.property{
  border-bottom: 1px solid lightgrey;
  padding: 4px;
}
.delivery{
  margin-top: 25px;
  font-weight: bold;
}
.delivery_icon{
  background-image: url('/images/delivery.png');
  padding-left: 35px;
  display: block;
}
.delivery_icon a{
 color: red;
 text-decoration: underline;
}
</style>