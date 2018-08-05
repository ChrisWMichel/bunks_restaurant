<template>
    <div>
        <div v-for="(item, index) in getItems.items">
            <div class="col-lg-5 col-sm-12 col-md-6">
                <div class="card" :class="{ 'card-left': index % 2 === 0}">
                   <div  v-if="item.image_path" >
                       <div class="card-image">
                           <img :src="image_url + item.image_path"/>
                           <span class="card-title">{{item.name}}</span>
                       </div>
                   </div>
                    <div v-else>
                        <div class="card-title center-align align-title">{{item.name}}</div>
                    </div>

                    <div class="card-content">
                        <p>{{item.description}}</p>
                    </div>
                    <div class="card-action">
                        <div class="row ">
                            <div class="col center-text">
                                <h6><span v-if="item.prices[0].size.length > 0" class="size-title">Size</span><span v-if="category_name === 'Pizzas'"> - Topping</span></h6>
                                <div v-for="size in item.prices">
                                    <div v-for="data in size.size">
                                        <div class="size-list">
                                            <ul class="ul-size ">
                                                <li class="size-spacing" v-if="size !== null">{{data.size}} - <span v-if="category_name === 'Pizzas'">{{data.topping_cost.cost | currency}}</span> </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <h6 v-if="item.prices[0].size.length > 0" class="price-title">Price</h6>
                                <div v-for="price in item.prices">
                                    <div class="price-list  col-left">
                                        <ul class="ul-size">
                                            <li>
                                                <form @click.prevent="addToCart(price, item.name)">
                                                    <input type="number" class="input-qantity" @change="changeQuantity($event.target.value)" value="1" />
                                                    {{price.price | currency}}
                                                    <button class="btn btn-xs add-btn" >Add</button>
                                                </form>

                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "MenuItemList",
        props:['category_name'],
        data(){
            return{
                image_url: '/images/',
                quantity: '1',
            }
        },
        computed: {
            getItems() {
                return this.$store.state.cat_item;
            },
        },
        methods:{
            changeQuantity(qty){
                this.quantity = qty;
            },

            addToCart(data, item_name){
                let cart = {
                    quantity: this.quantity,
                    item_name: item_name,
                    price: data.price,
                    size: null,
                    topping_cost: null
                };
                if(data.size.length > 0){
                    cart.size = data.size[0].size;
                    if(data.size[0].topping_cost !== null){
                        cart.topping_cost = data.size[0].topping_cost.cost;
                    }
                }
                this.$store.dispatch('addItemToCart', cart);
                this.$emit('itemAdded');
            }
        }
    }
</script>

<style scoped>
.input-qantity{
    width: 20px;
}
    .add-btn{
        /*padding: -10px -10px;*/
        font-size: 10px;
    }
    .center-text{
        text-align: right;
        margin-right: 10px;
    }
    .col{
        /*border: 1px solid black;*/
    }
    .col-left{
        float: left;
    }
    .col-right{
        float: right;
    }
    .price-title{
        margin-left: 30px;
    }
    .size-title{
        margin-right: 20px;
    }
    .size-spacing{
        margin-bottom: 50px;
        margin-top: 20px;
    }
    .align-title{
        padding-top: 30px;
    }
    input [type='number']{
        -webkit-appearance: textfield;
        -moz-appearance: textfield;
        appearance: textfield;

    }
input[type=number]::-webkit-inner-spin-button,
input[type=number]::-webkit-outer-spin-button {
    -webkit-appearance: none;
    margin: 0;
}
</style>
