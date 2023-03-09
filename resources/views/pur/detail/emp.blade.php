@extends('layout.index')
@section('title')
    {{ __('app.pur.Details') }}
@endsection
@section('pagetitle')
    {{ __('app.pur.Details') }}
@endsection
@section('action')
    @if ($pur->main_ok == null && $pur->main_ok_id == null)
        @can('pur-app')
            <form action="{{ route('emp.pur.Action', $pur->id) }}" method="post">
                @csrf
                <input type="hidden" name="action" value="1">
                <button type="submit" class="btn btn-green">
                    {{ __('app.pur.action.App') }}
                </button>
            </form>
        @endcan
    @elseif ($pur->main_ok && $pur->main_ok_id && $pur->main_done == null && $pur->main_done_id == null)
        @can('pur-app')
            <form action="{{ route('emp.pur.Action', $pur->id) }}" method="post">
                @csrf
                <input type="hidden" name="action" value="2">
                <button type="submit" class="btn btn-azure">
                    {{ __('app.pur.action.Done') }}
                </button>
            </form>
        @endcan
    @endif
@endsection
@section('page')
    {{-- {{$pur}} --}}
    <div class="row row-cards">
        <div class="col-md-6 col-lg-4 sticky-top">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        {{ __('app.pur.Data') }}
                    </h3>
                </div>
                <div class="card-body">
                    <h5>
                        {{ __('app.pur.Code') }} :
                        <strong>{{ $pur->id }}</strong>
                    </h5>
                    <h5>
                        {{ __('app.pur.Emp') }} :
                        <strong>{{ $pur->CBy->name }}</strong>
                    </h5>
                    <h5>
                        {{ __('app.pur.time.Add') }} :
                        <strong>{{ $pur->created_at->format(config('app.date.format')) }}</strong>
                    </h5>
                    <h5>
                        {{ __('app.pur.TotalItem') }} :
                        <strong>{{ count($pur->items) }}</strong>
                    </h5>
                    <h5>
                        {{ __('app.pur.Task') }} :
                        <strong>
                            <a target="_blank" href="{{ route('emp.task.Detail', $pur->Task->id) }}">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-external-link"
                                    width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                    fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <path d="M11 7h-5a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-5"></path>
                                    <path d="M10 14l10 -10"></path>
                                    <path d="M15 4l5 0l0 5"></path>
                                </svg>
                                {{ $pur->Task->tittle }}
                                &nbsp;

                            </a>
                        </strong>
                    </h5>
                    <h5>
                        {{ __('app.pur.Status') }} :
                        <strong>
                            @if ($pur->main_ok == null && $pur->main_ok_id == null)
                                {{ __('app.pur.stat.AnderMain') }}
                            @elseif ($pur->main_done == 1 && $pur->main_done_id == 1)
                                {{ __('app.pur.stat.Done') }}
                            @else
                                {{ __('app.pur.stat.OrderTake') }}
                            @endif
                        </strong>
                    </h5>
                    @if ($pur->main_ok == 1)
                        <h5>
                            {{ __('app.pur.time.App') }} :
                            {{ $pur->main_ok_time->format(config('app.date.format')) }}
                        </h5>
                    @endif
                    @if ($pur->main_ok == 1 && $pur->main_done == 1)
                        <h5>
                            {{ __('app.pur.time.Done') }} :
                            {{ $pur->main_done_time->format(config('app.date.format')) }}
                        </h5>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-8">
            <h4>
                {{ __('app.pur.Items') }}
            </h4>
            <div class="col-12">
                <div class="card">
                    <div class="table-responsive">
                        <table class="table table-vcenter card-table table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>{{ __('app.pur.table.Item') }}</th>
                                    <th>{{ __('app.pur.table.Q') }}</th>
                                    <th>{{ __('app.pur.table.Details') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pur->items as $k => $i)
                                    <tr>
                                        <td>{{ $k + 1 }}</td>
                                        <td>{{ $i->name }}</td>
                                        <td>{{ $i->q }}</td>
                                        <td>{{ $i->note }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
