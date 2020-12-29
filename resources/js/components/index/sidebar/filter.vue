<template>
  <div class="filter">
    <div class="mb-3 d-flex flex-wrap">
      <div
        v-for="elem in curFilter"
        :key="elem.id"
        class="cur-filter d-flex align-items-center"
      >
        <div
          v-for="arg in elem.value"
          :key="arg.id"
          class="cur-filter d-flex align-items-center"
        >
          <div class="filter-cross" @click="removeFilter(elem, arg)"></div>
          <div>{{ arg }}</div>
        </div>
      </div>
    </div>
    <div v-for="prop in filters" :key="prop.id" class="property">
      <div
        class="filter-header d-flex justify-content-between align-items-center"
        @click="prop.show = !prop.show"
      >
        <div class="filter-title">{{ prop.title }}</div>
        <div class="filter-arrow" :class="{ 'filter-active': prop.show }"></div>
      </div>
      <div v-if="prop.show">
        <div
          v-for="elem in prop.values"
          :key="elem.id"
          class="row filter-value align-items-center"
        >
          <input
            type="checkbox"
            class="col-2"
            :id="prop.title + elem.title"
            v-model="elem.check"
          />
          <label class="value-title col-10" :for="prop.title + elem.title">{{
            elem.title
          }}</label>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-6">
        <button class="filter-button button-reset" @click="reset()">
          Сбросить фильтр
        </button>
      </div>
      <div class="col-6">
        <button class="filter-button button-apply" @click="apply()">
          Применить
        </button>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: ["properties", "cur_filter", "prods_manufcturer"],
  data() {
    return {
      filters: [],
      curFilter: [],
    };
  },
  methods: {
    reset() {
      location.replace(location.href.split("?")[0]);
    },
    apply() {
      let href = location.href.split("?")[0] + "?";
      Array.prototype.forEach.call(this.filters, (prop) => {
        prop.values.forEach((elem) => {
          if (elem.check) href += prop.slug + "[]=" + elem.title + "&";
        });
      });
      location.replace(href);
    },
    removeFilter(filterTitle, filterValue) {
      //let href = location.href.split("?")[0] + "?";
      let start = location.href.indexOf(
        encodeURI(filterTitle.title + "[]=" + filterValue)
          .replace(/%5B/g, "[")
          .replace(/%5D/g, "]")
      );
      let end = location.href.indexOf("&", start);
      let href =
        location.href.substring(0, start) + location.href.substring(end + 1);
      location.replace(href);
    },
    compare(a, b) {
      if (a.title < b.title) {
        return -1;
      }
      if (a.title > b.title) {
        return 1;
      }
      return 0;
    },
  },
  beforeMount() {
    console.log(this.cur_filter);
    for (const [key, value] of Object.entries(this.cur_filter)) {
      if (key == 'page')
      continue;
      this.curFilter.push(Object.assign({}, { title: key, value: value }));
    }

    console.log(this.curFilter);
    let manufacturers = [];
    this.prods_manufcturer.forEach((prod) => {
      let selected = false;
      this.curFilter.forEach((item, index) => {
        if ("manufacturer" === item.title) {
          item.value.forEach((arg) => {
            if (prod.manufacturer === arg) selected = true;
          });
        }
      });
      manufacturers.push(
        Object.assign({}, { title: prod.manufacturer, check: selected })
      );
    });
    this.filters.push(
      Object.assign(
        {},
        {
          title: "Производитель",
          slug: "manufacturer",
          values: manufacturers.sort(this.compare),
          show: false,
          id: 0,
        }
      )
    );

    this.properties.forEach((prop, index) => {
      let values = [];
      Object.values(prop[2]).forEach((elem) => {
        let selected = false;
        this.curFilter.forEach((item, index) => {
          if (prop[1] === item.title) {
            item.value.forEach((arg) => {
              if (elem.trim() === arg) selected = true;
            });
          }
        });
        values.push(Object.assign({}, { title: elem, check: selected }));
      });
      this.filters.push(
        Object.assign(
          {},
          {
            title: prop[0],
            slug: prop[1],
            values: values.sort(this.compare),
            show: false,
            id: index + 1,
          }
        )
      );
    });
    console.log(this.filters);
  },
};
</script>

<style scoped>
.property {
  background: white;
  padding: 10px 20px;
  box-shadow: 5px 5px 5px rgba(0, 0, 0, 0.2);
  margin-bottom: 15px;
}
.filter-header {
  cursor: pointer;
}
.filter-title {
  font-size: 13pt;
  font-family: "Myriad Pro Condensed";
}
.filter-arrow {
  background-image: url("/images/arrow.png");
  background-position: center center;
  background-repeat: no-repeat;
  width: 15px;
  height: 7px;
}
.filter-active {
  -webkit-transform: rotate(180deg);
  -moz-transform: rotate(180deg);
  -ms-transform: rotate(180deg);
  -o-transform: rotate(180deg);
  transform: rotate(180deg);
}
.filter-button {
  font-size: 10pt;
  font-family: "Myriad Pro Regular";
  border: 0;
  width: 100%;
  padding: 4px 10px;
  height: 36px;
  color: #fff;
  margin-bottom: 25px;
}
.value-title {
  font-size: 10pt;
  margin-bottom: 0;
}
.button-reset {
  background: #979797;
}
.button-apply {
  background: #ce2500;
}
.cur-filter {
  margin-right: 15px;
  color: #959595;
}
.filter-cross {
  background-image: url("/images/cross.png");
  background-position: center center;
  background-repeat: no-repeat;
  width: 9px;
  height: 9px;
  cursor: pointer;
  margin-right: 5px;
}
</style>