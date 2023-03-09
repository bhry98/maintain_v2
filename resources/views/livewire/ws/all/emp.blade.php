<div>
    <div class="col-12">
        <div class="card">
            <div class="card-body border-bottom py-3">
                {{-- <div class="d-flex">
                    <div class=" text-muted">
                        {{ __('app.role.Code') }} :
                        <div class="ms-2 d-inline-block">
                            <input autofocus type="text" wire:model='search' class="form-control form-control-sm">
                        </div>
                    </div>
                </div> --}}
            </div>
            <div class="table-responsive">
                <table class="table card-table table-vcenter text-nowrap datatable">
                    <thead>
                        <tr>
                            <th>{{ __('app.ws.Code') }}</th>
                            <th>{{ __('app.ws.Name') }}</th>
                            <th>{{ __('app.ws.N.Mang') }}</th>
                            <th>{{ __('app.ws.T.Emp') }}</th>
                            <th>{{ __('app.ws.Details') }}</th>
                            <th>..</th>

                        </tr>
                    </thead>
                    <tbody>
                        @if (count($ws) > 0)
                            @foreach ($ws as $w)
                                <tr>
                                    <td>{{ $w->id }}</td>
                                    <td>{{ $w->name }}</td>
                                    <td>
                                        {{ $w->Mang->name }}
                                    </td>
                                    <td>
                                        {{ $w->Emps }}
                                    </td>
                                    <td>
                                        <a href="{{ route('emp.ws.Detail', $w->id) }}">{{ __('app.ws.Details') }}</a>
                                    </td>
                                    <td>
                                        <a href="{{ route('emp.ws.Edit', $w->id) }}">{{ __('app.ws.Edit') }}</a>
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
