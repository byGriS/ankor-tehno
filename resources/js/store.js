import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)

export default new Vuex.Store({
  state:{
    token: "",
    categories: [],
    basket:{
      items: [],
      requisites: ""
    }
  },

  getters:{
    categories: (state) => {
      return state.categories;
    },

    basket: (state) => {
      return state.basket;
    }
  },

})