<template>
    <div>
        <h2>Create invoice</h2>
        <p>Select a customer:
            <v-select  v-model="selectedCustomer" label="name" :options="customers"></v-select>
            <!-- <p>Selected customer: {{ selectedCustomer }}</p> -->
        </p>
        
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
import { EventBus } from '../../eventbus';
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
                id: '',
                customer_id: this.selectedCustomer.id,
                customer_name: this.selectedCustomer.name,
                sum_for_paying: null,
                invoice_closed: false,
                comments: null,
                created_at: null,
                updated_at: null,
                closing_date: null,
                invoiceitems: [],
            },
        }
    },
    computed: {
        ...mapGetters(['customers', 'tools']),
    },
    
    methods: {
        ...mapActions(['createInvoice']),
        createInvoice(){
            console.log('This is the new invoice object, just created:')
            console.dir(this.invoice);
            //SET TOOL not on stock missing here
            this.$store.dispatch('createInvoice', this.invoice);//send to vuex actions
            //this.eraseInvoice();
        },

        eraseInvoice(){
            //removes all invoice data after a successfull invoice creation
            this.selectedCustomer = '';
            this.toolsToLoan = [];
            EventBus.$emit('invoiceCreated');//removes selected tools from SelectTool component
        },
        
        AddToToolsToLoan(tool){//used for receiving tool objects from SelectTool components
            this.toolsToLoan.push(tool);
            console.log('Selected tool succesfully added to parent');
            console.dir(this.toolsToLoan);
        },
        addComponent(){//for adding another loan tool
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