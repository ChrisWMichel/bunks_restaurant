<template>
    <div>
   <!-- <div>{{getItems.name}}</div>-->
        <div class="row">
            <div class="col s10">
                <button v-for="category in getCatNames" @click="displayItems(category)">{{category.name}}</button>
            </div>
        </div>

        <h3>{{getItems.name}}</h3>
       <p>{{getItems.description}}</p>

        <hr>
        <transition name="fade" mode="out-in">
            <app-menu-item-list :category_name="category_name" v-if="show" key="first"></app-menu-item-list>
            <app-menu-item-list :category_name="category_name" v-else key="second"></app-menu-item-list>
        </transition>



    </div>
</template>

<script>
    import MenuItemList from './MenuItemList'

    export default {
        name: "MenuItems",
        components:{
            appMenuItemList: MenuItemList
        },
        data(){
            return{

                category_name: '',
                show: true
            }
        },
        computed:{
            getItems(){
                return this.$store.state.cat_item;
            },
            getCatNames(){
                return this.$store.state.categories;
            },

        },
        methods:{
            displayItems(cat){
                this.$store.state.cat_item = cat;
                this.category_name = cat.name;
                this.show = !this.show;

            }
        }
    }
</script>

<style scoped>
    .size-list{
        /* float:left;*/
        width: 80px;
    }

    .ul-size{
        text-align: center;
        list-style: none;
        padding: 0;
        margin:0;
    }

    .price-list{
        width: 70px;
        padding: 0;
        margin:0;
    }
    .center {
        display: block;
        margin-left: auto;
        margin-right: auto;
    }
    .fade-enter{
        opacity: 0;
    }
    .fade-enter-active{
        transition: opacity .5s;
    }
    .fade-leave{

    }
    .fade-leave-active{
        transition: opacity .5s;
        opacity: 0;
    }


</style>