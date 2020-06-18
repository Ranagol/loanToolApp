<template>
    <div>
        <h4>Invoices</h4>

        <!-- SEARCH FIELD -->
        <input v-model="searchTerm" name="searchTerm" class="form-control" type="search" placeholder="Search">

        <!-- If there is no data in the db... -->
        <div v-if="!invoices.length" class="alert alert-info">
            <h5>Loading</h5>
        </div>

        <table>
            <tr>
                <th>Nr#</th>
                <th>Customer</th>
                <th>Comments</th>
                <th>Created</th>
                <th>Invoice closed?</th>
                <th>Close invoice</th>
            </tr>
            <tr v-for="(invoice, i) in filteredInvoices" :key="i">
                <td>{{ invoice.id }}</td>
                <td>{{ invoice.customer_name }}</td>
                <td>{{ invoice.comments }}</td>
                <td>{{ invoice.created_at }}</td>
                <td>{{ invoice.invoice_closed || 'not closed' }}</td>
                <td><button @click="goToCloseInvoice(invoice.id)" class="btn btn-success btn-sm" >Close</button></td>
            </tr>
        </table>

            

        
    </div>
</template>

<script>
import { mapGetters } from 'vuex';
export default {
    name: 'OpenInvoices',
    data(){
        return {
            searchTerm:'',

        }
    },
    computed: {
        ...mapGetters(['invoices', 'errors']),
        openInvoices(){
            return this.invoices.filter((element) => {
                return element.invoice_closed == false;
            });
        },
        filteredInvoices(){
            return this.openInvoices.filter((element) => {
                return element.customer_name.toLowerCase().match(this.searchTerm.toLowerCase());
            });
        }
    },
    methods: {
        goToCloseInvoice(invoiceId){
            this.$router.push(`/close-invoice/${invoiceId}`);
        }
    }
    
}
</script>