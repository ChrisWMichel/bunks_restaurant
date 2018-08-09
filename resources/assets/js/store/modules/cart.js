

export default {
    //namespaced: true,
    state:{
        cart: [],
        cat_name: ''
    },
    getters:{
        getItemCount(state){
            return state.cart.length;
        },

    },
    mutations:{
        addItemToCart(state, item){
            state.cart.push(item);
        }
    },
    actions:{
        addItemToCart({commit}, item) {
            commit('addItemToCart', item);
        }
    }
}
