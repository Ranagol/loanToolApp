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
        }
    },
    data() {
        return {
           invoiceId: this.$route.params.id,
        }
    },
    methods: {
        async closeInvoice(){
            //Invoice level
            let updatedInvoice = this.invoice;
            let now = moment();
            updatedInvoice.invoice_closed = true;
            updatedInvoice.closing_date = now.format('YYYY-MM-DD');
            let sumToPay = 0;
            //Invoiceitem level
            updatedInvoice.invoiceitems.forEach(invoiceitem => {
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
            updatedInvoice.sum_for_paying = sumToPay;
            console.log('This is the final closed invoice object below:');
            console.dir(updatedInvoice);

            //update vuex - leave this for later

            //update db
            try {
              await invoiceService.updateInvoice(this.invoiceId, updatedInvoice);  
            } catch (error) {
                console.log('Error during closeInvoice.');
                console.dir(error);
            }
        }
        
    }
}
</script>