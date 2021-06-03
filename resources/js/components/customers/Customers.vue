<template>
    <div class="alert alert-dark my-content-page">
        
        <p class="alert alert-warning my-instructions">
            Here you can see the list of all your customers, who are in your database. This is the place where you can check if a current
            customer (who wants to loan a tool from your shop) is already in your database. Use the search field below to check this.
            <br>
            If the customer is already in the db, then proceed to the <a href="/create-invoice">Create invoice</a>. 
            <br>
            IF the customer is not in your db, then you will have to  collect the customers data, and create a new customer in the db. 
            This is happening in the <a href="/create-customer">Create customer</a>.
        </p>
        <hr>
        <div class="d-flex flex-row justify-content-between">
            <h3>Customers</h3>
            <router-link 
                class="nav-link btn btn-success" 
                to="/create-customer" 
            >Create new customer</router-link>
        </div>
        <br>
        
        <!-- SEARCH FIELD -->
        <input 
            v-model="searchTerm" 
            name="searchTerm" 
            class="form-control input-background" 
            type="search" 
            placeholder="Search by name, city, address or phone..."
        >
        <br>


        <!-- If there is no data in the db... -->
        <div v-if="!customers.length" class="alert alert-info">
            <h5>Loading</h5>
        </div>

        <table class="table table-text">
            <tr>
                <th>Name</th>
                <th>City</th>
                <th>Address</th>
                <th>Phone</th>
                <!-- <th>Blacklist</th> -->
            </tr>
            <tr v-for="(customer, i) in filteredCustomers" :key="i">
                <td>{{ customer.name }}</td>
                <td>{{ customer.city }}</td>
                <td>{{ customer.address }}</td>
                <td>{{ customer.phone }}</td>
                <!-- <td>{{ customer.blacklist }}</td> -->
            </tr>
        </table>
    </div>
</template>

<script>
import _ from 'lodash';
import { mapGetters, mapActions } from 'vuex';
export default {
    name: 'Customers',
    data(){
        return {
            searchTerm: '',
        }
    },
    computed: {
        ...mapGetters(['customers', 'errors']),
        filteredCustomers(){
            return this.customers.filter((element) => {
                return element.name.toLowerCase().match(this.searchTerm.toLowerCase())
                    || element.city.toLowerCase().match(this.searchTerm.toLowerCase())
                    || element.address.toLowerCase().match(this.searchTerm.toLowerCase())
                    || element.phone.toLowerCase().match(this.searchTerm.toLowerCase())
                ;
            });
        }
    },
    methods: {
        ...mapActions(['getCustomers']),
    },
    mounted() {
        console.log('called from Customers'),
        this.getCustomers();
    }

}
</script>