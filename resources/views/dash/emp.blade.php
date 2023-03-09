@extends('layout.index')
@section('title')
    {{-- {{dd($User)}} --}}
@endsection
@section('pagetitle')
    {{ __('app.dash.P') }}
@endsection
@section('page')
    {{-- @foreach ($User->Role->permission as $r)
        {{ $r }} <br>
    @endforeach --}}
    <div class="row row-cards">
        {{-- <div class="col-lg-6">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex">
                        <h3 class="card-title">Active users</h3>
                        <div class="ms-auto">
                            <div class="dropdown">
                                <a class="dropdown-toggle text-muted" href="#" data-bs-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false">Last 7 days</a>
                                <div class="dropdown-menu dropdown-menu-end">
                                    <a class="dropdown-item active" href="#">Last 7 days</a>
                                    <a class="dropdown-item" href="#">Last 30 days</a>
                                    <a class="dropdown-item" href="#">Last 3 months</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div id="chart-active-users-2"></div>
                        </div>
                        <div class="col-md-auto">
                            <div class="divide-y divide-y-fill">
                                <div class="px-3">
                                    <div class="text-muted">
                                        <span class="status-dot bg-primary"></span> Mobile
                                    </div>
                                    <div class="h2">11,425</div>
                                </div>
                                <div class="px-3">
                                    <div class="text-muted">
                                        <span class="status-dot bg-azure"></span> Desktop
                                    </div>
                                    <div class="h2">6,458</div>
                                </div>
                                <div class="px-3">
                                    <div class="text-muted">
                                        <span class="status-dot bg-green"></span> Tablet
                                    </div>
                                    <div class="h2">3,985</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}
        @livewire('dash.emp')
    </div>
@endsection
