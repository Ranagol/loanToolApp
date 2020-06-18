import Login from './components/authentication/Login';
import Register from './components/authentication/Register';
import Customers from './components/customers/Customers';
import Tools from './components/tools/Tools';
import CreateInvoice from './components/invoices/CreateInvoice';
import CloseInvoice from './components/invoices/CloseInvoice';
import Home from './components/elements/Home';
import Invoices  from './components/invoices/Invoices';
import Invoiceitems  from './components/invoiceitems/Invoiceitems';
import OpenInvoices  from './components/invoices/OpenInvoices';

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
    { path: '/close-invoice/:id', name:'CloseInvoice', component: CloseInvoice },
    { path: '/open-invoices', name:'open-invoices', component: OpenInvoices },

    //INVOICEITEMS
    { path: '/invoiceitems', name:'invoiceitems', component: Invoiceitems },

];

