require('./bootstrap');

import Vue from 'vue';
import App from './App.vue';
import i18n from './lang/i18n';
import store from './store/store';

Vue.config.productionTip = false;

new Vue({
    el: '#app',
    render: h => h(App),
    store,
    i18n,
});