<template>
    <div>
        <h3>Add New Employee</h3>
        <p>Have the employee register on the website. Once they've completed that, enter their email in the search field.</p>

        <label class="label">Email</label>
        <div class="control">
            <input class="input" type="email" v-model="user_email">
        </div>
        <button class="btn-sm" @click="createEmployee()">Submit</button>
        <hr/>
        <table class="table table-striped table-bordered table-hover">
            <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Remove</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="employee in employees">
                <td>{{employee.firstname}} {{employee.lastname}}</td>
                <td>{{employee.email}}</td>
                <td><button class="btn-danger">X</button></td>
            </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
/*TODO: do not allow admin to submit if field is empty.
* TODO: if email isn't found, send message to inform the admin that user hasn't registered yet.*/
    export default {
        name: "NewEmployee",
        data () {
            return {
                user_email: '',
            }
        },
        created(){

        },
        computed:{
            employees(){
                return this.$store.getters.getAllEmployees;
            }
        },
        methods: {
            createEmployee(){
                this.$store.dispatch('createEmployee', this.user_email);
                this.user_email = '';
            },

        }

    }
</script>

<style scoped>

</style>
