/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

Vue.component('positions-chart', require('./components/PositionsChart.vue').default);
Vue.component('gender-chart', require('./components/GenderChart.vue').default);
Vue.component('clients-map', require('./components/ClientsMap.vue').default);
Vue.component('offices-map', require('./components/OfficesMap.vue').default);
Vue.component('tags-chart', require('./components/TagsChart.vue').default);
Vue.component('grow-chart', require('./components/GrowChart.vue').default);
Vue.component('counter', require('./components/Counter.vue').default);

// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});
