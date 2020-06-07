import Vue from 'vue';
import Vuex from 'vuex';
Vue.use(Vuex);

import customerService from './service/customerService';
import toolService from './service/toolService';
export const store = new Vuex.Store({
  
//GETTERS    
getters: {
    customers: state => state.customers,
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
    errors(state, error){
        state.errors = error;
    }
    
},

//ACTIONS
actions: {
    async getCustomers( {commit}){
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
    }
}




});
  
  