<template>
    <div class="alert alert-dark">
        <!-- CREATE INVOICE -->
        <p class="alert alert-warning mt-2 mb-2">
            On this page you can record the loan tool into the database.  You need to do the next. 
            1.) Enter for how long, how many days would like
            the customer to use to loan tool. Example, for two days, enter 2 into the 'Number of days for tool loaning:' field. 2.) 
            Select a customer from the db. 3.) Select the tool or maybe tools from the 'Tools to loan:' field. You can add more than one 
            tools by repeating this process. 4.) The page has an A4 format, so you can easily print out two 
            copies of this document, once it is fully filled. 5.) Click on the 'Create invoice' button. This is it, the loaning 
            procedure is done, you can now double check your newly created invoice in the <a href="/open-invoices">Open invoices</a>
            or in the <a href="/invoices">All invoices</a>.
        </p>
        <hr>
        
        <div class="d-flew row justify-content-around">
            
            <div class="col-5">
                <!-- Loan document data -->
                <h2>Loan document</h2>
                <p>Loan document number: {{ loanDocumentNumber }}</p>
                <p>Date and time: {{ date }}</p>
                <p>Number of days for tool loaning: <input v-model="daysToLoan" class="form-control input-style rounded danger" type="text" required></p>
            </div>

            <div class="col-3">
                <!-- customer data display -->
                <p ><span class="d-print-none">Select a customer:</span> 
                    <v-select class="rounded danger"  v-model="selectedCustomer" label="name" :options="customers"></v-select>
                </p>
                <p>{{ selectedCustomer.city }}</p>
                <p>{{ selectedCustomer.address }}</p>
                <p>{{ selectedCustomer.phone }}</p>
            </div>
        </div>
        <hr>
        
        <div class="d-print-none">Tools to loan:
            <!-- SELECT TOOL -->
            <p>
                <v-select class="rounded danger" multiple v-model="selectedToolsx" label="model" :options="tools"></v-select>
            </p>
        </div>

        <!-- Table for showing the selected tools -->
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
                <td>TOTAL TO PAY: {{ total }}</td>
            </tr>
        </table>
        
        <button @click="createInvoice" class="btn btn-warning d-print-none">Create invoice</button>
    </div>
</template>

<script>
import vSelect from 'vue-select';
import moment from 'moment';
import { mapGetters, mapActions } from 'vuex';
export default {
    name: 'CreateInvoice',
    components: {
        vSelect,
    },
    data(){
        return {
            selectedCustomer: '',//this is the selected customer
            selectedToolsx: '',//contains the selected tools
            //invoice: {//this will be the newly created inovice, that will be sent to vuex and db
            loanDocumentNumber: moment().format('YYYYMMDD-HHmm'),
            date: moment().format('YYYY-MM-DD HH:mm:ss'),
            daysToLoan: 1,
        }
    },
    computed: {
        ...mapGetters(['customers', 'tools']),
        selectedTools(){
            return this.selectedToolsx || [];
        },
        total(){
            let totalx = 0;
            this.selectedTools.forEach(element => {
               totalx += element.price * this.daysToLoan; 
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
                invoiceitems: this.selectedTools,
            }
        },
        invoiceitems(){//here we are manually creating temporary invoiceitems for vuex. This data will be replaced with permanent invoiceitem from db, as soon the data arrives from db.
            let invoiceitemsx = [];
            this.selectedTools.forEach(element => {
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
            this.selectedToolsx = [];
        },
        
    },
    
}
</script>

<style>
    .input-style {
        width: auto;
    }
</style>