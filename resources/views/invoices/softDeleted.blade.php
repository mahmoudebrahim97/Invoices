@extends('layouts.master')
@section('title')
الفواتير المؤرشفه
@endsection
@section('css')
@endsection
@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h4 class="content-title mb-0 my-auto">الفواتير</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ الفواتير المؤرشفة</span>
						</div>
					</div>
				</div>
				<!-- breadcrumb -->
@endsection

@section('content')
@if (session()->has('force_delete'))
<div class="alert alert-success alert-dismissible fade show text-center" role="alert">
    <strong>{{ session()->get('force_delete') }}</strong>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif
				<!-- row -->
                <div class="row">
                    <!--div-->
                    <div class="col-xl-12">
                        <div class="card mg-b-20">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="example1" class="table key-buttons text-md-nowrap" data-page-length='10'
                                    style="text-align: center; font-size:12px; font-style: italic ;font-size:10px; ">
                                        <thead style="font-style: normal ; font-size:10px;">
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
                                                <th class="border-bottom-0">العمليات</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $a = 1; ?>
                                            @foreach ($invoices as $invoice)
                                                <tr >
                                                    <td>{{ $a++ }}</td>
                                                    <td>{{ $invoice->invoice_number }}</td>
                                                    <td>{{ $invoice->invoice_Date }}</td>
                                                    <td>{{ $invoice->Due_date }}</td>
                                                    <td>{{ $invoice->product }}</td>
                                                    <td>{{ $invoice->section->section_name }}</td>
                                                    <td>{{ $invoice->Amount_collection }}</td>
                                                    <td>{{ $invoice->Amount_Commission }}</td>
                                                    <td>{{ $invoice->Discount }}</td>
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
                                                    <td style="padding: 0px ;display:flex; justify-content:center;">
                                                        <a class="btn btn-danger p-2 m-1" style="font-size: 9px; font-style:italic; text-align: center; justify-content: center" href="{{ route('invoice.delete', $invoice->id ) }}">حذف </a>
                                                        <a class="btn btn-outline-info p-1 m-1" style="font-size: 9px; font-style:italic" href="{{route('invoice.restore',$invoice->id)}}">استعادة</a>
                                                    </td>
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
