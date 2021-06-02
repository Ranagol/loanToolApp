<template class='body-background'>
    <div class='body-background'>
        <navbar></navbar>
        <router-view></router-view>
    </div>
</template>

<script>
import Navbar from './Navbar';
import { mapActions } from 'vuex';
export default {
    name: 'App',
    components: {
        'navbar': Navbar,
    },
    methods: {
        ...mapActions(['getCustomers', 'getTools', 'getInvoices', 'getInvoiceitems']),
    },
    
    //This code below gets all the relevant data from db, whenever a page is loaded
    created(){
        this.getCustomers();
        this.getTools();
        this.getInvoices();
        this.getInvoiceitems();
    }
}
</script>

<style>
  @import '../../../css/app.css';
</style>

