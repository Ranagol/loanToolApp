<template>
    <div>
        <h4>History/InvoiceItems</h4>
        <p> {{ invoiceitems }}</p>

        
    </div>
</template>

<script>
import { mapGetters } from 'vuex';
export default {
    name: 'InvoiceItems',
    computed: {
        ...mapGetters(['invoiceitems']),
    },
    
    data(){
        return {
            

        }
    },
    
}
</script>