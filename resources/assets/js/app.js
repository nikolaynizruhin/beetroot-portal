
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

Vue.component('users', require('./components/Users.vue'));
Vue.component('clients', require('./components/Clients.vue'));
Vue.component('select-filter', require('./components/SelectFilter.vue'));
Vue.component('user-list', require('./components/UserList.vue'));
Vue.component('client-list', require('./components/ClientList.vue'));
Vue.component('user-modal', require('./components/UserModal.vue'));
Vue.component('position-chart', require('./components/PositionChart.vue'));
Vue.component('client-map', require('./components/ClientMap.vue'));

const app = new Vue({
    el: '#app'
});
