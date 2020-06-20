import Vue from 'vue';
import Vuex from 'vuex';
import createPersistedState from "vuex-persistedstate";
Vue.use(Vuex);

import customerService from './service/customerService';
import toolService from './service/toolService';
import invoiceService from './service/invoiceService';
import invoiceitemService from './service/invoiceitemService';
export const store = new Vuex.Store({

//vuex-persistedstate
plugins: [createPersistedState()],

//GETTERS    
getters: {
    customers: state => state.customers,
    tools: state => state.tools,
    invoices: state => state.invoices,
    invoiceitems: state => state.invoiceitems,
    errors: state => state.errors,
},

//STATE
state: {
    customers: [],
    tools: [],
    invoices: [],
    invoiceitems: [],
    errors: [],
},

//MUTATIONS
mutations: {
    getCustomers(state, customers){
        state.customers = customers;
    },
    getTools(state, tools){
        state.tools = tools;
    },
    getInvoices(state, invoices){
        state.invoices = invoices;
    },
    getInvoiceitems(state, invoiceitems){
        state.invoiceitems = invoiceitems;
    },
    createCustomer(state, customer){
        state.customers.push(customer);
        alert('Your customer ' + customer.name + ' was created.');
    },
    createTool(state, tool){
        state.tools.push(tool);
        alert('Your tool ' + tool.model + ' was created.');
    },
    createInvoice(state, invoice){
        state.invoices.push(invoice);
        //alert('Your new invoice was created.');
    },
    addInvoiceItems(state, invoiceitems){
        invoiceitems.forEach(element => {
            state.invoiceitems.push(element);
        });
    },

    

    errors(state, error){
        state.errors = error;
    }
    
},

//ACTIONS
actions: {
    async getCustomers( {commit} ){
        try {
            const response = await customerService.getCustomers();
            const customers = response.data;
            console.log( 'getCustomers from actions has been activated');
            console.dir(customers);
            commit('getCustomers', customers);
        } catch (error) {
            console.log('Error with getCustomers() in actions');
            console.dir(error);
            commit('errors', error);
        }
    },

    async getTools( {commit} ){
        try {
            const response = await toolService.getTools();
            const tools = response.data;
            console.log( 'getTools from actions has been activated');
            console.dir(tools);
            commit('getTools', tools);
        } catch (error) {
            console.log('Error with getTools() in actions');
            console.dir(error);
            commit('errors', error);
        }
    },

    async getInvoices( {commit} ){
        try {
            const response = await invoiceService.getInvoices();
            const invoices = response.data;
            console.log( 'getInvoices from actions has been activated');
            console.dir(invoices);
            commit('getInvoices', invoices);
        } catch (error) {
            console.log('Error with getInvoices() in actions');
            console.dir(error);
            commit('errors', error);
        }
    },

    async getInvoiceitems( {commit} ){
        try {
            const response = await invoiceitemService.getInvoiceitems();
            const invoiceitems = response.data;
            console.log( 'getInvoiceitems from actions has been activated');
            console.dir(invoiceitems);
            commit('getInvoiceitems', invoiceitems);
        } catch (error) {
            console.log('Error with getInvoiceitems() in actions');
            console.dir(error);
            commit('errors', error);
        }
    },

    async createCustomer( {commit, dispatch}, customer ){
        try {
            await customerService.createCustomer(customer);//for db
            commit('createCustomer', customer);//for vuex, temporary data
            dispatch('getCustomers');//immediatelly getting the new data with the new id from db
        } catch (error) {
            console.log('Error with createCustomer in actions');
            console.dir(error);
            alert(error);
            commit('errors', error);
        }
    },

    async createTool( { commit, dispatch}, tool ){
        try {
            await toolService.createTool(tool);//for db
            commit('createTool', tool);//for vuex, temporary data
            dispatch('getTools');//immediatelly getting the new data with the new id from db
        } catch (error) {
            console.log('Error with createTool in actions');
            console.dir(error);
            alert(error);
            commit('errors', error);
        }
    },

    async createInvoice( {commit, dispatch}, invoice){
        try {
            await invoiceService.createInvoice(invoice);//for db
            commit('createInvoice', invoice);//for vuex, temporary data
            dispatch('getInvoices');//immediatelly getting the new data with the new id from db
            dispatch('getInvoiceitems');//immediatelly getting the new data with the new id from db
        } catch (error) {
            console.log('Error with createInvoice in actions');
            console.dir(error);
            alert(error);
            commit('errors', error);
        }
    },

    addInvoiceItems( {commit}, invoiceitems){
        commit('addInvoiceItems', invoiceitems);
    }
}




});
  
  