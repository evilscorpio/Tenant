<?php namespace App\Modules\Tenant\Controllers;

use App\Http\Requests;
use App\Modules\Tenant\Models\Application\StudentApplicationPayment;
use App\Modules\Tenant\Models\Client\Client;
use App\Modules\Tenant\Models\Application\CourseApplication;
use App\Modules\Tenant\Models\Invoice\StudentInvoice;
use Flash;
use DB;

use Illuminate\Http\Request;

class StudentController extends BaseController
{

    protected $request;/* Validation rules for user create and edit */
    protected $rules = [
        'amount' => 'required|numeric',
        'date_paid' => 'required',
        'payment_method' => 'required|min:2|max:45'
    ];

    function __construct(Client $client, Request $request, CourseApplication $application, StudentApplicationPayment $payment, StudentInvoice $invoice)
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
        $data['client'] = $this->client->getDetails($application->client_id);
        return view("Tenant::Student/Account/index", $data);
    }

    /*
     * Controllers for payment
     * */
    public function createPayment($application_id)
    {
        $data['application_id'] = $application_id;
        return view("Tenant::Student/Payment/add", $data);
    }

    public function storePayment($application_id)
    {
        $this->validate($this->request, $this->rules);
        // if validates
        $created = $this->payment->add($this->request->all(), $application_id);
        if ($created)
            Flash::success('Payment has been added successfully.');
        return redirect()->route('tenant.application.students', $application_id);
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function createInvoice($application_id)
    {
        $data['application_id'] = $application_id;
        return view("Tenant::Student/Invoice/add", $data);
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
        return redirect()->route('tenant.application.students', $application_id);
    }


    /**
     * Get all the payments through ajax request.
     *
     * @return JSON response
     */
    function getPaymentsData($application_id)
    {
        $payments = StudentApplicationPayment::leftJoin('client_payments', 'client_payments.client_payment_id', '=', 'student_application_payments.client_payment_id')
            ->leftJoin('payment_invoice_breakdowns', 'client_payments.client_payment_id', '=', 'payment_invoice_breakdowns.payment_id')
            ->where('course_application_id', $application_id)
            ->select(['student_application_payments.student_payments_id', 'client_payments.*', 'payment_invoice_breakdowns.invoice_id', 'course_application_id']);

        $datatable = \Datatables::of($payments)
            ->addColumn('action', '<div class="btn-group">
                  <button class="btn btn-primary" type="button">Action</button>
                  <button data-toggle="dropdown" class="btn btn-primary dropdown-toggle" type="button">
                    <span class="caret"></span>
                    <span class="sr-only">Toggle Dropdown</span>
                  </button>
                  <ul role="menu" class="dropdown-menu">
                    <li><a href="http://localhost/condat/tenant/contact/2">View</a></li>
                    <li><a href="http://localhost/condat/tenant/contact/2">Edit</a></li>
                    <li><a href="http://localhost/condat/tenant/contact/2">Delete</a></li>
                  </ul>
                </div>')
            ->addColumn('invoice_id', function($data) {
                if(empty($data->invoice_id) || $data->invoice_id == 0)
                    return 'Uninvoiced <a class="btn btn-success btn-xs" data-toggle="modal" data-target="#condat-modal" data-url="'.url('tenant/student/payment/'.$data->client_payment_id.'/'.$data->course_application_id.'/assign').'"><i class="glyphicon glyphicon-plus-sign"></i> Assign to Invoice</a>';
                else
                    return format_id($data->invoice_id, 'SI');
            })
            ->editColumn('date_paid', function ($data) {
                return format_date($data->date_paid);
            })
            ->editColumn('student_payments_id', function ($data) {
                return format_id($data->student_payments_id, 'CP');
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
        /*$invoices = StudentInvoice::join('course_application', 'course_application.course_application_id', '=', 'college_invoices.course_application_id')
            ->where('course_application.course_application_id', $application_id)
            ->select(['college_invoices.*'])
            ->orderBy('college_invoices.created_at', 'desc');*/

        $invoices = StudentInvoice::join('invoices', 'student_invoices.invoice_id', '=', 'invoices.invoice_id')
            ->select(['invoices.*', 'student_invoices.student_invoice_id'])
            ->where('student_invoices.application_id', $application_id)
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
                    <li><a href="'.route("tenant.invoice.payments", [$data->invoice_id, 2]).'">View payments</a></li>
                    <li><a href="http://localhost/condat/tenant/contact/2">View</a></li>
                    <li><a href="http://localhost/condat/tenant/contact/2">Edit</a></li>
                    <li><a href="http://localhost/condat/tenant/contact/2">Delete</a></li>
                  </ul>
                </div>';
            })
            ->addColumn('status', 'Outstanding')
            ->addColumn('outstanding_amount',  function ($data) {
                return '5000 <a class="btn btn-success btn-xs" data-toggle="modal" data-target="#condat-modal" data-url="'.url('tenant/invoices/'.$data->invoice_id.'/payment/add/2').'"><i class="glyphicon glyphicon-plus-sign"></i> Add Payment</a>';
            })
            ->editColumn('invoice_date', function ($data) {
                return format_date($data->invoice_date);
            })
            ->editColumn('student_invoice_id', function ($data) {
                return format_id($data->student_invoice_id, 'SI');
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

}
