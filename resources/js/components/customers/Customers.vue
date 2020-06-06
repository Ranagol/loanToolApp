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
import customerService from '../../service/customerService';
export default {
    name: 'Customers',
    data(){
        return {
            searchTerm: '',
            customers: [],
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
        }
    },

    created(){
        this.getCustomers();
    }
}
</script>