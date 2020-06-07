<template>
    <div>
        <h4>Invoices</h4>

        <!-- SEARCH FIELD -->
        <input v-model="searchTerm" name="searchTerm" class="form-control" type="search" placeholder="Search">

        <!-- If there is no data in the db... -->
        <div v-if="!invoices.length" class="alert alert-info">
            <h5>Loading</h5>
        </div>        

        
    </div>
</template>

<script>
import { mapGetters } from 'vuex';
export default {
    name: 'Invoices',
    data(){
        return {
            searchTerm:'',

        }
    },
    computed: {
        ...mapGetters(['invoices', 'errors']),
        filteredInvoices(){
            return this.invoices.filter((element) => {
                return element.customer_name.toLowerCase().match(this.searchTerm.toLowerCase());
            });
        }
    },
    
}
</script>