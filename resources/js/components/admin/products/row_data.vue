<template>
  <div class="content-table-row d-flex">
    <div class="row-data flex-fill d-flex">
      <div class="cell col-10">{{ product.title }}</div>
      <div class="cell col-2 text-center">
        <input
          type="number"
          v-model="product.price"
          class="form-control form-control-sm"
          @change="saveProduct(product)"
        />
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: { product: Object},
  data(){
    return{
      body: null,
    }
  },
  methods:{
     saveProduct(product) {
      this.body.classList.add("waiting");
      window.axios
        .post("/admin/products/setPrice", { product: product })
        .then((response) => {
          this.body.classList.remove("waiting");
        });
    },
  },
  mounted(){
    this.body = document.querySelector('body');
  }
}
</script>