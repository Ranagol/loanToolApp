<template>
    <div>
        <button @click="createInvoice" class="btn btn-warning">Create invoice</button>

    </div>
</template>

<script>
export default {
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
             
                
                

        }
    },
    methods: {
        createInvoice(){

        }
    }
}
</script>