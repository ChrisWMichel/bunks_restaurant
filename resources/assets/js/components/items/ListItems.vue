<template>
    <div>
        <transition name="slide" mode="out-in">
            <div v-if="show" key="item-list">
        <div class="row">
            <div class="col s10">
                <button v-for="category in category_names" @click="displayItems(category)">{{category.name}}</button>
            </div>
            <div class="col s1 offset-10">
                <!--<button class="waves-effect waves-light btn-small yellow" @click="showDeleteBtn">{{show_delete_label}}</button>-->
            </div>
        </div>
                <h3>{{category_name}}</h3>
        <hr>

        <div class="row">
            <div class="col s12">
                <table class="table-striped table-bordered table-hover">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Image</th>
                        <th>Description</th>
                        <th>Price</th>
                        <th>
                            Actions
                            <button class="waves-effect waves-light btn-xs yellow" @click="showDeleteBtn">{{show_delete_label}}</button>
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="item in items">
                        <td  align="center">{{item.name}}</td>
                        <td>
                            <img v-if="item.image_path" :src="image_url + item.image_path" width="150" class="center"/>
                        </td>
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
                        <td class="actions">
                            <button class="btn btn-sm btn-info btn-set" @click="editItem(item)">Edit</button>
                            <button class="btn btn-xs btn-danger btn_x" v-if="show_delete" @click="deleteItem(item)">x</button>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
            </div>
        <app-edit-item v-else key="edit-item" :showActive="showActive" :item="item" @close_form="closeForm"></app-edit-item>
        </transition>
    </div>
</template>

<script>
    import EditItem from './EditItem'

    export default {
        name: "ListItems",
        components:{
            appEditItem: EditItem
        },
        data(){
            return{
                items:'',
                image_url: '/images/',
                showActive:'',
                item: '',
                show: true,
                category_name: '',
                show_delete: false,
                show_delete_label: 'Show Delete'
            }
        },
        mounted(){
            //this.category_names;
            this.displayItems(this.$store.state.categories[0]);
        },
        computed:{
            category_names(){
                return this.$store.state.categories;
            }
        },
        methods:{
            displayItems(category){
                this.category_name = category.name;
                this.items = '';
                this.items = category.items;
                //console.log(category.name);
            },
            editItem(item){
                this.show = false;
                this.item = item;
            },
            closeForm(){
                //this.category_names;
                this.show = true;
            },
            showDeleteBtn(){
                this.show_delete = !this.show_delete;
                if(this.show_delete){
                    this.show_delete_label = 'Hide Delete'
                }else{
                    this.show_delete_label = 'Show Delete'
                }
            },
            deleteItem(item){
                this.$store.dispatch('deleteItem', item);
                toastr.success('Item has been deleted.');
                axios.delete('api/items/' + item.id);
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
    .center {
        display: block;
        margin-left: auto;
        margin-right: auto;
    }
    table th{
        padding-left: 10px;
    }
    table td{
        padding: 3px;
        padding-left: 10px;
    }
    .slide-enter{

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
    .btn-set{
        display: block;
        margin-left: 10px;
        float: left;
    }
    .btn_x{
        margin-left: 10px;
    }
    td.actions{
        width: 120px;
        padding:0;
    }
</style>