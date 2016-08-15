<?php namespace App\Modules\Tenant\Controllers;

use App\Http\Requests;
use App\Modules\Tenant\Models\Invoice\Invoice;
use Flash;
use DB;
use Carbon\Carbon;

use Illuminate\Http\Request;

class InvoiceReportController extends BaseController
{

    function __construct(Invoice $invoice)
    {
        $this->Invoice = $invoice;
        parent::__construct();
    }

    public function getInvoicePending()
    {
        $data['invoice_reports'] = $this->Invoice->pendingInvoiceDetails();
        //$data['date'] = Carbon::now();

        return view("Tenant::Invoice Report/invoice_pending",$data);
    }

     public function getInvoicePaid()
    {
        $data['invoice_reports'] = $this->Invoice->getInvoiceDetails();
        
        $data['date'] = Carbon::now();     
                      
        return view("Tenant::Invoice Report/invoice_paid",$data);

    }
             

    public function getInvoiceFuture()
    {
        $data['invoice_reports'] = $this->Invoice->getInvoiceDetails();
        
        $data['date'] = Carbon::now();

        return view("Tenant::Invoice Report/invoice_future",$data);
    }
        

}//end of controller
