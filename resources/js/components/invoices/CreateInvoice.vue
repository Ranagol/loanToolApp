<template>
    <div>
        <h2>Create invoice</h2>
        
        <v-select  v-model="selectedCustomer" label="name" :options="customers"></v-select>
        <p>Selected customer: {{ selectedCustomer }}</p>
        <hr>

        <!-- SelectTool.vue -->
        <select-tool v-for="(component, i) in components" :key="i" :tools = 'tools' @toolSelected="AddToToolsToLoan"></select-tool>

        <button @click="addComponent" class="btn btn-info">Add another tool</button>

        <button @click="removeComponent" class="btn btn-info">Remove tool</button>
        
        <button @click="test" class="btn btn-success">Test</button>
        <button @click="createInvoice" class="btn btn-warning">Create invoice</button>
    </div>
</template>

<script>
import vSelect from 'vue-select';
import invoiceService from '../../service/invoiceService';
import SelectTool from '../tools/SelectTool';
import { mapGetters } from 'vuex';
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
            invoice: {
                customer:{},
                tools:{},
            },//this invoice object will be sent to the db
            
            
        }
    },
    computed: {
        ...mapGetters(['customers', 'tools']),
    },
    
    methods: {
        async createInvoice(){
            //LATER HERE I WILL HAVE TO LEAD THIS INTO VUEX
            this.invoice.customer = this.selectedCustomer;//adding customers
            this.invoice.tools = this.toolsToLoan;//adding tools
            console.dir(this.invoice);
            try {
                await invoiceService.createInvoice(this.invoice);
                console.log('Invoice object sent to api');
            } catch (error) {
                console.dir(error);
                console.log('Something is wrong with invoice creating.');
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