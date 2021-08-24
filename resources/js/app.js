require('./bootstrap');
window.Vue = require('vue');
import VueRouter from 'vue-router';
Vue.use(VueRouter);
import Vue from 'vue';

import App from './App.vue';
import Home from './components/Home';
import ProdukList from './components/ProdukList';
import AddProduk from './components/AddProduk';
import EditProduk from './components/EditProduk';

import VueSweetalert2 from 'vue-sweetalert2';
window.Swal = require('sweetalert2');
Vue.use(VueSweetalert2);
import utils from './helpers/utilities';
Vue.prototype.$utils = utils
import Vueaxios from 'vue-axios';
import axios from 'axios';
Vue.use(Vueaxios, axios);
 
const routes=[
    {
        name: '/',
        path: '/',
        component:Home
    },
    {
        name: '/produk',
        path: '/produk',
        component:ProdukList
    },
    {
        name: 'add_produk',
        path: '/add_produk',
        component:AddProduk
    },
    {
        name: 'get_produks',
        path: '/get_produks/edit/:id?',
        component:EditProduk
    }
];

const router = new VueRouter ({ mode: 'history', routes: routes});
const app = new Vue(Vue.util.extend({router},App)).$mount('#app');