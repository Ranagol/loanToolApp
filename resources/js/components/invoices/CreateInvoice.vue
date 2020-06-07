<template>
    <div>
        <h2>Create invoice</h2>
        
        <p>Selected customer: {{ selectedCustomer }}</p>
        <v-select  v-model="selectedCustomer" label="name" :options="customers"></v-select>
        
        
        
        <button @click="test" class="btn btn-success">Test</button>
        <button @click="createInvoiceWithItems" class="btn btn-warning">Create invoice</button>
    </div>
</template>

<script>
import vSelect from 'vue-select';
import invoiceService from '../../service/invoiceService';
import customerService from '../../service/customerService';
export default {
    name: 'CreateInvoice',
    components: {
        vSelect,
    },
    data(){
        return {
            
            searchTerm: '',
            customers: [],
            selectedCustomer: '',
            
            invoice: {
                customer_id: 1,
            },
            invoice_items: [
                { 
                    tool_id: 1,
                    price: 2200,
                },
                { 
                    tool_id: 2,
                    price: 2600,
                },
            ],
            invoiceWithItems: {},
            
        }
    },
    
    methods: {
        async createInvoiceWithItems(){
            this.invoiceWithItems.invoice = this.invoice;//this is the hardcoded customer_id for planning/testing
            console.dir(this.selectedCustomer);
            this.invoiceWithItems.invoice.customer = this.selectedCustomer;//this is the actual selected customer
            this.invoiceWithItems.invoice_items = this.invoice_items;//invoice items...
            console.dir(this.invoiceWithItems);
            // try {
            //     await invoiceService.createInvoice(this.invoiceWithItems);
            //     console.log('Invoice sent to api');
            // } catch (error) {
            //     console.dir(error);
            //     console.log('Something is wrong');
            // }
            // console.log('This is bad');
        },
        test(){
            console.dir(this.selectedCustomer.id);
        }
    },
    async created(){
        try {
            const response = await customerService.getCustomers(this.searchTerm);
            this.customers = response.data;
            console.dir(this.customers);
        } catch (error) {
            console.dir(error);
        }
    }
}
</script>