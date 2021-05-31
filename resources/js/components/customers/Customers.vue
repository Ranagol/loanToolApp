<template>
    <div class="alert alert-dark">
        
        <p class="alert alert-warning">
            Here you can see the list of all your customers, who are in your database. This is the place where you can check if a current
            customer (who wants to loan a tool from your shop) is already in your database. Use the search field below to check this.
            <br>
            If the customer is already in the db, then proceed to the <a href="/create-invoice">Create invoice</a>. 
            <br>
            IF the customer is not in your db, then you will have to  collect the customers data, and create a new customer in the db. 
            This is happening in the <a href="/create-customer">Create customer</a>.
        </p>
        <h3>Customers</h3>

        <!-- SEARCH FIELD -->
        <input v-model="searchTerm" name="searchTerm" class="form-control" type="search" placeholder="Search">

        <!-- If there is no data in the db... -->
        <div v-if="!customers.length" class="alert alert-info">
            <h5>Loading</h5>
        </div>

        <table class="table">
            <tr>
                <th>Name</th>
                <th>City</th>
                <th>Address</th>
                <th>Phone</th>
                <th>Blacklist</th>
            </tr>
            <tr v-for="(customer, i) in filteredCustomers" :key="i">
                <td>{{ customer.name }}</td>
                <td>{{ customer.city }}</td>
                <td>{{ customer.address }}</td>
                <td>{{ customer.phone }}</td>
                <td>{{ customer.blacklist }}</td>
            </tr>
        </table>
    </div>
</template>

<script>
import _ from 'lodash';
import { mapGetters } from 'vuex';
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
                return element.name.toLowerCase().match(this.searchTerm.toLowerCase());
            });
        }
    },

    
    

    //_.debounce(func, [wait=0], [options={}])
        //TODO how to use lodash debounce with the search? I don't want the axios to be activated for every letter immediatelly. Lodash is installed.
        //https://lodash.com/docs/4.17.15#debounce
}
</script>