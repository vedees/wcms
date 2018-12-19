/*!
 * WCMS - WEX Simple CMS
 * https://github.com/vedees/wcms
 * Copyright (C) 2018 Evgenii Vedegis <vedegis@gmail.com>
 * https://github.com/vedees/wcms/blob/master/LICENSE
 */

/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue & other libraries. It is a great starting
 * point when building robust, powerful web applications using Vue and WCMS.
 */

// Vue
window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('example-component', require('./components/Example.vue').default);

// Vue initial data
const app = new Vue({
    el: '#app',
});

//! Import common main files
// Main stylus
import './stylus/main.styl'
// Index.js
import './js'
