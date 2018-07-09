<template>
    <div>
        <h2 class="page-header">Categories</h2>

        <form @submit.prevent="addCategory">
            <div class="row">
                <div class="input-field col-md-6">
                    <input type="text" v-model="category.name" id="cat_name"/>
                    <label for="cat_name">Name</label>
                    <span class="help-block" v-for="error in errors.email" v-text="error"></span>
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-6 col-md-offset-5">
                    <button type="submit" class="btn btn-primary" :disabled="!isValidForm">Add</button>
                </div>
            </div>

        </form>
        <div class="clearfix"></div>
        <button class="btn btn-success" @click="$emit('finished')">Finished</button>
        <h3>Manage Categories</h3>
        <div class="col-sm-5">
            <table class="table table-striped table-bordered table-hover">
                <thead>
                <tr>

                    <th>Name</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="category in toppings_cat">


                    <td v-if="!edit_category || category_id !== category.id">{{category.name}}</td>

                    <td v-if="!edit_category || category_id !== category.id"><button class="btn btn-sm btn-info" @click="editCategory(category.id)">Edit</button> </td>
                    <td v-if="!edit_category || category_id !== category.id"><button class="btn btn-sm btn-danger" @click="deleteCategory(category)">X</button> </td>
                    <transition name="fade">
                        <!--<app-edit-category v-if="edit_category && category_id === category.id" @updateCat="updateCat($event)" @cancelUpdate="cancelUpdate()" :cat_id="category.id"></app-edit-category>-->
                    </transition>

                </tr>


                </tbody>
            </table>
        </div>

        <app-delete-category :cat_object="cat_object" :check_status="check_status" ></app-delete-category>



    </div>
</template>

<script>
    import axios from 'axios'
    //import EditCategory from './EditCategory'
    import DeleteCategory from '../admin/DeleteCategory'
    import {mapActions} from 'vuex'

    export default {
        //name: "Categories",
        components:{
            //appEditCategory: EditCategory,
            appDeleteCategory: DeleteCategory
        },
        data(){
            return{
                category:{
                    name: '',
                },
                toppings_cat:[],
                errors: [],
                category_id: '',
                edit_category: false,
                cat_object: '',
                check_status: {},
                stop_delete: true,
                message: '',

            }
        },
        created(){
            this.getToppings();
        },
        computed:{
            isValidForm(){
                return this.category.name;
            },

        },
        methods:{
            addCategory(){
                axios.post('/api/topping_cat', this.category)
                    .then(resp => {
                        this.toppings_cat.push(resp.data);
                        this.category.name = '';

                        toastr.success('New category added!');

                    })
            },
            getToppings(){
                this.toppings_cat = this.$store.state.cat_toppings;
            },
            editCategory(category_id){
                this.category_id = category_id;
                this.edit_category = true;
            },
            updateCat(category){
                this.category_id = '';
                this.edit_category = false;

                this.updateCategory(category);
                toastr.success(category.name + ' , has been updated successfully.');
            },
            ...mapActions([
                'updateCategory',
            ]),
            cancelUpdate(){
                this.category_id = '';
                this.edit_category = false;
            },
            deleteCategory(object){
                this.cat_object = object;

                if(object.topping_items.length > 0 ){
                    this.message = 'Can not delete! Items under this category have to be deleted first.';
                    this.stop_delete = false;
                }else{
                    this.message = 'Are you sure you want to delete this category?';
                    this.stop_delete = true;
                }
                this.check_status = {message: this.message, stop_delete: this.stop_delete, type: 'topping'};
                $('#modal1').modal();
            }
        }
    }
</script>

<style scoped>

</style>