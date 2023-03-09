@extends('layout.index')
@section('title')
    {{ __('app.dep.All') }}
@endsection
@section('pagetitle')
    {{ __('app.dep.All') }}
@endsection
@section('page')
    @livewire('dep.all.emp')
@endsection
