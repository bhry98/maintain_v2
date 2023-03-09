@extends('layout.index')
@section('title')
    {{ __('app.role.Details') }}
@endsection
@section('pagetitle')
    {{ __('app.role.Details') }}
@endsection
@section('page')
    {{ $role }}
@endsection
