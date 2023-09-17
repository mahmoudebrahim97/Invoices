@extends('layouts.master')
@section('title')
معلومات الفاتورة
@endsection
@section('css')
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div>      </div>
    <!-- breadcrumb -->
@endsection
@section('content')
    <!-- row -->
    <div class="row">
        <div class="col-md-10 ml-auto col-xl-10 mr-auto">
            <!-- Nav tabs -->
            <div class="card">
                <div class="card-header">
                    <ul class="nav panel-tabs main-nav-line">
                        <li><a href="#home" class="nav-link active" data-toggle="tab">معلومات
                                الفاتورة</a></li>
                        <li><a href="#profile" class="nav-link" data-toggle="tab">حالات الدفع</a></li>
                        <li><a href="#messages" class="nav-link" data-toggle="tab">المرفقات</a></li>
                    </ul>
                </div>
                <div class="card-body">
                    <!-- Tab panes -->
                    <div class="tab-content text-center">
                        <div class="tab-pane active" id="home" role="tabpanel">
                            <!-- On tables -->
                            <div class="col-xl-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-striped mg-b-0 text-md-nowrap">
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
                                                        <th>{{$invoice->section->section_name}}</td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">المنتج : </th>
                                                        <th>{{$invoice->product}}</th>
                                                        <th>مبلغ التحصيل : </th>
                                                        <th>{{$invoice->Amount_collection}}</th>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">مبلغ العموله : </th>
                                                        <th>{{$invoice->Amount_Commission}}</th>
                                                        <th>الخصم : </th>
                                                        <th>{{$invoice->Discount}}</th>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">نسبة الضريبه :</th>
                                                        <th>{{$invoice->Rate_VAT}}</th>
                                                        <th>قيمة الضريبه : </th>
                                                        <th>{{$invoice->Value_VAT}}</th>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">الاجمالي مع الضريبه : </th>
                                                        <td> {{$invoice->Total}}</td>
                                                        <td> ملاحظات : </td>
                                                        <td> {{$invoice->note}}</td>
                                                    </tr>
                                            </table>
                                        </div><!-- bd -->
                                    </div><!-- bd -->
                                </div><!-- bd -->
                            </div>
                        </div>
                        <div class="tab-pane" id="profile" role="tabpanel">
                            <table class="table table-striped mg-b-0 text-md-nowrap">
                                <tbody>
                                    <tr>
                                        <th>#</td>
                                        <th>رقم الفاتورة</th>
                                        <th>المنتج</th>
                                        <th>القسم</th>
                                        <th>حالة الدفع</th>
                                        <th>تاريخ الدفع</th>
                                        <th>ملاحظات</th>
                                        <th>تاريخ الاضافة</th>
                                        <th>المستخدم</th>
                                    </tr>
                                    <?php $n=1;?>
                                    @foreach ($details as $detail)
                                    <tr>
                                        <th scope="row"> {{$n++}} </th>
                                        <th>{{$detail->invoice_number}}</th>
                                        <th>{{$detail->product}}</td>
                                        <th>{{$invoice->section->section_name}}</th>
                                        <th>@if($detail->Value_Status===1)
                                            <span class="badge babge-pill badge-success">{{$detail->Status}}</span>
                                            @elseif ($detail->Value_Status===2)
                                            <span class="badge babge-pill badge-danger">{{$detail->Status}}</span>
                                            @else
                                            <span class="badge babge-pill badge-warning">{{$detail->Status}}</span>
                                            @endif
                                        </th>
                                        <th>{{$detail->Payment_Date}}</td>
                                        <th>{{$detail->note}}</td>
                                        <th>{{$detail->created_at}}</td>
                                        <th>{{$detail->user}}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="tab-pane" id="messages" role="tabpanel">
                            <table class="table table-striped mg-b-0 text-md-nowrap">
                                <tbody>
                                    <tr>
                                        <th>#</td>
                                        <th>اسم الملف</td>
                                        <th> قام بالاضافه</th>
                                        <th>تاريخ الاضافة</th>
                                        <th>العمليات</th>
                                    </tr>
                                    <?php $n=1;?>
                                    @foreach ($attachments as $attachment)
                                    <tr>
                                        <th scope="row"> {{$n++}} </th>
                                        <th>{{$attachment->file_name}}</th>
                                        <th>{{$attachment->Created_by}}</td>
                                        <th>{{$attachment->created_at}}</th>
                                        <th>
                                            <a class="btn btn-outline-success btn-sm" href="{{ route('viewFile',  [$attachment->invoice_number, $attachment->file_name]) }}" role="button"><i class="fas fa-eye"></i>&nbsp;عرض</a>
                                            <a class="btn btn-outline-primary btn-sm" href="{{route('downloadFile',$attachment->id)}}" role="button"><i class="fas fa-download"></i>&nbsp;تحميل</a>
                                            <a href="{{route('deleteFile',$attachment->id)}}"><button class="btn btn-outline-danger btn-sm">حذف</button></a>
                                        </th>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <a class="btn btn-outline-primary" href="{{ route('invoices') }}" role="button">رجوع</a>
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
