<div>
    <div class="col-12">
        <div class="card">
            <div class="card-body border-bottom py-3">
                <div class="d-flex">
                    <div class=" text-muted">
                        {{ __('app.mach.Code') }} :
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
                            <th>{{ __('app.mach.table.Code') }}</th>
                            <th>{{ __('app.mach.table.Name') }}</th>
                            <th>{{ __('app.mach.table.Dep') }}</th>
                            <th>{{ __('app.mach.table.TTask') }}</th>
                            <th>..</th>
                            <th>..</th>

                        </tr>
                    </thead>
                    <tbody>
                        @if (count($mach) > 0)
                            @foreach ($mach as $m)
                                <tr>
                                    <td>{{ $m->code }}</td>
                                    <td>{{ $m->name }}</td>
                                    <td>{{ $m->Dep->name }}</td>
                                    <td>{{ count($m->Tasks) }}</td>
                                    <td>
                                        <a
                                            href="{{ route('emp.mach.Details', $m->code) }}">{{ __('app.mach.Details') }}</a>
                                    </td>
                                    <td>
                                        <a
                                            href="{{ route('emp.mach.Edit', $m->code) }}">{{ __('app.mach.Edit') }}</a>
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
