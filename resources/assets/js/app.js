//import './coreui/main.js'

import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use( VueRouter)

import App from './views/App'
import Home from './views/Home'
import Login from './views/Login'
import SingleProduct from './views/SingleProduct'
import UserBoard from './views/UserBoard'
import Admin from './views/Admin'

const router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/',
            name: 'home',
            component: Home
        },
        {
            path: '/login',
            name: 'login',
            component: Login
        },
        {
            path: '/products/:id',
            name: 'single-products',
            component: SingleProduct
        },
        {
            path: '/dashboard',
            name: 'userboard',
            component: UserBoard,
            meta: {
                requiresAuth: true,
                is_user : true
            }
        },
        {
            path: '/admin/:page',
            name: 'admin-pages',
            component: Admin,
            meta: {
                requiresAuth: true,
                is_admin : true
            }
        },
        {
            path: '/admin',
            name: 'admin',
            component: Admin,
            meta: {
                requiresAuth: true,
                is_admin : true
            }
        },
    ],
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

const app = new Vue({
    el: '#app',
    components: { App },
    router,
    methods: {
        toggleBodyClass(addRemoveClass, className) {
          const el = document.body;
          if (addRemoveClass === "addClass") {
            el.classList.add(className);
          } else {
            el.classList.remove(className);
          }
        }
    },
});
