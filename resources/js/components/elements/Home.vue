<template>
    <div>
        <h3>Home/owerview</h3>
        
        <h5>Customers</h5>
        <p>Number of <router-link to="/customers" >customers</router-link>: {{ customers.length }}</p>
        <hr>

        <h5>Tools</h5>
        <p>All loan <router-link to="/tools" >tools</router-link>: {{ tools.length }}</p>
        <p>Tools on field: - development in progress -</p>
        <p>Tools on stock: - development in progress -</p>
        <p>Number of all <router-link  to="/invoiceitems" >loans</router-link>: {{ invoiceitems.length }}</p>
        <hr>

        <h5>Invoices</h5>
        <p>Number of all <router-link to="/invoices" >invoices</router-link>: {{ invoices.length }}</p>
        <p><router-link to="/open-invoices" >Number of open invoices</router-link>: {{ openInvoices }} </p>
        <p>Number of closed invoices: {{ closedInvoice }}</p>
        <hr>

        <h5>Money/profit from loan tools</h5>
        <p>Money earned from closed invoices: {{ money }} </p>
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
            // console.log('Home/invoices', this.invoices);
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
    data(){
        return {

        }
    },
    methods: {},
}
</script>