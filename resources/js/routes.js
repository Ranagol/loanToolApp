import Login from './components/authentication/Login';
import Register from './components/authentication/Register';
import Customers from './components/customers/Customers';
import Tools from './components/tools/Tools';
import CreateInvoice from './components/invoices/CreateInvoice';
import Home from './components/elements/Home';
import Invoices  from './components/invoices/Invoices';
import Invoiceitems  from './components/invoiceitems/Invoiceitems';

export const routes = [
    //AUTH
    { path: '/login', name: 'login', component: Login },
    { path: '/register', name: 'register', component: Register },

    //ELEMENTS
    { path: '/home', name: 'home', component: Home },

    //CUSTOMERS
    { path: '/customers', name: 'customers', component: Customers },

    //TOOLS
    { path: '/tools', name:'tools', component: Tools },

    //INVOICES
    { path: '/create-invoice', name:'CreateInvoice', component: CreateInvoice },
    { path: '/invoices', name:'invoices', component: Invoices },

    //INVOICEITEMS
    { path: '/invoiceitems', name:'invoiceitems', component: Invoiceitems },

];

