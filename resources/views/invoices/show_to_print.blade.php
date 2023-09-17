@extends('layouts.master')
@section('title')
معاينة قبل الطباعه
@endsection
@section('css')
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto"> الفواتير </h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ معاينة
                    الفاتورة قبل الطباعه</span>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
    <div class="container bg-white-5" id="print">
        <div class="rowr">
            <div class="col-xs-12">
                <div class="invoice-title">
                    <h2>فاتورة تحصيل</h2>
                    <h3>رقم : {{ $invoice->invoice_number }}</h3>
                </div>
                <hr>
                <br>
                <br>
                <div class="row">
                    <div class="col-xs-6">
                        <address>
                            <strong>المستخدم :</strong><br>
                            {{ auth()->user()->name }}<br>
                            {{ auth()->user()->email }}
                        </address>
                    </div>
                    <div class="col-xs-6 text-right">
                        <address>
                            <strong>تاريخ الفاتورة</strong><br>
                            {{ $invoice->invoice_Date }}<br><br>
                        </address>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading text-center">
                        <h3 class="panel-title"><strong>تفاصيل الفاتورة</strong></h3>
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-condensed">
                                <thead>
                                    <tr>

                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td style="font-size: 12px"><strong>رقم الفاتورة :</strong></td>
                                        <td class="text-center" style="font-size: 12px">
                                            <strong>{{ $invoice->invoice_number }}</strong></td>
                                        <td class="text-center"><strong>مبلغ التحصيل :</strong></td>
                                        <td class="text-right">
                                            <strong>{{ number_format($invoice->Amount_collection) }}</strong></td>
                                    </tr>
                                    <!-- foreach ($order->lineItems as $line) or some such thing here -->
                                    <tr>
                                        <td><strong>تاريخ الاستحقاق :</strong></td>
                                        <td class="text-center"><strong>{{ $invoice->Due_date }}</strong></td>
                                        <td class="text-center"><strong>مبلغ العمولة :</strong></td>
                                        <td class="text-right">
                                            <strong>{{ number_format($invoice->Amount_Commission) }}</strong></td>
                                    </tr>
                                    <tr>
                                        <td><strong>ناريخ الاصدار :</strong></td>
                                        <td class="text-center"><strong>{{ $invoice->invoice_Date }}</strong></td>
                                        <td class="text-center"><strong>الخصم :</strong></td>
                                        <td class="text-right"><strong>{{ number_format($invoice->Discount) }}</strong></td>
                                    </tr>
                                    <tr>
                                        <td><strong>اسم القسم : </strong></td>
                                        <td class="text-center"><strong>{{ $invoice->section->section_name }}</strong></td>
                                        <td class="text-center"><strong>نسبة الضريبه : </strong></td>
                                        <td class="text-right"><strong>{{ $invoice->Rate_VAT }}</strong></td>
                                    </tr>
                                    <tr>
                                        <td><strong>اسم المنتج : </strong></td>
                                        <td class="text-center"> <strong>{{ $invoice->product }}</strong></td>
                                        <td class="text-center" style="font-size: 12px"><strong>الاجمالي شامل الضريبه :
                                            </strong></td>
                                        <td class="text-right" style="font-size: 12px">
                                            <strong>{{ number_format($invoice->Amount_Commission) }}</strong></td>
                                    </tr>
                                    <tr>
                                        <td class="thick-line"></td>
                                        <td class="thick-line"></td>
                                        <td class="thick-line text-center"><strong><strong></strong></strong></td>
                                        <td class="thick-line text-right"><strong></strong></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- row -->
    <div class="container d-flex justify-content-center">
        <button class="btn btn-success" onclick="print()">طباعة</button>
    </div>
    </div>
    </div>
@endsection
@section('js')
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <script type="text/javascript">
        function print() {
            var printContents = document.getElementById('print').innerHTML;
            var originalContents = document.body.innerHTML;
            document.body.innerHTML = printContents;
            window.print();
            document.body.innerHTML = originalContents;
            location.reload();
        }
    </script>
@endsection
