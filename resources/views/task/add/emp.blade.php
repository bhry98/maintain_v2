@extends('layout.index')
@section('title')
    {{ __('app.task.h.AddNew') }}
@endsection
@section('pagetitle')
    {{ __('app.task.h.AddNew') }}
    {{ $ot }}
@endsection

@section('page')
    <div class="row row-cards">
        <div class="col-12">
            <form action="{{ route('emp.task.Add') }}" method="post" class="card">
                @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="row mb-3">
                            {{-- task --}}
                            <div class="col-6 mb-3">
                                <label class="form-label required">{{ __('app.task.Name') }}</label>
                                <select type="text" name="task"
                                    class="form-control @error('task') is-invalid @enderror" id="select-dep">
                                    <option value="">...</option>
                                    @foreach ($task as $e)
                                        <option value="{{ $e->id }}">
                                            {{ $e->tittle }} |
                                            {{ $e->id }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('task')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                            {{-- tittle --}}
                            <div class="col-6 mb-3">
                                <label class="form-label required">{{ __('app.task.h.Tittle') }}</label>
                                <input type="text" name="tittle" autofocus
                                    class="form-control @error('tittle') is-invalid @enderror" value="{{ old('tittle') }}">
                                @error('tittle')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                            {{-- صس --}}
                            <div class="col-6 mb-3">
                                <label class="form-label required">{{ __('app.ws.Name') }}</label>
                                <select type="text" name="ws" class="form-control @error('ws') is-invalid @enderror"
                                    id="select-dep">
                                    <option value="">...</option>
                                    @foreach ($ws as $e)
                                        <option value="{{ $e->id }}">
                                            {{ $e->name }} |
                                            {{ $e->id }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('ws')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-3 mb-3">
                                <label class="form-label ">{{ __('app.task.N.Emp') }}</label>
                                <input readonly type="text" value="{{ $User->name }}" class="form-control">
                            </div>
                            <div class="col-3 mb-3">
                                <label class="form-label ">{{ __('app.task.N.EmpCode') }}</label>
                                <input readonly type="text" value="{{ $User->code }}" class="form-control">

                            </div>
                            <div class="col-12 mb-3">
                                <label class="form-label required">{{ __('app.task.h.details') }}</label>
                                <textarea name="detail" class="form-control @error('detail') is-invalid @enderror" value="{{ old('detail') }}"></textarea>
                                @error('detail')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-2 mx-auto">
                                <button onclick="_submit()" id="btn" type="submit"
                                    class="btn btn-primary btn-pill w-100">
                                    <b>
                                        {{ __('app.task.h.Add') }}
                                    </b>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('js')
    <script src="{{ url('assets/js/select.js') }}"></script>
    <script>
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
        // @formatter:off
        document.addEventListener("DOMContentLoaded", function() {
            var el;
            window.TomSelect && (new TomSelect(el = document.getElementById('select-dep'), {
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
            window.TomSelect && (new TomSelect(el = document.getElementById('select-mang'), {
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
