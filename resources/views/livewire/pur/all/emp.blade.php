<div>
    <div class="col-12">
        <div class="card">
            <div class="card-body border-bottom py-3">
                <div class="d-flex">
                    <div class=" text-muted">
                        {{ __('app.pur.Code') }} :
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
                            <th>{{ __('app.pur.Code') }}</th>
                            <th>{{ __('app.pur.WShop') }}</th>
                            <th>{{ __('app.pur.Emp') }}</th>
                            <th>{{ __('app.pur.TotalItem') }}</th>
                            <th>{{ __('app.pur.time.Add') }}</th>
                            <th>{{ __('app.pur.Status') }}</th>
                            <th>..</th>

                        </tr>
                    </thead>
                    <tbody>
                        @if (count($pur) > 0)
                            @foreach ($pur as $p)
                                <tr>
                                    <td>{{ $p->id }}</td>
                                    <td>{{ $p->CBy->WShop->name }}</td>
                                    <td>{{ $p->CBy->name }}</td>
                                    <td>{{ count($p->Items) }}</td>
                                    <td>{{ $p->created_at->format(config('app.date.format')) }}</td>
                                    <td>
                                        @if ($p->main_ok == null && $p->main_ok_id == null)
                                            {{ __('app.pur.stat.AnderMain') }}
                                        @elseif ($p->main_done == 1 && $p->main_done_id == 1)
                                            {{ __('app.pur.stat.Done') }}
                                        @else
                                            {{ __('app.pur.stat.OrderTake') }}
                                        @endif
                                    </td>
                                    <td>
                                        <a
                                            href="{{ route('emp.pur.Details', $p->id) }}">{{ __('app.pur.Details') }}</a>
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
