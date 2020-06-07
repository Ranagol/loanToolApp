<template>
    <div>
        <h3>Customers</h3>

        <!-- SEARCH FIELD -->
        <input @input="getCustomers" v-model="searchTerm" name="searchTerm" class="form-control" type="search" placeholder="Search" aria-label="Search">
        
        
        <table class="table">
            <tr>
                <th>Name</th>
                <th>Address</th>
                <th>Phone</th>
                <th>Comments</th>
            </tr>
            <tr v-for="(customer, i) in customers" :key="i">
                <td>{{ customer.name }}</td>
                <td>{{ customer.address }}</td>
                <td>{{ customer.phone }}</td>
                <td>{{ customer.comments }}</td>
            </tr>
        </table>
    </div>
</template>

<script>
import _ from 'lodash';
import customerService from '../../service/customerService';
export default {
    name: 'Customers',
    
    data(){
        return {
            searchTerm: '',
            customers: [],
            selected: {},
        }
    },

    methods: {
        async getCustomers(){
            try {
                const response = await customerService.getCustomers(this.searchTerm);
                this.customers = response.data;
                console.dir(this.customers);
            } catch (error) {
                console.dir(error);
            }
        },
        //_.debounce(func, [wait=0], [options={}])
        //TODO how to use lodash debounce with the search? I don't want the axios to be activated for every letter immediatelly. Lodash is installed.
        //https://lodash.com/docs/4.17.15#debounce
    },
    
    created(){
        this.getCustomers();
    }
}
</script>