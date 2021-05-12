<template>
  <div>
    <div :class="classSpan" class="d-flex">
      <div class="symbolWrap">
        <div v-if="isHaveChildrens">
          <span v-if="!isShowChildren" @click="showChildren()">
            <svg
              width="1em"
              height="1em"
              viewBox="0 0 16 16"
              class="bi bi-caret-right-fill"
              fill="currentColor"
              xmlns="http://www.w3.org/2000/svg"
            >
              <path
                d="M12.14 8.753l-5.482 4.796c-.646.566-1.658.106-1.658-.753V3.204a1 1 0 0 1 1.659-.753l5.48 4.796a1 1 0 0 1 0 1.506z"
              />
            </svg>
          </span>
          <span v-else @click="showChildren()">
            <svg
              width="1em"
              height="1em"
              viewBox="0 0 16 16"
              class="bi bi-caret-down-fill"
              fill="currentColor"
              xmlns="http://www.w3.org/2000/svg"
            >
              <path
                d="M7.247 11.14L2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z"
              />
            </svg>
          </span>
        </div>
      </div>
      <div
        class="categoryTitle"
        :class="{ selectedCategory: isCurrentSelectedCategory, changed: category.changed }"
        @click="selectingCategory(category)"
      >
        {{ category.title }}
      </div>
    </div>
    <div v-if="isShowChildren && isHaveChildrens">
      <div v-for="elem in categoriesChildren" :key="elem.id">
        <branch
          :category="elem"
          :pos="pos + 1"
          :selectedCategory="selectedCategory"
          @select="selectingCategory($event)"
        ></branch>
      </div>
    </div>
  </div>
</template>


<script>
export default {
  props: ["category", "pos", "selectedCategory"],
  data() {
    return {
      isShowChildren: false,
    };
  },
  computed: {
    //добавляем отступ для смещения
    classSpan() {
      return "ml-" + this.pos * 2;
    },
    //проверяем есть ли дочерние категории
    isHaveChildrens() {
      return (
        this.category.childs != null &&
        this.category.childs instanceof Array &&
        this.category.childs.length > 0
      );
    },
    categoriesChildren() {
      return this.category.childs;
    },
    isCurrentSelectedCategory() {
      if (this.selectedCategory != null)
        return this.category.id == this.selectedCategory.id;
    }
  },
  methods: {
    //метод раскрытия категории + выбор и редирект самой категории
    showChildren() {
      this.isShowChildren = !this.isShowChildren;
    },
    selectingCategory(val) {
      this.$emit("select", val);
    },
  },
};
</script>

<style scoped>
.symbolWrap {
  width: 20px;
  text-align: center;
  padding: 2px 5px;
}
.symbolWrap span {
  cursor: pointer;
}
.categoryTitle {
  cursor: pointer;
  padding: 2px 5px;
  transition: all 0.2s ease;
}
.categoryTitle:hover {
  background: rgb(164, 210, 75);
  border-radius: 3px;
}
.selectedCategory {
  background: rgb(189, 224, 223);
  border-radius: 3px;
}
.changed::after{
  content: '*';
}
</style>