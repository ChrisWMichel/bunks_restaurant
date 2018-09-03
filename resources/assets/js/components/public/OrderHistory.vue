<template>
<div>
    <h2>Order History</h2>
    <button @click="hideHistory">Go Back</button>
    <hr/>
    <transition-group name="order" tag="p">
        <div v-for="order in orders" :key="order.id" class="order-item">
            <b-card :title="order.created_at | formatDate">
                <a href="#" @click.prevent="deleteOrder(order)" class="delete-order ">x</a>

                <table class="card-text">
                    <thead>
                    <tr>
                        <th>Qnty</th>
                        <th>Item</th>
                        <th>Size/ Price</th>
                    </tr>
                    </thead>
                    <tr v-for="item in order.order_histories">
                        <td>{{item.quantity}}</td>

                        <td v-if="item.ordered_toppings.length > 0">
                            {{item.item.name}}<br/>
                            - &nbsp;
                            <span v-for="topping in item.ordered_toppings">
                                {{topping.topping}},
                            </span>
                            ({{item.toppings_cost | currency}})
                        </td>
                        <td v-else>{{item.item.name}}</td>

                        <td v-if="item.size_id === null">none / {{item.item.prices[0].price * item.quantity | currency}}</td>

                        <div v-else>
                            <div v-for="price in item.item.prices">
                                <div v-if="price.size[0].id === item.size_id">
                                    <td>{{price.size[0].size}} / {{price.price * item.quantity | currency}}</td>
                                </div>
                            </div>
                        </div>
                    </tr>
                </table>
                <br/>
                <p v-if="order.notes"><b>Notes:</b> {{order.notes}}</p>
                <p class="card-link">Number of times re-ordered: {{order.reorder}}</p>
                <button class="btn-reorder btn card-link">Re-Order</button>
            </b-card>
        </div>
    </transition-group>

</div>
</template>

<script>
    export default {
        name: "OrderHistory",
        data(){
            return {
                notes: ''
            }
        },
        computed:{
            orders(){
                return this.$store.getters.getOrderHistory;
            }
        },
        methods:{
            hideHistory(){
                this.$emit('hideHistory');
            },
            deleteOrder(order){
                this.$store.dispatch('deleteOrder', order);
                toastr.warning('Order has been deleted.');
            }
        }
    }
</script>

<style scoped>

    .delete-order{
        color: red;
        text-decoration: none;
        float: right;
    }
    .order-item {

        margin-right: 10px;
    }
    .order-enter-active, .order-leave-active {
        transition: all 1s;
    }
    .order-enter, .order-leave-to /* .list-leave-active below version 2.1.8 */ {
        opacity: 0;
        transform: translateX(30px);
    }
    .btn-reorder{
       margin-left: 100px;
    }
    .card-link{
        display: inline-block;
        float: left;
    }
</style>
