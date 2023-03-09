@extends('layout.index')
@section('title')
    {{ __('app.mach.All') }}
@endsection
@section('pagetitle')
    {{ __('app.mach.All') }}
@endsection
@section('page')
    @livewire('mach.all.emp')
@endsection
