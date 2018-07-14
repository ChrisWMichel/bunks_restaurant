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

export const updateItem = (state, item) =>{
     state.categories.forEach(cat => {
        if (cat.id === item.category_id) {
            for(let x =0; x<cat.items.length; x++){
                if(cat.items[x].id === item.id){
                    cat.items[x] = item;
                }
            }
            return cat;
        }
    });
};

export const  getToppings = (state, cat_toppings) =>{
    state.cat_toppings = cat_toppings;

};

export const updateToppingCat = (state, category) =>{
    state.cat_toppings.forEach((cat) =>{
        if(cat.id === category.id){
            cat.name = category.name;
            return cat;
        }
    });
};

export const addTopping = (state, item) => {
    state.cat_toppings.forEach((x) => {
        if(x.id === item.topping__cat_id){
            console.log('still working');
            x.topping_items.push(item);
            return x;
        }
    });
};

export const updateTopping = (state, item) => {
    state.cat_toppings.forEach((x) => {
        if(x.id === item.id){
            for(let y =0; y<x.topping_items.length; y++){
                if(x.topping_items[y].id === item.id){
                    x.topping_items[y].item = item.item;
                    x.topping_items[y].double_price = item.double_price;
                    return x;
                }
            }
        }
    });
};