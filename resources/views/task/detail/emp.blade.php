@extends('layout.index')
@section('title')
    {{ __('app.task.Details') }}
@endsection
@section('pagetitle')
    {{ $task->tittle }}
@endsection
@section('subptittle')
    @if ($task->task_id)
        <a target="_blank" href="{{ route('emp.task.Detail', $task->task_id) }}">{{ $task->OldTask->tittle }}</a>
    @endif
@endsection
@section('action')
    @if ($task->emp_id == null && $task->emp_ok == null && $task->emp_start_time == null)
        <a href="#" class="btn btn-blue" data-bs-toggle="modal" data-bs-target="#modal-move">
            {{ __('app.task.prog.AppTask') }}
        </a>
        <div class="modal modal-blur fade" id="modal-move" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">
                            {{ __('app.task.prog.AppTask') }}
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('emp.task.AppToMy', $task->id) }}" method="post">
                        @csrf
                        <input type="hidden" name="task" value="{{ $task->id }}">
                        <div class="modal-body text-center">
                            <div class="col-12 mb-12">
                                <label class="form-label">{{ __('app.emp.Name') }} :
                                    {{ $User->name }}</label>
                                <label class="form-label">{{ __('app.task.Code') }} :
                                    {{ $task->id }}</label>
                                <button type="submit" class="btn btn-red" data-bs-dismiss="modal">
                                    {{ __('app.task.prog.StartTaTime') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endif
    @if ($task->workshop_id == null && $task->emp_ok == null)
        @can('task-move')
            <a href="#" class="btn btn-blue" data-bs-toggle="modal" data-bs-target="#modal-move">
                {{ __('app.task.ws.Move') }}
            </a>
            <div class="modal modal-blur fade" id="modal-move" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">
                                ترحيل الي ورشة
                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="{{ route('emp.task.MoveToWS', $task->id) }}" method="post">
                            @csrf
                            <div class="modal-body">
                                <input type="hidden" name="task" value="{{ $task->id }}">
                                <div class="col-12 mb-12">
                                    <label class="form-label">{{ __('app.ws.Name') }}</label>
                                    <select class="form-control" name="ws">
                                        <option value="">.....</option>
                                        @foreach ($ws as $w)
                                            <option value="{{ $w->id }}">
                                                {{ $w->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                            </div>
                            <div class="modal-footer text-center">
                                <button type="submit" class="btn btn-primary" data-bs-dismiss="modal">Save changes</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @endcan
    @else
        @can('task-end')
            <div class="ms-2 d-inline-block">
                <a href="{{ route('emp.task.End', $task->id) }}" class="btn btn-red @disabled($task->is_close == 1) ">
                    {{ __('app.task.End') }}
                </a>
            </div>
        @endcan
    @endif
@endsection
@section('page')
    <div class="row row-cards">
        <div class="col-md-6 col-lg-4 sticky-top">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        {{ __('app.task.Data') }}
                    </h3>
                </div>
                <div class="card-body">
                    <h5>
                        {{ __('app.task.N.Dep') }} :
                        <strong> {{ $task->Dep->name }}</strong>
                    </h5>
                    <h5>
                        {{ __('app.task.N.Cli') }} :
                        @if ($task->task_id == null)
                            <strong> {{ $task->Client->name }}</strong>
                        @else
                            <strong> {{ $task->EmpH->name }}</strong>
                        @endif
                    </h5>
                    <h5>
                        {{ __('app.task.table.Time') }} :
                        <strong> {{ $task->order_time->format(config('app.date.format')) }}</strong>
                    </h5>
                    <h5>
                        {{ __('app.task.time.MoveToWs') }} :
                        <strong>
                            {{ $task->main_ok_time == null ? __('app.Errors.NYet') : $task->main_ok_time->format(config('app.date.format')) }}</strong>
                    </h5>
                    <h5>
                        {{ __('app.task.table.Status') }} :
                        <strong>
                            {!! $task->Status($task->status) !!}
                        </strong>
                    </h5>
                </div>
            </div>
            @if ($task->EShop)
                <br>
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">
                            {{ __('app.task.ws.Data') }}
                        </h3>
                    </div>
                    <div class="card-body">
                        <h5>
                            {{ $task->details }}
                        </h5>
                    </div>
                </div>
            @endif
            <br>
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        {{ __('app.task.Details') }}
                    </h3>
                </div>
                <div class="card-body">
                    <h5>
                        {{ $task->details }}
                    </h5>
                </div>
            </div>
            @if ($task->Emp)
                <br>
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">
                            {{ __('app.emp.Details') }}
                        </h3>
                    </div>
                    <div class="card-body">
                        <h5>
                            {{ __('app.emp.Name') }} :
                            <strong> {{ $task->emp == null ? __('app.Errors.NYet') : $task->emp->name }}</strong>
                        </h5>
                        <h5>
                            {{ __('app.task.time.Take') }} :
                            <strong>
                                {{ $task->emp_start_time == null ? __('app.errors.NYet') : $task->emp_start_time->format(config('app.date.format')) }}</strong>
                        </h5>
                        <h5>
                            {{ __('app.task.time.End') }} :
                            <strong>
                                {{ $task->emp_end_time == null ? __('app.task.prog.InWork') : $task->emp_end_time->format(config('app.date.format')) }}</strong>
                        </h5>
                        <h5>
                            {{ __('app.task.time.TotalWork') }} :
                            <strong>
                                @if ($task->emp_start_time == null && $task->emp_end_time == null)
                                    {{ __('app.errors.NYet') }}
                                @elseif($task->emp_start_time && $task->emp_end_date == null)
                                    {{ __('app.task.prog.InWork') }}
                                @else
                                    {{ $task->emp_start_time->diffInHours($task->emp_end_date) }}
                                @endif
                                {{-- {{  ? __('app.Errors.NYet') : $task->emp_end_date->format(config('app.date.format')) }} --}}
                            </strong>
                        </h5>

                        @if ($task->emp_done)
                            <h3 class="text-center">
                                {{ __('app.task.EndNote') }}
                            </h3>
                            <h4>
                                {{ $task->emp_note }}
                            </h4>
                        @endif

                    </div>
                </div>
            @endif
            @if ($task->is_close == null)
                <br>
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">
                            {{ __('app.task.Actions') }}
                        </h3>
                    </div>
                    <div class="card-body">
                        <a href="{{ route('emp.task.ViewAdd', ['ot' => $task->id]) }}" class="btn btn-blue">
                            {{ __('app.task.h.Add') }}
                        </a>
                        <a href="#" class="btn btn-red" data-bs-toggle="modal" data-bs-target="#modal-end">
                            {{ __('app.task.End') }}
                        </a>


                    </div>

                </div>
            @endif

        </div>
        <div class="modal modal-blur fade" id="modal-end" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">
                            {{ __('app.task.End') }}
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('emp.task.End', $task->id) }}" method="post">
                        @csrf
                        <input type="hidden" name="task" value="{{ $task->id }}">
                        <div class="modal-body text-center">
                            <div class="col-12 mb-12">
                                <textarea required class="form-control" name="note" cols="30" rows="10"></textarea>
                                <br>
                                <button type="submit" class="btn btn-red">
                                    {{ __('app.task.End') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-8">
            <div dir="ltr" class="card">
                <div class="card-body">
                    <ul class="steps steps-green steps-counter my-4">
                        <li class="step-item">
                            {{ __('app.task.step.AddFCli') }}
                        </li>
                        <li class="step-item @if ($task->workshop_id == null && $task->emp_ok == null) active @endif">
                            {{ __('app.task.step.MainOk') }}

                        </li>
                        <li class="step-item @if ($task->emp_id == null && $task->emp_ok == null && $task->emp_start_time == null) active @endif">
                            {{ __('app.task.step.EmpOk') }}
                        </li>
                        <li class="step-item @if ($task->emp_done == null && $task->emp_ok && $task->is_close == null) active @endif">
                            {{ __('app.task.step.InWork') }}
                        </li>
                    </ul>
                    @if ($task->emp_done)
                        <h1 class="text-green text-center">
                            {{ __('app.Progr.IsDone') }}
                        </h1>
                    @endif
                    @if ($task->is_close && $task->cli_done == null && $task->emp_done == null)
                        <h1 class="text-red text-center">
                            {{ __('app.task.prog.IsDoneByMang') }}
                        </h1>
                    @endif
                </div>

            </div>
            <br>
            <h4>
                {{ __('app.task.prog.Prog') }}
            </h4>
            <div class="card">
                <div style="height:300px" class="table-responsive">
                    <table class="text-center table card-table table-vcenter text-nowrap datatable">
                        <thead>
                            <tr>
                                <th>{{ __('app.task.table.Who') }}</th>
                                <th>{{ __('app.task.table.Do') }}</th>
                                <th>{{ __('app.task.table.T') }}</th>
                            </tr>
                        </thead>

                        <tbody class="text-center">
                            @if (count($task->Prog) > 0)
                                @foreach ($task->Prog as $k => $p)
                                    <tr>

                                        <td>
                                            {{ $p->is_client == null ? $p->Emp->name : $p->Cli->name }}
                                        </td>
                                        <td>
                                            {{ $p->do }}
                                        </td>
                                        <td>
                                            {{ $p->time->format(config('app.date.format')) }}
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="4">
                                        <img src="/imgs/gif/no-data.gif" height="250" alt="Loading...">
                                    </td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
            <br>
            @if ($task->hold_time)
                <h4>
                    {{ __('app.task.prog.HoldTime') }}
                </h4>
                <div class="card">
                    <div style="height:300px" class="table-responsive">
                        <table class="text-center table card-table table-vcenter text-nowrap datatable">
                            <thead>
                                <tr>
                                    <th>{{ __('app.task.h.Start') }}</th>
                                    <th>{{ __('app.task.h.End') }}</th>
                                    <th>{{ __('app.task.h.Action') }}</th>
                                </tr>
                            </thead>
                            <tbody class="text-center">
                                @foreach ($task->HoldTime as $p)
                                    <tr>
                                        <td>{{ $p->start }}</td>
                                        <td>{{ $p->end == null ? '---' : $p->end }}</td>
                                        <td>{{ $p->why }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection
