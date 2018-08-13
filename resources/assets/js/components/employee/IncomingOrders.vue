<template>
    <div>
        <h2>Incoming Orders</h2>
    </div>
</template>

<script>
    export default {
        name: "IncomingOrders",
        data(){
            return{

            }
        },
        created(){
            this.getOrders();
        },
        methods:{
            getOrders(){
                this.$store.dispatch('getOrders');
            }
        }
    }
</script>

<style scoped>

</style>
