<template>
    <div class="card">
        <div v-if="!save_data">
        <div class="card-header">
            <p class="modal-card-title">Edit Item</p>
        </div>
        <div class="card-body">
            <form @submit.prevent="updateItem" method="post" enctype="multipart/form-data">
                <div class="row">
                    <label class="label">Name</label>
                    <div class="control">
                        <input class="input" type="text" v-model="item.name">
                    </div>
                </div>

                <div v-if="imageExist" class="row">
                    <div class="col-md-6 preview">
                        <img :src="image_url + item.image_path"/>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 preview">
                        <img v-if="url" :src="url"/>
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
                    <div class="col-sm col-sm-offset-1">
                        <h6 v-if="item.sizes.length > 0">Size</h6>
                        <div v-for="size in item.sizes">
                            <div class="size-list">
                                <ul class="ul-size">
                                    <li v-if="size !== null"><input type="text"  @change="updateSize(size, $event.target.value)"  :value="size.size"/></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm">
                        <h6 v-if="item.prices.length > 0">Price</h6>
                        <div v-for="price in item.prices">
                            <div class="price-list">
                                <ul class="ul-size text-center">
                                    <li><input type="text"  @change="updatePrice(price, $event.target.value)" :value="price.price"/></li>
                                </ul>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="edit-btn">
                    <button class="btn btn-primary" type="submit">Update Item</button>
                    <button class="btn btn-warning" @click="closeForm">Cancel</button>
                </div>
            </form>
        </div>
        </div>
        <div v-else class="text-center">
            <img :src="gif" width="300px"/>
        </div>
    </div>
</template>

<script>
    import axios from 'axios'

    export default {
        name: "EditItem",
        props:['showActive', 'item'],
        data(){
            return{
                image_url: '/images/',
                url: '',
                errors:[],
                new_size:'',
                size_array: [],
                price_array: [],
                new_image: '',
                save_data: false,
                gif: 'images/gif/loading.gif'
            }
        },
        computed:{
            imageExist(){
                return this.item.image_path;

            }
        },
        methods:{
            closeForm(){
                this.$emit('close_form');
            },
            updateItem(){
                this.save_data = true;
                if(this.size_array.length > 0){
                    axios.post('api/update_size', this.size_array)
                }
                if(this.price_array.length > 0){
                    axios.post('api/update_prices', this.price_array)
                }
                let fd = new FormData();
                fd.append('image', this.new_image);
                fd.append('name', this.item.name);
                fd.append('description', this.item.description);

                axios.post('api/update_item/' + this.item.id, fd)
                    .then(resp =>{
                        this.$store.commit('updateItem', resp.data);
                        this.$emit('close_form');
                        this.save_data = false;
                        //console.log(this.$store.state.categories);

                    })
            },
            onFileSelected(){
                this.item.image_path = '';
                this.new_image = this.$refs.file.files[0];
                this.url = URL.createObjectURL(this.new_image);
                //console.log(this.new_image);
            },
            updateSize(size, value){
                this.size_array.push({'id': size.id, 'size': value});
                //console.log('size', this.size_array);
            },
            updatePrice(price, value){
                this.price_array.push({'id': price.id, 'price': value});
                //console.log('price', this.price_array);
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
        margin-bottom: 10px;
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
        /*margin-left: -200px;*/
    }
    .preview {
        display: flex;
        justify-content: center;
        align-items: center;
    }
    .preview img {
        max-width: 100%;
        max-height: 350px;
    }
</style>