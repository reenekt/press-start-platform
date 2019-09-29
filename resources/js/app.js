/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

require('./helpers/sidebar');
require('./helpers/popover');
require('./helpers/bs-custom-file-input');

window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('cms-app-status', require('./components/CmsAppStatus.vue').default);
Vue.component('cms-app-plugin-list', require('./components/CmsAppPluginList.vue').default);
Vue.component('work-in-progress', require('./components/WorkInProgress.vue').default);
Vue.component('plugin-zip-uploader', require('./components/PluginZipUploader.vue').default);
Vue.component('install-plugin-card', require('./components/InstallPluginCard.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});
