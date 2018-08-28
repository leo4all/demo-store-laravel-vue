// The Vue build version to load with the `import` command
// (runtime-only or standalone) has been set in webpack.base.conf with an alias.
import './bootstrap'
import Vue from 'vue'
import BootstrapVue from 'bootstrap-vue'
import Datepicker from 'vuejs-datepicker'
import { id } from 'vuejs-datepicker/dist/locale'
import Notifications from 'vue-notification'
import Sweetalert from 'vue-sweetalert2'
import Loading from './components/Loading'
import App from './App'
import router from './router'
import store from './store'

Vue.use(BootstrapVue)
Vue.use(Notifications)
Vue.use(Sweetalert)

Vue.component('b-loading', Loading)
Vue.component('b-datepicker', {
  extends: Datepicker,
  props  : {
    bootstrapStyling: {
      type   : Boolean,
      default: true,
    },
    language: {
      type   : Object,
      default: () => id,
    },
  },
})

router.beforeEach((to, from, next) => {
  if(to.matched.some(record => record.meta.requiresAuth)) {
    if (localStorage.getItem('jwt') == null) {
      next({
        path: '/login',
        params: { nextUrl: to.fullPath }
      })
    } else {
      let user = JSON.parse(localStorage.getItem('user'))
      if(to.matched.some(record => record.meta.is_admin)) {
        if(user.is_admin == 1){
            next()
        }
        else{
            next({ name: 'userboard'})
        }
      }
      else if(to.matched.some(record => record.meta.is_user)) {
        if(user.is_admin == 0){
            next()
        }
        else{
            next({ name: 'admin'})
        }
      }
      next()
    }
  } else {
    next()
  }
})

window.Vue = new Vue({
  el        : '#app',
  router    : router,
  store     : store,
  template  : '<App/>',
  components: {
    App,
  },
})
