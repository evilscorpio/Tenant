<?php namespace App\Modules\Tenant\Models\Payment;

use App\Modules\Tenant\Models\Client\ClientPayment;
use App\Modules\Tenant\Models\Invoice\Invoice;
use App\Modules\Tenant\Models\Invoice\SubAgentInvoice;
use App\Modules\Tenant\Models\PaymentInvoiceBreakdown;
use Illuminate\Database\Eloquent\Model;
use DB;

class SubAgentApplicationPayment extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'subagent_application_payments';

    /**
     * The primary key of the table.
     *
     * @var string
     */
    protected $primaryKey = 'subagent_payments_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['course_application_id', 'client_payment_id'];

    /**
     * Disable default timestamp feature.
     *
     * @var boolean
     */
    public $timestamps = false;

    public function invoice()
    {
        return $this->belongsTo('App\Modules\Tenant\Models\PaymentInvoiceBreakdown', 'payment_id');
    }

    public function add(array $request, $application_id)
    {
        DB::beginTransaction();

        try {
            $payment = $this->createPayment($request);

            $subagent_payment = SubAgentApplicationPayment::create([
                'course_application_id' => $application_id,
                'client_payment_id' => $payment->client_payment_id,
            ]);

            DB::commit();
            return $subagent_payment->subagent_payments_id;
            // all good
        } catch (\Exception $e) {
            DB::rollback();
            dd($e);
            // something went wrong
        }
    }

    function addAndAssign(array $request, $invoice_id)
    {
        DB::beginTransaction();

        try {
            $payment = $this->createPayment($request);

            /* assign payment to invoice */
            PaymentInvoiceBreakdown::create([
                'invoice_id' => $invoice_id,
                'payment_id' => $payment->client_payment_id
            ]);

            $application_id = SubAgentInvoice::where('invoice_id', $invoice_id)->first()->course_application_id;

            $subagent_payment = SubAgentApplicationPayment::create([
                'course_application_id' => $application_id,
                'client_payment_id' => $payment->client_payment_id,
            ]);

            DB::commit();
            return $subagent_payment->subagent_payments_id;
            // all good
        } catch (\Exception $e) {
            DB::rollback();
            dd($e);
            // something went wrong
        }
    }

    public function createPayment($request)
    {
        $payment = ClientPayment::create([
            'client_id' => null, //change this later if necessary
            'amount' => $request['amount'],
            'date_paid' => insert_dateformat($request['date_paid']),
            'payment_method' => $request['payment_method'],
            'payment_type' => $request['payment_type'],
            'description' => $request['description']
        ]);
        return $payment;
    }



    function getDetails($payment_id)
    {
        $payment = StudentApplicationPayment::leftJoin('client_payments', 'client_payments.client_payment_id', '=', 'student_application_payments.client_payment_id')
            ->leftJoin('payment_invoice_breakdowns', 'client_payments.client_payment_id', '=', 'payment_invoice_breakdowns.payment_id')
            ->select(['student_application_payments.student_payments_id', 'client_payments.*', 'payment_invoice_breakdowns.invoice_id', 'course_application_id'])
            ->find($payment_id);
        return $payment;
    }

    function editPayment($request, $payment_id)
    {
        $payment = new ClientPayment();
        $payment->edit($request, $payment_id);

        $student_payment = StudentApplicationPayment::where('client_payment_id', $payment_id)->first();
        return $student_payment->course_application_id;
    }
}
