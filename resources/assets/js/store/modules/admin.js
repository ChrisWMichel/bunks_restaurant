
export default {
    //namespaced: true,
    state:{
        employees:[],
        getEmployees: []

    },
    getters:{

        getAllEmployees(state){
            return state.getEmployees;
        }
    },
    mutations:{
        createEmployee(state, user){
            state.employees.push(user);
        },
        storeEmployees(state, employees){
            state.employees = employees
        }


    },
    actions:{
        createEmployee({commit}, user_email){
            axios.get('api/create_employee', user_email).then(resp => {
                commit('createEmployee', resp.data);
            });
        },
        storeEmployees({commit}){
            axios.get('api/get_employees').then(resp =>{
                commit('storeEmployees', resp.data);
            });
        }
    }
}
