<template>
    <div>

        <div class="row">
            <div class="col s12">
                <button v-for="category in category_names" @click="displayItems(category)">{{category.name}}</button>
            </div>
        </div>
        <hr>

        <div class="row">
            <div class="col s12">
                <table class="table-striped table-bordered table-hover">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Price</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="item in items">
                        <td>{{item.name}}</td>
                        <td>{{item.description}}</td>

                        <td style="width: 180px;">

                            <div class="row">
                                <div class="col">
                                    <div v-for="size in item.sizes">
                                        <div class="size-list">
                                            <ul class="ul-size">
                                                <li v-if="size !== null">{{size.size}} - </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div v-for="price in item.prices">
                                        <div class="price-list">
                                            <ul class="ul-size text-center">
                                                <li>{{price.price | currency}}</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</template>

<script>
    export default {
        name: "ListItems",
        components:{

        },
        data(){
            return{
                items:'',
            }
        },
        computed:{
            category_names(){
                return this.$store.state.categories;
            }
        },
        methods:{
            displayItems(category){
                this.items = '';
                this.items = category.items;
                //console.log(this.items);
            }
        }
    }
</script>

<style scoped>
    .size-list{
        /* float:left;*/
        width: 70px;
    }

    .ul-size{
        text-align: center;
        list-style: none;
        padding: 0;
        margin:0;
    }

    .price-list{
        width: 60px;
        padding: 0;
        margin:0;
    }
</style>