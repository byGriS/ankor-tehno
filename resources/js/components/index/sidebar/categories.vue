<template>
  <div class="sidebar">
    <div v-if="smallWindow">
      <div v-if="!isMain">
        <div class="elem elem-back" @click="back()">Назад</div>
        <div class="category" v-for="item in categoriesShow" :key="item.id">
          <div v-if="item.childs != null && item.childs.length > 0 " class="elem" @click="showChild(item)">{{ item.title }}</div>
          <a v-else :href="'/catalog/' + mainSlug + '/' + item.slug">{{ item.title }}</a>
        </div>
      </div>
      <div v-else>
        <div class="category" v-for="item in categoriesShow" :key="item.id">
          <div class="elem" @click="showChild(item)">{{ item.title }}</div>
        </div>
      </div>
    </div>
    <div v-else>
      <div class="category" v-for="item in categories" :key="item.id">
        <category :category="item" :mainSlug="'/'"></category>
      </div>
    </div>
  </div>
</template>

<script>

export default {
  props: ["categories"],
  data() {
    return {
      categoriesShow: [],
      isMain: true,
      windowWidth: window.innerWidth,
      mainSlug: "",
      oldCategoryId: null,
    };
  },
  computed: {
    smallWindow() {
      return this.windowWidth < 576;
    },
  },
  methods: {
    onResize() {
      this.windowWidth = window.innerWidth;
    },
    showChild(item) {
        console.log(item);
        this.oldCategoryId = item.category_id;
        this.categoriesShow = item.childs;
        this.isMain = false;
        this.mainSlug = item.slug;
    },
    back(){
      if (this.oldCategoryId == null){
        this.categoriesShow = this.categories;
        this.isMain = true;
      }else{
        this.categories.forEach(element => {
          if (element.id == this.oldCategoryId){
            this.oldCategoryId = element.category_id;
            this.categoriesShow = element.childs;
            this.mainSlug = element.slug;
          }
          
        });
      }

    }
  },
  beforeMount() {
    this.categoriesShow = this.categories;
    console.log( this.categoriesShow);
  },
  mounted() {
    this.$nextTick(() => {
      window.addEventListener("resize", this.onResize);
    });
  },
  beforeDestroy() {
    window.removeEventListener("resize", this.onResize);
  },
};
</script>

<style scoped>
/* sidebar categories */

.sidebar {
  background: white;
  padding: 20px 0;
  box-shadow: 5px 5px 5px rgba(0, 0, 0, 0.2);
  margin-bottom: 30px;
}

.sidebar .category {
  position: relative;
}

.sidebar .category a {
  display: block;
  border-top: 1px solid #f4f4f4;
  padding: 10px 25px;
  font-family: Tahoma;
  font-size: 10pt;
  text-transform: uppercase;
  cursor: pointer;
  color: #3a3a3a;
  text-decoration: none;
}


.sidebar .elem {
  display: block;
  border-top: 1px solid #f4f4f4;
  padding: 10px 25px;
  font-family: Tahoma;
  font-size: 10pt;
  text-transform: uppercase;
  cursor: pointer;
  color: #3a3a3a;
  text-decoration: none;
}
.elem-back {
  background: #eee;
}



.sidebar .category:last-child {
  border-bottom: 1px solid #f4f4f4;
}

</style>