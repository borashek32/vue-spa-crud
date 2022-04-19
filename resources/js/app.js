require('./bootstrap');

window.Vue = require('vue').default;

import Vue from 'vue';
import App from './components/App'
import Navbar from './components/includes/NavBar'
import Footer from './components/includes/Footer'
import Posts from './components/pages/posts/Index'
// import ValidationErrors from './components/includes/ValidationErrors'

Vue.component('navbar', Navbar);
Vue.component('site-footer', Footer);
Vue.component('posts', Posts);
// Vue.component('validation-errors', ValidationErrors)

const app = new Vue({
    el: '#app',
    render: h => h(App)
});
