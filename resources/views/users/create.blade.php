@extends('layouts.master')

@section('title')
اضافة مستخدم
@endsection

@section('css')
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">المستخدمين</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ اضافة مستخدم</span>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection
@section('content')

    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <strong>عذرا !</strong>هناك مشكلة في ملئ الحقل <br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {!! Form::open(['route' => 'users.store', 'method' => 'POST']) !!}

    <div class="row">
        <div class="col-5">
            <div class="form-group">
                <strong>اسم المستخدم :</strong>
                <br>
                {!! Form::text('name', null, ['placeholder' => 'ادخل اسم المستخدم', 'class' => 'form-control']) !!}
            </div>
        </div>

        <div class="col-5">
            <div class="form-group">
                <strong>البريد الالكتروني :</strong>
                {!! Form::text('email', null, ['placeholder' => 'ادخل الايميل', 'class' => 'form-control']) !!}
            </div>
        </div>
    </div>

    <div class="row">
            <div class="col-5">
                <div class="form-group">
                    <strong>كلمة المرور :</strong>
                    <br>
                    {!! Form::password('password', ['placeholder' => 'الباسوورد', 'class' => 'form-control']) !!}
                </div>
            </div>

        <div class="col-5">
                <div class="form-group">
                    <strong>تاكيد كلمة المرور :</strong>
                    <br>
                    {!! Form::password('confirm-password', ['placeholder' => 'اعد كتابة الباسوورد', 'class' => 'form-control']) !!}
                </div>
        </div>
    </div>

    <div class="row row-sm mg-b-20">
        <div class="col-lg-5">
            <strong class="form-label">حالة المستخدم</strong>
            <select name="status" id="select-beast" class="form-control  nice-select">
                <option value="مفعل">مفعل</option>
                <option value="غير مفعل">غير مفعل</option>
            </select>
        </div>
    </div>

    <div class="row">
        <div class="col-5 pr-0">
            <div class="form-group">
                <strong>الصلاحيات :</strong>
                <br>
                {!! Form::select('role_name[]', $roles, [], ['class' => 'form-control', 'multiple']) !!}
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
            <button type="submit" class="btn btn-primary m-1">تاكيد</button>
            <a class="btn btn-outline-primary m-5" href="{{ route('users.index') }}"> رجوع</a>
        </div>
    </div>
    {!! Form::close() !!}

    <!-- row closed -->
</div>
    <!-- Container closed -->
    </div>
    <!-- main-content closed -->
    @endsection
    
    @section('js')
    @endsection
