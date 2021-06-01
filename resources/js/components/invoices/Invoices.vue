<template>
    <div class="alert alert-dark">
        <p class="alert alert-warning mt-2 mb-2">
            THE INVOICE SYSTEM EXPLANATION: when a customer loans out a tool from the shop, an open invoice is created. The created invoice is open, because
            the data of the open invoice can be changed by you. This is needed, because quite often happens that a customer returns a tool sooner 
            - or maybe much later - than he thought he will, and this will change the final amount to pay that was preliminary defined on the invoice, when the customer 
            loaned the tool.This is why we have open invoices. While the tool is on the field, with the customer, the invoice stays open.
            Once the customer returned the tool, and payed, then you need to close the invoice. The open invoices are editable, the closed
            invoice are not editable. So we have three pages regarding invoices:
            <ol>
                <li>
                    <a href="/create-invoice">Create invoice</a>, where the invoices are created when a tool is loaned out.
                </li>
                <li>
                    <a href="/open-invoices">Open invoices</a>, where you can see all the open invoices
                </li>
                <li>
                    <a href="/invoices">All invoices</a>, where you can see all created invoices, regardless if it is open or closed.
                </li>
            </ol>
        </p>
        <p class="alert alert-warning mt-2 mb-2">
            Here, on this page, as said before, you can see the list of all  invoices, regardless if they are open or closed.
        </p>
        <h4>Invoices</h4>

        <!-- SEARCH FIELD -->
        <input v-model="searchTerm" name="searchTerm" class="form-control" type="search" placeholder="Search">

        <!-- If there is no data in the db... -->
        <div v-if="!invoices.length" class="alert alert-info">
            <h5>Loading</h5>
        </div>

        <table class="table">
            <tr>
                <th>Nr#</th>
                <th>Customer</th>
                <th>To pay</th>
                <th>Created</th>
                <th>Closing date</th>
                <th>Comments</th>
                <th>Invoce closed?</th>
            </tr>
            <tr v-for="(invoice, i) in filteredInvoices" :key="i">
                <td>{{ invoice.id }}</td>
                <td>{{ invoice.customer_name }}</td>
                <td>{{ invoice.sum_for_paying }}</td>
                <td>{{ invoice.created_at }}</td>
                <td>{{ invoice.closing_date }}</td>
                <td>{{ invoice.comments }}</td>
                <td>{{ invoice.invoice_closed || 'not closed' }}</td>
            </tr>
        </table>

            

        
    </div>
</template>

<script>
import { mapGetters, mapActions } from 'vuex';
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
    methods: {
        ...mapActions(['getInvoices']),
    },
    mounted() {
        console.log('called from All invoices'),
        this.getInvoices();
    }
}
</script>