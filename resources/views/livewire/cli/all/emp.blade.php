<div>
    <div class="col-12">
        <div class="card">
            <div class="card-body border-bottom py-3">
                <div class="d-flex">
                    <div class=" text-muted">
                        {{ __('app.cli.Code') }} :
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
                            <th>{{ __('app.cli.Code') }}</th>
                            <th>{{ __('app.cli.Name') }}</th>
                            <th>{{ __('app.cli.Email') }}</th>
                            <th>{{ __('app.cli.N.Mang') }}</th>
                            <th>{{ __('app.cli.T.Dep') }}</th>
                            <th>{{ __('app.cli.Details') }}</th>
                            <th>..</th>

                        </tr>
                    </thead>
                    <tbody>
                        @if (count($cli) > 0)
                            @foreach ($cli as $c)
                                <tr>


                                    <td>{{ $c->code }}</td>
                                    <td>{{ $c->name }}</td>
                                    <td>
                                        {{ $c->email }}
                                    </td>
                                    <td>
                                        {{ $c->Mang == null ? '---' : $c->Mang->name }}
                                    </td>
                                    <td>
                                        {{ count($c->dep_id) }}
                                    </td>

                                    <td>
                                        <a
                                            href="{{ route('emp.cli.Detail', $c->code) }}">{{ __('app.cli.Details') }}</a>
                                    </td>
                                    <td>
                                        <a href="{{ route('emp.cli.Edit', $c->code) }}">{{ __('app.cli.Edit') }}</a>
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
