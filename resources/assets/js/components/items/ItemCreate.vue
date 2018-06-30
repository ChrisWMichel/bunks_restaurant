<template>
    <div>
        <transition name="slide" mode="out-in">
            <div v-if="show" key="item">
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
                        <input type="text" v-model="item.name" id="item_name"/>
                        <label for="item_name">Item Name</label>
                        <span class="help-block" v-for="error in errors.item" v-text="error"></span>
                    </div>
                    <div class="input-field col-md-6">
                        <input type="file" ref="file" @change="onFileSelected"/>
                        <!--<picture-input
                                name="photo_id"
                                ref="pictureInput"
                                @change="onFileSelected"
                                @remove="onRemoved"
                                width="200"
                                :removable="true"
                                removeButtonClass="ui red button"
                                height="200"
                                accept="image/jpeg, image/png, image/gif"
                                buttonClass="ui button primary"
                                :customStrings="{
                      upload: '<h1>Upload it!</h1>',
                      drag: 'Drag and drop your image here, or click the box'}">
                        </picture-input>-->
                    </div>
                </div>
            <div class="row">
                <div class="input-field col-md-6">
                    <textarea v-model="item.description" id="cat_description" class="materialize-textarea" ></textarea>
                    <label for="cat_description">Description</label>
                </div>
            </div>
            <div class="row">
                <div class="col-md-1 col-md-offset-3">
                    <button type="submit" class="btn btn-primary" :disabled="!isValidForm">Add</button>
                </div>
            </div>
        </form>
        </div>

        <app-size-price v-else key="price" :item="send_item" :cat_id="item.cat_id" @priceAdded="show = true"></app-size-price>
    </transition>
    </div>
</template>

<script>
    import AddSizePrice from './AddSizePrice'
    import PictureInput from 'vue-picture-input'
    import axios from 'axios'

    export default {
        name: "ItemCreate",
        components:{
            appSizePrice: AddSizePrice,
            PictureInput
        },
        data(){
            return{
                categories: this.$store.state.categories,
                item:{
                    cat_id:'',
                    name: '',
                    description:'',
                    image: ''
                },
                send_item:'',
                category_name: 'Choose Category',
                errors:[],
                item_id: '',
                show: true
            }
        },
        created(){
           //this.getCatList();

        },
        computed:{
            isValidForm(){
                return this.item.name && this.item.cat_id;
            },

        },
        methods:{
            getCatId(cat_id, cat_name){
                this.item.cat_id = cat_id;
                this.category_name = cat_name;

            },
            getCatList(){
               /* axios.get('api/items')
                    .then(resp => {
                        this.categories = resp.data;
                        console.log(this.categories);
                    })*/
            },
            addNewItem(e){
                let fd = new FormData();
                fd.append('file', this.item.image, this.item.image.name);
               /* formData.append('cat_id', this.item.cat_id);
                formData.append('name', this.item.name);
                formData.append('description', this.item.description);*/
                console.log('formData', fd);
                //console.log('image', this.item);
                axios.post('api/items', fd, {headers:{'Content-type': 'multipart/form-data'}})
                    .then(resp => {
                        console.log('return', resp);
                        this.send_item = resp.data;
                        this.item.name = '';
                        this.item.description = '';
                        this.category_name = 'Choose Category';
                        this.show = false;
                    })
            },
            onFileSelected(event){
                /*if(image){
                    this.item.image = image;
                    console.log('image', this.item.image)
                }else{
                    console.log('Not going to happen.');
                }*/
               /* if (this.$refs.pictureInput.file) {
                    this.item.image = this.$refs.pictureInput.file;

                } else {
                    console.log("Old browser. No support for Filereader API");
                }*/
               //this.item.image = event.target.files[0];
               this.item.image = this.$refs.file.files[0];
                console.log('fileSelected', this.item.image)
            },
            onRemoved() {
                this.item.image = '';
            }

        }
    }
</script>

<style scoped>
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

</style>