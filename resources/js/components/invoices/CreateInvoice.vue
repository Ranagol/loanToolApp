<template>
    <div>
        <!-- CREATE INVOICE -->
        
        <div class="d-flew row justify-content-around">
            <!-- SELECT TOOL -->
            <p>Select a tool:
                <v-select multiple v-model="selectedTools" label="model" :options="tools"></v-select>
            </p>
            
            <div class="col-5">
                <!-- Loan document data -->
                <h2>Loan document</h2>
                <p>Loan document number: {{ loanDocumentNumber }}</p>
                <p>Date and time: {{ date }}</p>
                <p>Number of days for tool loaning: <input v-model="daysToLoan" class="form-control" type="text"></p>
                
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
            <tr v-for="(tool, i) in selectedTools" :key="i">
                <td>{{ tool.brand }}</td>
                <td>{{ tool.model }}</td>
                <td>{{ tool.serial_number }}</td>
                <td>{{ tool.price }}</td>
                <td>{{ daysToLoan }}</td>
                <td>{{ tool.price * daysToLoan }}</td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <!-- <td>TOTAL TO PAY: {{ total }}</td> -->
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

export default {
    name: 'CreateInvoice',
    components: {
        vSelect,
        'select-tool': SelectTool,
    },
    data(){
        return {
            selectedCustomer: '',//this is the selected customer
            selectedTools: '',//contains the selected tools
            //invoice: {//this will be the newly created inovice, that will be sent to vuex and db
            loanDocumentNumber: moment().format('YYYYMMDD-HHmm'),
            date: moment().format('YYYY-MM-DD HH:mm'),
            daysToLoan: 1,
        }
    },
    computed: {
        ...mapGetters(['customers', 'tools']),
        // total(){
        //     let totalx = 0;
        //     this.selectedTools.forEach(element => {
        //        totalx += element.price * this.daysToLoan; 
        //     });
        //     return totalx;
        // },
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
                invoiceitems: this.selectedTools,
            }
        },
        // invoiceitems(){//here we are manually creating temporary invoiceitems for vuex. This data will be replaced with permanent invoiceitem from db, as soon the data arrives from db.
        //     let invoiceitemsx = [];
        //     this.selectedTools.forEach(element => {
        //         let invoiceitem = {
        //             tool_id: element.id,
        //             customer_name: this.selectedCustomer.name,
        //             model: element.model,
        //             price: element.price,
        //             taken: moment().format('YYYY-MM-DD HH:mm:ss'),
        //         }
        //         invoiceitemsx.push(invoiceitem);
        //     });
        //     return invoiceitemsx;
        // }
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
            this.selectedTools = [];
        },
        
    },
    
}
</script>