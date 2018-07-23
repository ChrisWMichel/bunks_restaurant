<template>
    <div :class="{'front-page': display_cat}">
        <!--<div id="header">
            <h2>Header</h2>
        </div>-->
        <transition name="slide" mode="out-in">
            <div v-if="display_cat" key="item-list" id="body">
                <div class="menu-center">
                    <h2>Menu</h2>
                    <app-category-menu @receivedCategory="ShowItems"></app-category-menu>
                </div>
            </div>
            <div v-else="display_items">
                <app-menu-items></app-menu-items>
            </div>
        </transition>

        <!--Display items with second menut-->


        <!--<div id="footer">
            <p>&copy; 2018</p>
        </div>-->
    </div>

</template>

<script>
    import CategoryMenu from './CategoryMenu'
    import MenuItems from './MenuItems'

    export default {
        name: "PublicSide",
        components: {
            appCategoryMenu: CategoryMenu,
            appMenuItems: MenuItems
        },
        data(){
           return{
               display_cat: true,
               display_items: false
           }
        },
        created(){
            this.getCategories();
        },
        methods:{
            getCategories(){
                axios.get('api/category').then(resp =>{
                    this.$store.dispatch('getCategories', resp.data);

                })
            },
            ShowItems(){
                this.display_cat = !this.display_cat;
                this.display_items = !this.display_items;
            }
        }
    }
</script>

<style scoped>
.front-page{
    position:relative;
    min-height: 100%;
    background-image: url("../../../../../public/images/cms/bunks_filter2.jpg");
    background-position: center center;
    background-repeat:  no-repeat;
    background-attachment: fixed;
    background-size:  cover;
    background-color: #999;
}
.front-page-2{
    position:relative;
    min-height: 100%;
    background-image: url("../../../../../public/images/cms/bunks_filter2.jpg");
    background-position: center center;
    background-repeat:  no-repeat;
    background-attachment: fixed;
    background-size:  cover;
    background-color: #999;
    opacity: 0.5;
}
#header {
    background:#ff0;
    padding:10px;
}
#body {
    padding:10px;
    padding-bottom:60px;   /* Height of the footer */

}
#footer {
    position:absolute;
    bottom:0;
    width:100%;
    height:60px;   /* Height of the footer */
    background:#999;
}
    .menu-center{
        text-align: center;
    }

.slide-enter-active{
    animation: slide-in 200ms ease-out forwards;
}
.slide-leave{

}
.slide-leave-active{
    animation: slide-out 200ms ease-out forwards;
}
@keyframes slide-in {
    from{
        transform: translateY(-30px);
        opacity: 0;
    }
    to{
        transform: translateY(0);
        opacity: 1;
    }
}
@keyframes slide-out {
    from{
        transform: translateY(0);
        opacity: 1;
    }
    to{
        transform: translateY(20px);
        opacity: 0;
    }

}
</style>