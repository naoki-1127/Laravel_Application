/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */


require('./bootstrap');

import Vue from 'vue';
import App from './vue/app'
import { library } from '@fortawesome/fontawesome-svg-core'
import { faCalendarWeek, faHeart, faPlusSquare, faTrash,faUpload,faFolder } from '@fortawesome/free-solid-svg-icons'
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'
import { faPhp,faGolang,faVuejs, faGit } from '@fortawesome/free-brands-svg-icons'

/* import VueRouter from 'vue-router'; */
import { BootstrapVue, IconsPlugin } from 'bootstrap-vue';
/* import router from './router'; */

library.add(faPlusSquare, faTrash,faUpload,faCalendarWeek,faHeart,faFolder,faPhp,faGolang,faVuejs,faGit)

window.Vue = require('vue');

Vue.component('font-awesome-icon', FontAwesomeIcon)
Vue.use(BootstrapVue)
Vue.use(IconsPlugin)
/* Vue.use(VueRouter); */

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('dashboard-component', require('./components/DashboardComponent.vue').default);
Vue.component('photo-component', require('./components/PhotoComponent.vue').default);
Vue.component('storage-component',require('./components/StorageComponent.vue').default);
Vue.component('study-component', require('./components/StudyComponent.vue').default);
Vue.component('dictionary-component', require('./components/DictionaryComponent.vue').default);
Vue.component('todo-component',require('./components/TodoComponent.vue').default);



/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    components: { App }
});
