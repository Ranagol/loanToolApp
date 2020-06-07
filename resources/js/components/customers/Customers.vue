<template>
    <div>
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
                <th>Address</th>
                <th>Phone</th>
                <th>Comments</th>
            </tr>
            <tr v-for="(customer, i) in filteredCustomers" :key="i">
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
import { mapGetters } from 'vuex';
import customerService from '../../service/customerService';
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