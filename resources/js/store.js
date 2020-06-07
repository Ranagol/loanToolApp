import Vue from 'vue';
import Vuex from 'vuex';
Vue.use(Vuex);

import customerService from './service/customerService';
import toolService from './service/toolService';
import invoiceService from './service/invoiceService';
export const store = new Vuex.Store({
  
//GETTERS    
getters: {
    customers: state => state.customers,
    tools: state => state.tools,
    invoices: state => state.invoices,
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
    }
}




});
  
  