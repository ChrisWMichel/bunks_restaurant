<template>

    <div>
        <h2>Cart</h2>
        <button @click="hideCart">Go Back</button>
        <hr/>

            <table class="table table-striped table-bordered table-hover">
                <thead>
                <tr>
                    <th>Qnty</th>
                    <th>Item</th>
                    <th>Size</th>
                    <th>Price</th>
                </tr>
                </thead>
                <tbody>
                    <tr v-for="(item, index) in items.cart" :key="item.id">
                        <td>
                            <input type="number" class="input-qantity" @change="changeQty($event.target.value, item, index)" :value="item.quantity" />
                            <button class="btn-xs">update</button>

                        </td>

                        <td v-if="item.toppings.length > 0"
                            >{{item.item_name}}<br> <span v-for="topping in item.toppings">{{topping.name}}, &nbsp;</span> </td>

                        <td v-if="item.toppings.length == 0">{{item.item_name}}</td>

                        <td v-if="item.size">{{item.size}}</td>

                        <td v-else>n/a</td>

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

    </div>
</template>

<script>
    export default {
        name: "ShowCart",
        data(){
            return{
                topping_count: 0,
                top_total: 0,
                sales_tax: this.$store.getters.getSalesTax,
                total_cost: 0
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
            }
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
            }
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
</style>
