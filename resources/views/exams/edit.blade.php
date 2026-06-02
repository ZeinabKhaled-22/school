@extends('layouts.master')
@section('css')
    @toastr_css
@section('title')
    {{ trans('exam-translation.edit_exam') }}
@stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
@section('PageTitle')
    {{ trans('exam-translation.edit_exam') }}
    
@stop
<!-- breadcrumb -->
@endsection
@section('content')
    <!-- row -->
    <div class="row">
        <div class="col-md-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">

                    @if(session()->has('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>{{ session()->get('error') }}</strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                    <div class="col-xs-12">
                        <div class="col-md-12">
                            <br>
                            <form action="{{route('exam.update','test')}}" method="post" autocomplete="off">
                                {{ method_field('patch') }}
                                @csrf
                                <div class="form-row">
                                    <div class="col">
                                        <label for="title">{{ trans('exam-translation.exam_name_ar') }}</label>
                                        <input type="text" name="name_ar"
                                               value="{{ $exam->getTranslation('name', 'ar') }}"
                                               class="form-control">
                                        <input type="hidden" name="id" value="{{$exam->id}}">
                                    </div>
                                    <div class="col">
                                        <label for="title">{{ trans('exam-translation.exam_name_en') }}</label>
                                        <input type="text" name="name_en"
                                               value="{{ $exam->getTranslation('name', 'en') }}"
                                               class="form-control">
                                    </div>
                                    <div class="col">
                                        <label for="title">{{ trans('exam-translation.term') }}</label>
                                        <input type="number" name="term" class="form-control" value="{{ $exam->term }}">
                                    </div>
                                </div>
                                <br>

                                <div class="form-group col">
                                <label for="inputZip">{{ trans('exam-translation.academic_year') }}</label>
                                <select class="custom-select mr-sm-2" name="academic_year">
                                    @php
                                        $current_year = date("Y")
                                    @endphp
                                    @for($year=$current_year; $year<=$current_year +1 ;$year++)
                                        <option value="{{ $year}}" {{$year == $exam->year ? 'selected' : ' '}}>{{ $year }}</option>
                                    @endfor
                                </select>
                            </div>
                                <button class="btn btn-success btn-sm nextBtn btn-lg pull-right" type="submit"> {{ trans('exam-translation.submit') }}
                                </button>
                            </form>
                        </div>
                    </div>
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