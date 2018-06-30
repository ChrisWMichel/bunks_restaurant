

export default {
    //namespaced: true,
    state:{

    },
    getters:{

    },
    mutations:{
       /* getCategories(state, categories){
            state.categories = categories;

        }*/,
        /*updateCategory(state, category){
            state.categories.forEach((cat) =>{
                if(cat.id === category.id){
                    cat.name = category.name;
                    cat.description = category.description;
                    return cat;
                }
            });
        }*/,
        /*deleteCategory(state, cat_object){

            const index = state.categories.indexOf(cat_object);
            state.categories.splice(index, 1);
            //console.log(state.categories);
        }*/
    },
    actions:{
       /* getCategories({commit}, categories){

            commit('getCategories', categories);
        }*/,
        /*updateCategory({commit}, category){
            commit('updateCategory', category);
        }*/,
        deleteCategory({commit}, cat_object){
            commit('deleteCategory', cat_object);
        }
    }
}