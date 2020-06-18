<template>
    <div>
        <h2>Create invoice</h2>
        
        <v-select  v-model="selectedCustomer" label="name" :options="customers"></v-select>
        <p>Selected customer: {{ selectedCustomer }}</p>
        <hr>

        <!-- SelectTool.vue -->
        <select-tool v-for="(component, i) in components" :key="i" :tools = 'tools' @toolSelected="AddToToolsToLoan"></select-tool>

        <!-- Buttons -->
        <button @click="addComponent" class="btn btn-info">Add another tool</button>
        <button @click="removeComponent" class="btn btn-info">Remove tool</button>
        <button @click="createInvoice" class="btn btn-warning">Create invoice</button>
    </div>
</template>

<script>
import vSelect from 'vue-select';
import invoiceService from '../../service/invoiceService';
import SelectTool from '../tools/SelectTool';
import { mapGetters, mapActions } from 'vuex';
export default {
    name: 'CreateInvoice',
    components: {
        vSelect,
        'select-tool': SelectTool,
    },
    data(){
        return {
            selectedCustomer: '',//this is the selected customer
            toolsToLoan: [],//we will collect here all selected tools from the SelectTool componentS. This will be sent to the db.
            components: ['one'],//this is used to dynamically add more SelectTool components
            invoice: {//this will be the newly created inovice, that will be sent to vuex and db
                customer:{},
                tools:{},
            },//this invoice object will be sent to the db
            
            
        }
    },
    computed: {
        ...mapGetters(['customers', 'tools']),
    },
    
    methods: {
        ...mapActions(['createInvoiceInStore']),
        async createInvoice(){
            this.invoice.customer = this.selectedCustomer;//adding customers
            this.invoice.tools = this.toolsToLoan;//adding tools
            console.dir(this.invoice);
            //ADD NEW INVOICE TO VUEX
            // let invoiceForVuex = {
            //     closing_date = null,
            //     comments = null,
            //     customer_id = this.customer.id,
            //     customer_name = this.customer.name,
            //     id: 17,
            //     invoice_closed: 0,
            //     invoiceitems: Array(1),//what happened here and who did this?
            //     sum_for_paying: null,
            // };

            //this.$store.dispatch('createInvoiceInStore', invoiceForVuex);

            //SET TOOL not on stock

            try {
                await invoiceService.createInvoice(this.invoice);
                console.log('Invoice object sent to api');
            } catch (error) {
                console.dir(error);
                console.log('Something is wrong with invoice creating in the db.');
            }
        },
        
        AddToToolsToLoan(tool){//used for receiving tool objects from SelectTool components
            this.toolsToLoan.push(tool);
            console.log('Selected tool succesfully added to parent');
            console.dir(this.toolsToLoan);
        },
        addComponent(){//for addind another loan tool
            this.components.push('another component');
        },
        removeComponent(){//for removing a loan tool line
            this.components.pop();
        },
        test(){
            console.dir(this.selectedCustomer.id);
        }
    },
    
}
</script>