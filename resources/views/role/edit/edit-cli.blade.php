@extends('layout.index')
@section('title')
    {{ __('app.role.EditCli') }}
@endsection
@section('pagetitle')
    {{ __('app.role.EditCli') }}
@endsection
@section('page')
    <form method="POST" action="{{ route('emp.role.ChengRole') }}" class="row row-cards col-12 card">
        @csrf
        <div class="row mb-3 card-body">
            {{-- emp --}}
            <div class="col-6 mb-3">
                <label class="form-label required">{{ __('app.role.N.Emp') }}</label>
                <input type="hidden" name="type" value="cli">
                <select name="emp" id="select-emp" class="form-control @error('emp') is-invalid @enderror">
                    <option value="">....</option>
                    @foreach ($cli as $E)
                        <option value="{{ $E->code }}">{{ $E->name }} | ({{ $E->code }})</option>
                    @endforeach
                </select>
                @error('emp')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
            {{-- role --}}
            <div class="col-6 mb-3">
                <label class="form-label required">{{ __('app.role.Name') }}</label>
                <select name="role" id="select-role" class="form-control @error('role') is-invalid @enderror">
                    <option value="">....</option>

                    @foreach ($role as $R)
                        <option value="{{ $R->id }}">{{ $R->name[$Local] }} | ({{ $R->code }})</option>
                    @endforeach
                </select>
                @error('role')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
            <div class="col-12 text-center">
                <button type="submit" onclick="_submit()" id="btn" class="btn btn-azure">
                    {{ __('app.role.Edit') }}
                </button>
            </div>
        </div>
    </form>
@endsection
@section('js')
    <script src="{{ url('/assets/js/select.js') }}"></script>
    <script>
        // @formatter:off
        document.addEventListener("DOMContentLoaded", function() {
            var el;
            window.TomSelect && (new TomSelect(el = document.getElementById('select-emp'), {
                copyClassesToDropdown: false,
                dropdownClass: 'dropdown-menu ts-dropdown',
                optionClass: 'dropdown-item',
                controlInput: '<input>',
                render: {
                    item: function(data, escape) {
                        if (data.customProperties) {
                            return '<div><span class="dropdown-item-indicator">' + data
                                .customProperties + '</span>' + escape(data.text) + '</div>';
                        }
                        return '<div>' + escape(data.text) + '</div>';
                    },
                    option: function(data, escape) {
                        if (data.customProperties) {
                            return '<div><span class="dropdown-item-indicator">' + data
                                .customProperties + '</span>' + escape(data.text) + '</div>';
                        }
                        return '<div>' + escape(data.text) + '</div>';
                    },
                },
            }));
        });
        // @formatter:on
        // @formatter:off
        document.addEventListener("DOMContentLoaded", function() {
            var el;
            window.TomSelect && (new TomSelect(el = document.getElementById('select-role'), {
                copyClassesToDropdown: false,
                dropdownClass: 'dropdown-menu ts-dropdown',
                optionClass: 'dropdown-item',
                controlInput: '<input>',
                render: {
                    item: function(data, escape) {
                        if (data.customProperties) {
                            return '<div><span class="dropdown-item-indicator">' + data
                                .customProperties + '</span>' + escape(data.text) + '</div>';
                        }
                        return '<div>' + escape(data.text) + '</div>';
                    },
                    option: function(data, escape) {
                        if (data.customProperties) {
                            return '<div><span class="dropdown-item-indicator">' + data
                                .customProperties + '</span>' + escape(data.text) + '</div>';
                        }
                        return '<div>' + escape(data.text) + '</div>';
                    },
                },
            }));
        });
        // @formatter:on
    </script>
@endsection
