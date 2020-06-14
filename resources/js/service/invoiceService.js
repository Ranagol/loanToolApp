import { HTTP } from './baseService';

class InvoiceService {

    getInvoices(){
        return HTTP.get('/invoices');
    }
    getInvoiceById(id){
        return HTTP.get(`/invoices/${id}`);
    }

    createInvoice(invoice){
        console.log('InvoiceService/createInvoice activated.');
        return HTTP.post('/invoices', invoice);
    }

    getOpenInvoices(){
        return HTTP.get("/open-invoices");
    }

    updateInvoice(id){
        return HTTP.patch(`/invoices/${id}`);
    }

    deleteInvoice(id){
        return HTTP.delete(`/invoices/${id}`);
    }
    
}

const invoiceService = new InvoiceService();
export default invoiceService;