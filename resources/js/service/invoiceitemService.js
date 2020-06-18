import { HTTP } from './baseService';

class InvoiceitemService {

    getInvoiceitems(){
        return HTTP.get('/invoiceitems');
    }
    getInvoiceitemById(id){
        return HTTP.get(`/invoiceitems/${id}`);
    }

    createInvoiceitem(invoiceitem){
        return HTTP.post('/invoiceitems', invoiceitem);
    }

    deleteInvoiceitem(id){
        return HTTP.delete(`/invoiceitems/${id}`);
    }
    
}

const invoiceitemService = new InvoiceitemService();
export default invoiceitemService;