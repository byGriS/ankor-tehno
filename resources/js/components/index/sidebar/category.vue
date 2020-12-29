<template>
  <div class="category">
    <a :href="'/catalog' +mainSlug + category.slug">{{ category.title }}</a>
    <div v-if="category.childs != null && category.childs.length > 0" class="category-dropdown">
       <div class="category"  v-for="child in category.childs" :key="child.id">
        <category :category="child" :mainSlug="getMainSlug"></category>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: ["category", "mainSlug"],
  computed:{
    getMainSlug(){
      return this.mainSlug + this.category.slug +'/';
    }
  },
  beforeMount(){
    //console.log(this.mainSlug);
  }
};
</script>

<style scoped>
.category{
  position: relative;
}
.category a {
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
.category-dropdown {
  display: none;
  position: absolute;
  top: 0;
  left: 100%;
  background-color: #fff;
  min-width: 255px;
  padding: 20px 0;
  z-index: 1;
  box-shadow: 5px 5px 5px rgba(0, 0, 0, 0.2);
}

.category:hover>.category-dropdown {
  display: block;
}
.category a:hover {
  background: #3a3a3a;
  color: #fff;
  text-decoration: none;
}
</style>