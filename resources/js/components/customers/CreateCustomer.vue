<template>
    <div class="alert alert-dark my-content-page">
        
        <p class="alert alert-warning my-instructions">
            On this page you can write your new customers data into the database. The first step is to check if this
            customer is already in the database. Use the search field for this in the <a href="/customers">Customers</a>.
            If you already did this, and your customer has selected the tool that he wants to loan, you can go to to the
            <a href="/create-invoice">Create invoice</a>.
        </p>
        <h3>Create customer</h3>
        
        <p>Name: <input v-model="customer.name" name="name" class="form-control input-background" type="text"></p>
        <p>City: <input v-model="customer.city" name="city" class="form-control input-background" type="text"></p>
        <p>Address: <input v-model="customer.address" name="address" class="form-control input-background" type="text"></p>
        <p>Phone: <input v-model="customer.phone" name="phone" class="form-control input-background" type="text"></p>
        <p>Comment: <input v-model="customer.comments" name="comments" class="form-control input-background" type="text"></p>
        <!-- <form>
            <div class="form-group">
                <label for="exampleFormControlFile1">Upload customers scanned ID data:</label>
                <input type="file" class="form-control-file" id="exampleFormControlFile1">
            </div>
        </form> -->
        <button @click="addCustomer" class="btn btn-success">Create customer</button>
    </div>
</template>

<script>
import { mapGetters, mapActions } from 'vuex';
export default {
    name: 'CreateCustomer',
    computed: {
        ...mapGetters(['customers']),
    },
    data(){
        return {
            customer: {},
        }
    },
    methods: {
        ...mapActions(['createCustomer']),
        addCustomer(){
            this.$store.dispatch('createCustomer', this.customer);
        }
    },
    
    
}
</script>