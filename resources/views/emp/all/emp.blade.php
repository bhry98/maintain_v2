@extends('layout.index')
@section('title')
    {{ __('app.emp.All') }}
@endsection
@section('pagetitle')
    {{ __('app.emp.All') }}
@endsection
@section('page')
    @livewire('emp.all.emp')
@endsection
