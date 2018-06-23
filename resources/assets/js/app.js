
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('cards-component', require('./components/CardsComponent.vue').default);
Vue.component('nav-component', require('./components/NavComponent.vue').default);
Vue.component('users-component', require('./components/UsersComponent.vue').default);
Vue.component('roles-component', require('./components/RolesComponent.vue').default);

import Bus from './components/Bus.js';

const app = new Vue({
  el: '#app',
  data(){
    	return {

    	}
    },
    computed: {
        component: function () {
            return Bus.component;
        }, 
    },
});
