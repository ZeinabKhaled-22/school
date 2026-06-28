@extends('layouts.master')
@section('css')
    @toastr_css
@section('title')
    {{ trans('fee-invoice-translation.add_fee') }}
@stop
@endsection
@section('page-header')
<h3>  {{ trans('fee-invoice-translation.add_fee') }}  </h3>
@section('PageTitle')
    {{ trans('fee-invoice-translation.add_fee') }}
@stop
<!-- breadcrumb -->
@endsection
@section('content')
    <!-- row -->
    <div class="row">
        <div class="col-md-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="post" action="{{ route('fee.store') }}" autocomplete="off">
                        @csrf
                        <div class="form-row">
                            <div class="form-group col">
                                <label for="inputEmail4">{{ trans('fee-invoice-translation.name_ar') }}</label>
                                <input type="text" value="{{ old('title_ar') }}" name="title_ar" class="form-control">
                            </div>

                            <div class="form-group col">
                                <label for="inputEmail4">{{ trans('fee-invoice-translation.name_en') }}</label>
                                <input type="text" value="{{ old('title_en') }}" name="title_en" class="form-control">
                            </div>


                            <div class="form-group col">
                                <label for="inputEmail4">{{ trans('fee-invoice-translation.amount') }}</label>
                                <input type="number" value="{{ old('amount') }}" name="amount" class="form-control">
                            </div>
                        </div>


                        <div class="form-row">

                            <div class="form-group col">
                                <label for="inputState">{{ trans('fee-invoice-translation.grade') }}</label>
                                <select class="custom-select mr-sm-2" name="grade_id">
                                    <option selected disabled>{{trans('parent-translation.choose')}}...</option>
                                    @foreach($grades as $grade)
                                        <option value="{{ $grade->id }}">{{ $grade->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group col">
                                <label for="inputZip">{{ trans('fee-invoice-translation.classroom') }}</label>
                                <select class="custom-select mr-sm-2" name="classroom_id">

                                </select>
                            </div>
                            <div class="form-group col">
                                <label for="inputZip">{{ trans('fee-invoice-translation.year') }}</label>
                                <select class="custom-select mr-sm-2" name="year">
                                    <option selected disabled>{{trans('parent-translation.choose')}}...</option>
                                    @php
                                        $current_year = date("Y")
                                    @endphp
                                    @for($year=$current_year; $year<=$current_year +1 ;$year++)
                                        <option value="{{ $year}}">{{ $year }}</option>
                                    @endfor
                                </select>
                            </div>

                            <div class="form-group col">
                                <label for="inputZip">{{ trans('fee-invoice-translation.fee_type') }}</label>
                                <select class="custom-select mr-sm-2" name="fee_type">
                                    <option value="1">{{ trans('fee-invoice-translation.fee_school') }}</option>
                                    <option value="2">{{ trans('fee-invoice-translation.fee_bus') }}</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputAddress">{{ trans('fee-invoice-translation.description') }}</label>
                            <textarea class="form-control" name="description" id="exampleFormControlTextarea1" rows="4"></textarea>
                        </div>
                        <br>

                        <button type="submit" class="btn btn-primary">{{ trans('grade-translation .submit') }}</button>

                    </form>

                </div>
            </div>
        </div>
    </div>
    <!-- row closed -->
@endsection
@section('js')
    @toastr_js
    @toastr_render
@endsection