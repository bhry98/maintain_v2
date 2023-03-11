<div>
    <div class="col-12">
        <div class="card">
            <div class="card-body border-bottom py-3">
                <div class="d-flex">
                    <div class=" text-muted">
                        {{ __('app.task.Code') }} :
                        <div class="ms-2 d-inline-block">
                            <input autofocus type="text" wire:model='search' class="form-control form-control-sm">
                        </div>
                    </div>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table card-table table-vcenter text-nowrap datatable">
                    <thead>
                        <tr>
                            <th>{{ __('app.task.table.Code') }}</th>
                            <th>{{ __('app.task.table.Dep') }}</th>
                            <th>{{ __('app.task.table.Cli') }}</th>
                            <th>{{ __('app.task.table.Time') }}</th>
                            <th>{{ __('app.task.table.Status') }}</th>
                            <th>{{ __('app.task.table.Ws') }}</th>
                            <th>{{ __('app.task.N.Emp') }}</th>
                            <th>{{ __('app.task.table.Mang') }}</th>
                        </tr>
                    </thead>
                    <tbody wire:poll.1000ms>
                        @if (count($task) > 0)
                            @foreach ($task as $t)
                                <tr>
                                    <td>{{ $t->id }}</td>
                                    <td>{{ $t->Dep->name }}</td>
                                    @if ($t->task_id == null)
                                        <td>{{ $t->Client->name }}</td>
                                    @else
                                        <td>{{ $t->EmpH->name }}</td>
                                    @endif
                                    <td>{{ $t->order_time->format(config('app.date.format')) }}</td>
                                    <td>{!! $t->Status($t->status) !!}</td>
                                    @if ($User->is_mang)
                                        <td>
                                            @if ($t->emp_ok == null && $t->emp_id == null)
                                                <a href="#" data-bs-toggle="modal"
                                                    data-bs-target="#modal-move-to-emp-{{ $t->id }}">
                                                    {{ __('app.task.prog.MoveToEmp') }}
                                                </a>
                                            @elseif ($t->Emp && $t->emp_ok != null && $t->emp_start_time == null)
                                                <a href="#" data-bs-toggle="modal"
                                                    data-bs-target="#modal-start-{{ $t->id }}">
                                                    {{ $t->Emp->name }}
                                                </a>
                                                ||
                                                <a href="#" data-bs-toggle="modal"
                                                    data-bs-target="#modal-move-to-emp-{{ $t->id }}">
                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                        class="icon icon-tabler icon-tabler-chevrons-up-left"
                                                        width="24" height="24" viewBox="0 0 24 24"
                                                        stroke-width="2" stroke="currentColor" fill="none"
                                                        stroke-linecap="round" stroke-linejoin="round">
                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                        <path d="M7 15v-8h8"></path>
                                                        <path d="M11 19v-8h8"></path>
                                                    </svg>
                                                </a>
                                            @else
                                                <a href="#" data-bs-toggle="modal"
                                                    data-bs-target="#modal-emp-{{ $t->id }}">
                                                    {{ $t->WShop->name }}
                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                        class="icon icon-tabler icon-tabler-user" width="24"
                                                        height="24" viewBox="0 0 24 24" stroke-width="2"
                                                        stroke="currentColor" fill="none" stroke-linecap="round"
                                                        stroke-linejoin="round">
                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                        <path d="M12 7m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0"></path>
                                                        <path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2"></path>
                                                    </svg>
                                                </a>
                                            @endif
                                        </td>
                                    @else
                                        <td>
                                            @if ($t->emp_id == $User->id)
                                                11111
                                            @else
                                                {{ $t->Emp == null ? '--' : $t->Emp->name }}
                                            @endif
                                        </td>
                                    @endif
                                    <td>
                                        @if ($t->Emp)
                                            {{ $t->Emp->name }}
                                        @else
                                            {{-- {{__("app.task.N.EmpNYet")}} --}}
                                            ----
                                        @endif
                                    </td>
                                    <td>
                                        {{-- @php
                                            $time1 = new DateTime('2019-01-23 18:16:25');
                                            $time2 = new DateTime('2019-01-23 11:36:28');
                                            $timediff = $time1->diff($time2);
                                            echo $timediff->format('%y year %m month %d days %h hour %i minute %s second') . '<br/>';
                                        @endphp --}}
                                        <a href="{{ route('emp.task.Detail', $t->id) }}">
                                            {{ __('app.task.Details') }}
                                        </a>
                                    </td>
                                    {{-- <td>
                                        {{ $emp }}
                                    </td> --}}
                                </tr>
                                <div wire:ignore.self class="modal modal-blur fade"
                                    id="modal-start-{{ $t->id }}" tabindex="-1" role="dialog"
                                    aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">
                                                    {{ __('app.task.prog.StartTaTime') }}
                                                </h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            @if ($t->Emp)
                                                <form
                                                    wire:submit.prevent="StartTaskTime({{ $t->id }},{{ $t->Emp->id }})">
                                                    <div class="modal-body text-center">
                                                        <div class="col-12 mb-12">
                                                            <label class="form-label">{{ __('app.emp.Name') }} :
                                                                {{ $t->Emp->name }}</label>
                                                            <label class="form-label">{{ __('app.emp.Code') }} :
                                                                {{ $t->id }}</label>
                                                            <button type="submit" class="btn btn-red"
                                                                data-bs-dismiss="modal">
                                                                {{ __('app.task.prog.StartTaTime') }}
                                                            </button>
                                                        </div>
                                                    </div>
                                                </form>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                {{--  --}}
                                <div wire:ignore.self class="modal modal-blur fade"
                                    id="modal-move-to-emp-{{ $t->id }}" tabindex="-1" role="dialog"
                                    aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">
                                                    {{ __('app.task.prog.MoveToEmp') }}
                                                </h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <form wire:submit.prevent="MoveToEmp({{ $t->id }})">
                                                <div class="modal-body">
                                                    <input type="hidden" name="task" value="{{ $t->id }}">
                                                    <div class="col-12 mb-12">
                                                        <label class="form-label">{{ __('app.emp.Name') }}</label>
                                                        <select class="form-control" wire:model='emp_id_select'>
                                                            <option value="">.....</option>
                                                            @foreach ($emp as $e)
                                                                <option value="{{ $e->id }}">
                                                                    {{ $e->name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>

                                                </div>

                                                <div class="modal-footer text-center">
                                                    {{-- <a href="#" data-bs-toggle="modal"
                                                    data-bs-target="#modal-move-to-emp-{{ $t->id }}">
                                                    {{ __('app.task.prog.MoveToEmp') }}
                                                </a> --}}

                                                    <button type="submit" class="btn btn-primary"
                                                        data-bs-dismiss="modal">
                                                        {{ __('app.task.prog.MoveToEmp') }}
                                                    </button>
                                                </div>
                                            </form>

                                        </div>
                                    </div>
                                </div>
                                {{--  --}}
                                <div wire:ignore.self class="modal modal-blur fade"
                                    id="modal-emp-{{ $t->id }}" tabindex="-1" role="dialog"
                                    aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">
                                                    الفني
                                                </h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row">
                                                    @if ($t->Emp)
                                                        <div class="text-center col-12 mb-3">

                                                            <h2>{{ $t->Emp->name }}</h2>
                                                            <h2> {{ $t->Emp->code }}</h2>
                                                            <h1>{{ $t->LiveTime() }}</h1>
                                                            {{-- @php
                                                                $start = new DateTime($t->emp_start_time, new DateTimeZone(config('app.timezone')));
                                                                $end = new DateTime($t->emp_end_time, new DateTimeZone(config('app.timezone')));
                                                                $diff = $start->diff($end);
                                                            @endphp
                                                            <h1>{{ $diff->format(' %h : %i : %s ') }}
                                                               ({{$end->format('%d | %h : %i : %s ')}}) 
                                                            </h1> --}}
                                                        </div>
                                                        <div class="text-center col-12 mb-3">

                                                        </div>
                                                    @endif

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--  -->
                            @endforeach
                        @else
                            <tr>
                                <td colspan="7" class="text-center">
                                    <img src="{{ url('imgs/gif/no-data.gif') }}" height="230" alt="No Data..." />
                                    <br />
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
            <div class="card-footer d-flex align-items-center">

            </div>
        </div>
    </div>
</div>
