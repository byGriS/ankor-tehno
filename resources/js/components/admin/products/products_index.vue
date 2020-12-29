<template>
  <div class="h-100pc d-flex">
    <div class="category-list col-5 border-right">
      <h4>Товары</h4>
      <div class="d-flex">
        <button class="btn btn-sm btn-primary mr-1">Добавить категорию</button>
        <button class="btn btn-sm btn-primary">Добавить товар</button>
      </div>
      <div>
        <div class="curCategory">
          Текущая категория: <br />/<span
            v-for="category in curCategory"
            :key="category.id"
            >{{ category.title }}/</span
          >
        </div>
        <div class="categoryList">
          <div class="categoryBack" v-if="curCategory.length > 0" @click="categoryBack()">Назад</div>
          <div
            v-for="category in categories"
            :key="category.id"
            @click="selectCategory(category)"
          >
            {{ category.title }}
          </div>
        </div>
      </div>
    </div>
    <div class="col-7">
      <h4>Описание</h4>
    </div>
  </div>
</template>

<script>
export default {
  props: ["categoriesMain"],
  data() {
    return {
      curCategory: [],
      categories: [],
    };
  },
  computed: {
    /*categories() {
      return this.$store.getters.categories;
    },*/
  },
  methods: {
    categoryBack() {
      this.curCategory.pop();
      this.getCategoriesById(this.curCategory[this.curCategory.length - 1]);
    },
    selectCategory(category) {
      this.curCategory.push(category);
      this.getCategoriesById(category);
    },
    getCategoriesById(category) {
      window.axios
        .get("/admin/getCateoriesById", {
          params: {
            id: category == null ? null : category.id,
          },
        })
        .then((response) => {
          //this.$store.state.categories = response.data;
          this.categories = response.data;
        });
    },
  },
  beforeMount() {
    //this.$store.state.categories = this.categoriesMain;
    this.categories = this.categoriesMain;
  },
};
</script>

<style scoped>
.curCategory{

}
.categoryList{

}
.categoryList div{
  border: 1px solid rgb(220, 220, 220);
  border-radius: 3px;
  margin: 2px 0;
  padding: 4px;
  color: #eee;
  background: #0061c9;
}
.categoryList .categoryBack{
  background: rgb(214, 214, 214);
  color: #111;
}
</style>
