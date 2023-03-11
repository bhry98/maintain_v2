@extends('layout.index')
@section('title')
    {{ __('app.emp.AddNew') }}
@endsection
@section('pagetitle')
    {{ __('app.emp.AddNew') }}
@endsection
@section('page')
    <div class="row row-cards">
        <div class="col-12">
            <form action="{{ route('emp.emp.Edit', $emp->code) }}" method="post" class="card">
                @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="row mb-3">
                            {{-- name --}}
                            <div class="col-6 mb-3">
                                <label class="form-label required">{{ __('app.emp.Name') }}</label>
                                <input type="text" name="name" autofocus
                                    class="form-control @error('name') is-invalid @enderror" value="{{ $emp->name }}">
                                @error('name')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            {{-- dep --}}
                            <div class="col-6 mb-3">
                                <label class="form-label required">{{ __('app.emp.N.Ws') }}</label>
                                <select type="text" name="dep"
                                    class="form-control @error('dep') is-invalid @enderror" id="select-dep">
                                    <option value="">...</option>
                                    @foreach ($ws as $e)
                                        <option value="{{ $e->id }}"
                                            @if ($emp->workshop_id == $e->id) selected @endif>
                                            {{ $e->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('dep')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                            {{-- emp --}}
                            <div class="col-6 mb-3">
                                <label class="form-label required">{{ __('app.emp.N.Mang') }}</label>
                                <select type="text" name="emp"
                                    class="form-control @error('emp') is-invalid @enderror" id="select-mang">
                                    <option value="">...</option>
                                    @foreach ($man as $e)
                                        <option value="{{ $e->id }}"
                                            @if ($emp->mang_id == $e->id) selected @endif>
                                            {{ $e->name }} |
                                            {{ $e->code }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('emp')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                            {{-- code --}}
                            <div class="col-6 mb-3">
                                <label class="form-label required">{{ __('app.emp.Code') }}</label>
                                <input type="text" name="code"
                                    class="form-control @error('code') is-invalid @enderror" value="{{ $emp->code }}">
                                @error('code')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                            {{-- email --}}
                            <div class="col-6 mb-3">
                                <label class="form-label required">{{ __('app.emp.Email') }}</label>
                                <input type="text" name="email"
                                    class="form-control @error('email') is-invalid @enderror" value="{{ $emp->email }}">
                                @error('email')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                            {{-- username --}}
                            <div class="col-6 mb-3">
                                <label class="form-label required">{{ __('app.emp.Username') }}</label>
                                <input type="text" name="username"
                                    class="form-control @error('username') is-invalid @enderror"
                                    value="{{ $emp->username }}">
                                @error('username')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                            {{-- password --}}
                            <div class="col-6 mb-3">
                                <label class="form-label required">{{ __('app.emp.Password') }}</label>
                                <input type="password" name="password"
                                    class="form-control @error('password') is-invalid @enderror"
                                    value="{{ old('password') }}">
                                @error('password')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                            {{-- is_mang --}}
                            <div class="col-6 mb-3">
                                <label class="form-label required">{{ __('app.emp.Type') }}</label>
                                <select name="is_mang" class="form-control @error('is_mang') is-invalid @enderror">
                                    @foreach (__('app.select.emp-type') as $k => $v)
                                        <option value="{{ $k }}" @if ($emp->is_mang == $k) selected @endif>
                                            {{ $v }}</option>
                                    @endforeach
                                </select>
                                @error('is_mang')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                            {{-- Active --}}
                            <div class="col-6 mb-3">
                                <label class="form-label required">{{ __('app.emp.Active') }}</label>
                                <select name="active" class="form-control @error('active') is-invalid @enderror">
                                    @foreach (__('app.select.acc-active') as $k => $v)
                                        <option value="{{ $k }}" @if ($emp->active == $k) selected @endif>{{ $v }}</option>
                                    @endforeach
                                </select>
                                @error('active')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                            {{-- role --}}
                            <div class="col-6 mb-3">
                                <label class="form-label required">{{ __('app.emp.Role') }}</label>
                                <select type="text" name="role"
                                    class="form-control @error('role') is-invalid @enderror" id="select-role">
                                    <option value="">...</option>
                                    @foreach ($role as $e)
                                        <option value="{{ $e->id }}" @if ($emp->role_id == $e->id) selected @endif>
                                            {{ $e->name[$Local] }} |
                                            {{ $e->code }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('role')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-2 mx-auto">
                                <button onclick="_submit()" id="btn" type="submit"
                                    class="btn btn-primary btn-pill w-100">
                                    <b>
                                        {{ __('app.emp.Edit') }}
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
