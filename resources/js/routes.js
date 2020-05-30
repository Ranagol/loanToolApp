import Customers from './components/customers/Customers';
import Tools from './components/tools/Tools';

export default {
    mode: 'history',

    routes: [
        { path: '/customers', name: 'customers', component: Customers },
        { path: '/tools', name:'tools', component: Tools },
    ]
};
