import { HTTP } from './baseService';

class CustomerService {

    getCustomers(searchTerm){
        return HTTP.get('/customers', {params: {searchTerm: searchTerm}});
    }

    // searchCustomers(searchTerm){
    //     return HTTP.get('/search-customers', {params: {searchTerm: searchTerm}})//we are sending an object containing a search term.
    // }
}

const customerService = new CustomerService();
export default customerService;