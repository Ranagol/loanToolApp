require('./bootstrap');

import Vue from 'vue';

//VueRouter code
import VueRouter from 'vue-router';
import routes from './routes';
Vue.use(VueRouter);

//Global registration for the App.vue
Vue.component('App', require('./components/elements/App.vue').default);

let app = new Vue({
    el: '#app',

    router: new VueRouter(routes)
});
