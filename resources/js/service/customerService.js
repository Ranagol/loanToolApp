import { HTTP } from './baseService';

class CustomerService {

    getCustomers(){
        return HTTP.get('/customers');
    }

    searchCustomers(searchTerm){
        return HTTP.get('/search-customers', {params: {searchTerm: searchTerm}})//we are sending an object containing a search term.
    }
}

const customerService = new CustomerService();
export default customerService;