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
            //set the new, updated parameters of the invoice
            updatedInvoice = this.invoice;
            updatedInvoice.invoice_closed = true;
            updatedInvoice.invoiceitems.forEach(invoiceitem => {
                invoiceitem.returned = new Date();
                //invoiceitem.time_on_field =

                
            });
            //updatedInvoice.sum_for_paying = xxxxxxxxx
            console.log('This is the update invoice below:');
            console.dir(updatedInvoice);

            //update vuex

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