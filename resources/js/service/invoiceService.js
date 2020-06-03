import { HTTP } from './baseService';

class InvoiceService {

    getInvoices(){
        return HTTP.get('/invoices');
    }
}

const invoiceService = new InvoiceService();
export default invoiceService;