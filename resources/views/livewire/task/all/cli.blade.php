<div wire:poll.5000ms>
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
                    <tbody>
                        @if (count($task) > 0)
                            {{-- {{dd($task)}} --}}
                            @foreach ($task as $t)
                                <tr>
                                    <td>{{ $t->id }}</td>
                                    <td>{{ $t->Dep->name }}</td>
                                    <td>{{ $t->Client->name }}</td>
                                    <td>{{ $t->order_time->format(config('app.date.format')) }}</td>
                                    <td>{!! $t->Status($t->status) !!}</td>
                                    <td>{{ $t->WShop == null ? '--' : $t->WShop->name }}</td>
                                    <td>
                                        <a href="{{ route('cli.task.Details', $t->id) }}">{{ __('app.task.Details') }}</a>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="6" class="text-center">
                                    <img src="{{ url('imgs/gif/no-data.gif') }}" height="230" alt="No Data..." />
                                    <br />
                                    {{-- {{ F }} --}}
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
