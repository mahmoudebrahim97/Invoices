@extends('layouts.master')
@section('title')
    حذف الفاتورة نهائيا
@endsection
@section('css')
@endsection
@section('page-header')
    <div class="container text-center justify-center w-50">
        <div class="alert alert-danger w-100 text-center font-bold" style="font-size: 20px; font-style: italic="
            role="alert ">
            هل أنت متاكد من حذف الفاتورة نهائيا ؟
        </div>
    </div>
    <div class="container w-75" style="margin-top: 7px;">
        <div class="tab-pane active" id="home" role="tabpanel">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped mg-b-0 text-md-nowrap font-sans" style="font-size: small">
                                <tbody>
                                    <tr>
                                        <th>رقم الفاتورة : </td>
                                        <th>{{ $invoice->invoice_number }}</th>
                                        <th>تاريخ الاصدار : </th>
                                        <th>{{ $invoice->invoice_Date }}</th>
                                    </tr>
                                    <tr>
                                        <th scope="row">تاريخ الاستحقاق : </th>
                                        <th>{{ $invoice->Due_date }}</th>
                                        <th>القسم :</th>
                                        <th>{{ $invoice->section->section_name }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">المنتج : </th>
                                        <th>{{ $invoice->product }}</th>
                                        <th>مبلغ التحصيل : </th>
                                        <th>{{ $invoice->Amount_collection }}</th>
                                    </tr>
                                    <tr>
                                        <th scope="row">مبلغ العموله : </th>
                                        <th>{{ $invoice->Amount_Commission }}</th>
                                        <th>الخصم : </th>
                                        <th>{{ $invoice->Discount }}</th>
                                    </tr>
                                    <tr>
                                        <th scope="row">نسبة الضريبه :</th>
                                        <th>{{ $invoice->Rate_VAT }}</th>
                                        <th>قيمة الضريبه : </th>
                                        <th>{{ $invoice->Value_VAT }}</th>
                                    </tr>
                                    <tr>
                                        <th scope="row">الاجمالي مع الضريبه : </th>
                                        <td> {{ $invoice->Total }}</td>
                                        <td> ملاحظات : </td>
                                        <td> {{ $invoice->note }}</td>
                                    </tr>
                            </table>
                        </div><!-- bd -->
                    </div><!-- bd -->
                </div><!-- bd -->
            </div>
        </div>
    </div>
    <div class="container" style="display: flex;justify-content:center; margin-top=0px">
        <a href="{{route('invoice.forceDelete',$invoice->id)}}"><button class="btn btn-danger btn-lg m-3">تأكيد
                الحذف</button></a>
        <a href="{{ route('invoice.softDeleted') }}"><button type="button"
                class="btn btn-outline-secondary m-3 btn-lg">رجوع</button></a>
    </div>

    <!-- breadcrumb -->
@endsection
@section('content')
    <!-- row -->
    <div class="row">

    </div>
    <!-- row closed -->
    </div>
    <!-- Container closed -->
    </div>
    <!-- main-content closed -->
@endsection
@section('js')
@endsection
2
