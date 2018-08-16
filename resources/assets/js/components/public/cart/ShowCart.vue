<template>

    <div>
        <h2>Cart</h2>
        <button @click="hideCart">Go Back</button>
        <hr/>
        <form @change="delivery">
            <input type="radio"  checked value="pickup" id="one" v-model="picked">
            <label for="one" :class="{'bold-lable': picked === 'pickup'}">Pick Up</label>

            <input type="radio" id="two" value="deliver" v-model="picked">
            <label for="two" :class="{'bold-lable': picked === 'deliver'}">Delivered</label>
        </form>
        <transition name="slide">
        <div v-if="address_form">
            <div class="row">
                <div class="col-2 col-lg-offset-2">

                        <app-address-form @closeForm="address_form=false"></app-address-form>

                </div>
            </div>
        </div>
        </transition>
        <br>
            <table class="table table-striped table-bordered table-hover">
                <thead>
                <tr>
                    <th>Qnty</th>
                    <th>Size</th>
                    <th>Item</th>
                    <th>Price</th>
                </tr>
                </thead>
                <tbody>
                    <tr v-for="(item, index) in items.cart" :key="item.id">
                        <td>
                            <input type="number" class="input-qantity" @change="changeQty($event.target.value, item, index)" :value="item.quantity" />
                            <button class="btn-xs">update</button>

                        </td>
                        <td v-if="item.size">{{item.size}}</td>

                        <td v-else>n/a</td>

                        <td v-if="item.toppings.length > 0"
                            >{{item.item_name}}<br> <span v-for="topping in item.toppings">{{topping.name}}, &nbsp;</span> </td>

                        <td v-if="item.toppings.length == 0">{{item.item_name}}</td>

                        <td>{{item.total_item_cost | currency}}</td>

                        <td><button class="btn-xs btn-danger" @click="removeItem(item.id, index)">X</button> </td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>Sales tax ({{sales_tax * 100}}%)</td>
                        <td>{{tax_sum | currency}}</td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td><b>Total</b></td>
                        <td><b>{{tax_sum  + total_cost | currency}}</b></td>
                    </tr>
                </tbody>
            </table>
        <div class="row">
            <div class="col-8">
                <textarea v-model="checkout_note" placeholder="Notes"></textarea>
            </div>
            <div class="col-2 col-lg-offset-1">
                <button class="btn btn-large" @click="checkout">Purchase</button>
            </div>
        </div>


    </div>
</template>

<script>
    import AddressForm from './AddressForm'

    export default {
        name: "ShowCart",
        components:{
            appAddressForm: AddressForm
        },
        data(){
            return{
                topping_count: 0,
                top_total: 0,
                sales_tax: this.$store.getters.getSalesTax,
                total_cost: 0,
                checkout_note: '',
                picked: 'pickup',
                address_form: false,
            }
        },
        computed:{
            items(){
                return this.$store.state.cart;
            },
            tax_sum(){
                this.total_cost = 0;
                this.items.cart.forEach(item => {
                    this.total_cost += item.total_item_cost;
                });
                return this.total_cost * this.sales_tax;
            },

        },
        methods:{
            hideCart(){
                this.$emit('toggle_cart');
            },
            removeItem(item_id, index){
                this.$store.dispatch('removeItem', {item_id, index});
                this.$emit('update_count');
            },
            changeQty(qty, item, index){
                item.total_item_cost = item.price * qty;
                item.quantity = qty;
                this.$store.dispatch('updateQuantity', {item: item, index: index});
            },
            checkout(){

                this.$store.dispatch('checkout',{note: this.checkout_note, total_cost: this.total_cost + this.tax_sum});
            },
            delivery(){
                if(this.$store.state.user.address === null){
                    if(this.picked === 'deliver'){
                        this.address_form = true;
                    }
                } else {
                    this.address_form = false;
                }
            },

        }
    }
</script>

<style scoped>
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

    .input-qantity{
        width: 20px;
    }
    .slide-enter{

    }
    .slide-enter-active{
        animation: slide-in 200ms ease-out forwards;
    }
    .slide-leave{

    }
    .slide-leave-active{
        animation: slide-out 200ms ease-out forwards;
    }
    @keyframes slide-in {
        from{
            transform: translateY(-30px);
            opacity: 0;
        }
        to{
            transform: translateY(0);
            opacity: 1;
        }
    }
    @keyframes slide-out {
        from{
            transform: translateY(0);
            opacity: 1;
        }
        to{
            transform: translateY(20px);
            opacity: 0;
        }

    }

    .bold-lable{
        color: green;
    }


</style>
