require('./bootstrap');

window.Vue = require('vue').default;

import Vue from 'vue';
import App from './components/App'
import Navbar from './components/includes/NavBar'
import Footer from './components/includes/Footer'
import Posts from './components/pages/posts/Index'

Vue.component('navbar', Navbar);
Vue.component('site-footer', Footer);
Vue.component('posts', Posts);

const app = new Vue({
    el: '#app',
    render: h => h(App)
});
