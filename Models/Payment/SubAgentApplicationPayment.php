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

}
