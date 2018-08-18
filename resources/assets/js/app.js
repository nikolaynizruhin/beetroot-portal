
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

Vue.component('positions-chart', require('./components/PositionsChart.vue'));
Vue.component('gender-chart', require('./components/GenderChart.vue'));
Vue.component('clients-map', require('./components/ClientsMap.vue'));
Vue.component('offices-map', require('./components/OfficesMap.vue'));
Vue.component('grow-chart', require('./components/GrowChart.vue'));
Vue.component('counter', require('./components/Counter.vue'));

const app = new Vue({
    el: '#app'
});
