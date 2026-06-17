@extends('layouts.master')
@section('css')

@section('title')
    {{ trans('student-translation.attendance_report') }}
@stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
@section('PageTitle')
    {{ trans('student-translation.attendance_report') }}
@stop
<!-- breadcrumb -->

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

                <form method="post"  action="{{ route('attendance.search') }}" autocomplete="off">
                    @csrf
                    <h6 style="font-family: 'Cairo', sans-serif;color: blue">{{ trans('student-translation.search') }}</h6><br>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="student">{{trans('student-translation.student')}}</label>
                                <select class="custom-select mr-sm-2" name="student_id">
                                    <option value="0">{{trans('student-translation.all')}}</option>
                                    @foreach($students as $student)
                                        <option value="{{ $student->id }}">{{ $student->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="card-body datepicker-form">
                            <div class="input-group" data-date-format="yyyy-mm-dd">
                                <input type="text"  class="form-control range-from date-picker-default" placeholder="{{ trans('student-translation.start_date') }}" required name="from">
                                <span class="input-group-addon">{{ trans('student-translation.to_date') }}</span>
                                <input class="form-control range-to date-picker-default" placeholder="{{ trans('student-translation.end_date') }}" type="text" required name="to">
                            </div>
                        </div>

                    </div>
                    <button class="btn btn-success btn-sm nextBtn btn-lg pull-right" type="submit">{{trans('student-translation.submit')}}</button>
                </form>
                @isset($Students)
                <div class="table-responsive">
                    <table id="datatable" class="table  table-hover table-sm table-bordered p-0" data-page-length="50"
                           style="text-align: center">
                        <thead>
                        <tr>
                            <th class="alert-success">#</th>
                            <th class="alert-success">{{trans('student-translation.name')}}</th>
                            <th class="alert-success">{{trans('student-translation.grade')}}</th>
                            <th class="alert-success">{{trans('student-translation.section')}}</th>
                            <th class="alert-success">{{trans('student-translation.date')}}</th>
                            <th class="alert-warning">{{trans('student-translation.status')}}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($Students as $student)
                            <tr>
                                <td>{{ $loop->index+1 }}</td>
                                <td>{{$student->student->name}}</td>
                                <td>{{$student->grade->name}}</td>
                                <td>{{$student->section->name}}</td>
                                <td>{{$student->attendance_date}}</td>
                                <td>

                                    @if($student->attendence_status == 0)
                                        <span class="btn-danger">{{trans('student-translation.absence')}}</span>
                                    @else
                                        <span class="btn-success">{{trans('student-translation.presence')}}</span>
                                    @endif
                                </td>
                            </tr>
                        {{-- @include('pages.Students.Delete') --}}
                        @endforeach
                    </table>
                </div>
                @endisset

            </div>
        </div>
    </div>
</div>
<!-- row closed -->
@endsection
@section('js')

@endsection