@extends('layouts.master')
@section('css')
    @toastr_css
@section('title')
    {{ trans('proccessing-fee-translation.proccessing_fee') }}
@stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
@section('PageTitle')
  {{ trans('proccessing-fee-translation.proccessing_fee') }}
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
                                        <tr class="alert-success">
                                            <th>#</th>
                                            <th>{{ trans('proccessing-fee-translation.name') }}</th>
                                            <th>{{ trans('proccessing-fee-translation.amount') }}</th>
                                            <th>{{ trans('proccessing-fee-translation.description') }}</th>
                                            <th>{{ trans('proccessing-fee-translation.proccess') }}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($processingFees as $processingFee)
                                            <tr>
                                            <td>{{ $processingFee->id }}</td>
                                            <td>{{$processingFee->student->name}}</td>
                                            <td>{{ number_format($processingFee->amount, 2) }}</td>
                                            <td>{{$processingFee->description}}</td>
                                                <td>
                                                    <a href="{{route('processing_fee.edit',$processingFee->id)}}" class="btn btn-info btn-sm" role="button" aria-pressed="true"><i class="fa fa-edit"></i></a>
                                                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#Delete_receipt{{$processingFee->id}}" ><i class="fa fa-trash"></i></button>
                                                </td>
                                            </tr>
                                        @include('processing-fees.delete')
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