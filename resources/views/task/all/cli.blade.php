@extends('layout.index')
@section('title')
    {{ __('app.task.All') }}
@endsection
@section('pagetitle')
    {{ __('app.task.All') }}
@endsection
@section('page')
    @livewire('task.all.cli')
@endsection
