<div>
    <div class="col-12">
        <div class="card">
            <div class="card-body border-bottom py-3">
                <div class="d-flex">
                    <div class=" text-muted">
                        {{ __('app.role.Code') }} :
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
                            <th>{{ __('app.role.Code') }}</th>
                            <th>{{ __('app.role.Name') }}</th>
                            <th>{{ __('app.role.T.P') }}</th>
                            <th>{{ __('app.role.T.Emp') }}</th>
                            <th>{{ __('app.role.Details') }}</th>
                            <th>..</th>

                        </tr>
                    </thead>
                    <tbody>
                        @if (count($roles) > 0)
                            @foreach ($roles as $r)
                                <tr>
                                    <td>{{ $r->code }}</td>
                                    <td><a href="invoice.html" class="text-reset" tabindex="-1">Design Works</a></td>
                                    <td>
                                        {{ count($r->permission) }}
                                    </td>
                                    <td>
                                        {{ $r->Emps }}
                                    </td>
                                    <td>
                                        <a
                                            href="{{ route('emp.role.Detail', $r->code) }}">{{ __('app.role.Details') }}</a>
                                    </td>
                                    <td>
                                        <a href="{{ route('emp.role.Edit', $r->code) }}">{{ __('app.role.Edit') }}</a>
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
