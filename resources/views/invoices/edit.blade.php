@extends('layouts.master')
@section('title')
تعديل الفاتورة
@endsection
@section('css')
    <!--- Internal Select2 css-->
    <link href="{{ URL::asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet">
    <!---Internal Fileupload css-->
    <link href="{{ URL::asset('assets/plugins/fileuploads/css/fileupload.css') }}" rel="stylesheet" type="text/css" />
    <!---Internal Fancy uploader css-->
    <link href="{{ URL::asset('assets/plugins/fancyuploder/fancy_fileupload.css') }}" rel="stylesheet" />
    <!--Internal Sumoselect css-->
    <link rel="stylesheet" href="{{ URL::asset('assets/plugins/sumoselect/sumoselect-rtl.css') }}">
    <!--Internal  TelephoneInput css-->
    <link rel="stylesheet" href="{{ URL::asset('assets/plugins/telephoneinput/telephoneinput-rtl.css') }}">
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">الفواتير</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ تعديل
                    الفاتورة رقم {{ $invoice->invoice_number }}</span>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection

@section('content')
    @if (session()->has('add'))
        <div class="alert alert-success alert-dismissible fade show text-center" role="alert">
            <strong>{{ session()->get('add') }}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    <div class="row">
        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('invoice.update', $invoice->id) }}" method="post" enctype="multipart/form-data"
                        autocomplete="off">
                        {{ csrf_field() }}
                        {{-- 1 --}}
                        <div class="row">
                            <div class="col">
                                <label for="inputName" class="control-label">رقم الفاتورة</label>
                                <input type="text" class="form-control" id="inputName" name="invoice_number"
                                    title="يرجي ادخال رقم الفاتورة" required value="{{ $invoice->invoice_number }}">
                            </div>

                            <div class="col">
                                <label>تاريخ الفاتورة</label>
                                <input class="form-control fc-datepicker" name="invoice_date" placeholder="YYYY-MM-DD"
                                    type="text" value="{{ date('Y-m-d') }}" required>
                            </div>

                            <div class="col">
                                <label>تاريخ الاستحقاق</label>
                                <input class="form-control fc-datepicker" name="due_date" placeholder="YYYY-MM-DD"
                                    type="text" required value="{{ $invoice->Due_date }}">
                            </div>

                        </div>

                        {{-- 2 --}}
                        <div class="row">
                            <div class="col">
                                <label for="inputName" class="control-label">القسم</label>
                                <select name="section_name" class="form-control SlectBox"
                                    onclick="console.log($(this).val())" onchange="console.log('change is firing')" required
                                    oninvalid="setCustomValidity('من فضلك اعد ملئ البيانات')">
                                    <option value="{{ $invoice->section->id }}"> {{ $invoice->section->section_name }}
                                    </option>
                                    @foreach ($sections as $s)
                                        <option value="{{ $s->id }}"> {{ $s->section_name }} </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col">
                                <label for="inputName" class="control-label">المنتج</label>
                                <select id="product" name="product" class="form-control" required>
                                    <option value="{{ $invoice->product }}">{{ $invoice->product }}</option>
                                </select>
                            </div>
                            <div class="col">
                                <label for="inputName" class="control-label">مبلغ التحصيل</label>
                                <input type="text" class="form-control" id="inputName" name="amount_collection"
                                    oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                                    required value="{{ $invoice->Amount_collection }}">
                            </div>
                        </div>
                        {{-- 3 --}}
                        <div class="row">

                            <div class="col">
                                <label for="inputName" class="control-label">مبلغ العمولة</label>
                                <input type="text" class="form-control form-control-lg" id="Amount_Commission"
                                    name="amount_commission" title="يرجي ادخال مبلغ العمولة "
                                    oninput="myFunction2()"
                                    required value="{{ $invoice->Amount_Commission }}">
                            </div>

                            <div class="col">
                                <label for="inputName" class="control-label">الخصم</label>
                                <input type="text" class="form-control form-control-lg" id="Discount" name="discount"
                                    title="يرجي ادخال مبلغ الخصم " required value="{{ $invoice->Discount }}"
                                    oninput="myFunction()">
                            </div>

                            <div class="col">
                                <label for="inputName" class="control-label">نسبة ضريبة القيمة المضافة</label>
                                <select name="rate_vat" id="rate_vat" class="form-control" onchange="myFunction()">
                                    <!--placeholder-->
                                    <option value="" disabled>{{ $invoice->Rate_VAT }}</option>
                                    <option value=" 5%">5%</option>
                                    <option value="10%">10%</option>
                                </select>
                            </div>
                        </div>

                        {{-- 4 --}}

                        <div class="row">
                            <div class="col">
                                <label for="inputName" class="control-label">قيمة ضريبة القيمة المضافة</label>
                                <input type="text" class="form-control" id="Value_VAT" name="value_vat" readonly
                                    required oninvalid="setCustomValidity('من فضلك اعد ملئ البيانات')"
                                    value="{{ $invoice->Value_VAT }}">
                            </div>

                            <div class="col">
                                <label for="inputName" class="control-label">الاجمالي شامل الضريبة</label>
                                <input type="text" class="form-control" id="Total" name="total" readonly
                                    required oninvalid="setCustomValidity('من فضلك اعد ملئ البيانات')"
                                    value="{{ $invoice->Total }}">
                            </div>
                        </div>

                        {{-- 5 --}}
                        <div class="row">
                            <div class="col">
                                <label for="exampleTextarea">ملاحظات</label>
                                <textarea class="form-control" id="exampleTextarea" name="note" rows="3">{{ $invoice->note }}</textarea>
                            </div>
                        </div><br>

                        <p class="text-danger">* صيغة المرفق pdf, jpeg ,.jpg , png </p>
                        <h5 class="card-title">المرفقات</h5>

                        <div class="col-sm-12 col-md-12">
                            <input type="file" name="file" class="dropify"
                                accept=".pdf,.jpg, .png, image/jpeg, image/png" data-height="70" />
                        </div><br>

                        <div class="d-flex justify-content-center">
                            <button type="submit" class="btn btn-primary m-3">حفظ البيانات</button>
                            <a href="{{ route('invoices') }}" class="btn btn-outline-primary m-3">رجوع</a>
                        </div>
                    </form>
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
    <script src="{{ URL::asset('assets/plugins/select2/js/select2.min.js') }}"></script>
    <!--Internal Fileuploads js-->
    <script src="{{ URL::asset('assets/plugins/fileuploads/js/fileupload.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/fileuploads/js/file-upload.js') }}"></script>
    <!--Internal Fancy uploader js-->
    <script src="{{ URL::asset('assets/plugins/fancyuploder/jquery.ui.widget.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/fancyuploder/jquery.fileupload.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/fancyuploder/jquery.iframe-transport.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/fancyuploder/jquery.fancy-fileupload.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/fancyuploder/fancy-uploader.js') }}"></script>
    <!--Internal  Form-elements js-->
    <script src="{{ URL::asset('assets/js/advanced-form-elements.js') }}"></script>
    <script src="{{ URL::asset('assets/js/select2.js') }}"></script>
    <!--Internal Sumoselect js-->
    <script src="{{ URL::asset('assets/plugins/sumoselect/jquery.sumoselect.js') }}"></script>
    <!--Internal  Datepicker js -->
    <script src="{{ URL::asset('assets/plugins/jquery-ui/ui/widgets/datepicker.js') }}"></script>
    <!--Internal  jquery.maskedinput js -->
    <script src="{{ URL::asset('assets/plugins/jquery.maskedinput/jquery.maskedinput.js') }}"></script>
    <!--Internal  spectrum-colorpicker js -->
    <script src="{{ URL::asset('assets/plugins/spectrum-colorpicker/spectrum.js') }}"></script>
    <!-- Internal form-elements js -->
    <script src="{{ URL::asset('assets/js/form-elements.js') }}"></script>
    {{-- product value --}}

    <script>
        var date = $('.fc-datepicker').datepicker({
            dateFormat: 'yy-mm-dd'
        }).val();
    </script>

    <script>
        $(document).ready(function() {
            $('select[name="section_name"]').on('change', function() {
                var SectionId = $(this).val();
                if (SectionId) {
                    $.ajax({
                        url: "{{ URL::to('section') }}/" + SectionId,
                        type: "GET",
                        dataType: "json",
                        success: function(data) {
                            $('select[name="product"]').empty();
                            $.each(data, function(key, value) {
                                $('select[name="product"]').append('<option value="' +
                                    value + '">' + value + '</option>');
                            });
                        },
                    });
                } else {
                    console.log('AJAX load did not work');
                }
            });
        });
    </script>


    <script>
        function myFunction() {
            var amount_commission = parseFloat(document.querySelector("[name='amount_commission']").value);
            var discount = parseFloat(document.querySelector("[name='discount']").value);
            var rate_vat = parseFloat(document.querySelector("[name='rate_vat']").value);
            var value_vat = parseFloat(document.querySelector("[name='value_vat']").value);
            var amount_commission2 = amount_commission - discount;
            if (typeof amount_commission === 'undefined' || !amount_commission) {
                alert('يرجي ادخال مبلغ العمولة ');
            } else {
                var value = amount_commission2 * rate_vat / 100;
                var tot = value + amount_commission2;
                va = parseFloat(value.toFixed(2));
                to = parseFloat(tot.toFixed(2));
                document.querySelector("[name='value_vat']").value = va;
                document.querySelector("[name='total']").value = to;
            }
        }
    </script>

    <script>
        function myFunction2() {
            var amount_commission = parseFloat(document.querySelector("[name='amount_commission']").value);
            var discount = parseFloat(document.querySelector("[name='discount']").value);
            var rate_vat = parseFloat(document.querySelector("[name='rate_vat']").value);
            var value_vat = parseFloat(document.querySelector("[name='value_vat']").value);
            var amount_commission2 = amount_commission - discount;
            if (typeof rate_vat !== 'undefined' || rate_vat) {
                var value = amount_commission2 * rate_vat / 100;
                var tot = value + amount_commission2;
                va = parseFloat(value.toFixed(2));
                to = parseFloat(tot.toFixed(2));
                document.querySelector("[name='value_vat']").value = va;
                document.querySelector("[name='total']").value = to;
            }
        }
    </script>

    <script>
        var amount_commission = document.querySelector("[name='amount_commission']");
        console.log(amount_commission);
    </script>
@endsection
