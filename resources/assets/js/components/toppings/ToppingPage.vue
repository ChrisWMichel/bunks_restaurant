<template>
    <div>
        <div v-if="hideCatBtn">
            <button type="button" @click="toggleCat" class="btn btn-info">Create/Edit Categories</button>
        </div>

        <div v-if="showCategory">
            <app-category-create @finished = 'toggleCat'></app-category-create>
        </div>

        <div v-if="hideCatBtn">
            <app-add-topping></app-add-topping>
        </div>



    </div>
</template>

<script>
    import CategoryCreate from './CategoryCreate'
    import AddTopping from './AddTopping'

    export default {
        name: "CategoryPage",
        data(){
            return{
                showCategory: false,
                hideCatBtn: true,
            }
        },
        components:{
            appCategoryCreate: CategoryCreate,
            appAddTopping: AddTopping
        },
        methods:{
            toggleCat(){
                this.showCategory = !this.showCategory;
                this.hideCatBtn = !this.hideCatBtn;

            }
        }
    }
</script>

<style scoped>

</style>