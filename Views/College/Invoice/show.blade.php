@extends('layouts.tenant')
@section('title', 'View Invoice')
@section('breadcrumb')
    @parent
    <li><a href="{{url('tenant/clients')}}" title="All Clients"><i class="fa fa-users"></i> Clients</a></li>
    <li>Add</li>
@stop
@section('content')
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
                        <th>Amount</th>
                        <th>GST</th>
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
                            <td>$250.30</td>
                        </tr>
                        <tr>
                            <th>Tax (9.3%)</th>
                            <td>$10.34</td>
                        </tr>
                        <tr>
                            <th>Shipping:</th>
                            <td>$5.80</td>
                        </tr>
                        <tr>
                            <th>Total:</th>
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
    <!-- / end client details section -->
    <table class="table table-bordered">
        <thead class="thead-default">
        <tr>
            <th>
                <h4>
                    Student Name
                </h4>
            </th>
            <th>
                <h4>Description</h4>
            </th>

            <th>
                <h4>Amount</h4>
            </th>
            <th>
                <h4>GST</h4>
            </th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td>Jenish Maskey</td>
            <td>{{ $invoice->description }}</td>
            <td class="text-right">${{ $invoice->commission_amount }}</td>
            <td class="text-right">${{ $invoice->gst }}</td>
        </tr>
        <tr>
            <td>Template Design</td>
            <td>{{ $invoice->other_description }}</td>

            <td class="text-right">${{ $invoice->amount }}</td>
            <td class="text-right">${{ $invoice->gst }}</td>
        </tr>

        </tbody>
    </table>
    <div class="row text-right">
        <div class="col-xs-2 col-xs-offset-8">
            <p>
            <h4>
                Sub Total : <br>
                GST : <br>

                <h3>Total Amount :</h3>
                Less Paid Amount : <br>

                <h3>Amount Due :</h3> <br>
            </h4>
            </p>
        </div>
        <div class="col-xs-2">
            <p>
            <h4>
                ${{ $invoice->total_commission }} <br>
                ${{ $invoice->total_gst }} <br>

                <h3>${{ $invoice->final_total }} </h3>
                $1000.00<br>

                <h3>$345</h3><br>
            </h4>
            </p>
        </div>
    </div>
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

    <div class="col-xs-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Invoice Details</h3>
            </div>

            <div class="box-body">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="col-md-4"><strong>Invoice Date</strong></div>
                        <div class="col-sm-8">
                            {{ format_date($invoice->invoice_date) }}
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="col-md-4"><strong>Installment Number</strong></div>
                        <div class="col-sm-8">
                            {{ $invoice->installment_no }}
                        </div>
                    </div>
                </div>
                <br/>

                <div class="panel panel-default">
                    <div class="panel-heading">
                        <span class="panel-title">Commission on Tuition Fee</span>
                    </div>
                    <div class="panel-body">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <div class="col-md-4"><strong>Tuition Fee</strong></div>
                                <div class="col-sm-8">
                                    ${{ $invoice->tuition_fee }}
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-4"><strong>Enrollment Fee</strong></div>
                                <div class="col-sm-8">
                                    ${{ $invoice->enrollment_fee }}
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-4"><strong>Material Fee</strong></div>
                                <div class="col-sm-8">
                                    ${{ $invoice->material_fee }}
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-4"><strong>COE Fee</strong></div>
                                <div class="col-sm-8">
                                    ${{ $invoice->coe_fee }}
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-4"><strong>Other Fee</strong></div>
                                <div class="col-sm-8">
                                    ${{ $invoice->other_fee }}
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-4"><strong>Sub Total</strong></div>
                                <div class="col-sm-8">
                                    ${{ $invoice->sub_total }}
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6">

                            <div class="form-group">
                                <div class="col-md-4"><strong>Description</strong></div>
                                <div class="col-sm-8">
                                    {{ $invoice->description }}
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-4"><strong>Commission Percent</strong></div>
                                <div class="col-sm-8">
                                    ${{ $invoice->commission_percent }}
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-4"><strong>Commission Amount</strong></div>
                                <div class="col-sm-8">
                                    ${{ $invoice->commission_amount }}
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-4"><strong>Commission GST</strong></div>
                                <div class="col-sm-8">
                                    ${{ $invoice->commission_gst }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="panel panel-default">
                    <div class="panel-heading">
                        <span class="panel-title">Other Commission</span>
                    </div>
                    <div class="panel-body">
                        <div class="col-sm-6">

                            <div class="form-group">
                                <div class="col-md-4"><strong>Amount</strong></div>
                                <div class="col-sm-8">
                                    ${{ $invoice->amount }}
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-4"><strong>Incentive GST</strong></div>
                                <div class="col-sm-8">
                                    ${{ $invoice->gst }}
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <div class="col-md-4"><strong>Description</strong></div>
                                <div class="col-sm-8">
                                    {{ $invoice->other_description }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="panel panel-default">
                    <div class="panel-heading">
                        <span class="panel-title">Total Commission</span>
                    </div>
                    <div class="panel-body">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <div class="col-md-4"><strong>Total Amount</strong></div>
                                <div class="col-sm-8">
                                    ${{ $invoice->total_commission }}
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-4"><strong>Total GST</strong></div>
                                <div class="col-sm-8">
                                    ${{ $invoice->total_gst }}
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <div class="col-md-4"><strong>Payable To College</strong></div>
                                <div class="col-sm-8">
                                    ${{ $invoice->payable_to_college }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop



