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
                            <th>{{ __('app.task.table.Mang') }}</th>
                            {{-- <th>..</th> --}}

                        </tr>
                    </thead>
                    <tbody wire:poll.1s>

                        {{-- {{dd($task)}} --}}
                        @if (count($task) > 0)
                            @foreach ($task as $t)
                                <tr>
                                    <td>{{ $t->id }}
                                        @if ($t->task_id)
                                            ({{ $t->task_id }})
                                        @endif
                                    </td>
                                    <td>{{ $t->Dep->name }}</td>
                                    @if ($t->task_id == null)
                                        <td>{{ $t->Client->name }}</td>
                                    @else
                                        <td>{{ $t->EmpH->name }}</td>
                                    @endif
                                    <td>{{ $t->order_time->format(config('app.date.format')) }}</td>
                                    <td>{!! $t->Status($t->status) !!}</td>
                                    {{-- <td>
                                        @if ($t->WShop == null)
                                            <a href="#" data-bs-toggle="modal"
                                                data-bs-target="#modal-move-{{ $t->id }}">
                                                {{ __('app.task.ws.Move') }}
                                            </a>
                                        @elseif ($t->WShop != null && $t->emp_ok == null)
                                            <a href="#" data-bs-toggle="modal"
                                                data-bs-target="#modal-move-{{ $t->id }}">
                                                {{ $t->WShop->name }}
                                            </a>
                                            ||
                                            <a href="#" data-bs-toggle="modal"
                                                data-bs-target="#modal-move-to-emp-{{ $t->id }}">
                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                    class="icon icon-tabler icon-tabler-chevrons-up-left" width="24"
                                                    height="24" viewBox="0 0 24 24" stroke-width="2"
                                                    stroke="currentColor" fill="none" stroke-linecap="round"
                                                    stroke-linejoin="round">
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
                                    </td> --}}
                                    <td>
                                        @if ($t->WShop)
                                            @if ($t->emp_ok && $t->emp_start_time)
                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                    class="icon icon-tabler icon-tabler-lock" width="24"
                                                    height="24" viewBox="0 0 24 24" stroke-width="2"
                                                    stroke="currentColor" fill="none" stroke-linecap="round"
                                                    stroke-linejoin="round">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                    <path
                                                        d="M5 11m0 2a2 2 0 0 1 2 -2h10a2 2 0 0 1 2 2v6a2 2 0 0 1 -2 2h-10a2 2 0 0 1 -2 -2z">
                                                    </path>
                                                    <path d="M12 16m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0"></path>
                                                    <path d="M8 11v-4a4 4 0 0 1 8 0v4"></path>
                                                </svg>
                                                {{ $t->WShop->name }}
                                                ({{ $t->Emp == null ? '---' : $t->Emp->username }})
                                            @else
                                                <a href="#" data-bs-toggle="modal"
                                                    data-bs-target="#move-{{ $t->id }}">
                                                    {{ $t->WShop->name }}
                                                    ({{ $t->Emp == null ? '---' : $t->Emp->username }})
                                                </a>
                                            @endif
                                        @else
                                            <a href="#" data-bs-toggle="modal"
                                                data-bs-target="#move-{{ $t->id }}">
                                                {{ __('app.task.ws.Move') }}
                                            </a>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('emp.task.Detail', $t->id) }}">
                                            {{ __('app.task.Details') }}
                                        </a>
                                    </td>
                                    {{-- <td>
                                        {{ $emp }}
                                    </td> --}}
                                </tr>


                                <!--  -->
                                <div wire:ignore.self class="modal modal-blur fade" id="move-{{ $t->id }}"
                                    tabindex="-1" role="dialog" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">
                                                    {{ __('app.task.ws.Move') }}
                                                </h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <form wire:submit.prevent="MoveTask({{ $t->id }})">
                                                <div class="modal-body">
                                                    <div class="col-12 mb-12">
                                                        <label class="form-label">{{ __('app.ws.Name') }}</label>
                                                        <select class="form-control" wire:model='GetSelectEmp'>
                                                            <option value="">.....</option>
                                                            @foreach ($ws as $w)
                                                                <option value="{{ $w->id }}">
                                                                    {{ $w->name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <br>
                                                    @if (!is_null($GetSelectEmp))
                                                        <div class="col-12 mb-12">
                                                            <label class="form-label">{{ __('app.ws.Name') }}</label>
                                                            <select class="form-control" wire:model='select_emp'>
                                                                <option value="">.....</option>
                                                                @foreach ($emp as $e)
                                                                    <option value="{{ $e->id }}">
                                                                        {{ $e->name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    @endif
                                                </div>

                                                <div class="modal-footer text-center">
                                                    <button type="submit" class="btn btn-primary"
                                                        data-bs-dismiss="modal">
                                                        {{ __('app.task.ws.Move') }}
                                                    </button>
                                                </div>
                                            </form>

                                        </div>
                                    </div>
                                </div>
                                <!--  -->
                                <div wire:ignore.self class="modal modal-blur fade" id="modal-move-{{ $t->id }}"
                                    tabindex="-1" role="dialog" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">
                                                    {{ __('app.task.ws.Move') }}
                                                </h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <form wire:submit.prevent="MoveTo({{ $t->id }})">
                                                <div class="modal-body">
                                                    <input type="hidden" name="task" value="{{ $t->id }}">
                                                    <div class="col-12 mb-12">
                                                        <label class="form-label">{{ __('app.ws.Name') }}</label>
                                                        <select class="form-control" wire:model='ws_id_select'>
                                                            <option value="">.....</option>
                                                            @foreach ($ws as $w)
                                                                <option value="{{ $w->id }}">
                                                                    {{ $w->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>

                                                </div>

                                                <div class="modal-footer text-center">
                                                    <button type="submit" class="btn btn-primary"
                                                        data-bs-dismiss="modal">
                                                        {{ __('app.task.ws.Move') }}
                                                    </button>
                                                </div>
                                            </form>

                                        </div>
                                    </div>
                                </div>
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
                                                    <input type="hidden" name="task"
                                                        value="{{ $t->id }}">
                                                    <div class="col-12 mb-12">
                                                        <label class="form-label">{{ __('app.emp.Name') }}</label>
                                                        <select class="form-control" wire:model='emp_id_select'>
                                                            <option value="">.....</option>
                                                            @if ($t->workshop_id && $t->workshop_id != null)
                                                                @foreach ($t->WShop->Emps as $e)
                                                                    <option value="{{ $e->id }}">
                                                                        {{ $e->name }}
                                                                    </option>
                                                                @endforeach
                                                                {{-- @foreach ($emp as $e)
                                                                <option value="">{{$e->workshop_id}}</option>
                                                                    @if ($t->workshop_id == $e->workshop_id)
                                                                        <option value="{{ $e->id }}">
                                                                            {{ $e->name }}
                                                                        </option>
                                                                    @endif
                                                                @endforeach --}}
                                                            @endif

                                                        </select>
                                                    </div>

                                                </div>

                                                <div class="modal-footer text-center">
                                                    <button type="submit" class="btn btn-primary"
                                                        data-bs-dismiss="modal">
                                                        {{ __('app.task.ws.Move') }}
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
                                                        <div class="col-12 mb-3">
                                                            <label
                                                                class="form-label">{{ __('app.task.N.Emp') }}</label>
                                                            <h2>{{ $t->Emp->name }}</h2>
                                                            <h2> {{ $t->Emp->code }}</h2>

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
