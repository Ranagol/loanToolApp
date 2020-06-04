<template>
    <div>
        <h2>Create invoice</h2>

        <el-select v-model="value" filterable placeholder="Select">
            <el-option
                v-for="item in options"
                :key="item.value"
                :label="item.label"
                :value="item.value">
            </el-option>
        </el-select>       

        <button @click="createInvoiceWithItems" class="btn btn-warning">Create invoice</button>
    </div>
</template>

<script>
import invoiceService from '../../service/invoiceService';
export default {
    name: 'CreateInvoice',
    data(){
        return {
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
            options: [
                {
                    value: 'Option1',
                    label: 'Option1'
                }, 
                {
                    value: 'Option2',
                    label: 'Option2'
                }, 
                {
                    value: 'Option3',
                    label: 'Option3'
                }
            ],
            value: ''
             
        }
    },
    methods: {
        async createInvoiceWithItems(){
            this.invoiceWithItems.invoice = this.invoice;
            this.invoiceWithItems.invoice_items = this.invoice_items;
            console.dir(this.invoiceWithItems);
            try {
                await invoiceService.createInvoice(this.invoiceWithItems);
                console.log('Invoice sent to api');
            } catch (error) {
                console.dir(error);
                console.log('Something is wrong');
            }
            console.log('This is bad');
        },

        
    }
}
</script>