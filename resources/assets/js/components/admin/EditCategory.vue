<template>
    <transition name="fade">
    <tr>
        <td colspan="3">
            <div class="row">
                <div class="col-md-12"  style="width: 800px;">
                    <div class="card blue-grey darken-1">
                        <div class="card-content white-text">
                            <button class="btn btn-sm cancle-btn" @click="cancelUpdate">X</button>
                            <div class="clearfix"></div>
                            <form @submit.prevent="updateCategory">
                                <div class="row">
                                    <div class="input-field col-md-12">
                                        <input type="text" v-model="cat_name" id="cat_name" value=""/><!---->
                                        <!--<label for="cat_name">Name</label>-->
                                        <span class="help-block" v-for="error in errors.email" v-text="error"></span>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field col-md-12">
                                        <!--<input v-model="cat_desc" id="cat_description" type="text" value="">-->
                                        <textarea v-model="cat_desc" id="cat_description" class="materialize-textarea"  ></textarea>
                                        <!--<label for="cat_description">Description</label>-->
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-md-12 col-md-offset-5">
                                        <button type="submit" class="btn btn-primary" :disabled="!isValidForm">Update</button>
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </td>

    </tr>
    </transition>
</template>

<script>
    import axios from 'axios'

    export default {
        name: "EditCategory",
        props: ['cat_id'],
        data(){
            return{
                cat_name: '',
                cat_desc: '',
                errors: []
            }
        },
        created(){
            this.getCategory()
        },
        methods:{
            getCategory(){
                axios.get('api/category/' + this.cat_id)
                    .then(resp => {
                        this.cat_name = resp.data.name;
                        this.cat_desc = resp.data.description;
                        //console.log(this.cat_desc);
                    })
            },
            updateCategory(){
                axios.put('api/category/' + this.cat_id, {name: this.cat_name, description: this.cat_desc})
                    .then(resp => {
                        this.$emit('updateCat', resp.data);
                    })
            },
            cancelUpdate(){
                this.$emit('cancelUpdate');
            }
        },
        computed:{
            isValidForm(){
                return this.cat_name;
            }
        }
    }
</script>

<style scoped>
    .cancle-btn{
        float: right;
    }
    .fade-enter{
        opacity: 0;
    }
    .fade-enter-active{
       /* transition: opacity 1s;*/
    }
    .fade-leave{

    }
    .fade-leave-active{
        transition: opacity .3s;
        opacity: 0;
    }
</style>