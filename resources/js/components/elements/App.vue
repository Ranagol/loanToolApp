<template>
    <div>
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
        ...mapActions(['getCustomers', 'getTools', 'getInvoices']),
    },
    created(){
        this.getCustomers();
        this.getTools();
        this.getInvoices();
    }
}
</script>