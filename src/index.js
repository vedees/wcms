/*!
 * WCMS v0.0.1 - WEX Simple CMS
 * https://github.com/wexcms/wcms
 * Copyright (C) 2018 Evgenii Vedegis <vedegis@gmail.com>
 * https://github.com/wexcms/wcms/master/LICENSE
 */

 /**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue & other libraries and stylus files. It is a great starting
 * point when building robust, powerful web applications using Vue and WCMS.
 */

 window.Vue = require('vue');

import stylus from './stylus/main.styl'
import js from './js/main.js'

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('example-component', require('./components/ExampleComponent.vue').default);

const app = new Vue({
    el: '#app',
});
