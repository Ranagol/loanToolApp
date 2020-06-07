<template>
    <div>
        <h2>Create invoice</h2>
        
        <v-select  v-model="selectedCustomer" label="name" :options="customers"></v-select>
        <p>Selected customer: {{ selectedCustomer }}</p>
        <hr>
        <select-tool :toolsFromDb = 'toolsFromDb'></select-tool>
        
        <button @click="test" class="btn btn-success">Test</button>
        <button @click="createInvoiceWithItems" class="btn btn-warning">Create invoice</button>
    </div>
</template>

<script>
import vSelect from 'vue-select';
import invoiceService from '../../service/invoiceService';
import customerService from '../../service/customerService';
import SelectTool from '../tools/SelectTool';
import toolService from '../../service/toolService';
export default {
    name: 'CreateInvoice',
    components: {
        vSelect,
        'select-tool': SelectTool,
    },
    data(){
        return {
            customers: [],
            selectedCustomer: '',
            toolsFromDb: [],
            
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
            try {
                await invoiceService.createInvoice(this.invoiceWithItems);
                console.log('Invoice sent to api');
            } catch (error) {
                console.dir(error);
                console.log('Something is wrong - createInvoiceWithItems()');
            }
            
        },
        async getCustomers(){
            try {
                const response = await customerService.getCustomers(this.searchTerm);
                this.customers = response.data;
                console.dir(this.customers);
            } catch (error) {
                console.dir(error);
            }
        },
        async getTools(){
            try {
                const response = await toolService.getTools(this.searchTerm);
                this.toolsFromDb = response.data;
                console.dir(this.toolsFromDb);
            } catch (error) {
                console.dir(error);
            }
        },
        test(){
            console.dir(this.selectedCustomer.id);
        }
    },
    async created(){
        this.getCustomers();
        this.getTools();
    }
}
</script>