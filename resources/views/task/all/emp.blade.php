@extends('layout.index')
@section('title')
    {{ __('app.task.All') }}
@endsection
@section('pagetitle')
    {{ __('app.task.All') }}
@endsection

@section('page')
    @livewire('task.all.emp')
    {{-- <div class="card">
        <div dir="ltr" class="card-body">
            <livewire:task-for-main/>
        </div>
    </div> --}}
@endsection
