<template>
    <div>
        


        <div class="d-flew row justify-content-around">
            <div class="col-3">
                

                <!-- SelectTool.vue -->
                <select-tool v-for="(component, i) in components" :key="i" :tools = 'tools' @toolSelected="AddToToolsToLoan"></select-tool>
            </div>
            <div class="d-flex flex-column col-1 align-items-end">
                <!-- Buttons for adding or removing tools -->
                <button @click="addComponent" class="btn btn-success  btn-sm">Add tool</button>
                <button @click="removeComponent" class="btn btn-warning btn-sm">Remove tool</button>
            </div>
            <div class="col-5">
                <!-- Loan document data -->
                <h2>Loan document</h2>
                <p>Loan document number: {{ loanDocumentNumber }}</p>
                <p>Date and time: {{ date }}</p>
                <p>Number of days for tool loaning: <input v-model="days" class="form-control" type="text"></p>
                
            </div>
            <div class="col-3">
                <!-- customer data display -->
                <p>Select a customer:
                    <v-select  v-model="selectedCustomer" label="name" :options="customers"></v-select>
                </p>
                <p>{{ selectedCustomer.city }}</p>
                <p>{{ selectedCustomer.address }}</p>
                <p>{{ selectedCustomer.phone }}</p>
            </div>
        </div>
        <hr>
        
        <p>Tools to loan:</p>
        <table class="table">
            <tr>
                <th>Brand</th>
                <th>Model</th>
                <th>Serial number</th>
                <th>Price/day</th>
                <th>Days</th>
                <th>Total price</th>
            </tr>
            <tr v-for="(tool, i) in toolsToLoan" :key="i">
                <td>{{ tool.brand }}</td>
                <td>{{ tool.model }}</td>
                <td>{{ tool.serial_number }}</td>
                <td>{{ tool.price }}</td>
                <td>{{ days }}</td>
                <td>{{ tool.price * days }}</td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td>TOTAL TO PAY: {{ total }}</td>
            </tr>
        </table>
        

        <button @click="createInvoice" class="btn btn-warning">Create invoice</button>
    </div>
</template>

<script>
import vSelect from 'vue-select';
import moment from 'moment';
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
            //invoice: {//this will be the newly created inovice, that will be sent to vuex and db
            loanDocumentNumber: moment().format('YYYYMMDD-HHmm'),
            date: moment().format('YYYY-MM-DD HH:mm'),
            days: 1,
        }
    },
    computed: {
        ...mapGetters(['customers', 'tools']),
        total(){
            let totalx = 0;
            this.toolsToLoan.forEach(element => {
               totalx += element.price * this.days; 
            });
            return totalx;
        },
        invoice(){
            return {
                id: '',
                customer_id: this.selectedCustomer.id,
                customer_name: this.selectedCustomer.name,
                sum_for_paying: null,
                invoice_closed: false,
                comments: null,
                created_at: moment().format('YYYY-MM-DD HH:mm:ss'),
                updated_at: null,
                closing_date: null,
                invoiceitems: this.toolsToLoan,
            }
        },
        invoiceitems(){//here we are manually creating temporary invoiceitems for vuex. This data will be replaced with permanent invoiceitem from db, as soon the data arrives from db.
            let invoiceitemsx = [];
            this.toolsToLoan.forEach(element => {
                let invoiceitem = {
                    tool_id: element.id,
                    customer_name: this.selectedCustomer.name,
                    model: element.model,
                    price: element.price,
                    taken: moment().format('YYYY-MM-DD HH:mm:ss'),
                }
                invoiceitemsx.push(invoiceitem);
            });
            return invoiceitemsx;
        }
    },
    
    methods: {
        ...mapActions(['createInvoice']),
        createInvoice(){
            console.log('This below is the new invoice object, just created:')
            console.dir(this.invoice);
            //SET TOOL not on stock missing here
            this.$store.dispatch('createInvoice', this.invoice);//send invoice to vuex actions
            this.$store.dispatch('addInvoiceItems', this.invoiceitems);//send invoiceitems to vuex actions
            this.eraseInvoice();//removes all invoice data after a successfull invoice creation
        },

        

        eraseInvoice(){
            this.selectedCustomer = '';
            this.toolsToLoan = [];
            EventBus.$emit('invoiceCreated');//removes selected tools from SelectTool child component
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
    },
    
}
</script>