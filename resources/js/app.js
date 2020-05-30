require('./bootstrap');

import Vue from 'vue';

//VueRouter code
import VueRouter from 'vue-router';
import routes from './routes';
Vue.use(VueRouter);

//Axios code
import axios from 'axios';
window.axios = axios;//we are assigning axios globally
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

//Navbar global registration
Vue.component('App', require('./components/elements/App.vue').default);

let app = new Vue({
    el: '#app',

    router: new VueRouter(routes)
});
