<template>
    <form @submit.prevent="addAddress">
        <div class="input-field">
            <input type="text" id="address" v-model="address.address">
            <label for="address">Address</label>
            <span class="help-block" v-for="error in errors.address" v-text="error"></span>
        </div>
        <div class="input-field">
            <input type="text" id="city" v-model="address.city">
            <!--<label for="city">City</label>-->
            <span class="help-block" v-for="error in errors.address" v-text="error"></span>
        </div>

        <button class="btn btn-sm" :disabled="!isValidForm" type="submit">Submit</button>
    </form>
</template>

<script>
    export default {
        name: "AddressForm",
        data(){
            return{
                address:{
                    address: '',
                    city: 'Harvard',
                    user_id: this.$store.state.user.id
                },
                errors: [],
            }
        },
        computed:{
            isValidForm(){
                return this.address.address && this.address.city;
            }
        },
        methods:{
            addAddress(){
                console.log('user', this.$store.state.user);
                this.$store.dispatch('updateAddress', this.address)
                this.$emit('closeForm');
            }
        },
    }
</script>

<style scoped>

</style>
