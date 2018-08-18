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
                                <div v-for="data in item.prices">
                                    <div class="price-list  col-left">
                                        <ul class="ul-size">
                                            <li>
                                                <form>
                                                    <input :disabled="category_name === 'Pizzas' ? true : false" type="number" class="input-qantity" @change.prevent="changeQuantity($event.target.value)" value="1" />

                                                    {{data.price | currency}}
                                                    <button :disabled="!$store.state.user" class="btn btn-xs add-btn" @click.prevent="addToCart(data, item.name)">Add</button>
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
        <app-add-toppings @form_closed="toppingsAdded" :item="item"></app-add-toppings>
    </div>
</template>

<script>
    import AddToppings from './cart/AddToppings'

    export default {
        name: "MenuItemList",
        props:['category_name'],
        components:{
            appAddToppings: AddToppings
        },
        data(){
            return{
                image_url: '/images/',
                quantity: 1,
                item: '',

                cart:[]
            }
        },
        computed: {
            getItems() {
                return this.$store.state.cat_item;
            },
            itemCount(){
                return this.$store.getters.getItemCount;
            }
        },
        methods:{
            changeQuantity(qty){
                this.quantity = qty;
            },
            addToCart(data, item_name){
                //console.log('data', data);
                // check for duplicates
                if(this.category_name !== 'Pizzas' ){
                     this.$store.dispatch('checkForDuplicates', {data: data, item_name: item_name, quantity: this.quantity}); //Number(this.quantity)

                     if(this.$store.getters.getCheckDuplicate){
                         toastr.success('Quantity of ' + item_name + ' has been updated.');
                     }
                }
                if(!this.$store.getters.getCheckDuplicate){
                    let id = this.itemCount + 1;
                    this.cart = {
                        id: id,
                        item_id: data.item_id,
                        quantity: this.quantity,
                        item_name: item_name,
                        price: data.price,
                        size: null,
                        size_id: null,
                        topping_cost: 0,
                        toppings: [],
                        total_topping_cost: 0,
                        total_item_cost: 0
                    };

                    if(data.size.length > 0){
                        this.cart.size = data.size[0].size;
                        this.cart.size_id = data.size[0].id;
                        //console.log('size_id', this.cart.size_id)
                        if(data.size[0].topping_cost !== null){
                            this.cart.topping_cost = data.size[0].topping_cost.cost;
                        }
                    }

                    if(this.category_name === 'Pizzas'){
                        this.item = this.cart;
                        $('#addToppings').modal();
                    }else{
                        this.cart.total_item_cost = this.quantity * data.price;

                        this.$store.dispatch('addItemToCart', this.cart);
                        this.$emit('itemAdded');
                        toastr.success(item_name + ' , has been addedd to your cart.');
                    }
                    this.quantity = 1;
                }
            },
            toppingsAdded(){
                this.$emit('itemAdded');
                toastr.success('Your pizza has been added to your cart.');
               // console.log(this.$store.state.cart);
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
