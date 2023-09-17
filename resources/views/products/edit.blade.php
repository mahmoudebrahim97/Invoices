@extends('layouts.master')
@section('title')
تعديل المنتج
@endsection
@section('css')
@endsection
@section('page-header')
				<!-- breadcrumb -->
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content modal-content-demo">
                            <div class="modal-header">
                                <h6 class="modal-title"> تعديل المنتج </h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                            </div>
                            <div class="modal-body">
                                <form method="post" action="{{route('products.update',$product->id)}}">
                                    @csrf
                                    <label  class="form-label" style="font-weight: bold" >اسم المنتج</label>
                                    <input type="text" class="form-control" required oninvalid="setCustomValidity('من فضلك املأ الحقل')"
                                    name="product_name" value="{{$product->product_name}}">
                                    <label class="form-label" style="font-weight: bold"> اسم القسم</label>
                                    <select class="form-control form-select-lg mb-3" aria-label="Default select example" name="section_name">
                                        @foreach ( $sections as $s)
                                        @endforeach
                                        <option selected > {{$s->section_name}} </option>
                                        @foreach ($sections as $s )
                                        <option value="{{ $s->id }}">{{$s->section_name}}</option>
                                        @endforeach
                                    </select>
                                    <label for="exampleFormControlTextarea1" class="form-label" style="font-weight: bold" >الوصف</label>
                                    <textarea class="form-control"  rows="3" name="description">{{$product->description}}</textarea>
                                    <br>
                                    <button class="btn ripple btn-primary" type="submit">تعديل</button>
                                    <a href="{{route('products')}}"><button class="btn ripple btn-secondary" data-dismiss="modal" type="button">اغلاق</button></a>
                                </form>
                            </div>
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
