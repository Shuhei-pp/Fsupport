import Vue from 'vue';

//ziggy
import route from 'ziggy';
import { Ziggy } from './Ziggy';

//vue-router
import VueRouter from 'vue-router';

//components
import HomeComponent from './components/HomeComponent.vue';
import AreaShowComponent from './components/Areas/AreaShowComponent.vue';
import FrecordsDetailComponent from './components/Frecords/FrecordsDetailComponent.vue';
import FrecordSearchComponent from './components/Frecords/FrecordSearchComponent.vue';

/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue').default;

//Vue.js routing
Vue.use(VueRouter);

const router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/',
            name: 'vue.home',
            component: HomeComponent
        },
        {
            path: '/area/:areaId',
            name: 'area.show',
            component: AreaShowComponent,
            props: true
        },
        {
            path: '/frecord/detail/:frecordId',
            name: 'frecord.detail',
            component: FrecordsDetailComponent,
            props: true
        },
        //検索ページ
        {
            path: '/frecord/search',
            name: 'frecord.search',
            component: FrecordSearchComponent
        },
    ]
});

//ziggy
Vue.mixin({
    methods: {
        route: (name, params, absolute, config = Ziggy) => route(name, params, absolute , config),
    },
});

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

//Vue.component('example-component', require('./components/ExampleComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    router
});
