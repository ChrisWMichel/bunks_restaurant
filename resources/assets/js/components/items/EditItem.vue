<template>
    <div class="card">
        <div class="card-header">
            <p class="modal-card-title">Edit Item</p>
        </div>
        <div class="card-body">

            <div class="row">
                <label class="label">Name</label>
                <div class="control">
                    <input class="input" type="text" v-model="item.name">
                </div>
            </div>

            <div v-if="imageExist" class="row">
                <div class="col-md-6" id="preview">
                    <img :src="image_url + item.image_path"/>
                </div>
            </div>
            <div class="row">
                <div class="input-field col-md-2">
                    <input type="file" ref="file" @change="onFileSelected"/>
                </div>
            </div>

            <div class="row">
                <div class="input-field col-md-5">
                    <textarea v-model="item.description" id="cat_description" class="materialize-textarea" ></textarea>
                </div>
            <!--</div>-->
            <!--<div class="row">-->
            <!--<div class="list-price-block">-->
                <div class="col-sm col-sm-offset-1">
                    <div v-for="size in item.sizes">
                        <div class="size-list">
                            <ul class="ul-size">
                                <li v-if="size !== null"><input type="text"  @change="updateSize(size, $event.target.value)"  :value="size.size"/></li><!--{'size': size, 'value': $event.target.value}-->
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-sm">
                    <div v-for="price in item.prices">
                        <div class="price-list">
                            <ul class="ul-size text-center">
                                <li><input type="text"  @change="updatePrice(price, $event.target.value)" :value="price.price"/></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!--</div>-->

            </div>
            <div class="edit-btn">
                <button class="btn btn-primary" @click="updateItem">Update Item</button>
                <button class="btn btn-warning" @click="closeForm">Cancel</button>
            </div>

        </div>
    </div>
</template>

<script>
    export default {
        name: "EditItem",
        props:['showActive', 'item'],
        data(){
            return{
                image_url: '/images/',
                errors:[],
                new_size:'',
                size_array: [],
                price_array: []
            }
        },
        computed:{
            imageExist(){
                return this.item.image_path
            }
        },
        methods:{
            closeForm(){
                this.$emit('close_form');
            },
            updateItem(){

            },
            onFileSelected(){

                this.item.image_path = this.$refs.file.files[0];
                this.url = URL.createObjectURL(this.item.image_path);
            },
            updateSize(size, value){

                //this.size_array.push({'id': size.size.id, 'size': size.value});
                this.size_array.push({'id': size.id, 'size': value});
                console.log('size', this.size_array);
            },
            updatePrice(price, value){
                this.price_array.push({'id': price.id, 'price': value});
                console.log('price', this.price_array);
            }
        }
    }
</script>

<style scoped>
    #preview {
        display: flex;
        justify-content: center;
        align-items: center;
    }

    #preview img {
        max-width: 100%;
        max-height: 350px;
    }
    .edit-btn{
        float: right;
    }
    .size-list{
        /* float:left;*/
        width: 70px;
    }

    /*.ul-size{
        text-align: center;
        list-style: none;
        padding: 0;
        margin:0;
    }*/

    .price-list{
        width: 60px;
        padding: 0;
        margin-left: -200px;
    }
    .list-price-block{
        border: 1px solid black;
        width: 30%;
    }
</style>