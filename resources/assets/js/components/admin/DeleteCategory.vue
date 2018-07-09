<template>
    <div id="modal1" class="modal">
        <div class="modal-content">
            <h2>{{cat_object.name}}</h2>
            <h4>{{check_status.message}}</h4>

            <button v-if="check_status.stop_delete" @click="deleteCat">Delete</button>

        </div>
        <div class="modal-footer">
            <button @click="cancelCatDelete" class="modal-close waves-effect waves-green btn-flat">Cancel</button>
        </div>
    </div>

</template>

<script>
    import axios from 'axios'

    export default {
        name: "DeleteCategory",
        props:['cat_object', 'check_status'],
        data(){
            return{
                url: ''
            }
        },
        methods:{
            deleteCat(){
                if(this.check_status.type == item){
                    this.url = 'api/category/'
                }else{
                    this.url = 'api/topping_cat/'
                }
                axios.delete(this.url + this.cat_object.id)
                    .then(resp => {
                        this.$store.dispatch('admin/deleteCategory', this.cat_object);
                        this.cancelCatDelete();
                    })
            },
            cancelCatDelete(){
                $('#modal1').modal();
                $('#modal1').modal('hide')

            }
        }
    }
</script>

<style scoped>

</style>