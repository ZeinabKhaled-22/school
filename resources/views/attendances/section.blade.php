@extends('layouts.master')
@section('css')
    @toastr_css
@section('title')
    {{ trans('section-translation.title_page') }}: الحضور والغياب
@stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
@section('PageTitle')
    {{ trans('section-translation.title_page') }}: الحضور والغياب
@stop
<!-- breadcrumb -->
@endsection
@section('content')
    <!-- row -->
    <div class="row">
        <div class="col-md-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">
                    <a class="button x-small" href="#" data-toggle="modal" data-target="#exampleModal">
                        {{ trans('section-translation.add_section') }}</a>
                </div>

                @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif

                <div class="card card-statistics h-100">
                    <div class="card-body">
                        <div class="accordion gray plus-icon round">

                            @foreach ($grades as $grade)

                                <div class="acd-group">
                                    <a href="#" class="acd-heading">{{ $grade->name }}</a>
                                    <div class="acd-des">

                                        <div class="row">
                                            <div class="col-xl-12 mb-30">
                                                <div class="card card-statistics h-100">
                                                    <div class="card-body">
                                                        <div class="d-block d-md-flex justify-content-between">
                                                            <div class="d-block">
                                                            </div>
                                                        </div>
                                                        <div class="table-responsive mt-15">
                                                            <table class="table center-aligned-table mb-0">
                                                                <thead>
                                                                <tr class="text-dark">
                                                                    <th>#</th>
                                                                    <th>{{ trans('section-translation.name_section') }}
                                                                    </th>
                                                                    <th>{{ trans('section-translation.name_class') }}</th>
                                                                    <th>{{ trans('section-translation.status') }}</th>
                                                                    <th>{{ trans('section-translation.processes') }}</th>
                                                                </tr>
                                                                </thead>
                                                                <tbody>
                                                                @foreach ($grade->sections as $list_sections)
                                                                    <tr>
                                                                        <td>{{ $list_sections->id }}</td>
                                                                        <td>{{ $list_sections->name }}</td>
                                                                        <td>{{ $list_sections->classroom->name }}</td>
                                                                        <td>
                                                                            <label class="badge badge-{{$list_sections->status == 1 ? 'success':'danger'}}">{{$list_sections->status == 1 ? 'نشط':'غير نشط'}}</label>
                                                                        </td>

                                                                        <td>
                                                                            <a href="{{route('attendance.show',$list_sections->id)}}" class="btn btn-warning btn-sm" role="button" aria-pressed="true">قائمة الطلاب</a>
                                                                        </td>
                                                                    </tr>
                                                                @endforeach
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
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
            <script>
                $(document).ready(function () {
                    $('select[name="grade_id"]').on('change', function () {
                        var grade_id = $(this).val();
                        if (grade_id) {
                            $.ajax({
                                url: "{{ URL::to('classes') }}/" + Grade_id,
                                type: "GET",
                                dataType: "json",
                                success: function (data) {
                                    $('select[name="classroom_id"]').empty();
                                    $.each(data, function (key, value) {
                                        $('select[name="classroom_id"]').append('<option value="' + key + '">' + value + '</option>');
                                    });
                                },
                            });
                        } else {
                            console.log('AJAX load did not work');
                        }
                    });
                });

            </script>

@endsection