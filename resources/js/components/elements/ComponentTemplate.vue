<template>
    <div>
        <h3>ComponentTemplate</h3>

    </div>
</template>

<script>
import { mapGetters, mapActions } from 'vuex';
export default {
    name: 'ComponentTemplate',
    computed: {
        ...mapGetters(['customers', 'tools', 'invoices', 'invoiceitems']),
    },
    data(){
        return {

        }
    },
    methods: {
        ...mapActions(['getCustomers', 'getTools', 'getInvoices', 'getInvoiceitems']),
    },
    
    created(){
        this.getCustomers();
        this.getTools();
        this.getInvoices();
        this.getInvoiceitems();
    }
}
</script>