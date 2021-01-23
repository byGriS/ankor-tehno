require('./bootstrap');

window.toggleSidebar = function() {
  var sidebar = document.getElementsByClassName("sidebar")[0];
  if (sidebar.style.left === "0px") {
    sidebar.style.left = '';
  } else {
    sidebar.style.left = "0px";
  }
}
$(window).on('load', function() {
  $('#slideshow0').nivoSlider({
    controlNav: false,
    directionNav: false
  });
});

window.Vue = require('vue');

import store from './store'

Vue.component('category', require('./components/index/sidebar/category.vue').default);

import AdminProductsIndex from './components/admin/products/products_index';
import BasketIcon from './components/index/basket/icon';
import HeaderSlider from './components/index/header_slider.vue';
import FooterCategoriesList from './components/index/footer_categories_list';
import Product from './components/index/products/product';
import Category from './components/index/categories/category';
import ProductDetail from './components/index/products/detail';
import BasketDetail from './components/index/basket/detail';
import SidebarCategories from './components/index/sidebar/categories'
import SidebarFilter from './components/index/sidebar/filter'
import BrandSlider from './components/index/brand_slider'

const app = new Vue({
  el: '#app',
  store,
  components: {
    AdminProductsIndex,
    BasketIcon,
    HeaderSlider,
    FooterCategoriesList,
    Product,
    Category,
    ProductDetail,
    BasketDetail,
    SidebarCategories,
    SidebarFilter,
    BrandSlider,
  },
  beforeMount() {
    let token = localStorage.getItem('token');
    if (token == null) {
      localStorage.setItem('token', window.axios.defaults.headers.common['X-CSRF-TOKEN']);
      token = localStorage.getItem('token');
    }
    this.$store.state.token = token;
    window.axios
      .get('/getBasket', {
        params: {
          token: token
        }
      })
      .then(response => {
        //console.log(response);
        this.$store.state.basket.items = response.data;
      })
  }
})