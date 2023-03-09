@extends('layout.index')
@section('title')
    {{ __('app.role.All') }}
@endsection
@section('pagetitle')
    {{ __('app.role.All') }}
@endsection
@section('page')
    @livewire('role.all')
@endsection
