@extends('layouts.master')

@section('title')
    الصلاحيات
@endsection

@section('css')
@endsection

@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">المستخدمين</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ صلاحيات
                    المستخدمين</span>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
    <!-- row -->
    <div class="row mb-2 ">
        <div class="col-lg-12 margin-tb d-flex justify-content-center">
            <div class="pull-right">
                @can('اضافة صلاحية')
                    <a class="btn btn-success" href="{{ route('roles.create') }}">اضافة صلاحيه جديده</a>
                @endcan
            </div>
        </div>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success pt-2 font-bold justify-content-center align-items-center">
            <p>{{ $message }}</p>
        </div>
    @endif

    <table class="table table-bordered">
        <tr>
            <th>#</th>
            <th>الاسم</th>
            @can('العمليات علي الصلاحيه')
                <th width="280px">العمليات</th>
            @endcan
        </tr>
        @foreach ($roles as $key => $role)
            <tr>
                <td>{{ ++$i }}</td>
                <td>{{ $role->name }}</td>
                @can('العمليات علي الصلاحيه')
                    <td>
                        @can('عرض صلاحية')
                            <a class="btn btn-info" href="{{ route('roles.show', $role->id) }}">عرض</a>
                        @endcan
                        @can('تعديل صلاحية')
                            <a class="btn btn-primary" href="{{ route('roles.edit', $role->id) }}">تعديل</a>
                        @endcan
                        @can('حذف صلاحية')
                            {!! Form::open(['method' => 'DELETE', 'route' => ['roles.destroy', $role->id], 'style' => 'display:inline']) !!}
                            {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                            {!! Form::close() !!}
                        @endcan
                    </td>
                @endcan
            </tr>
        @endforeach
    </table>
    {!! $roles->render() !!}
    <!-- row closed -->
    </div>
    <!-- Container closed -->
    </div>
    <!-- main-content closed -->
@endsection
@section('js')
@endsection
