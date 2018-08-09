<template>
    <div >
        <ul >
            <li v-for="category in getCategories" :key="category.id">
                <button @click="catSelected(category)" class="btn btn-lg black center-align">{{category.name}}</button>
            </li>
        </ul>


    </div>
</template>

<script>
    export default {
        name: "CategoryMenu",
        data(){
            return{

            }
        },
        computed:{
            getCategories(){
                return this.$store.state.categories
            }
        },
        methods:{
            catSelected(category){
                this.$store.state.cat_item = category;
                this.$store.state.cat_name = category.name;
                this.$emit('receivedCategory');
            }
        }
    }
</script>

<style scoped>
button{
    margin-top: 15px;

}
button.btn:hover{
    background: white;
}
.center-align{
    /*vertical-align: text-top;*/
}
</style>
