<template>
    <div id="addToppings" class="modal">

        <div class="modal-content">
            <h3>Add Toppings<span class="topping-cost">&nbsp; topping cost - {{item.topping_cost | currency}} (price doubles in blue).</span></h3>

            <div class="row">
                <div v-for="category in categories" class="col">
                    <table>
                        <tr>
                            <th><h4><b>{{category.name}}</b></h4></th>
                        </tr>
                        <tr v-for="name in category.topping_items">
                            <td>
                                <input type="checkbox" v-model="selected" :value="{name: name.item, double: name.double_price}" :id="name.id" />
                                <label :class="{bold_name: name.double_price}" :for="name.id">{{name.item}}</label>
                            </td>

                        </tr>
                    </table>
                </div>
            </div>
            <div class="align-content-center">
                <button @click="closeForm">Add Selected Toppings</button>
            </div>
        </div>
        <div class="modal-footer">
            <button @click="cancelCatDelete" class="modal-close waves-effect waves-green btn-flat">Cancel</button>
        </div>
    </div>
</template>

<script>
    export default {
        name: "AddToppings",
        props:['item'],
        data(){
            return{
                selected:[]
            }
        },
        created(){

        },
        computed:{
            categories(){
                return this.$store.state.cat_toppings;
            }
        },

        methods:{
            cancelCatDelete(){
                $('#addToppings').modal('hide')
            },
            closeForm(){
                //console.log('cart', this.item);
                $('#addToppings').modal('hide');

                this.item.toppings = this.selected;
                let total = 0;

                for(let x=0; x < this.selected.length; ++x){

                    if(this.item.toppings[x].double){
                        total +=  parseInt(this.item.topping_cost * 2);
                    }else{
                        total += parseInt(this.item.topping_cost);
                    }
                }

                this.item.total_topping_cost = total;
                this.item.total_item_cost = total + this.item.price;

                this.$store.dispatch('addItemToCart', this.item);

                this.selected = [];
                this.$emit('form_closed');
            }
        }
    }
</script>

<style scoped>

    .topping-cost{
        font-size: 14px;
    }
    .bold_name{
        font-weight: bolder;
        color:blue;
    }
</style>
