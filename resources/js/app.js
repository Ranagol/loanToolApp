require('./bootstrap');
import Vue from 'vue';

//vuex
import { store } from './store';

//vueSelect
import vSelect from "vue-select";
import "vue-select/dist/vue-select.css";
Vue.component("v-select", vSelect);

//VueRouter code
import VueRouter from 'vue-router';
import { routes } from './routes';
Vue.use(VueRouter);
const router = new VueRouter({
    routes,
    mode: 'history',
});


router.beforeEach((to, from, next) => {
    const isThereToken = localStorage.getItem('loginToken');	//check if the user has a login token
  
    if ((to.name !== 'login' && to.name !== 'register') && !isThereToken) {	//if the user is not logged in, he can only visit the login and the register pag	e. ATTENTION: these here are route NAMES, NOT ROUTE PATHS!
  
      next('/login');
      return;
    } else if ((to.name == 'login' || to.name == 'register') && isThereToken ) {	//if the user is logged in, he can't visit login and register pages, if he does 	that, navigate him to the /movies
    
      return next('/tools');
  
    } else next();
    
});

//Global registration for the App.vue
Vue.component('App', require('./components/elements/App.vue').default);

let app = new Vue({
    el: '#app',
    router,
    store,
});






  