
export default {
    //namespaced: true,
    state:{
        employees:[],

    },
    getters:{

        getAllEmployees(state){
            return state.employees;
        }
    },
    mutations:{
        createEmployee(state, user){
            console.log('email', state.employees);
            state.employees.push(user);
        },
        storeEmployees(state, employees){
            state.employees = employees;

        }


    },
    actions:{
        createEmployee({commit}, user_email){

            axios.post('api/create_employee', {email: user_email}).then(resp => {
                commit('createEmployee', resp.data);
            });
        },
        storeEmployees({commit}){
            axios.get('api/get_employees').then(resp =>{
               // console.log('employees', resp.data);
                commit('storeEmployees', resp.data);
            });
        }
    }
}
