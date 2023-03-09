@extends('layout.index')
@section('title')
    {{ __('app.pur.All') }}
@endsection
@section('pagetitle')
    {{ __('app.pur.All') }}
@endsection
@section('page')
    @livewire('pur.all.emp')
@endsection
