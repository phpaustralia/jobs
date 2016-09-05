import Vue from 'vue'
import Vuex from 'vuex'

// Make vue aware of Vuex
Vue.use(Vuex)

const state = {
  searchUrl: "/api/v1/jobs"
}

const mutations = {
  CHANGEURL: (state, url) => {
    state.searchUrl = url
  }
}

// Combine the initial state and the mutations to create a Vuex store.
// This store can be linked to our app.
export default new Vuex.Store({
  state,
  mutations
})