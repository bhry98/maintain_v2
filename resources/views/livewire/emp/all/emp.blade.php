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
                            <th>{{ __('app.emp.Code') }}</th>
                            <th>{{ __('app.emp.Name') }}</th>
                            <th>{{ __('app.emp.Email') }}</th>
                            <th>{{ __('app.emp.N.Mang') }}</th>
                            <th>{{ __('app.emp.N.Ws') }}</th>
                            <th>{{ __('app.emp.Details') }}</th>
                            <th>..</th>

                        </tr>
                    </thead>
                    <tbody>
                        @if (count($emp) > 0)
                            @foreach ($emp as $e)
                                <tr>


                                    <td>{{ $e->code }}</td>
                                    <td>{{ $e->name }}</td>
                                    <td>
                                        {{ $e->email }}
                                    </td>
                                    <td>
                                        {{ $e->Mang == null ? '---' : $e->Mang->name }}
                                    </td>
                                    <td>
                                        {{ $e->WShop == null ? '---' : $e->WShop->name }}
                                    </td>
                                    <td>
                                        <a href="{{ route('emp.emp.Detail', $e->code) }}">{{ __('app.emp.Details') }}</a>
                                    </td>
                                    <td>
                                        <a href="{{ route('emp.emp.Edit', $e->code) }}">{{ __('app.emp.Edit') }}</a>
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
