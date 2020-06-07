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
                <th>To pay</th>
                <th>Comments</th>
                <th>Created</th>
                <th>Closing date</th>
                <th>Invoce closed?</th>
                <th>Close invoice</th>
            </tr>
            <tr v-for="(invoice, i) in invoices" :key="i">
                <td>{{ invoice.id }}</td>
                <td>{{ invoice.customer_name }}</td>
                <td>{{ invoice.sum_for_paying }}</td>
                <td>{{ invoice.comments }}</td>
                <td>{{ invoice.created_at }}</td>
                <td>{{ invoice.closing_date }}</td>
                <td>{{ invoice.invoice_closed || 'not closed' }}</td>
                <td><button class="btn btn-success btn-sm" >Close</button></td>
            </tr>
        </table>

            

        
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