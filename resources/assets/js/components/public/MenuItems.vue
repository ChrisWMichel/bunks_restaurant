<template>
    <div>
        <div v-if="show_history">
            <app-order-history @hideHistory = "toggelHistory"></app-order-history>
        </div>
        <div v-else>
           <div v-if="!show_cart">
               <div class="row">
                   <div class="col s10">
                       <button v-for="category in getCatNames" @click="displayItems(category)">{{category.name}}</button>
                   </div>
               </div>

            <div class="row">
                <div class="col">
                    <h3>{{getItems.name}}</h3>
                </div>
                <div class="col">
                    <div v-if="getOrderHistory.length > 0">
                        <button @click="toggelHistory" class="btn-sm blue order-history">Order History</button>
                       <!-- <router-link :to="{name: 'order_history'}" ><a class="btn-sm blue order-history">Order History</a></router-link>-->
                    </div>
                </div>
                <div class="col">
                    <div v-if="$store.state.user">
                        <button v-if="item_count !== null" @click="showCart" class="btn-warning btn-large"><span class="newline">({{item_count}} items)</span> Checkout</button>
                    </div>
                    <div v-else>
                        <h3><b>Please login or register to order online.</b></h3>
                    </div>
                </div>
            </div>
               <p>{{getItems.description}}</p>
           </div>

            <hr>
            <div v-if="!show_cart">
                <transition name="fade" mode="out-in">
                    <app-menu-item-list @itemAdded="itemCount" :category_name="category_name" v-if="show" key="first"></app-menu-item-list>
                    <app-menu-item-list @itemAdded="itemCount" :category_name="category_name" v-else key="second"></app-menu-item-list>
                </transition>
            </div>
            <div v-if="show_cart">
                <app-cart @toggle_cart="showCart" @update_count="itemCount"></app-cart>
            </div>
        </div>

    </div>
</template>

<script>
    import MenuItemList from './MenuItemList'
    import Cart from '../public/cart/ShowCart'
    import OrderHistory from './OrderHistory'

    export default {
        name: "MenuItems",
        components:{
            appMenuItemList: MenuItemList,
            appCart: Cart,
            appOrderHistory: OrderHistory
        },
        data(){
            return{
                item_count:null,
                category_name: this.$store.state.cat_name,
                show_items: true,
                show_cart: false,
                show_history: false,
                show:true
            }
        },
        computed:{
            getItems(){
                return this.$store.state.cat_item;
            },
            getCatNames(){
                return this.$store.state.categories;
            },
            getOrderHistory(){
                return this.$store.getters.getOrderHistory;
            }

        },
        methods:{
            displayItems(cat){
                this.$store.state.cat_item = cat;
                this.category_name = cat.name;
                this.show_items = !this.show_items;
                this.show = !this.show;
            },
            showCart(){
                //console.log(this.$store.state.cart);
               this.show_cart = !this.show_cart;
            },
            itemCount(){
                this.item_count = this.$store.getters.getItemCount;
            },

            toggelHistory(){
                this.show_history = !this.show_history;
                this.show_items = !this.show_items;
                this.show_cart = !this.show_cart;
                //this.show = !this.show;
            },

        }
    }
</script>

<style scoped>
    .size-list{
        /* float:left;*/
        width: 80px;
    }

    .ul-size{
        text-align: center;
        list-style: none;
        padding: 0;
        margin:0;
    }

    .price-list{
        width: 70px;
        padding: 0;
        margin:0;
    }
    .center {
        display: block;
        margin-left: auto;
        margin-right: auto;
    }
    .fade-enter{
        opacity: 0;
    }
    .fade-enter-active{
        transition: opacity .5s;
    }
    .fade-leave{

    }
    .fade-leave-active{
        transition: opacity .5s;
        opacity: 0;
    }
    .top-page{
        position: fixed;
        overflow: hidden;
        top: 70px; right: 0; bottom: 60px; left: 200px;
        padding-bottom: 30px !important;
    }
    .newline{
        display: inline;
    }
    .order-history{
        color: white;
    }


</style>
