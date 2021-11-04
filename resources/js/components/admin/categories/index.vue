<template>
  <div class="d-flex">
    <div class="col-4 border-right">
      <div v-for="elem in categories" :key="elem.id">
        <branch
          :category="elem"
          :pos="pos"
          :selectedCategory="selectedCategory"
          @select="selectedCategory = $event"
        ></branch>
      </div>
    </div>
    <div class="col-8" v-if="selectedCategory != null">
      <div class="d-flex my-1">
        <label for="seo_title" class="col-sm-3">Title(seo)</label>
        <div class="col-sm-9">
          <input
            class="form-control form-control-sm"
            id="seo_title"
            v-model="changeData.seo_title"
            @change="selectedCategory.changed = true"
          />
        </div>
      </div>

      <div class="d-flex my-1">
        <label for="seo_description" class="col-sm-3">Description(seo)</label>
        <div class="col-sm-9">
          <input
            class="form-control form-control-sm"
            id="seo_description"
            v-model="changeData.seo_description"
            @change="selectedCategory.changed = true"
          />
        </div>
      </div>

      <div class="d-flex my-1">
        <label for="context_title" class="col-sm-3">Контекст (заголовок)</label>
        <div class="col-sm-9">
          <input
            class="form-control form-control-sm"
            id="context_title"
            v-model="changeData.context_title"
            @change="selectedCategory.changed = true"
          />
        </div>
      </div>

      <div class="d-flex my-1">
        <label class="col-sm-3">Контекст</label>
        <div class="col-sm-9">
          <textarea class="form-control form-control-sm" rows="8" v-model="changeData.context_body">
          </textarea>
        </div>
      </div>

      <button class="btn btn-sm btn-success" @click="save()">Сохранить</button>

      <product-list :selected-category-id="selectedCategory.id"></product-list>
    </div>
  </div>
</template>

<script>
import ProductList from '../products/list.vue'

export default {
  props: ["categoriesInput"],
  components:{
    ProductList
  },
  data() {
    return {
      pos: 0,
      categories: [],
      selectedCategory: null,
      changeData: {
        seo_title: "",
        seo_description: "",
        context_title: "",
        context_body: "",
      },
    };
  },
  watch: {
    selectedCategory(val) {
      this.changeData.seo_title = val.seo_title;
      this.changeData.seo_description = val.seo_description;
      this.changeData.context_title = val.context_title;
      this.changeData.context_body = val.context_body?val.context_body:'';
      this.selectedCategory.changed = false;
    },
  },
  methods: {
    save() {
      this.selectedCategory.seo_title = this.changeData.seo_title;
      this.selectedCategory.seo_description = this.changeData.seo_description;
      this.selectedCategory.context_title = this.changeData.context_title;
      this.selectedCategory.context_body = this.changeData.context_body;
      window.axios.post('/admin/categories/'+this.selectedCategory.id, {
        'seo_title': this.selectedCategory.seo_title,
        'seo_description': this.selectedCategory.seo_description,
        'context_title': this.selectedCategory.context_title,
        'context_body': this.selectedCategory.context_body
      })
      .then(response => {
        this.selectedCategory.changed = false;
      })
    },
  },
  mounted() {
    if (this.categoriesInput != null) {
      this.categoriesInput.forEach((elem) => {
        this.categories.push(Object.assign(elem, {changed: false}));
      });
    }
  },
};
</script>

<style>
.categories-wrap {
  height: 100%;
  background: rgb(243, 243, 243);
  border-right: 4px solid rgb(206, 206, 206);
}
.ck-editor__editable {
  min-height: 300px;
  height: 300px;
}
</style>
