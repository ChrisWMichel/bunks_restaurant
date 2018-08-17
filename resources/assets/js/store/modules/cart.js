

export default {
    //namespaced: true,
    state:{
        cart: [],
        cat_name: '',
        sales_tax: 0,
        biz_info: [],
        check_duplicate: false,
        item_id_records: [],
        checkout_note: '',
        active_orders:[]
    },
    getters:{
        getItemCount(state){
            return state.cart.length;
        },
        getSalesTax(state){
            return state.sales_tax;
        },
        getCheckDuplicate(state){
            return state.check_duplicate;
        },
        getActiveOrders(state){
            return state.active_orders;
        }
    },
    mutations:{
        addItemToCart(state, item){
            state.cart.push(item);
        },
        removeItem(state, item){
            state.cart.splice(item.index, 1);
            /*let index = state.item_id_records.map((x)=>{return x}).indexOf(item.item_id);
            state.item_id_records.splice(index, 1);
            console.log(state.item_id_records);*/
        },
        updateQuantity(state, item){
            Vue.set(state.cart, item.index, item.item);
        },
        setBizInfo(state, info){
            state.sales_tax = info.sales_tax;
            state.biz_info = info;
        },
        checkForDuplicates(state, data){
            if(state.cart.length === 0){
                state.item_id_records.push(data.data.item_id);
                state.check_duplicate = false;
            }else{
             let item_id = state.item_id_records.find((id) =>{
                    return id === data.data.item_id;
                });
                if(!item_id){
                    state.item_id_records.push(data.data.item_id);
                    state.check_duplicate = false;
                }else{
                    let item = state.cart.find((obj) => {return obj.item_id === data.data.item_id});

                    if(item.size !== null  && data.data.size.length > 0){
                        let item_size = state.cart.find((size) => {return size.size === data.data.size[0].size});

                        if(item_size && item_size.item_id === data.data.item_id){
                            item_size.quantity += Number(data.quantity);
                            item_size.total_item_cost = item_size.price * item_size.quantity;
                            state.check_duplicate = true;
                        }else{
                            state.check_duplicate = false;
                        }
                    }else{
                        item.quantity += Number(data.quantity);
                        item.total_item_cost = item.price * item.quantity;
                        state.check_duplicate = true;
                    }
                }
            }
        },
        getOrders(state, orders){
            state.active_orders = orders;
        },
        updateAddress(state, user){
            state.user = user;
        }
    },
    actions:{
        addItemToCart({commit}, item) {
            commit('addItemToCart', item);
        },
        removeItem({commit}, index){
            commit('removeItem', index);
        },
        updateQuantity({commit}, item){
            commit('updateQuantity', item);
        },
        getBizInfo({commit}){
            axios.get('api/biz_info').then(resp =>{
                commit('setBizInfo', resp.data);
            });
        },
        checkForDuplicates({commit}, data){
            commit('checkForDuplicates', data);
        },
        checkout({commit, state, getters}, payload){
            const user = getters.getUser;

            axios.post('api/checkout', {pickup: payload.pickup, cart: state.cart, note: payload.note, total_cost: payload.total_cost, user_id:user.id})
                .then(resp =>{
                    console.log('order', resp.data);
                });
        },
        getOrders({commit}){
            axios.get('api/get_orders').then(resp => {
                console.log(resp.data);
                commit('getOrders', resp.data);
            })
        },
        updateAddress({commit, state, getters}, address){

            axios.post('api/update_address/' + address.user_id, {address: address.address, city: address.city})
                .then(resp =>{
                    commit('updateAddress', resp.data);
                })
        }
    }
}
