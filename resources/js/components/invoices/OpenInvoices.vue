<template>
    <div class="alert alert-dark my-content-page">

        <p class="alert alert-warning mt-2 mb-2 my-instructions">
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

        <p class="alert alert-warning mt-2 mb-2 my-instructions">
            Here, on this page, as said before, you can see the list of all open invoices. Once the customer returns the tool that he loaned, and payes
            for it, you need to close his open invoice. This can be simply done, by clicking on the 'Close invoice' button.
        </p>

        <h4>Open invoices</h4>

        <!-- SEARCH FIELD -->
        <input 
            v-model="searchTerm" 
            name="searchTerm" 
            class="form-control input-background" 
            type="search" 
            placeholder="Search"
        >

        <!-- If there is no data in the db... -->
        <div v-if="!invoices.length" class="alert alert-info">
            <h5>Loading</h5>
        </div>

        <table class="table table-text">
            <tr>
                <th>Nr#</th>
                <th>Customer</th>
                <th>Created</th>
                <th>Comments</th>
                <th>Close invoice</th>
            </tr>
            <tr v-for="(invoice, i) in filteredInvoices" :key="i">
                <td>{{ invoice.id }}</td>
                <td>{{ invoice.customer_name }}</td>
                <td>{{ invoice.created_at }}</td>
                <td>{{ invoice.comments }}</td>
                <td>
                    <button 
                        @click="closeInvoice(invoice.id)" 
                        class="btn btn-success btn-sm" 
                    >Close invoice</button>
                </td>
            </tr>
        </table>

    </div>
</template>

<script>
import moment from 'moment';
import { mapGetters, mapActions } from 'vuex';
// import invoiceService from '../../service/invoiceService';
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
        },
    },
    methods: {
        ...mapActions(['getInvoices', 'updateInvoice']),

        closeInvoice(invoiceId){
            try {
                const invoiceForClosing = this.prepareInvoiceDataForClosing(invoiceId)
                this.updateInvoice(invoiceForClosing);
                this.$router.push('/invoices');//redirects the user to the invoices page
            } catch (error) {
                console.log('OpenInvoices.vue: Error during closing the invoice.');
                console.dir(error);
            }
        },

        prepareInvoiceDataForClosing(invoiceId){//here we are closing the invoice, and modifying the invoice object values.
            //Get the selected invoice for closing
            let closedInvoice = this.invoices.find(invoice => invoice.id == invoiceId);

            //Invoice level data preparation
            let now = moment();
            closedInvoice.closing_date = now.format('YYYY-MM-DD');
            let sumToPay = 0;

            //Invoiceitem level data preparation
            closedInvoice.invoiceitems.forEach(invoiceitem => {
                invoiceitem.returned = now.format('YYYY-MM-DD');
                //counting the time period while the tool was on field
                let loanDate = moment(invoiceitem.created_at);
                let durationObject = moment.duration(now.diff(loanDate));//here we are creating a moment duration object which is a time period between two moments
                let days = durationObject.asDays();//show this time period in days
                days = Math.ceil(days);//round up the time period
                //-------------------
                invoiceitem.time_on_field = days;
                invoiceitem.to_pay = days * invoiceitem.price;
                sumToPay += invoiceitem.to_pay;
                invoiceitem.invoice_line_closed = true;
            });
            closedInvoice.sum_for_paying = sumToPay;

            return closedInvoice;
        }
    },

    mounted() {
        console.log('called from Open invoices'),
        this.getInvoices();
    }
}
</script>