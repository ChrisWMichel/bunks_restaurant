<template>
    <div>
        <nav id="sidebar">

            <div class="sidebar-header">
                <h3>Admin Area</h3>
            </div>

            <!-- Sidebar Links -->
            <ul class="list-unstyled components">
                <router-link tag="li" :to="{name: 'dashboard'}" active-class="active" exact><a>Dashboard</a></router-link>

                <router-link tag="li" :to="{name: 'categories'}" active-class="active"><a>Categories</a></router-link>
                <router-link tag="li" :to="{name: 'topping_page'}" active-class="active"><a>Toppings</a></router-link>

                <li><!-- Link with dropdown items -->
                    <a href="#items" data-toggle="collapse" aria-expanded="false">Items</a>
                    <ul class="collapse list-unstyled" id="items">
                        <router-link tag="li" :to="{name: 'create_item'}" active-class="active"><a>Add Item</a></router-link>
                        <router-link tag="li" :to="{name: 'list_items'}" active-class="active"><a>View Items</a></router-link>
                    </ul>

                <li><!-- Link with dropdown items -->
                    <a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false">CMS</a>
                    <ul class="collapse list-unstyled" id="homeSubmenu">
                        <li><a href="#">Page</a></li>
                        <li><a href="#">Page</a></li>
                        <li><a href="#">Page</a></li>
                    </ul>

                <li><a href="#">Customers</a></li>

                <li>
                    <a href="#createEmployee" data-toggle="collapse" aria-expanded="false">Employees</a>
                    <ul class="collapse list-unstyled" id="createEmployee">
                        <router-link tag="li" :to="{name: 'new-admin'}" active-class="active"><a>Create Admin</a></router-link>
                        <router-link tag="li" :to="{name: 'new-employee'}" active-class="active"><a>Create Employee</a></router-link>
                    </ul>
                </li>

            </ul>
        </nav>


            <button type="button" id="sidebarCollapse" class="btn btn-info navbar-btn"><!---->
                <i class="glyphicon glyphicon-align-left"></i>
            </button>
       <div class="clearfix"></div>

    </div>
</template>

<script>
    export default {
        name: "SideMenu",
        created(){
            this.getCategories();
            this.getToppings();
            this.getEmployees();
            this.$router.push('/dashboard')
        },
        methods:{
            getItems(){

            },
            getCategories(){
                axios.get('api/category').then(resp => {
                    this.$store.dispatch('getCategories', resp.data);
                })
            },
            getToppings(){
                axios.get('api/topping_cat').then(resp => {
                    this.$store.dispatch('getToppings', resp.data);
                })
            },
            getEmployees(){
                this.$store.dispatch('storeEmployees');
            }
        }
    }
</script>

<style scoped>
    #sidebar{
        float: left;
        padding-left: 15px;
    }
    .navbar-btn, #sidebar{
        margin-top: -50px;
    }
    #sidebar li a{
        color: #c1bb37;
    }
    #sidebarCollapse{
        background-color: #7c7c7c;
        margin-left: 5px;
    }

</style>
