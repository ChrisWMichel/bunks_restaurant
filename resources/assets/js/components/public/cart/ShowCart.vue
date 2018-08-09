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
                    <tr v-for="item in items.cart" :key="item.id">
                        <td>{{item.quantity}}</td>

                        <td v-if="item.toppings.length > 0"
                            >{{item.item_name}}<br> <span v-for="topping in item.toppings">{{topping.name}}, &nbsp;</span> </td>

                        <td v-if="item.toppings.length == 0">{{item.item_name}}</td>

                        <td v-if="item.size">{{item.size}}</td>

                        <td v-else>n/a</td>

                        <td>{{item.price + item.total_topping_cost | currency}}</td>
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
                top_total: 0
            }
        },
        computed:{
            items(){
                return this.$store.state.cart;
            }
        },
        methods:{
            hideCart(){
                this.$emit('toggle_cart');
            }
        }
    }
</script>

<style scoped>

</style>
