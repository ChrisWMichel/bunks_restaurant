export const uploadAdmins = ({commit}, admins) =>{
    commit('uploadAdmins', admins);
};

export const  getCategories = ({commit}, categories) =>{

    commit('getCategories', categories);
};

export const addCategory = ({commit}, category) =>{
    axios.post('api/category', category)
        .then(resp => {
                commit('addCategory', resp.data);
        });

};

export const updateCategory = ({commit}, category) =>{
    commit('updateCategory', category);
};

export const deleteCategory = ({commit}, cat_object) =>{
    commit('deleteCategory', cat_object);
};

export const addNewItem = ({commit}, item)=>{
    commit('addNewItem', item);
};
export const updateItem = ({commit}, item) =>{
    commit('updateItem', item);
};

export const deleteItem = ({commit}, item) =>{
    commit('deleteItem', item);
};

export const addItemPrice = ({commit}, price) =>{
    commit('addItemPrice', price);
};

export const addItemSizePrice = ({commit}, item) =>{
    commit('addItemSizePrice', item);
};

export const getToppings = ({commit}, cat) =>{
    commit('getToppings', cat);
};

export const updateToppingCat = ({commit}, cat) =>{
    commit('updateToppingCat', cat);
};

export const addTopping = ({commit}, cat) =>{
    commit('addTopping', cat);
};

export const updateTopping = ({commit}, item)=>{
    commit('updateTopping', item);
};

export const deleteTopping = ({commit}, item)=>{
    commit('deleteTopping', item);
};

