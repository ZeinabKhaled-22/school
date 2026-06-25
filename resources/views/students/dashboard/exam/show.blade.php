@extends('layouts.master')
@section('css')
    @toastr_css
    @livewireStyles
    @section('title')
        {{ trans('quizz-translation.show_quizz') }}
    @stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
    @section('PageTitle')
        {{ trans('quizz-translation.show_quizz') }}
    @stop
    <!-- breadcrumb -->
@endsection
@section('content')


    @livewire('show-question',['quizz_id' => $quizz_id , 'student_id' => $student_id])
@endsection
@section('js')
    @toastr_js
    @toastr_render
    @livewireScripts
@endsection