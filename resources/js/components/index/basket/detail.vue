<template>
  <div>
    <h1>КОРЗИНА</h1>
    <h3 v-if="basket.items.length == 0">Корзина пуста</h3>
    <div v-else>
      <h3>1.Выбор товаров</h3>
      <div
        v-for="(item, index) in basket.items"
        :key="item.id"
        class="product row align-items-stretch"
      >
        <div
          class="col-12 col-md-3 col-lg-2 col-image"
          :style="{ 'background-image': 'url(' + item.images[0].src + ')' }"
        />
        <div class="col-12 col-md-5 col-lg-7 col-title">
          <a :href="'/catalog/' + item.parentSlug + '/' + item.id">{{
            item.title
          }}</a>
        </div>
        <div class="col-6 col-md-3 col-lg-2 text-right">
          <div class="d-flex count-wrap justify-content-end">
            <button
              class="btn-count btn-minus"
              @click="addCount(item, index, -1)"
            >
              -
            </button>
            <div>
              <input
                class="input-count"
                v-model="item.count"
                @keypress="isNumber($event)"
                @change="countChange(item)"
              />
            </div>
            <button
              class="btn-count btn-plus"
              @click="addCount(item, index, 1)"
            >
              +
            </button>
          </div>
        </div>
        <div class="col-6 col-md-1 col-lg-1 text-right">
          <div class="btn-delete" @click="deleteProduct(item)">
            <svg
              viewBox="0 0 128 128"
              xml:space="preserve"
              xmlns="http://www.w3.org/2000/svg"
              xmlns:xlink="http://www.w3.org/1999/xlink"
            >
              <g>
                <g
                  id="Icon-Trash"
                  transform="translate(232.000000, 228.000000)"
                >
                  <polygon
                    class="st0"
                    id="Fill-6"
                    points="-207.5,-205.1 -204.5,-205.1 -204.5,-181.1 -207.5,-181.1    "
                  />
                  <polygon
                    class="st0"
                    id="Fill-7"
                    points="-201.5,-205.1 -198.5,-205.1 -198.5,-181.1 -201.5,-181.1    "
                  />
                  <polygon
                    class="st0"
                    id="Fill-8"
                    points="-195.5,-205.1 -192.5,-205.1 -192.5,-181.1 -195.5,-181.1    "
                  />
                  <polygon
                    class="st0"
                    id="Fill-9"
                    points="-219.5,-214.1 -180.5,-214.1 -180.5,-211.1 -219.5,-211.1    "
                  />
                  <path
                    class="st0"
                    d="M-192.6-212.6h-2.8v-3c0-0.9-0.7-1.6-1.6-1.6h-6c-0.9,0-1.6,0.7-1.6,1.6v3h-2.8v-3     c0-2.4,2-4.4,4.4-4.4h6c2.4,0,4.4,2,4.4,4.4V-212.6"
                    id="Fill-10"
                  />
                  <path
                    class="st0"
                    d="M-191-172.1h-18c-2.4,0-4.5-2-4.7-4.4l-2.8-36l3-0.2l2.8,36c0.1,0.9,0.9,1.6,1.7,1.6h18     c0.9,0,1.7-0.8,1.7-1.6l2.8-36l3,0.2l-2.8,36C-186.5-174-188.6-172.1-191-172.1"
                    id="Fill-11"
                  />
                </g>
              </g>
            </svg>
          </div>
        </div>
      </div>
      <h3>Оформление заказа</h3>
      <form action="/confirmOrder" method="POST">
        <div class="">
          <input type="hidden" name="_token" :value="csrf" />
          <input type="hidden" name="token" :value="token" />
          <input type="hidden" name="requisites" :value="basket.requisites" />
          <div class="row">
            <div class="col-12 col-md-6">
              <div class="form-group">
                <input
                  type="text"
                  name="name"
                  placeholder="Имя*"
                  required="required"
                  class="form-control"
                />
              </div>
              <div class="form-group">
                <input
                  type="email"
                  name="email"
                  placeholder="Email*"
                  required="required"
                  class="form-control"
                />
              </div>
              <div class="form-group">
                <input
                  type="text"
                  name="phone"
                  placeholder="Номер телефона"
                  class="form-control"
                />
              </div>
              <div class="form-group row px-3 align-items-center">
                <label
                  for="addFile"
                  class="select-file-label btn btn-sm btn-info my-1"
                  >Прикрепить файл</label
                >
                <input
                  type="file"
                  name="file"
                  id="addFile"
                  placeholder="Реквизиты"
                  class="select-file-input"
                  @change="selectFile"
                />
                <div class="px-3">
                  {{fileName}}
                </div>
              </div>
            </div>
            <div class="col-12 col-md-6">
              <div class="form-group">
                <textarea
                  rows="5"
                  name="comment"
                  placeholder="Комментарии"
                  class="form-control"
                ></textarea>
              </div>
            </div>
          </div>
        </div>
        <div class="">
          <button type="submit" class="btn btn-primary">
            Отправить заявку
          </button>
        </div>
      </form>
    </div>
  </div>
</template>
<script>
export default {
  data() {
    return {
      timer: null,
      fileName: "",
    };
  },
  computed: {
    basket() {
      return this.$store.getters.basket;
    },
    token() {
      return this.$store.state.token;
    },
    csrf() {
      return window.axios.defaults.headers.common["X-CSRF-TOKEN"];
    },
  },
  methods: {
    addCount(item, index, add) {
      if (add == -1 && this.$store.state.basket.items[index].count == 1) return;
      this.$store.state.basket.items[index].count =
        parseInt(this.$store.state.basket.items[index].count) + parseInt(add);
      var self = this;
      clearTimeout(this.timer);
      this.timer = setTimeout(function () {
        window.axios
          .get("/updateProductInBasket", {
            params: {
              token: self.$store.state.token,
              id: item.id,
              count: item.count,
            },
          })
          .then((response) => {
            self.$store.state.basket.items = response.data;
          });
      }, 1000);
    },
    isNumber: function (evt) {
      evt = evt ? evt : window.event;
      var charCode = evt.which ? evt.which : evt.keyCode;
      if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        evt.preventDefault();
      } else {
        return true;
      }
    },
    countChange(item) {
      var self = this;
      clearTimeout(this.timer);
      this.timer = setTimeout(function () {
        window.axios
          .get("/updateProductInBasket", {
            params: {
              token: self.$store.state.token,
              id: item.id,
              count: item.count,
            },
          })
          .then((response) => {
            self.$store.state.basket.items = response.data;
          });
      }, 1000);
    },
    deleteProduct(item) {
      if (confirm("Удалить " + item.title + " из корзины?"))
        window.axios
          .get("/deleteProductInBasket", {
            params: {
              token: this.$store.state.token,
              id: item.id,
            },
          })
          .then((response) => {
            this.$store.state.basket.items = response.data;
            this.updateBasket();
          });
    },
    updateBasket() {
      window.axios
        .get("/getBasket", {
          params: {
            token: this.$store.state.token,
          },
        })
        .then((response) => {
          this.$store.state.basket.items = response.data;
        });
    },
    selectFile(event) {
      if (event.target.files.length == 0) {
        return;
      }
      this.fileName = event.target.files[0].name;
      var formData = new FormData();
      formData.append("file", event.target.files[0]);
      window.axios
        .post("/basket/upload", formData, {
          headers: { "Content-Type": "multipart/form-data" },
        })
        .then((response) => {
          this.$store.state.basket.requisites = "/storage/" + response.data;
        });
    },
  },
  beforeMount() {
    console.log(this.basket);
  },
};
</script>
<style scoped>
.product {
  background: #fff;
  border-bottom: 1px solid #f4f4f4;
  padding: 15px;
}
.product .col-image {
  height: 150px;
  background-position: center center;
  background-size: contain;
  background-repeat: no-repeat;
}
.col-title a {
  text-transform: uppercase;
  color: red;
  font-family: "Myriad Pro Semibold";
}
.input-count {
  width: 100px;
  margin: 10px 0;
  text-align: center;
}
.btn-count {
  margin: 10px 0;
  border: 0px;
  border-top: 1px solid black;
  border-bottom: 1px solid black;
  outline: 0 !important;
  min-width: 30px;
  background: #fff;
}
.btn-minus {
  border-left: 1px solid black;
}
.btn-plus {
  border-right: 1px solid black;
}
.btn-delete {
  padding-top: 6px;
  cursor: pointer;
}
.btn-delete svg {
  width: 64px;
  min-width: 64px;
  max-width: 64px;
}
form {
  background: #fff;
  padding: 20px;
}
.select-file-label {
  border-radius: 4px;
  text-align: center;
  height: 30px;
  padding: 3px;
  margin: 0;
  width: 150px;
}
.select-file-input {
  opacity: 0;
  position: absolute;
  width: 150px;
  display: none;
}
</style>