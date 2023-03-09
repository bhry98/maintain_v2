@extends('layout.index')
@section('title')
    {{ __('app.ws.All') }}
@endsection
@section('pagetitle')
    {{ __('app.ws.All') }}
@endsection
@section('page')
    @livewire('ws.all.emp')
@endsection
