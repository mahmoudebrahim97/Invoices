@extends('layouts.master')
@section('title')
تقرير الفواتير ال{{$type}}
@endsection
@section('css')
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">Pages</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ Empty</span>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
    <!-- row -->
    <a href="{{ route('invoices_reports') }}"><button class="btn btn-outline-primary w-100">رجوع</button></a>
    <div class="card-body">
        <div class="table-responsive">
            <table id="example" class="table key-buttons text-md-nowrap" style=" text-align: center">
                <thead>
                    <tr>
                        <th class="border-bottom-0">#</th>
                        <th class="border-bottom-0">رقم الفاتورة</th>
                        <th class="border-bottom-0">تاريخ القاتورة</th>
                        <th class="border-bottom-0">تاريخ الاستحقاق</th>
                        <th class="border-bottom-0">المنتج</th>
                        <th class="border-bottom-0">القسم</th>
                        <th class="border-bottom-0">الخصم</th>
                        <th class="border-bottom-0">نسبة الضريبة</th>
                        <th class="border-bottom-0">قيمة الضريبة</th>
                        <th class="border-bottom-0">الاجمالي</th>
                        <th class="border-bottom-0">الحالة</th>
                        <th class="border-bottom-0">ملاحظات</th>

                    </tr>
                </thead>
                <tbody>
                    <?php $i = 0; ?>
                    @foreach ($invoices as $invoice)
                        <?php $i++; ?>
                        <tr>
                            <td>{{ $i }}</td>
                            <td>{{ $invoice->invoice_number }} </td>
                            <td>{{ $invoice->invoice_Date }}</td>
                            <td>{{ $invoice->Due_date }}</td>
                            <td>{{ $invoice->product }}</td>
                            <td><a
                                    href="{{ route('invoice.details', $invoice->id) }}">{{ $invoice->section->section_name }}</a>
                            </td>
                            <td>{{ $invoice->Discount }}</td>
                            <td>{{ $invoice->Rate_VAT }}</td>
                            <td>{{ $invoice->Value_VAT }}</td>
                            <td>{{ $invoice->Total }}</td>
                            <td>
                                @if ($invoice->Value_Status == 1)
                                    <span class="text-success">{{ $invoice->Status }}</span>
                                @elseif($invoice->Value_Status == 2)
                                    <span class="text-danger">{{ $invoice->Status }}</span>
                                @else
                                    <span class="text-warning">{{ $invoice->Status }}</span>
                                @endif
                            </td>
                            <td>{{ $invoice->note }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <!-- row closed -->
    </div>
    <!-- Container closed -->
    </div>
    <!-- main-content closed -->
@endsection
@section('js')
@endsection
