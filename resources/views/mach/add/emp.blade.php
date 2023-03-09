@extends('layout.index')
@section('title')
    {{ __('app.mach.AddNew') }}
@endsection
@section('pagetitle')
    {{ __('app.mach.AddNew') }}
@endsection
@section('page')
    <div class="row row-cards">
        <div class="col-12">
            <form action="{{ route('emp.mach.Add') }}" method="post" class="card">
                @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="row mb-3">
                            {{-- name --}}
                            <div class="col-6 mb-3">
                                <label class="form-label required">{{ __('app.mach.N.Name') }}</label>
                                <input type="text" name="name"
                                    class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}">
                                @error('name')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                           
                            {{-- code --}}
                            <div class="col-6 mb-3">
                                <label class="form-label required">{{ __('app.mach.Code') }}</label>
                                <input type="text" name="code"
                                    class="form-control @error('code') is-invalid @enderror" value="{{ old('name') }}">
                                @error('code')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                           
                            {{-- dep --}}
                            <div class="col-6 mb-3">
                                <label class="form-label required">{{ __('app.mach.N.Dep') }}</label>
                                <select type="text" name="dep"
                                    class="form-control @error('dep') is-invalid @enderror" id="select-emp">
                                    <option value="">...</option>
                                    @foreach ($dep as $e)
                                        <option value="{{ $e->id }}">
                                            {{ $e->name }} |
                                            {{ $e->code }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('dep')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-12 mb-3">
                                <label class="form-label ">{{ __('app.mach.Note') }}</label>
                                <textarea name="note" class="form-control @error('note') is-invalid @enderror" value="{{ old('note') }}"></textarea>
                                @error('note')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-2 mx-auto">
                                <button onclick="_submit()" id="btn" type="submit"
                                    class="btn btn-primary btn-pill w-100">
                                    <b>
                                        {{ __('app.mach.Add') }}
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
    </script>
@endsection
