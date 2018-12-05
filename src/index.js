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

window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('text-component', require('./components/Text.vue').default);
Vue.component('modal-component', require('./components/UI/Modal.vue').default);
Vue.component('images-component', require('./components/Images.vue').default);
Vue.component('code-list-component', require('./components/CodeList.vue').default);

const app = new Vue({
    el: '#app',
});

/**
 * Import another Libs
 */

// CodeMirror
import CodeMirror from 'codemirror'
// Mode:
import 'codemirror/mode/xml/xml.js'
// Theme css in libs.styl

window.CodeMirror = CodeMirror


// Import common main files
import stylus from './stylus/main.styl'
import js from './js'