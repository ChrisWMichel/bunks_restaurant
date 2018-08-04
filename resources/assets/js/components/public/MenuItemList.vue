<template>
    <div>
        <div v-for="(item, index) in getItems.items">
            <div class="col-lg-5 col-sm-12 col-md-6">
                <div class="card" :class="{ 'card-left': index % 2 === 0}">
                    <div class="card-image">
                        <img v-if="item.image_path" :src="image_url + item.image_path"/>
                        <span class="card-title">{{item.name}}</span>
                    </div>
                    <div class="card-content">
                        <p>{{item.description}}</p>
                    </div>
                    <div class="card-action">
                        <div class="row">
                            <div class="col">
                                <h6><span v-if="item.sizes.length > 0">Size</span><span v-if="category_name === 'Pizzas'"> - Topping</span></h6>
                                <div v-for="size in item.sizes">
                                    <div class="size-list">
                                        <ul class="ul-size">
                                            <li v-if="size !== null">{{size.size}} - <span v-if="category_name === 'Pizzas'">{{size.topping_cost.cost | currency}}</span> </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <h6 v-if="item.sizes.length > 0">Price</h6>
                                <div v-for="price in item.prices">
                                    <div class="price-list">
                                        <ul class="ul-size text-center">
                                            <li>
                                                <form @click.prevent="addToCart(price.id)">
                                                    <input type="number" v-model="quantity" class="input-qantity" value="1" />
                                                    {{price.price | currency}}
                                                    <button class="btn btn-xs" >Add</button>
                                                </form>

                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "MenuItemList",
        props:['category_name'],
        data(){
            return{
                image_url: '/images/',
                quantity: 1,
            }
        },
        computed: {
            getItems() {
                return this.$store.state.cat_item;
            },
        },
        methods:{
            addToCart(priceID){
                console.log('cat_name', this.category_name);
                console.log('priceID', priceID);
            }
        }
    }
</script>

<style scoped>
.input-qantity{
    width: 40px;
}
</style>