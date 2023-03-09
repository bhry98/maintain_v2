@extends('layout.index')
@section('title')
    {{ __('app.task.AllFWs') }}
@endsection
@section('pagetitle')
    {{ __('app.task.AllFWs') }}
@endsection

@section('page')
    @livewire('task.ws.all')
    {{-- <div class="card">
        <div dir="ltr" class="card-body">
            <livewire:task-for-main/>
        </div>
    </div> --}}
@endsection