@extends('layouts.master')

@section('title')
اضافة صلاحيه
@endsection

@section('css')
    <link href="{{ URL::asset('assets/plugins/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
    <!--Internal  treeview -->
    <link href="{{ URL::asset('assets/plugins/treeview/treeview-rtl.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">صلاحيات المستخدم</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/
                    اضافة صلاحيه جديدة</span>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <strong>عذرا!</strong> هناك خطأ في حقل الادخال<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {!! Form::open(['route' => 'roles.store', 'method' => 'POST']) !!}
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>اسم الصلاحية :</strong>
                <br>
                <br>
                {!! Form::text('name', null, ['class' => 'form-control']) !!}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>الصلاحيات :</strong>
                <br/>
                <hr/>
                @foreach ($permission as $value)
                    <label
                        style="font-size: 16px; font-family: Verdana, Geneva, Tahoma, sans-serif d-grid; width:50%;">{{ Form::checkbox('permission[]', $value->id, false, ['class' => 'name']) }}
                        {{ $value->name }}</label>
                @endforeach
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
            <button type="submit" class="btn btn-primary ml-2">تأكيد</button>
            <a class="btn btn-outline-primary mr-2 " href="{{ route('roles.index') }}"> رجوع</a>
        </div>
    </div>
    {!! Form::close() !!}
    </div>
    <!-- Container closed -->
    </div>
    <!-- main-content closed -->
@endsection
@section('js')
    <script src="{{ URL::asset('assets/plugins/treeview/treeview.js') }}"></script>
@endsection
