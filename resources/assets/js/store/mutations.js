export const uploadAdmins = (state, admins) =>{
    state.admins = admins;
};

export const  getCategories = (state, categories) =>{
    state.categories = categories;

};

export const updateCategory = (state, category) =>{
    state.categories.forEach((cat) =>{
        if(cat.id === category.id){
            cat.name = category.name;
            cat.description = category.description;
            return cat;
        }
    });
};

export const deleteCategory = (state, cat_object) =>{

    const index = state.categories.indexOf(cat_object);
    state.categories.splice(index, 1);
    //console.log(state.categories);
};
