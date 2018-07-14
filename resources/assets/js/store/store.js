import Vue from 'vue'
import Vuex from 'vuex'
//import admin from './modules/admin'
//import items from './modules/items'

import * as actions from './actions'
import * as getters from './getters'
import * as mutations from './mutations'

Vue.use(Vuex);

export const store = new Vuex.Store({

    state:{
        admins: '',
        categories: [],
        cat_toppings: [],
        edit_topping: []
    },
    getters,
    mutations,
    actions,
    modules:{
        /*admin,
        items*/
    }

});

