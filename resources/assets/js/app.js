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

//users
Vue.component('user-nav', require('./components/users/Nav.vue').default);
Vue.component('user-def', require('./components/users/Default.vue').default);
Vue.component('user-cards', require('./components/users/UserCards.vue').default);
Vue.component('standard-cards', require('./components/users/StandardCards.vue').default);

// admin
Vue.component('admin-nav', require('./components/admin/Nav.vue').default);
Vue.component('users', require('./components/admin/Users.vue').default);
Vue.component('roles', require('./components/admin/Roles.vue').default);
Vue.component('admin-cards', require('./components/admin/Cards.vue').default);

// modals
Vue.component('modal-delete', require('./components/modals/ModalDelete.vue').default);
Vue.component('modal-add-cards', require('./components/modals/ModalAddCard.vue').default);
Vue.component('input-card', require('./components/modals/InputForModalAddCard.vue').default);
Vue.component('modal-editing-card', require('./components/modals/ModalEditingCards.vue').default);

import Bus from './components/Bus.js';

const app = new Vue({
  el: '#app',

  data() {
    return {}
  },

  computed: {
    component: function () {
      return Bus.component;
    },
    usercomponent: function () {
      return Bus.usercomponent;
    },
  },
});
