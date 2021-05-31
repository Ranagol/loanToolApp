<template>
    <div class="alert alert-dark">
        <p class="alert alert-warning mt-2 mb-2">
            This page is focused on the "history" of the individual loan tools. This is needed, because on one invoice there could be two, three,
            etc., tools. And on the invoice related pages we can't see the exact details. Here we can see which tools were the longest time on the
            field, which tool has 'created' the biggest amount of money, if the tool is still on the field maybe, and so on.
        </p>
        <h4>History of the individual loan tools</h4>

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