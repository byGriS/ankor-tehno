<template>
  <div>
    <a href="/basket">
      <div class="d-flex cursor-pointer" @click="showBasket = !showBasket">
        <div class="basket-icon" />
        <div
          class="basket-count-items"
          :class="{ active: basket.items.length > 0 }"
        >
          {{ basket.items.length }}
        </div>
      </div>
    </a>
    <!-- <div v-if="showBasket" class="basketCard">

    </div> -->
  </div>
</template>
<script>
export default {
  data() {
    return {
      showBasket: false,
    };
  },
  computed: {
    basket() {
      return this.$store.getters.basket;
    },
  },
  beforeMount() {},
};
</script>

<style scoped>
.basket-icon {
  background-image: url("/images/basket_icon.png");
  background-repeat: no-repeat;
  background-position: left center;
  width: 24px;
  height: 20px;
}
.basket-count-items {
  margin: 0 10px;
  color: #fff;
  background: #838383;
  text-align: center;
  width: 20px;
  border-radius: 10px;
  line-height: 20px;
  font-size: 10pt;
}
.active {
  background: #ff7e00;
}
.basketCard {
  position: absolute;
  z-index: 100;
  background: #fff;
}
a{
  text-decoration: none;
}
</style>