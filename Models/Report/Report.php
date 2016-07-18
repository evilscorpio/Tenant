<?php namespace App\Modules\Tenant\Models\Report;
use App\Modules\Tenant\Models\Invoice\CollegeInvoice;
use App\Modules\Tenant\Models\Invoice;
use App\Modules\Tenant\Models\College\OtherCommission;
use App\Modules\Tenant\Models\College\TuitionCommission;
use App\Modules\Tenant\Models\Payment\CollegePayment;
use Illuminate\Database\Eloquent\Model;
use DB;

Class Report extends Model{

	public function CollegeInvoiceReport(){
		$college_invoice = CollegeInvoice::leftJoin('ci_tuition_commissions', 'ci_tuition_commissions.college_invoice_id', '=', 'college_invoices.college_invoice_id')
            ->leftJoin('ci_other_commissions', 'ci_other_commissions.college_invoice_id', '=', 'college_invoices.college_invoice_id')
            ->select('college_invoices.*', 'college_invoices.college_invoice_id as invoice_id', 'ci_tuition_commissions.*', 'ci_other_commissions.amount as incentive', 'ci_other_commissions.gst as incentive_gst', 'ci_other_commissions.description as other_description')
            ->find(15);
        return $college_invoice;
	}

}