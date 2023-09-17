@extends('layouts.master')
@section('title')
تعديل القسم
@endsection
@section('css')
@endsection
@section('page-header')
				<!-- breadcrumb -->
                <div class="container justify-center w-25" style="margin-top: 100px">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li style="list-style-type: none; font-weigth:bold;"> x -> {{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                        <form method="post" action="{{route('update',$section->id)}}">
                            @csrf
                            @method('post')
                            <label  class="form-label" style="font-weight: bold" >اسم القسم</label>
                            <input type="text" class="form-control"name="section_name" value="{{$section->section_name}}">
                            <label  class="form-label" style="font-weight: bold" >الوصف</label>
                            <textarea class="form-control"  rows="3" name="description">{{$section->description}}</textarea>
                            <br>
                            <button class="btn btn-primary" type="submit" >حفظ</button>
                        </form>
                        <br>
                        <a href="{{route('sections')}}"><button class="btn btn-outline-primary w-100">رجوع</button></a>
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





