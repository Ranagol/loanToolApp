<template>
    <div class="alert alert-dark my-content-page">
        <p class="alert alert-warning mt-2 mb-2 my-instructions">
            This page is focused on the "history" of the individual loan tools. This is needed, because on one invoice there could be two, three,
            etc., tools. And on the invoice related pages we can't see the exact details. Here we can see which tools were the longest time on the
            field, which tool has 'created' the biggest amount of money, if the tool is still on the field maybe, and so on.
        </p>
        <h4>History of the individual loan tools</h4>

        <!-- SEARCH FIELD -->
        <input 
            v-model="searchTerm" 
            name="searchTerm" 
            class="form-control input-background" 
            type="search" 
            placeholder="Search by customers, tools, return date..."
        >

        <!-- If there is no data in the db... -->
        <div v-if="!invoiceitems.length" class="alert alert-info">
            <h5>Loading</h5>
        </div>

        <table class="table table-text">
            <tr>
                <th>Invoice nr</th>
                <th>Tool</th>
                <th>Customer</th>
                <th>Loan date</th>
                <th>Return date</th>
                <th>Days on field</th>
                <th>To pay</th>
                <th>Closed?</th>
            </tr>
            <tr v-for="(invoiceitem, i) in filteredInvoiceitems" :key="i">
                <td>{{ invoiceitem.invoice_id }}</td>
                <td>{{ invoiceitem.model }}</td>
                <td>{{ invoiceitem.customer_name }}</td>
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
import { mapGetters, mapActions } from 'vuex';
export default {
    name: 'InvoiceItems',
    computed: {
        ...mapGetters(['invoiceitems']),
        filteredInvoiceitems(){
            return this.invoiceitems.filter((element) => {
                return element.customer_name.toLowerCase().match(this.searchTerm.toLowerCase()) 
                    || element.model.toLowerCase().match(this.searchTerm.toLowerCase()) 
                    || element.taken.toLowerCase().match(this.searchTerm.toLowerCase())  
                ;
            });
        }
    },
    data(){
        return {
            searchTerm: '',
        }
    },
    methods: {
        ...mapActions(['getInvoiceitems']),
    },
    mounted() {
        console.log('called from History/Invoiceitems'),
        this.getInvoiceitems();
    }
    
}
/*
comments: null
created_at: "2021-05-31T14:12:32.000000Z"
customer_name: "Andor Horvat"
id: 2
invoice_id: 3
invoice_line_closed: 0
model: "FFFFFFF"
price: 10000
returned: null
taken: "2021-05-31"
time_on_field: null
to_pay: null
tool_id: 6
updated_at: "2021-05-31T14:12:
*/
</script>