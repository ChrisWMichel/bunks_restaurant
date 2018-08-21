import Vue from 'vue'
import Vuex from 'vuex'
import cart from './modules/cart'
import admin from './modules/admin'

import * as actions from './actions'
import * as getters from './getters'
import * as mutations from './mutations'

Vue.use(Vuex);

export const store = new Vuex.Store({

    state:{
        admins: '',
        categories: [],
        cat_item:'',
        cat_toppings: [],
        item_toppings: [],
        edit_topping: [],
        user: {}

    },
    getters,
    mutations,
    actions,
    modules:{
        cart,
        admin
    }

});

