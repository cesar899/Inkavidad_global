import Vue from 'vue'
import Vuex from 'vuex'

// Modules
import app from './app'
import appConfig from './app-config'
import verticalMenu from './vertical-menu'
import batchs from './batchs'
import projects from './projects'
import groups from './groups'

Vue.use(Vuex)

export default new Vuex.Store({
  modules: {
    app,
    appConfig,
    verticalMenu,
    batchs,
    projects,
    groups
  },
  strict: process.env.DEV,
})
