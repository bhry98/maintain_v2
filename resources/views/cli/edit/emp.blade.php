@extends('layout.index')
@section('title')
    {{ __('app.cli.Edit') }}
@endsection
@section('pagetitle')
    {{ __('app.cli.Edit') }}
@endsection

@section('page')
    <div class="row row-cards">
        <div class="col-12">
            <form action="{{ route('emp.cli.Edit', $cli->code) }}" method="post" class="card">
                @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="row mb-3">
                            {{-- name --}}
                            <div class="col-6 mb-3">
                                <label class="form-label required">{{ __('app.cli.Name') }}</label>
                                <input type="text" name="name" autofocus
                                    class="form-control @error('name') is-invalid @enderror" value="{{ $cli->name }}">
                                @error('name')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                            {{-- dep --}}
                            <div class="col-6 mb-3">
                                <label class="form-label required">{{ __('app.cli.N.D') }}</label>
                                <select type="text" name="dep[]" multiple
                                    class="form-control @error('dep') is-invalid @enderror" id="select-dep">
                                    <option value="">...</option>
                                    @foreach ($dep as $e)
                                        @foreach ($cli->dep_id as $v)
                                            <option value="{{ $e->id }}"
                                                @if ($v == $e->id) selected @endif>
                                                {{ $e->name }} |
                                                {{ $e->code }}
                                            </option>
                                        @endforeach
                                    @endforeach
                                </select>
                                @error('dep')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                            {{-- emp --}}
                            <div class="col-6 mb-3">
                                <label class="form-label required">{{ __('app.cli.N.Mang') }}</label>
                                <select type="text" name="emp"
                                    class="form-control @error('emp') is-invalid @enderror" id="select-mang">
                                    <option value="">...</option>
                                    @foreach ($clie as $e)
                                        <option value="{{ $e->id }}"
                                            @if ($cli->mang_id == $e->id) selected @endif>
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
                                <label class="form-label required">{{ __('app.cli.Code') }}</label>
                                <input type="text" name="code"
                                    class="form-control @error('code') is-invalid @enderror" value="{{ $cli->code }}">
                                @error('code')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                            {{-- email --}}
                            <div class="col-6 mb-3">
                                <label class="form-label required">{{ __('app.cli.Email') }}</label>
                                <input type="text" name="email"
                                    class="form-control @error('email') is-invalid @enderror" value="{{ $cli->email }}">
                                @error('email')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                            {{-- username --}}
                            <div class="col-6 mb-3">
                                <label class="form-label required">{{ __('app.cli.Username') }}</label>
                                <input type="text" name="username"
                                    class="form-control @error('username') is-invalid @enderror"
                                    value="{{ $cli->username }}">
                                @error('username')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                            {{-- password --}}
                            <div class="col-6 mb-3">
                                <label class="form-label required">{{ __('app.cli.Password') }}</label>
                                <input type="password" name="password"
                                    class="form-control @error('password') is-invalid @enderror"
                                    value="{{ old('password') }}">
                                @error('password')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                            {{-- is_mang --}}
                            <div class="col-6 mb-3">
                                <label class="form-label required">{{ __('app.cli.Type') }}</label>
                                <select name="is_mang" class="form-control @error('is_mang') is-invalid @enderror">
                                    @foreach (__('app.select.cli-type') as $k => $v)
                                        <option value="{{ $k }}"
                                            @if ($cli->is_mang == $k) selected @endif>
                                            {{ $v }}</option>
                                    @endforeach
                                </select>
                                @error('is_mang')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                            {{-- Active --}}
                            <div class="col-6 mb-3">
                                <label class="form-label required">{{ __('app.cli.Active') }}</label>
                                <select name="active" class="form-control @error('is_mang') is-invalid @enderror">
                                    @foreach (__('app.select.acc-active') as $k => $v)
                                        <option value="{{ $k }}"
                                            @if ($cli->is_mang == $k) selected @endif>
                                            {{ $v }}</option>
                                    @endforeach
                                </select>
                                @error('active')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                            {{-- قخمث --}}
                            <div class="col-6 mb-3">
                                <label class="form-label required">{{ __('app.cli.Role') }}</label>
                                <select type="text" name="role"
                                    class="form-control @error('role') is-invalid @enderror" id="select-role">
                                    <option value="">...</option>
                                    @foreach ($role as $e)
                                        <option value="{{ $e->id }}"
                                            @if ($cli->is_mang == $e->id) selected @endif>
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
                                        {{ __('app.cli.Edit') }}
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
