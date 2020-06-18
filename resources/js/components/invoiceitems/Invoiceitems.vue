<template>
    <div>
        <h4>History/InvoiceItems</h4>

        <!-- If there is no data in the db... -->
        <div v-if="!invoiceitems.length" class="alert alert-info">
            <h5>Loading</h5>
        </div>

        <table class="table">
            <tr>
                <th>Invoice nr</th>
                <th>Customer</th>
                <th>Tool</th>
                <th>Loan date</th>
                <th>Return date</th>
                <th>Days on field</th>
                <th>To pay</th>
                <th>Closed?</th>
            </tr>
            <tr v-for="(invoiceitem, i) in invoiceitems" :key="i">
                <td>{{ invoiceitem.invoice_id }}</td>
                <td>{{ invoiceitem.customer_name }}</td>
                <td>{{ invoiceitem.model }}</td>
                <td>{{ invoiceitem.taken }}</td>
                <td>{{ invoiceitem.returned }}</td>
                <td>{{ invoiceitem.time_on_field }}</td>
                <td>{{ invoiceitem.to_pay }}</td>
                <td>{{ invoiceitem.invoice_line_closed }}</td>
            </tr>
        </table>

        
    </div>
</template>

<script>
import { mapGetters } from 'vuex';
export default {
    name: 'InvoiceItems',
    computed: {
        ...mapGetters(['invoiceitems']),
    },
    
    data(){
        return {
            

        }
    },
    
}
</script>