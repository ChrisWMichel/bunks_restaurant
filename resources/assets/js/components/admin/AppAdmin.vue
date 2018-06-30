<template>
    <div class="row">
        <app-side-menu></app-side-menu>

        <div class="container">
            <router-view></router-view>
        </div>
    </div>
</template>

<script>
    import SideMenu from "./SideMenu";

    export default {
        name: "AppAdmin",
        components:{
            AppSideMenu: SideMenu
        },
        created(){
            //this.goToDashboard();
        },
        methods:{
            goToDashboard(){

                //this.$router.go('/dashboard')
            }
        }
    }
</script>

<style scoped>

</style>