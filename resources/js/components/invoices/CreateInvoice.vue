<template>
    <div>
        <h2>Create invoice</h2>

        <button @click="createInvoiceWithItems" class="btn btn-warning">Create invoice</button>
    </div>
</template>

<script>
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
             
        }
    },
    methods: {
        async createInvoiceWithItems(){
            this.invoiceWithItems.invoice = this.invoice;
            this.invoiceWithItems.invoice_items = this.invoice_items;
            console.dir(this.invoiceWithItems);
        },

        
    }
}
</script>