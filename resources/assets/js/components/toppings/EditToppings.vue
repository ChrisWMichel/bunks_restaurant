<template>
    <div id="topping-modal" class="modal">
        <div class="modal-content">
            <h3>{{item.item}}</h3>

            <input type="text" v-model="item.item"/>
            <div class="row">
                <div class="input-field">
                    <input type="checkbox" v-model="item.double_price" id="doublePrice"/>
                    <label for="doublePrice">Double Price</label>

                </div>
            </div>
            <div class="modal-footer">
                <div class="col-lg-5">
                    <button class="btn-success" @click="updateItem">Update</button>
                </div>
                <div class="col-lg-2 col-lg-offset-1">
                    <button class="btn-danger" @click="deleteItem">Delete</button>
                </div>
                <div class="col-lg-2 col-lg-offset-1">
                    <button @click="cancelItemEdit" class="modal-close waves-effect waves-green cancle-btn">Cancel</button>
                </div>

            </div>

        </div>
    </div>

</template>

<script>
    export default {
        name: "EditToppings",
        props:['editItem'],
        data(){
            return{

            }
        },
        computed:{
            item(){
                return this.$store.state.edit_topping;
            }
        },
        created(){

        },
        methods:{
            updateItem(){
                this.item.double_price = (this.item.double_price === true) ? 1:0;
                let topping = {
                    item: this.item.item,
                    id: this.item.id,
                    double_price: this.item.double_price,
                    topping__cat_id: this.item.topping__cat_id,
                };
                this.$store.dispatch('updateTopping', topping);
                this.$store.state.edit_topping = '';
                this.cancelItemEdit();
                axios.put('api/topping_items/' + topping.id, topping);

            },
            cancelItemEdit(){
                $('#topping-modal').modal();
                $('#topping-modal').modal('hide')

            },
            deleteItem(){

            }
        },

    }
</script>

<style scoped>
.modal{
    width:40%;
    height: 45%;
    overflow-scrolling: auto;
}
.modal-content{
    border: none;
    box-shadow: none;
}
</style>