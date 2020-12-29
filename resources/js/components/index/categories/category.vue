<template>
  <div class="category">
    <div>
      <a
        :href="
          '/catalog' +
          (this.category.parentSlug != null ? '/'+this.category.parentSlug : '') +
          '/' +
          this.category.slug
        "
      >
        <img :src="category['image']['src']" />
        <div class="title">{{ category["title"] }}</div>
      </a>
    </div>
    <div class="childs">
      <div
        v-if="category.childs != null && category.childs.length > 0"
        class="childs-header py-2 mt-3 d-flex align-items-center"
        @click="isShowChilds = !isShowChilds"
      >
        <div class="arrow"></div>
        <div class="count-childs">{{ category.childs.length }} категорий</div>
      </div>
      <div v-if="isShowChilds">
        <div v-for="child in category.childs" :key="child.id" class="child">
          <a :href="getHref(child)">{{ child.title }}</a>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  props: ["category"],
  data() {
    return {
      isShowChilds: false,
    };
  },
  methods: {
    getHref(child) {
      return (
        "/catalog" +
        (this.category.parentSlug != null ? '/'+this.category.parentSlug : "") +
        "/" +
        this.category.slug +
        "/" +
        child.slug
      );
    },
  },
  beforeMount() {
  },
};
</script>

<style scoped>
.category {
  background: #fff;
  margin-bottom: 25px;
  transition: box-shadow 0.3s;
  text-align: center;
  padding: 20px 30px;
}
.category:hover {
  box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.3);
}
.category a {
  text-decoration: none;
}
img {
  width: 150px;
  height: 150px;
  object-fit: contain;
}
.category .title {
  text-transform: uppercase;
  color: #3a3a3a;
  font-size: 11pt;
  font-weight: bold;
}
.category:hover .title {
  color: red;
}
.childs {
  text-align: left;
  cursor: pointer;
}
.childs-header {
  border-bottom: 1px solid lightgrey;
}
.arrow {
  background-image: url("/images/arrow.png");
  width: 12px;
  height: 7px;
  margin-right: 10px;
}
.count-childs {
  color: #838383;
  font-size: 9pt;
}
.child {
  padding: 3px 0;
  border-bottom: 1px solid lightgrey;
}
.child a {
  color: #3a3a3a;
  text-transform: uppercase;
  font-size: 8pt;
  font-weight: bold;
  font-family: Tahoma;
}
.child a:hover {
  color: red;
}
</style>