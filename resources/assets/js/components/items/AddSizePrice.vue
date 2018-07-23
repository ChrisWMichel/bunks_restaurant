<template>
    <div class="row" id="whole-page">
        <div class="col-md-6 " id="add-price-field">
            <h3>Category: {{cat_name}}</h3>
            <h2>{{item.name}}</h2>
            <p>{{item.description}}</p>

            <div class="row">
                <div class="input-field col-md-4">
                    <input type="text" v-model="size" id="size" placeholder="none"/>
                    <label for="size">Size</label>
                </div>
            </div>
            <div v-if="cat_name === 'Pizzas'">
                <div class="row">
                    <div class="input-field col-md-3">
                        <input type="number" v-model="topping_price" id="topping_price"/>
                        <label for="topping_price">Topping Price</label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="input-field col-md-3">
                    <input type="number"  v-model="price" id="price"/>
                    <label for="size">Price</label>
                </div>
            </div>
            <div class="row">
                <div class="col-md-1 col-md-offset-3">
                    <button type="submit" class="btn btn-primary" :disabled="!isValidForm" @click="addPrice">Add</button>
                </div>
            </div>
        </div><!--class="col-md-4 "-->
        <div class="col-md-4 col-md-offset-6 show-price">
            <div v-if="main_array.length > 0">
                <ul>
                    <li v-for="main in main_array"><h4>{{main.size}} - {{main.price | currency}}</h4></li>
                </ul>

            </div>
            <div class="row" v-if="finished">
                <div class="col-md-1 col-md-offset-3">
                    <button type="submit" class="btn btn-primary" @click="finishItem">Finish</button>
                </div>
            </div>
        </div>
    </div><!--row-->
</template>

<script>
    import axios from 'axios'

    export default {
        name: "AddSizePrice",
        props:['item', 'cat_name'],
        data(){
            return{
                main_array:[],
                size:'',
                price:'',
                finished: false,
                topping_price: ''
            }
        },
        computed:{
            isValidForm(){
                return this.price;
            },

        },
        methods:{
            addPrice(){
                if(this.size !== ''){
                    if(this.topping_price !== ''){
                        this.main_array.push({topping: this.topping_price, size:this.size, price:this.price});
                    }else{
                        this.main_array.push({size:this.size, price:this.price});
                    }

                    if(this.main_array.length > 1 || this.topping_price !== ''){
                        this.finished = true;
                    }
                    this.topping_price = '';
                    this.price = '';
                    this.size = '';
                }else{
                    // add price to item only with no size, and close the form
                    axios.post('api/price', {item_id: this.item.id, price: this.price})
                        .then(resp => {
                            this.$store.dispatch('addItemPrice', resp.data);
                        });

                    this.$emit('priceAdded');
                    toastr.success(this.item.name + ' has been added successfully.');
                }
            },
            finishItem(){
                //add sizes and prices
                axios.post('api/size/' + this.item.id, this.main_array)
                    .then(resp => {
                        // can't retrieve item via SizeController, fixing this problem with this new function:
                        axios.get('api/getItem/' + this.item.id).then(item =>{
                            this.$store.dispatch('addItemSizePrice', item.data);
                        });
                    });
                this.$emit('priceAdded');
                toastr.success(this.item.name + ' has been added successfully.');
            },
            formatPrice(value) {
                let val = (value/1).toFixed(2);
                return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")
            },

        },

    }
</script>

<style scoped>
    .show-price{
        margin-left: 100px;
    }
    #add-price-field{
        width: 40%;
    }
    #whole-page{
        display: inline;
    }
</style>