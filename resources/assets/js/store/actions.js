export const uploadAdmins = ({commit}, admins) =>{
    commit('uploadAdmins', admins);
};

export const  getCategories = ({commit}, categories) =>{

    commit('getCategories', categories);
};

export const updateCategory = ({commit}, category) =>{
    commit('updateCategory', category);
};

export const deleteCategory = ({commit}, cat_object) =>{
    commit('deleteCategory', cat_object);
};

export const updateItem = ({commit}, item) =>{
    commit('updateItem', item);
};