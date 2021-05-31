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
            Here, on this page, as said before, you can see the list of all open invoices. Once the customer returns the tool that he loaned, and payes
            for it, you need to close his open invoice. This can be simply done, by clicking on the 'Close invoice' button.
        </p>

        <h4>Open invoices</h4>

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
                <th>Created</th>
                <th>Comments</th>
                <th>Edit open invoice</th>
                <th>Close invoice</th>
            </tr>
            <tr v-for="(invoice, i) in filteredInvoices" :key="i">
                <td>{{ invoice.id }}</td>
                <td>{{ invoice.customer_name }}</td>
                <td>{{ invoice.created_at }}</td>
                <td>{{ invoice.comments }}</td>
                <td>Edit(under development)</td>
                <td><button @click="goToCloseInvoice(invoice.id)" class="btn btn-success btn-sm" >Close invoice(under development)</button></td>
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