require('./bootstrap');

import Vue from 'vue';
import App from './App.vue';
import i18n from './lang/i18n';
import store from './store/store';
import router from './router/router';

Vue.config.productionTip = false;

new Vue({
    el: '#app',
    render: h => h(App),
    store,
    router,
    i18n,
});
