<template>
    <div class="row" id="whole-page">
        <div class="col-md-4 " id="add-price-field">
            <h2>{{item.name}}</h2>
            <p>{{item.description}}</p>

            <div class="row">
                <div class="input-field col-md-3">
                    <input type="text" v-model="size" id="size" placeholder="none"/>
                    <label for="size">Size</label>
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
        props:['item', 'cat_id'],
        data(){
            return{
                main_array:[],
                size:'',
                price:'',
                finished: false
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
                    this.main_array.push({size:this.size, price:this.price});
                    if(this.main_array.length > 1){
                        this.finished = true;
                    }
                    this.price = '';
                    this.size = '';
                }else{
                    // add price to item only, and close the form
                    axios.post('api/price', {item_id: this.item.id, price: this.price})
                        .then(resp => {
                            // update vuex
                        });

                    //this.$store.state.categories.push(this.item);

                    this.$emit('priceAdded');
                    toastr.success(this.item.name + ' has been added successfully.');
                    //TODO: instaed of retrieving categories from the databas, push it in vuex
                    this.getCategories();
                }
            },
            finishItem(){
                //add sizes and prices
                axios.post('api/size/' + this.item.id, this.main_array);
                // update category -- note: promise did not work in the SizeControll method

                this.$emit('priceAdded');
                toastr.success(this.item.name + ' has been added successfully.');
                //TODO: instaed of retrieving categories from the databas, push it in vuex
                this.getCategories();
            },
            formatPrice(value) {
                let val = (value/1).toFixed(2);
                return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")
            },
            getCategories(){
                axios.get('api/category').then(resp => {
                    this.$store.dispatch('getCategories', resp.data);
                })
            }

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