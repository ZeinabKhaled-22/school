@extends('layouts.master')
@section('css')
    @toastr_css
    @section('title')
        {{ trans('parent-translation.list_sons') }}
    @stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
    @section('PageTitle')
        {{ trans('parent-translation.list_sons') }}
    @stop
    <!-- breadcrumb -->
@endsection
@section('content')
    <!-- row -->
    <div class="row">
        <div class="col-md-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">
                    <div class="col-xl-12 mb-30">
                        <div class="card card-statistics h-100">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="datatable" class="table  table-hover table-sm table-bordered p-0"
                                           data-page-length="50"
                                           style="text-align: center">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>{{trans('student-translation.name')}}</th>
                                            <th>{{trans('student-translation.email')}}</th>
                                            <th>{{trans('student-translation.gender')}}</th>
                                            <th>{{trans('student-translation.grade')}}</th>
                                            <th>{{trans('student-translation.classrooms')}}</th>
                                            <th>{{trans('student-translation.section')}}</th>
                                            <th>{{trans('student-translation.processes')}}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($students as $student)
                                            <tr>
                                                <td>{{ $loop->index+1 }}</td>
                                                <td>{{$student->name}}</td>
                                                <td>{{$student->email}}</td>
                                                <td>{{$student->gender->name}}</td>
                                                <td>{{$student->grade->name}}</td>
                                                <td>{{$student->classroom->name}}</td>
                                                <td>{{$student->section->name}}</td>
                                                <td>
                                                    <div class="dropdown show">
                                                        <a class="btn btn-success btn-sm dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            {{ trans('parent-translation.processes') }}
                                                        </a>
                                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                            <a class="dropdown-item" href="{{route('sons.results',$student->id)}}"><i style="color: #ffc107" class="far fa-eye "></i>&nbsp;عرض نتائج الاختبارات</a>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </table>
                                </div>
                            </div>
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