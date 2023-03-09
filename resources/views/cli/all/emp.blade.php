@extends('layout.index')
@section('title')
    {{ __('app.cli.All') }}
@endsection
@section('pagetitle')
    {{ __('app.cli.All') }}
@endsection
@section('page')
    @livewire('cli.all.emp')
@endsection
