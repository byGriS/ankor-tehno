<template>
  <div>
    <h3>Товары</h3>
    <div class="my-2 content-table-wrap">
      <div class="content-table-header d-flex">
        <div class="col-10 text-center">Наименование</div>
        <div class="col-2 text-center">Цена</div>
      </div>
      <div class="content-table-body">
        <div
          v-for="product in products"
          :key="product.id"
          class="content-table-row d-flex"
        >
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
      </div>
      <div class="d-flex justify-content-center" v-if="last_page > 1">
        <button
          type="button"
          class="btn btn-sm btn-info m-1"
          :disabled="page < 2"
          @click="prev()"
        >
          Назад
        </button>
        <button
          type="button"
          class="btn btn-sm btn-info m-1"
          :disabled="page == last_page"
          @click="next()"
        >
          Далее
        </button>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    selectedCategoryId: Number,
  },
  data() {
    return {
      products: [],
      page: 1,
      last_page: 1,
      body: null,
    };
  },
  watch: {
    selectedCategoryId() {
      this.page = 1;
      this.last_page = 1;
      this.getProducts();
    },
  },
  methods: {
    getProducts() {
      window.axios
        .get(
          "/admin/products/" + this.selectedCategoryId + "?page=" + this.page
        )
        .then((response) => {
          this.products = response.data.data;
          this.last_page = response.data.last_page;
          this.body.classList.remove("waiting");
        });
    },
    saveProduct(product) {
      this.body.classList.add("waiting");
      window.axios
        .post("/admin/products/setPrice", { product: product })
        .then((response) => {
          this.body.classList.remove("waiting");
        });
    },
    prev() {
      this.page--;
      this.body.classList.add("waiting");
      this.getProducts();
    },
    next() {
      this.page++;
      this.body.classList.add("waiting");
      this.getProducts();
    },
  },
  mounted() {
    this.getProducts();
    this.body = document.querySelector("body");
  },
};
</script>