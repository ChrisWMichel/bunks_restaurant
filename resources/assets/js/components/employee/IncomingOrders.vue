<template>
    <div>
        <h2>Incoming Orders</h2>

        <div class="card">
            <div class="card-header">

            </div>
            <div class="card-body">

            </div>
            <div class="card-footer">

            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "IncomingOrders",
        data(){
            return{
                //orders: this.$store.getters.getActiveOrders
            }
        },
        created(){
            this.getOrders();
        },
        computed:{
            orders(){
                return this.$store.getters.getActiveOrders;
            }
        },
        methods:{
            getOrders(){
               this.$store.dispatch('getOrders');
               //console.log('active_orders', this.$store.getters.getActiveOrders);
            }
        }
    }
</script>

<style scoped>

</style>
