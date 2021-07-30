<template>
  <div class="product h-100 d-flex flex-column justify-content-between">
    <div>
      <a :href="'/catalog/' + product.parentSlug + '/' + product.id">
        <!-- <div
          v-if="product['show_in_main'] > 0"
          class="stock_icon"
          :class="stockClass"
        /> -->
        <img
          v-if="product['images'] != null && product['images'].length > 0"
          :src="product['images'][0]['src']"
        />
        <div class="title">{{ product["title"] }}</div>
      </a>
      <div class="manufacturer">
        <strong
          >Производитель:
          <span class="uppercase color-red">{{
            product["manufacturer"]
          }}</span></strong
        >
      </div>
      <div class="properties">
        <div v-for="property in product.properties" :key="property.id">
          <div
            v-if="
              property['title'].length < 25 &&
              property['pivot']['value'].length < 15
            "
            class="text-center"
          >
            {{ property["title"].trim() }}: {{ property["pivot"]["value"] }}
          </div>
        </div>
      </div>
    </div>
    <div>
      <div
        class="button button-orange"
        data-toggle="modal"
        data-target="#oneClickModal"
        @click="oneClick()"
      >
        КУПИТЬ В 1 КЛИК
      </div>
      <div class="row">
        <div class="col-6 d-flex pr-5px">
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
        <div class="col-6 pl-5px">
          <div
            class="button button-red d-flex align-items-center justify-content-center"
            @click="toBasket()"
          >
            <div class="icon-basket"></div>
            <div class="crutch57" >В КОРЗИНУ</div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: ["product"],
  data() {
    return {
      count: 1,
    };
  },
  computed: {
    stockClass() {
      return "stock" + this.product["show_in_main"];
    },
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
    oneClick() {
      let input_product_id = document.getElementById("product_id");
      input_product_id.value = this.product.id;
      let input_product_count = document.getElementById("product_count");
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
  beforeMount() {},
};
</script>

<style scoped>
.product {
  background: #fff;
  margin-bottom: 25px;
  transition: box-shadow 0.3s;
  text-align: center;
  padding: 20px 30px;
}
.product:hover {
  box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.3);
}
.product a {
  text-decoration: none;
}
img {
  width: 150px;
  height: 150px;
  object-fit: contain;
}
.stock_icon {
  position: absolute;
  left: 80%;
  top: 5%;
  width: 25px;
  height: 35px;
}
.stock1 {
  background-image: url("/images/stock1.png");
}
.product .title {
  text-transform: uppercase;
  color: #3a3a3a;
  font-size: 11pt;
  font-weight: bold;
}
.product:hover .title {
  color: red;
}
.manufacturer {
  font-size: 9pt;
  margin: 10px;
}
.properties {
  font-size: 8pt;
  color: #838383;
  margin: 10px;
}
.button {
  color: #fff;
  font-size: 8pt;
  padding: 5px 10px;
  margin: 10px 0;
  cursor: pointer;
  transition: 0.3s;
  text-align: center;
  height: 30px;
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
.icon-basket {
  background-image: url("/images/basket_icon.png");
  background-size: cover;
  background-position: center, center;
  width: 18px;
  height: 16px;
}
@media (max-width: 768px) {
  .icon-basket {
    display: none;
  }
}
.input-count {
  width: 100%;
  margin: 10px 0;
  height: 30px;
  text-align: center;
  border-top: 1px solid black;
  border-bottom: 1px solid black;
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
.crutch57{
  min-width: 57px;
  width: 57px;
}
</style>