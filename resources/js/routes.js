//AUTH
import Login from './components/authentication/Login';
import Register from './components/authentication/Register';

//ELEMENTS
import Home from './components/elements/Home';
//CUSTOMERS
import Customers from './components/customers/Customers';
import CreateCustomer from './components/customers/CreateCustomer';

//TOOLS
import Tools from './components/tools/Tools';
import CreateTool from './components/tools/CreateTool';

//INVOICES
import CreateInvoice from './components/invoices/CreateInvoice';
import CloseInvoice from './components/invoices/CloseInvoice';
import Invoices  from './components/invoices/Invoices';
import OpenInvoices  from './components/invoices/OpenInvoices';

//INVOICEITEMS
import Invoiceitems  from './components/invoiceitems/Invoiceitems';


export const routes = [
    //AUTH
    { path: '/login', name: 'login', component: Login },
    { path: '/register', name: 'register', component: Register },

    //ELEMENTS
    { path: '/home', name: 'home', component: Home },

    //CUSTOMERS
    { path: '/customers', name: 'customers', component: Customers },
    { path: '/create-customer', name: 'create-customer', component: CreateCustomer },

    //TOOLS
    { path: '/tools', name:'tools', component: Tools },
    { path: '/create-tool', name: 'create-tool', component: CreateTool },

    //INVOICES
    { path: '/create-invoice', name:'CreateInvoice', component: CreateInvoice },
    { path: '/invoices', name:'invoices', component: Invoices },
    { path: '/close-invoice/:id', name:'CloseInvoice', component: CloseInvoice },
    { path: '/open-invoices', name:'open-invoices', component: OpenInvoices },

    //INVOICEITEMS
    { path: '/invoiceitems', name:'invoiceitems', component: Invoiceitems },

];

