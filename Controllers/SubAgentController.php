<?php namespace App\Modules\Tenant\Controllers;

use App\Http\Requests;
use App\Modules\Tenant\Models\Payment\SubAgentApplicationPayment;
use App\Modules\Tenant\Models\Client\Client;
use App\Modules\Tenant\Models\Application\CourseApplication;
use App\Modules\Tenant\Models\Invoice\SubAgentInvoice;
use Flash;
use DB;

use Illuminate\Http\Request;

class SubAgentController extends BaseController
{

    protected $request;/* Validation rules for user create and edit */
    protected $rules = [
        'amount' => 'required|numeric',
        'date_paid' => 'required',
        'payment_method' => 'required|min:2|max:45'
    ];

    function __construct(Client $client, Request $request, CourseApplication $application, SubAgentApplicationPayment $payment, SubAgentInvoice $invoice)
    {
        $this->client = $client;
        $this->request = $request;
        $this->application = $application;
        $this->invoice = $invoice;
        $this->payment = $payment;
        parent::__construct();
    }


    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index($application_id)
    {
        $data['stats'] = $this->invoice->getStats($application_id);
        $data['application'] = $application = $this->application->getDetails($application_id);
        $data['invoice_array'] = $this->invoice->getList($application_id);
        $data['client'] = $this->client->getDetails($application->client_id);
        return view("Tenant::SubAgent/Account/index", $data);
    }

    /*
     * Controllers for payment
     * */
    public function createPayment($application_id)
    {
        $data['application_id'] = $application_id;
        return view("Tenant::SubAgent/Payment/add", $data);
    }

    public function storePayment($application_id)
    {
        $this->validate($this->request, $this->rules);
        // if validates
        $created = $this->payment->add($this->request->all(), $application_id);
        if ($created)
            Flash::success('Payment has been added successfully.');
        return redirect()->route('tenant.application.subagents', $application_id);
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function createInvoice($application_id)
    {
        $data['application_id'] = $application_id;
        return view("Tenant::SubAgent/Invoice/add", $data);
    }

    public function storeInvoice($application_id)
    {
        $rules = [
            'invoice_amount' => 'required|numeric',
            'invoice_date' => 'required',
            'due_date' => 'required'
        ];
        $this->validate($this->request, $rules);
        // if validates
        $created = $this->invoice->add($this->request->all(), $application_id);
        if ($created)
            Flash::success('Invoice has been created successfully.');
        return redirect()->route('tenant.application.subagents', $application_id);
    }


    /**
     * Get all the payments through ajax request.
     *
     * @return JSON response
     */
    function getPaymentsData($application_id)
    {
        $payments = SubAgentApplicationPayment::leftJoin('client_payments', 'client_payments.client_payment_id', '=', 'subagent_application_payments.client_payment_id')
            ->leftJoin('payment_invoice_breakdowns', 'client_payments.client_payment_id', '=', 'payment_invoice_breakdowns.payment_id')
            ->where('course_application_id', $application_id)
            ->select(['subagent_application_payments.subagent_payments_id', 'subagent_application_payments.course_application_id', 'payment_invoice_breakdowns.invoice_id', 'client_payments.*']);

        $datatable = \Datatables::of($payments)
            ->addColumn('action', function($data) {
                return '<div class="btn-group">
                  <button class="btn btn-primary" type="button">Action</button>
                  <button data-toggle="dropdown" class="btn btn-primary dropdown-toggle" type="button">
                    <span class="caret"></span>
                    <span class="sr-only">Toggle Dropdown</span>
                  </button>
                  <ul role="menu" class="dropdown-menu">
                    <li><a href="'.route('subagents.payment.view', $data->subagent_payments_id).'">View</a></li>
                    <li><a href="http://localhost/condat/tenant/contact/2">Edit</a></li>
                    <li><a href="http://localhost/condat/tenant/contact/2">Delete</a></li>
                  </ul>
                </div>';
            })
            //->addColumn('invoice_id', 'Uninvoiced <button class="btn btn-success btn-xs"  data-toggle="modal" data-target="#invoiceModal"><i class="glyphicon glyphicon-plus-sign"></i> Assign to Invoice</button>')
            ->addColumn('invoice_id', function($data) {
                if(empty($data->invoice_id) || $data->invoice_id == 0)
                    return 'Uninvoiced <a class="btn btn-success btn-xs" data-toggle="modal" data-target="#condat-modal" data-url="'.url('tenant/payment/'.$data->client_payment_id.'/'.$data->course_application_id.'/assign').'"><i class="glyphicon glyphicon-plus-sign"></i> Assign to Invoice</a>';
                else
                    return format_id($data->invoice_id, 'I');
            })
            ->editColumn('date_paid', function ($data) {
                return format_date($data->date_paid);
            })
            ->editColumn('subagent_payments_id', function ($data) {
                return format_id($data->subagent_payments_id, 'SAP');
            });
        return $datatable->make(true);
    }

    /**
     * Get all the invoices through ajax request.
     *
     * @return JSON response
     */
    function getInvoicesData($application_id)
    {
        $invoices = SubAgentInvoice::join('invoices', 'subagent_invoices.invoice_id', '=', 'invoices.invoice_id')
            ->select(['invoices.*', 'subagent_invoices.subagent_invoice_id'])
            ->where('subagent_invoices.course_application_id', $application_id)
            ->orderBy('created_at', 'desc');
        $datatable = \Datatables::of($invoices)
            ->addColumn('action', function ($data) {
                return '<div class="btn-group">
                  <button class="btn btn-primary" type="button">Action</button>
                  <button data-toggle="dropdown" class="btn btn-primary dropdown-toggle" type="button">
                    <span class="caret"></span>
                    <span class="sr-only">Toggle Dropdown</span>
                  </button>
                  <ul role="menu" class="dropdown-menu">
                    <li><a href="'.route("tenant.invoice.payments", [$data->invoice_id, 3]).'">View Payments</a></li>
                    <li><a href="http://localhost/condat/tenant/contact/2">View</a></li>
                    <li><a href="http://localhost/condat/tenant/contact/2">Edit</a></li>
                    <li><a href="http://localhost/condat/tenant/contact/2">Delete</a></li>
                  </ul>
                </div>';
            })
            ->addColumn('status', 'Outstanding')
            ->addColumn('outstanding_amount', function ($data) {
                return '5000 <a class="btn btn-success btn-xs" data-toggle="modal" data-target="#condat-modal" data-url="'.url('tenant/invoices/'.$data->invoice_id.'/payment/add/3').'"><i class="glyphicon glyphicon-plus-sign"></i> Add Payment</a>';
            })
            ->editColumn('invoice_date', function ($data) {
                return format_date($data->invoice_date);
            })
            ->editColumn('invoice_id', function ($data) {
                return format_id($data->invoice_id, 'I');
            });
        return $datatable->make(true);
    }

    /**
     * Assign payment to invoice
     */
    function assignInvoice($payment_id, $application_id)
    {
        $data['invoice_array'] = $this->invoice->getList($application_id);
        $data['payment_id'] = $payment_id;
        return view("Tenant::Client/Payment/assign", $data);
    }

    function viewPayment($payment_id)
    {

    }

}
