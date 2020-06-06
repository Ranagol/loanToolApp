import { HTTP } from './baseService';

class CustomerService {

    getCustomers(searchTerm){
        return HTTP.get('/customers', {params: {searchTerm: searchTerm}});
    }

    
}

const customerService = new CustomerService();
export default customerService;