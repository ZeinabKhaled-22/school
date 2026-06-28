@extends('layouts.master')
@section('css')
    @toastr_css
@section('title')
    {{ trans('fee-invoice-translation.fee_invoices') }}
@stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
@section('PageTitle')
    {{ trans('fee-invoice-translation.fee_invoices') }}
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
                                            <th>{{trans('fee-invoice-translation.name')}}</th>
                                            <th>{{trans('fee-invoice-translation.fee_type')}}</th>
                                            <th>{{trans('fee-invoice-translation.amount')}}</th>
                                            <th>{{trans('fee-invoice-translation.grade')}}</th>
                                            <th>{{trans('fee-invoice-translation.classroom')}}</th>
                                            <th>{{trans('fee-invoice-translation.description')}}</th>
                                            <th>{{trans('fee-invoice-translation.proccess')}}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($fee_invoices as $fee_invoice)
                                            <tr>
                                            <td>{{ $fee_invoice->id }}</td>
                                            <td>{{$fee_invoice->student->name}}</td>
                                            <td>{{$fee_invoice->fee->title}}</td>
                                            <td>{{ number_format($fee_invoice->amount, 2) }}</td>
                                            <td>{{$fee_invoice->grade->name}}</td>
                                            <td>{{$fee_invoice->classroom->name}}</td>
                                            <td>{{$fee_invoice->description}}</td>
                                                <td>
                                                    <a href="{{route('fee_invoice.edit',$fee_invoice->id)}}" class="btn btn-info btn-sm" role="button" aria-pressed="true"><i class="fa fa-edit"></i></a>
                                                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#Delete_Fee_invoice{{$fee_invoice->id}}" ><i class="fa fa-trash"></i></button>
                                                </td>
                                            </tr>
                                        @include('fee-invoices.delete')
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