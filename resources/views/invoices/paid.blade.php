@extends('layouts.master')

@section('title')
    الفواتير المدفوعه
@endsection

@section('css')
@endsection

@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">الفواتير</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ الفواتير
                    المدفوعه</span>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection

@section('content')
    <!-- row -->
    <div class="row">
        <div class="col-xl-12">
            <div class="card mg-b-20">
                <div class="card-body p-1">
                    <div class="table-responsive ">
                        <table id="example1" class="table key-buttons text-md-nowrap" data-page-length='10'
                            style="text-align: center; font-size:12px; ">
                            <thead style="font-style: normal ; ">
                                <tr>
                                    <th class="border-bottom-0">#</th>
                                    <th class="border-bottom-0">رقم الفاتورة</th>
                                    <th class="border-bottom-0">تاريخ الفاتورة</th>
                                    <th class="border-bottom-0">تاريخ الاستحقاق</th>
                                    <th class="border-bottom-0">المنتج</th>
                                    <th class="border-bottom-0">القسم</th>
                                    <th class="border-bottom-0">الخصم</th>
                                    <th class="border-bottom-0">نسبة الضريبه</th>
                                    <th class="border-bottom-0">قيمة الضريبه</th>
                                    <th class="border-bottom-0">الاجمالي</th>
                                    <th class="border-bottom-0">الحالة </th>
                                    <th class="border-bottom-0">ملاحظات </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $a = 1; ?>
                                @foreach ($paid as $p)
                                    <tr>
                                        <td>{{ $a++ }}</td>
                                        <td>{{ $p->invoice_number }}</td>
                                        <td>{{ $p->invoice_Date }}</td>
                                        <td>{{ $p->Due_date }}</td>
                                        <td>{{ $p->product }}</td>
                                        <td>{{ $p->section->section_name }}</td>
                                        <td>{{ $p->Amount_collection }}</td>
                                        <td>{{ $p->Amount_Commission }}</td>
                                        <td>{{ $p->Discount }}</td>
                                        <td>{{ $p->Total }}</td>
                                        <td>
                                            <span class="badge badge-success">{{$p->Status}}</span>
                                        </td>
                                        <td>{{ $p->note }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
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
