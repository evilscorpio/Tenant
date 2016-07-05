@extends('layouts.tenant')
@section('title', 'View Invoice')
@section('breadcrumb')
    @parent
    <li><a href="{{url('tenant/clients')}}" title="All Clients"><i class="fa fa-users"></i> Clients</a></li>
    <li>Add</li>
@stop
@section('content')

    <div class="row">
        <div class="col-xs-6">
            <h1>
                <img src="http://theexcursionnepal.com/assets/images/logo.png" width="400px">
            </h1>
        </div>
        <div class="col-xs-6 text-right">
            <h2>TAX INVOICE</h2>
        </div>
    </div>

    <section class="invoice">
        <!-- title row -->
        <div class="row">
            <div class="col-xs-12">
                <h2 class="page-header">
                    <i class="fa fa-globe"></i> Condat Solutions
                    <small class="pull-right">Date: {{ get_today_date() }}</small>
                </h2>
            </div>
            <!-- /.col -->
        </div>
        <!-- info row -->
        <div class="row invoice-info">
            <div class="col-xs-5 invoice-col">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        $agency->name
                    </div>
                    <div class="panel-body">
                        <p><strong>$agency->abn</strong><br/>
                            $agency->street <br/>
                            $agency->suburb $agency->state $agency->postcode <br/>
                        </p>
                        <address>
                            <strong>Admin, Inc.</strong><br>
                            795 Folsom Ave, Suite 600<br>
                            San Francisco, CA 94107<br>
                            Phone: (804) 123-5432<br>
                            Email: info@almasaeedstudio.com
                        </address>
                    </div>
                </div>
            </div>
            <div class="col-xs-5 invoice-col col-xs-offset-2 text-right">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Invoice To
                    </div>
                    <div class="panel-body">
                        <p>
                            <strong>Thom Zheng</strong><br/>
                            <strong>Invoice:</strong> #{{ format_id($invoice->college_invoice_id, 'CI') }}<br/>
                            <br/>
                            <strong>Invoice Date:</strong> {{ format_date($invoice->invoice_date) }}<br/>
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.row -->

        <!-- Table row -->
        <div class="row">
            <div class="col-xs-12 table-responsive">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>Student Name</th>
                        <th>Description</th>
                        <th class="text-right">Amount</th>
                        <th class="text-right">GST</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>Jenish Maskey</td>
                        <td>{{ $invoice->description }}</td>
                        <td class="text-right">${{ float_format($invoice->commission_amount) }}</td>
                        <td class="text-right">${{ float_format($invoice->gst) }}</td>
                    </tr>
                    <tr>
                        <td>Template Design</td>
                        <td>{{ $invoice->other_description }}</td>
                        <td class="text-right">${{ float_format($invoice->amount) }}</td>
                        <td class="text-right">${{ float_format($invoice->gst) }}</td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->

        <div class="row">
            <!-- accepted payments column -->
            <div class="col-xs-6">
                <p class="lead">Payment Methods:</p>
                <img src="../../dist/img/credit/visa.png" alt="Visa">
                <img src="../../dist/img/credit/mastercard.png" alt="Mastercard">
                <img src="../../dist/img/credit/american-express.png" alt="American Express">
                <img src="../../dist/img/credit/paypal2.png" alt="Paypal">

                <p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
                    Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles, weebly ning heekya handango imeem
                    plugg
                    dopplr jibjab, movity jajah plickers sifteo edmodo ifttt zimbra.
                </p>
            </div>
            <!-- /.col -->
            <div class="col-xs-6">
                <p class="lead">Amount Due 2/22/2014</p>

                <div class="table-responsive">
                    <table class="table">
                        <tbody>
                        <tr>
                            <th style="width:50%">Subtotal:</th>
                            <td>${{ float_format($invoice->total_commission) }}</td>
                        </tr>
                        <tr>
                            <th>GST</th>
                            <td>${{ float_format($invoice->total_gst) }}</td>
                        </tr>
                        <tr>
                            <th>Total Amount:</th>
                            <td>$5.80</td>
                        </tr>
                        <tr>
                            <th>Paid Amount:</th>
                            <td>$265.24</td>
                        </tr>
                        <tr>
                            <th>Amount Due:</th>
                            <td>$265.24</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->

        <!-- this row will not appear when printing -->
        <div class="row no-print">
            <div class="col-xs-12">
                <a href="invoice-print.html" target="_blank" class="btn btn-default"><i class="fa fa-print"></i>
                    Print</a>
                <button type="button" class="btn btn-success pull-right"><i class="fa fa-credit-card"></i> Submit
                    Payment
                </button>
                <button type="button" class="btn btn-primary pull-right" style="margin-right: 5px;">
                    <i class="fa fa-download"></i> Generate PDF
                </button>
            </div>
        </div>
    </section>
    <!-- / end client details section -->
    <div class="row">
        <div class="col-xs-5">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <h4>Bank details</h4>
                </div>
                <div class="panel-body">
                    <p>Account Name</p>

                    <p>BSB : 063-043 | Account Number : 1064 4210</p>

                    <p>Bank Name</p>
                </div>
            </div>
        </div>
        <div class="col-xs-7">
            <div class="span7">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <h4>Contact Details</h4>
                    </div>
                    <div class="panel-body">
                        <p>Ph : $agency->phone_id </p>

                        <p>Email : $agency->email_id </p>

                        <p>Website : $agency->website </p>

                    </div>
                </div>
            </div>
        </div>
    </div>
@stop



