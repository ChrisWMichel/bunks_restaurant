//import 'bootstrap/dist/css/bootstrap.css'
//import 'bootstrap-vue/dist/bootstrap-vue.css'
require('./bootstrap');

window.Vue = require('vue');
import VueRouter from 'vue-router'
import {routes} from "./routes/routes";
import {store} from './store/store'
import BootstrapVue from 'bootstrap-vue'
import Materialize from 'materialize-css'
import moment from 'moment'
//import 'bootstrap-vue/dist/bootstrap-vue.css'
Vue.use(Materialize);
Vue.use(BootstrapVue);



Vue.use(VueRouter);

const router = new VueRouter({
    routes,
    //mode: 'history',
    scrollBehavior(to, from, savedPosition){
        if(savedPosition){
            return savedPosition;
        }
        if(to.hash){
            return {selector: to.hash};
        }
        return {x: 0, y:0};

    }
});

Vue.filter('currency', (value)=>{
    let val = (value/1).toFixed(2);
    return '$' + val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
});

Vue.filter('formatTime', (value) =>{
    return moment(String(value)).format('hh:mm')
});

Vue.component('app-admin', require('./components/admin/AppAdmin.vue'));
Vue.component('app-public', require('./components/public/PublicSide.vue'));
Vue.component('app-incoming-orders', require('./components/employee/IncomingOrders'));

const app = new Vue({
    el: '#app',
    router,
    store,
});

/* mounted(){
        console.log('modal mounted');
        $('.modal').modal();
    }
}).$mount('#app')*/
