<template>
    <div>
        <h3>Customers</h3>

        <!-- SEARCH FIELD -->
        <input @input="getCustomers" v-model="searchTerm" name="searchTerm" class="form-control" type="search" placeholder="Search" aria-label="Search">
        

        <p>{{ customers }}</p>
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
                this.customers = await customerService.getCustomers(this.searchTerm);
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