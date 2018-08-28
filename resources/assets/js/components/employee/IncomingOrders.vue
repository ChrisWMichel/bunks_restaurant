<template>
    <div>
        <h2>Incoming Orders: {{orders.length}}</h2>
        <transition-group name="list" tag="p">
            <div v-for="(order, index) in orders" :key="order.id" class="list-item">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col-4">
                                        <h4>Customer: {{order.user.firstname}} {{order.user.lastname}}</h4>
                                    </div>
                                    <div class="col-4 col-lg-offset-1">
                                        <h4>Order placed at: {{order.created_at | formatTime}}</h4>
                                    </div>
                                </div>

                                <div v-if="order.pickup">
                                    <h3>This order is for pickup.</h3>
                                </div>
                                <div v-else>
                                    <h3>This order is for delivery:</h3>
                                    <p>
                                        {{order.user.address}}<br>
                                        {{order.user.city}}
                                    </p>
                                </div>
                            </div>
                            <div class="card-body">
                                <div v-if="order.notes">
                                    <p>
                                        <b>Message:</b>
                                        {{order.notes}}
                                    </p>
                                </div>

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
                                    <tr v-for="item in order.order_histories" :key="item.id">
                                        <td>{{item.quantity}}</td>

                                        <td v-if="item.ordered_toppings.length > 0">
                                            {{item.item.name}}<br>
                                            - <span v-for="topping in item.ordered_toppings">{{topping.topping}}, &nbsp;</span>
                                            ({{item.toppings_cost | currency}})
                                        </td>
                                        <td v-else>
                                            {{item.item.name}}
                                        </td>
                                        <td v-if="item.size_id === null">n/a</td>
                                        <td v-if="item.size_id === null">{{item.item.prices[0].price * item.quantity | currency}}</td>
                                        <td v-if="item.size_id !== null && price.size[0].id === item.size_id" v-for="price in item.item.prices">{{price.size[0].size}}</td>
                                        <td v-if="item.size_id !== null && price.size[0].id === item.size_id" v-for="price in item.item.prices">{{price.price * item.quantity | currency}}</td>
                                    </tr>
                                    <tr>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td><b>Total w/ tax</b></td>
                                        <td><b>${{order.total}}</b></td>

                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="card-footer">
                                <button class="btn-large btn-complete" @click="orderFinished(index, order.id)">Complete</button>
                            </div>
                        </div>
                    </div><!--colum-->
                </div><!--row-->

            </div>
        </transition-group>

    </div>
</template>

<script>
    export default {
        name: "IncomingOrders",
        data(){
            return{
                order_count: 0
            }
        },
        created(){
            this.getOrders();

            setInterval(()=>{
                this.getOrders();
            }, 30000);
        },
        computed:{
            orders(){
                return this.$store.getters.getActiveOrders;
            }
        },
        methods:{
            getOrders(){
               this.$store.dispatch('getOrders');
               if(this.order_count < this.orders.length){
                   const audio = new Audio('the-calling.mp3');
                   audio.play();
                   console.log('sound off');
               }
                this.order_count = this.orders.length;
               //console.log('active_orders', this.$store.getters.getActiveOrders);
            },
            orderFinished(index, order_id){
                this.$store.dispatch('finishedOrder', {index, order_id});
            },

        }
    }
</script>

<style scoped>
    .list-item {
        display: inline-block;
        margin-right: 10px;
    }
    .list-enter-active, .list-leave-active {
        transition: all 1s;
    }
    .list-enter, .list-leave-to /* .list-leave-active below version 2.1.8 */ {
        opacity: 0;
        transform: translateX(30px);
    }
   .btn-complete{
       float: right;
   }
    .card-body{
        color: #000;
    }
    .card{
        width: 800px;
        /*display: inline-block;*/
    }
</style>
