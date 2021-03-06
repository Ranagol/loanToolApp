import { HTTP } from './baseService';

class CustomerService {

    getCustomers(searchTerm){
        return HTTP.get('/customers', {params: {searchTerm: searchTerm}});
    }

    createCustomer(customer){
        return HTTP.post('/customers', customer);
    }

    
}

const customerService = new CustomerService();
export default customerService;