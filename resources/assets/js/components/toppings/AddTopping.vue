<template>
    <div>
        <h3>Add Item</h3>
        <form @submit.prevent="addNewItem" method="post" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-3">
                    <b-dropdown id="ddown-buttons" :text="category_name" class="m-2">
                        <b-dropdown-item-button v-for="category in categories"
                                                @click="getCatId(category.id, category.name)"
                                                :key="category.id"
                                                v-model="category_name"
                        >{{category.name}}</b-dropdown-item-button>
                    </b-dropdown>
                </div>
            </div>

            <div class="row">
                <div class="input-field col-md-3">
                    <input type="text" v-model="topping_name" id="item_name"/>
                    <label for="item_name">Item Name</label>
                    <span class="help-block" v-for="error in errors" v-text="error"></span>
                </div>
            </div>

            <div class="row">
                <div class="input-field col-md-3">
                    <input type="checkbox" v-model="double_price" id="double"/>
                    <label for="double">Double Price (item will be bold)</label>

                </div>
            </div>

            <div class="row">
                <div class="col-md-1 col-md-offset-3">
                    <button type="submit" class="btn btn-primary" :disabled="!isValidForm">Add</button>
                </div>
            </div>
        </form>

        <div class="row">
            <div v-for="category in categories" class="col">
                <table>
                    <tr>
                        <th><h4><b>{{category.name}}</b></h4></th>
                    </tr>
                    <tr v-for="name in category.topping_items">
                        <td>
                            <a :class="{bold_name: name.double_price}"
                               class="waves-effect waves-light modal-trigger"
                               href="#" @click="editItem(name)">{{name.item}}</a>
                        </td>

                    </tr>
                </table>
            </div>
        </div>
        <app-edit-topping></app-edit-topping>
    </div>
</template>

<script>
    import EditToppings from './EditToppings'
    import {mapActions} from 'vuex'

    export default {
        name: "AddTopping",
        data(){
            return{
                categories: this.$store.state.cat_toppings,
                errors:[],
                topping_name: '',
                category_name: 'Choose Category',
                cat_id: '',
                double_price: 0,
                item_edit:'',
                load_item: false
            }
        },
        components:{
            appEditTopping: EditToppings
        },
        computed:{
            isValidForm(){
                return this.topping_name && this.cat_id;
            }

        },
        methods:{
            getCatId(cat_id, cat_name){
                this.cat_id = cat_id;
                this.category_name = cat_name;

                //console.log('cat_id', this.cat_id)
            },
            addNewItem(){
                let fd = new FormData();
                fd.append('cat_id', this.cat_id);
                fd.append('name', this.topping_name);
                fd.append('double_price', this.double_price);

                axios.post('api/topping_items', fd)
                    .then(resp => {
                        this.topping_name = '';
                        this.category_name = 'Choose Category';
                        this.double_price = 0;
                        this.cat_id = '';

                        this.addTopping(resp.data);
                       // console.log('categories',this.$store.state.cat_toppings);
                        toastr.success('Topping has been updated successfully.');
                    })
            },
            ...mapActions([
                'addTopping'
            ]),
            editItem(item){
                this.$store.state.edit_topping = item;
                $('#topping-modal').modal();
            }

        }
    }
</script>

<style scoped>
.bold_name{
    font-weight: bolder;
}
</style>