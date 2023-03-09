<div>
    <div class="col-12">
        <div class="card">
            <div class="card-body border-bottom py-3">
                <div class="d-flex">
                    <div class=" text-muted">
                        {{ __('app.dep.Code') }} :
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
                            <th>{{ __('app.dep.Code') }}</th>
                            <th>{{ __('app.dep.Name') }}</th>
                            <th>{{ __('app.dep.N.Mang') }}</th>
                            <th>{{ __('app.dep.Level') }}</th>
                            <th>{{ __('app.dep.Details') }}</th>
                            <th>..</th>

                        </tr>
                    </thead>
                    <tbody>
                        @if (count($dep) > 0)
                            @foreach ($dep as $d)
                                <tr>
                                    <td>{{ $d->code }}</td>
                                    <td>{{ $d->name }}</td>
                                    <td>
                                        {{ $d->Mang == null ? '---' : $d->Mang->name }}
                                    </td>
                                    <td>
                                        {{ $d->level }}
                                    </td>
                                    <td>
                                        <a href="{{ route('emp.dep.Detail', $d->id) }}">{{ __('app.dep.Details') }}</a>
                                    </td>
                                    <td>
                                        <a href="{{ route('emp.dep.Edit', $d->id) }}">{{ __('app.dep.Edit') }}</a>
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
