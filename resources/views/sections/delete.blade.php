@extends('layouts.master')
@section('title')
حذف القسم
@endsection
@section('css')
@endsection
@section('page-header')
                <div class="container w-50" style="margin-top: 50px;">
                    <div class="alert alert-danger w-100 text-center font-bold" style="font-size: 25px" role="alert ">
                        هل أنت متاكد من حذف قسم ' {{$section->section_name}} ' ؟
                    </div>
                    <div class="container" style="display: flex;justify-content:center;">
                        <a href="{{route('delete_2',$section->id)}}"><button type="button" class="btn btn-danger btn-lg m-3">تأكيد الحذف</button></a>
                        <a href="{{route('sections')}}"><button type="button" class="btn btn-outline-secondary m-3 btn-lg">رجوع</button></a>
                    </div>
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
