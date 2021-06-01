<template>
    <div>
        <h3>Close invoice</h3>

        <!-- If there is no data in the db... -->
        <div v-if="!this.invoices.length" class="alert alert-info">
            <h5>Loading</h5>
        </div>
        
        <p>Invoice id: {{ invoiceId }}</p>
        <p>{{ invoice }}</p>
        <button @click="closeInvoice" class="btn btn-success">Close invoice</button>

        
        
    </div>
</template>

<script>
import moment from 'moment';
import { mapGetters } from 'vuex';
import invoiceService from '../../service/invoiceService';
export default {
    name: 'CloseInvoice',
    computed: {
        ...mapGetters(['invoices']),
        invoice(){
            return this.invoices.find(invoice => invoice.id == this.invoiceId);
        },
        closedInvoice(){//here we are closing the invoice, and modifying the invoice object values.
            
            //Invoice level
            let closedInvoice = this.invoice;
            let now = moment();
            closedInvoice.invoice_closed = true;
            closedInvoice.closing_date = now.format('YYYY-MM-DD');
            let sumToPay = 0;

            //Invoiceitem level
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
    data() {
        return {
           invoiceId: this.$route.params.id,
        }
    },
    methods: {
        async closeInvoice(){
            console.log('This is the final closed invoice object below:');
            console.dir(this.closedInvoice);

            //send the closed invoice to vuex

            //send the closed invoice to the db
            try {
              await invoiceService.updateInvoice(this.invoiceId, this.closedInvoice);
              console.log('Invoice successfully closed.');
            } catch (error) {
                console.log('Error during closeInvoice from CloseInvoice.vue.');
                console.dir(error);
            }
        }
        
    }
}
</script>