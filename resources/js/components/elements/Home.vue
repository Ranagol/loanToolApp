<template>
    <div class="alert alert-dark my-content-page">
        <p class="alert alert-warning my-instructions">Welcome! On this page you can see some statistics about your loan tool shop. How many tools you have, 
            how many loans were made, how much money was earned, etc. This page will serve also as a starting point.
            So, if you have a customer in your imaginary shop who wants to loan a tool, the first thing to do is to 
            check if the customer is already in your database. That is happening in the <a href="/customers">Customers</a> 
            section. If you know for sure that this customer of yours is already in the database, then proceed to the
            <a href="/create-invoice">Create invoice</a>.
        </p>
        <h3>Home/owerview</h3>

        <h5>Customers</h5>
        <p>Number of <router-link to="/customers" >customers</router-link>: {{ customers.length }}</p>
        <hr>

        <h5>Tools</h5>
        <p>All loan <router-link to="/tools" >tools</router-link>: {{ tools.length }}</p>
        <!-- <p>Tools on field: - development in progress -</p>
        <p>Tools on stock: - development in progress -</p> -->
        <p>Number of all <router-link  to="/invoiceitems" >loans</router-link>: {{ invoiceitems.length }}</p>
        <hr>

        <h5>Invoices</h5>
        <p>Number of all <router-link to="/invoices" >invoices</router-link>: {{ invoices.length }}</p>
        <p><router-link to="/open-invoices" >Number of open invoices</router-link> (loan tools currently on field): {{ openInvoices }} </p>
        <p>Number of closed invoices (loan tools returned and payed): {{ closedInvoice }}</p>
        <hr>

        <h5>Money/profit from loan tools</h5>
        <p>Money earned from closed invoices: <strong class="h4">{{ money }}</strong>  </p>
        <hr>
    </div>
</template>

<script>
import { mapGetters, mapActions } from 'vuex';
export default {
    name: 'Home',
    computed: {
        ...mapGetters(['customers', 'tools', 'invoices', 'invoiceitems']),
        openInvoices(){
            let openInvoices = 0;
            console.log('Home/invoices', this.invoices);
            this.invoices.forEach(element => {
                if (element.invoice_closed == false) {
                    openInvoices++;
                }
            });

            return openInvoices;
        },
        closedInvoice(){
            return this.invoices.length - this.openInvoices;
        },
        money(){
            let money = 0;
            this.invoices.forEach(element => {
                if (element.invoice_closed == true) {
                    money += element.sum_for_paying;
                }
            });

            return money;
        }
    },
    methods: {
        ...mapActions(['getCustomers', 'getTools', 'getInvoices', 'getInvoiceitems']),
    },
    mounted() {
        console.log('called from mounted'),
        this.getCustomers();
        this.getTools();
        this.getInvoices();
        this.getInvoiceitems();
    }

}
</script>