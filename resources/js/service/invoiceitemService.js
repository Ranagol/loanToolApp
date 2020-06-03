import { HTTP } from './baseService';

class InvoiceitemService {

    getInvoices(){
        return HTTP.get('/invoices');
    }
    getInvoiceById(id){
        return HTTP.get(`/invoices/${id}`);
    }

    createInvoice(invoice){
        return HTTP.post('/invoices', invoice);
    }

    getOpenInvoices(){
        return HTTP.get("/open-invoices");
    }

    deleteInvoice(id){
        return HTTP.delete(`/invoices/${id}`);
    }
    
}

const invoiceService = new InvoiceService();
export default invoiceService;