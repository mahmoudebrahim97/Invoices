@extends('layouts.master')
@section('title')
    قائمة المستخدمين
@endsection
@section('css')
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">المستخدمين</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ قائمة
                    المستخدمين</span>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
    <!-- row -->
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-right d-flex justify-content-center mb-2">
                @can('اضافة مستخدم')
                    <a class="btn btn-outline-primary" href="{{ route('users.create') }}">اضافة مستخدم جديد</a>
                @endcan
            </div>
        </div>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success font-bold text-center">
            <p>{{ $message }}</p>
        </div>
    @endif

    <table class="table table-responsive">
        <tr>
            <th>No</th>
            <th>اسم المستخدم</th>
            <th>البريد الالكتروني</th>
            <th>الحالة</th>
            <th>الصلاحيات</th>
            @can('عمليات المستخدم')
                <th width="280px">العمليات</th>
            @endcan
        </tr>
        @foreach ($data as $key => $user)
            <tr>
                <td>{{ ++$i }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>
                    @if ($user->status == 'مفعل')
                        <span class="label text-success d-flex" style="font-size: 15px ; font-family: sans-serif">
                            <div class="dot-label bg-success ml-1"></div>{{ $user->status }}
                        </span>
                    @else
                        <span class="label text-danger d-flex" style="font-size: 15px;font-family: sans-serif">
                            <div class="dot-label bg-danger ml-1"></div>{{ $user->status }}
                        </span>
                    @endif
                </td>
                <td>
                    @if (!empty($user->getRoleNames()))
                        @foreach ($user->getRoleNames() as $v)
                            <label class="badge badge-success">{{ $v }}</label>
                        @endforeach
                    @endif
                </td>
                @can('عمليات المستخدم')
                    <td>
                        <a class="btn btn-info m-1" href="{{ route('users.show', $user->id) }}">عرض</a>
                        @can('تعديل مستخدم')
                            <a class="btn btn-primary m-1" href="{{ route('users.edit', $user->id) }}">تعديل</a>
                        @endcan
                        @can('حذف مستخدم')
                            {!! Form::open(['method' => 'DELETE', 'route' => ['users.destroy', $user->id], 'style' => 'display:inline']) !!}
                            {!! Form::submit('حذف', ['class' => 'btn btn-danger m-1']) !!}
                            {!! Form::close() !!}
                        @endcan
                    </td>
                @endcan
            </tr>
        @endforeach
    </table>

    {!! $data->render() !!}

    <!-- row closed -->
    </div>
    <!-- Container closed -->
    </div>
    <!-- main-content closed -->
@endsection
@section('js')
@endsection
