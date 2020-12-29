<template>
  <div class="footer-nav row">
    <div class="col-12 col-sm-6 col-md-4" v-for="cat in categoriesMain" :key="cat.id">
      <div >
        <a :href="'/catalog/' + cat.slug">{{ cat.title.toUpperCase() }}</a>
      </div>
    </div>
    <!-- <div class="col-4">
      <div v-for="cat in col1" :key="cat.id">
        <a :href="'/' + cat.slug">{{ cat.title.toUpperCase() }}</a>
      </div>
    </div>
    <div class="col-4">
      <div v-for="cat in col2" :key="cat.id">
        <a :href="'/' + cat.slug">{{ cat.title.toUpperCase() }}</a>
      </div>
      </div>
    <div class="col-4">      
      <div v-for="cat in col3" :key="cat.id">
        <a :href="'/' + cat.slug">{{ cat.title.toUpperCase() }}</a>
      </div>
    </div> -->
  </div>
</template>

<script>
export default {
  props: ["categoriesMain"],
  data() {
    return {
      col1: [],
      col2: [],
      col3: [],
    };
  },
  beforeMount() {
    let countInCol = Math.ceil(this.categoriesMain.length / 3);
    for (let i = 0; i < this.categoriesMain.length; i++) {
      if (i < countInCol) this.col1.push(this.categoriesMain[i]);
      else if (i < countInCol * 2.0) this.col2.push(this.categoriesMain[i]);
      else this.col3.push(this.categoriesMain[i]);
    }
  },
};
</script>

<style scoped>
.footer-nav div {
  line-height: 1rem;
}
.footer-nav a {
  color: #fff;
  text-decoration: none;
  font-family: "Myriad Pro Condensed";
  font-size: 10pt;
}
</style>